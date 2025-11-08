#!/usr/bin/env node
/*
 * Auto-detect and watch all themes' SCSS → CSS using Dart Sass.
 * Usage: npm run watch:all
 */

const fs = require("fs");
const path = require("path");
const { spawn } = require("child_process");

const THEMES_ROOT = path.resolve(__dirname, "..", "theme02", "wp-content", "themes");
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

function findThemes(root) {
  if (!isDir(root)) return [];
  return fs
    .readdirSync(root)
    .map((name) => ({ name, dir: path.join(root, name) }))
    .filter(({ dir }) => isDir(dir));
}

function spawnWatcher(theme) {
  const scssDir = path.join(theme.dir, "assets", "scss");
  const cssDir = path.join(theme.dir, "assets", "css");

  if (!isDir(scssDir)) {
    console.log(`[건너뜀] ${theme.name}: 'assets/scss' 디렉터리가 없습니다.`);
    return null;
  }

  ensureDir(cssDir);

  const args = [
    "--style=compressed",
    "--update",
    "--watch",
    `${scssDir}:${cssDir}`,
  ];

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
  console.log(`[정보] 테마 경로: ${THEMES_ROOT}`);
  const themes = findThemes(THEMES_ROOT);
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

