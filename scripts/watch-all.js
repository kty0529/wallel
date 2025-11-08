#!/usr/bin/env node
/*
 * 모든 테마의 SCSS를 자동 탐지하여 CSS로 감시/빌드합니다.
 * 사용법:
 *   - 개발 모드(기본): NODE_ENV=development npm run watch
 *   - 배포 모드:        NODE_ENV=production npm run watch
 *   - 특정 테마만:      THEME=theme02 npm run watch
 *   - 복수 테마:        THEME=theme02,theme02-refactor npm run watch
 *   - 감시 제외:        THEME_IGNORE=theme01,experimental npm run watch
 * 
 * 개선점:
 *   - 루트 레벨 테마 디렉터리 자동 탐지
 *   - THEME 환경변수로 대상 테마 필터링 지원
 *   - THEME_IGNORE 환경변수로 특정 테마 감시 제외
 *   - 개발/배포 모드에 맞춘 Sass 옵션 자동 전환
 */

const fs = require("fs");
const path = require("path");
const { spawn } = require("child_process");

const REPO_ROOT = path.resolve(__dirname, "..");
const sassBin = process.env.SASS_BIN || "sass"; // 기본적으로 전역 sass를 사용합니다.

function isDir(p) {
  try {
    return fs.statSync(p).isDirectory();
  } catch (_) {
    return false;
  }
}

function ensureDir(p) {
  try {
    fs.mkdirSync(p, { recursive: true });
  } catch (_) {
    /* no-op */
  }
}

function findThemes() {
  // 리포지토리 루트의 1뎁스 디렉터리 중 워드프레스 테마로 보이는 경로
  // 판별 기준: 디렉터리이며, 루트에 style.css가 존재하거나 assets/scss가 존재
  const candidates = fs
    .readdirSync(REPO_ROOT)
    .map((name) => ({ name, dir: path.join(REPO_ROOT, name) }))
    .filter(({ name, dir }) =>
      // 불필요/시스템 디렉터리 제외
      ![".git", ".vscode", "node_modules", "scripts", "common"].includes(name) &&
      isDir(dir)
    )
    .map(({ name, dir }) => ({
      name,
      dir,
      hasStyle: fs.existsSync(path.join(dir, "style.css")),
      hasScss: isDir(path.join(dir, "assets", "scss")),
    }))
    .filter((t) => t.hasStyle || t.hasScss)
    .sort((a, b) => Number(b.hasScss) - Number(a.hasScss));

  return candidates.map(({ name, dir }) => ({ name, dir }));
}

function buildSassArgs({ scssDir, cssDir }) {
  const isProd = (process.env.NODE_ENV || "development") === "production" ||
                 (process.env.SASS_MODE || "").toLowerCase() === "prod";

  if (isProd) {
    // 배포 권장 옵션
    return [
      "--style=compressed",
      "--no-source-map",
      "--no-error-css",
      "--update",
      "--watch",
      `${scssDir}:${cssDir}`,
    ];
  }
  // 개발 권장 옵션
  return [
    "--style=expanded",
    "--embed-source-map",
    "--embed-sources",
    "--quiet-deps",
    "--update",
    "--watch",
    `${scssDir}:${cssDir}`,
  ];
}

function spawnWatcher(theme) {
  const scssDir = path.join(theme.dir, "assets", "scss");
  const cssDir = path.join(theme.dir, "assets", "css");

  if (!isDir(scssDir)) {
    console.log(`[건너뜀] ${theme.name}: 'assets/scss' 디렉터리가 없습니다.`);
    return null;
  }

  ensureDir(cssDir);

  const args = buildSassArgs({ scssDir, cssDir });

  console.log(`[시작] ${theme.name}: sass ${args.join(" ")}`);
  const child = spawn(sassBin, args, { stdio: "inherit" });
  child.on("exit", (code, signal) => {
    console.log(`[종료] ${theme.name}: code=${code} signal=${signal ?? "none"}`);
  });
  child.on("error", (err) => {
    console.error(`[오류] ${theme.name}:`, err.message);
  });
  return child;
}

function main() {
  const filterRaw = (process.env.THEME || "").trim();
  const ignoreRaw = (process.env.THEME_IGNORE || "").trim();
  const DEFAULT_IGNORE = ["theme01"]; // 기본적으로 theme01은 감시 제외

  const filters = filterRaw
    ? filterRaw.split(",").map((s) => s.trim()).filter(Boolean)
    : [];
  const ignores = [
    ...DEFAULT_IGNORE,
    ...(ignoreRaw ? ignoreRaw.split(",").map((s) => s.trim()).filter(Boolean) : []),
  ];

  const themesAll = findThemes();
  const themesUnignored = themesAll.filter((t) => !ignores.includes(t.name));
  const themes = filters.length
    ? themesUnignored.filter((t) => filters.includes(t.name))
    : themesUnignored;

  console.log(`[정보] 감지된 테마: ${themesAll.map((t) => t.name).join(", ") || "없음"}`);
  if (ignores.length) {
    console.log(`[정보] 제외(THEME_IGNORE+DEFAULT): ${ignores.join(", ")}`);
  }
  if (filters.length) {
    console.log(`[정보] 필터(THEME) 적용: ${filters.join(", ")}`);
  }
  if (themes.length === 0) {
    console.log("[경고] 감시할 테마를 찾지 못했습니다.");
    process.exit(1);
  }

  const children = themes
    .map(spawnWatcher)
    .filter(Boolean);

  if (children.length === 0) {
    console.log("[경고] 감시 가능한 테마가 없습니다.");
    process.exit(1);
  }

  // 종료 신호 처리: 하위 프로세스 정리
  const shutdown = () => {
    console.log("[정보] 종료 신호를 받아 감시 프로세스를 정리합니다.");
    children.forEach((c) => {
      try {
        c.kill();
      } catch (_) {}
    });
    process.exit(0);
  };
  process.on("SIGINT", shutdown);
  process.on("SIGTERM", shutdown);
}

main();
