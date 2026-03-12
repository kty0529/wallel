# Repository Guidelines

## 문서 계층 및 우선순위

- 기본 지침은 루트 `AGENTS.md`를 따릅니다(본 문서).
- 각 폴더 내 `AGENTS.md`는 해당 폴더/하위 경로에 대한 세부 지침을 보강합니다.
- 지침 충돌 시 루트 지침이 우선합니다. 단, 폴더 문서에 “루트 지침을 이 항목에서 한해 재정의”라고 명시된 경우에만 예외를 허용합니다.
- 에이전트는 작업 시 루트 → 가장 가까운 폴더의 `AGENTS.md` 순으로 모두 참조합니다.

## 프로젝트 구조 및 모듈 구성

- 테마 위치: `theme02/wp-content/themes/` (활성: `theme02`, `theme02-refactor`).
- 에셋 디렉터리: `assets/scss`, `assets/css`, `assets/js`, `assets/images`, `assets/fonts`, `assets/svgs`.
- WordPress 템플릿: `*.php` (예: `archive-*.php`, `single-*.php`, `functions.php`).
- 루트 구성 파일: `.stylelintrc.json`, `.eslintrc.js`, `package.json`, `package-lock.json`.

## 빌드·테스트·개발 명령어

- `npm run watch`: 모든 테마의 `assets/scss`를 자동 탐지·감시하여 각 테마의 `assets/css`로 출력합니다.
- `npx stylelint "theme02/wp-content/themes/**/assets/scss/**/*.scss"`: 스타일 린트.
- `npx eslint "theme02/wp-content/themes/**/assets/js/**/*.js"`: JS 린트.
- 일회성 빌드 예: `npx sass --style=compressed theme02/wp-content/themes/theme02/assets/scss:theme02/wp-content/themes/theme02/assets/css`.
- 최적화 권장: 개발 `--style=expanded --embed-source-map --embed-sources --quiet-deps`, 배포 `--style=compressed --no-source-map --no-error-css`. 다테마 빌드는 `build:css` 스크립트로 한 번에 실행할 수 있습니다.
- 참고: 기존 개별 감시 스크립트(`watch`, `watch:refactor`)는 제거되었습니다. 필요 시 환경변수 기반(`THEME=<name>`) 단일 스크립트를 추가하여 임의 테마만 감시하도록 확장할 수 있습니다.
- 자동 감시: `npm run watch`는 `theme02/wp-content/themes/` 하위 모든 테마의 `assets/scss`를 자동 탐지하여 감시하고 `assets/css`로 출력합니다.

## 코딩 스타일 및 네이밍

- SCSS: 2칸 들여쓰기, `stylelint-config-recommended-scss`+`idiomatic-order` 준수. `.stylelintrc.json` 규칙에 맞게 선언 순서/간격 유지.
- JS: ESLint `recommended` + React 규칙, ES2021 모듈, 큰따옴표 사용(규칙화).
- 파일/폴더: kebab-case 권장(예: `site-header.scss`), 기존 폴더 체계 일관 유지.
- PHP/WordPress: 부분 템플릿과 `get_template_part` 활용, 에셋은 `functions.php`에서 올바르게 enqueue.

## 테스트 지침

- 단위 테스트는 구성되어 있지 않습니다. 린팅 + 로컬 WordPress 실행으로 검증합니다.
- 아카이브/싱글/택소노미/커스텀 페이지가 경고 없이 렌더링되는지 확인합니다.
- 브라우저 확인: 최신 Chrome/Safari, SCSS의 반응형 브레이크포인트 점검.
- 푸시 전 린터 실행: stylelint 및 eslint.

## 커밋 및 PR 가이드

- 커밋: 명령형·간결·단일 목적. 예) `style: reorder header variables`, `theme: add portfolio archive template`, `build: compress scss outputs`.
- 관련 변경은 커밋 단위로 그룹화(템플릿/스타일/스크립트 분리).
- PR: 요약, 영향 경로, UI 전/후 스크린샷, 연결 이슈 포함. 수정한 WordPress 훅/필터 명시.

## 보안·설정 팁

- 비밀값과 `wp-config.php`는 커밋 금지. 템플릿의 하드코딩된 자격 증명/URL 지양.
- PHP 출력은 반드시 이스케이프/정화(`esc_html`, `esc_url`, `wp_kses_post`), 입력 검증.
- 대용량 바이너리는 최적화하여 커밋, 설계 원본은 외부 저장.

## 배포 프로세스

- 현재 배포는 SFTP를 통해 파일 저장 시 즉시 업로드되도록 구성되어 있습니다.
- CSS 산출물이 생성되는 즉시 원격 서버로 전송되므로, 배포 모드에서는 `--style=compressed --no-source-map` 사용을 권장드립니다.
- 불필요한 파일 업로드를 피하려면 에디터/클라이언트의 SFTP 제외 목록에 `node_modules`, `**/*.map`, 임시 파일 등을 추가해 주십시오.

## 에이전트 전용 안내

0. 변경은 기본적으로 `wp-content/` 하위에 국한하되, 환경 재현 목적의 요청(예: `.gitignore`, `db_dumps/`)은 예외로 허용합니다. 실행 방법과 필요한 컨테이너 재기동 여부를 명시하세요.
1. AI 처리 과정 메시지와 응답 메시지는 모두 한국어로 작성한다.
2. 처리 과정 메시지를 제외한 모든 응답에는 존댓말을 사용한다.
3. 응답에 한글 인코딩 깨짐 또는 타 언어 혼입이 보이면 즉시 한국어 문장으로 정정한다.
   - 응답 생성 시 **한글(UTF-8) 인코딩이 깨지지 않도록 확인**하고, 깨진 문자열(예: `��`) 또는 타 언어 문장이 섞이면 즉시 전체 문장을 한국어로 다시 작성한다.
   - 조합형 자모가 분리된 문자열(예: `ㅂㅅㅅ`, `열`)이나 의미 없는 특수문자 조합이 섞이면, 해당 문장을 즉시 정상 한글 완성형으로 교정한다.
4. 한국어로 주석 작성하고 내용이 바뀌면 주석도 변경한다.
5. 사용자가 요청한 작업 범위외 파일은 수정하지 않는다.
6. 이해하지 못한 요구 사항이 있으면 반드시 사용자에게 되물어본다.
7. 디버그 로그는 문제가 해결 되었다면 반드시 삭제한다.
8. 보안에 취약한 코드는 특별한 지시가 없다면 사용 금지한다.
9. 추측성 수정은 절대 금지한다. 원인을 모르면 수정 금지한다.
10. 간단하지 않은 문제라면 웹 검색을 통해 최신 해결책을 검색한다.
11. 이 프로젝트는 프로덕션이다. 오류 수정을 위해 우회하는 임시 코드를 작성 금지한다.
12. 코드 작업 시 `docs/` 폴더의 모든 Markdown 문서를 숙지하고, 해당 문서에 정의된 규칙을 준수한다. `docs` 폴더가 없을 경우 이 지침은 무시해도 된다.
13. 최종 응답 전 한글 문장을 자체 점검하여 다음 문자열이 포함되지 않도록 한다: 깨진 문자(`��`), 분리 자모(`ᄀ`~`ᇿ`, `ㄱ` 단독 나열), 의미 없는 반복 특수문자.
