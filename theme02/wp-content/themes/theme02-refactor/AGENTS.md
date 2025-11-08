# Repository Guidelines

## 프로젝트 구조 및 모듈 구성

- 루트 템플릿: `index.php`, `single.php`, `archive.php`, `page.php`, `404.php`, 그리고 전용 템플릿(예: `single-portfolio.php`, 각 taxonomy 아카이브).
- `functions/`: 테마 모듈 로직(커스텀 포스트 타입, 메타박스, 댓글/트랙백 비활성화 등).
- `templates/parts/`: 재사용 파셜(리스트, 페이지네이션, 오프캔버스, 애드센스) 및 `templates/random-banners/` 배너 템플릿.
- `assets/scss/`: 저자용 SCSS 소스(`base/`, `helpers/`, `layouts/`, `components/` 하위 파셜 포함).
- `assets/css/`: 컴파일된 CSS 산출물; 디버깅용 `*.map` 포함.
- `assets/js/`: 사이트 스크립트(`core-header.js`, `core-footer.js`).
- `assets/vendor/`: 서드파티 라이브러리(Lightbox2, Swiper, PrismJS). 폰트/이미지/SVG는 각각 `assets/fonts/`, `assets/images/`, `assets/svgs/`.

## 빌드·테스트·개발 명령

- SCSS 단발 빌드: `sass assets/scss:assets/css --style=compressed`
- SCSS 감시: `sass --watch assets/scss:assets/css`
- PHP 린트(전체): `find . -name "*.php" -print0 | xargs -0 -n1 php -l`
- WP 활성화(wp-cli): `wp theme activate theme02-refactor` 후 `wp cache flush`
- 로컬 WP: Docker/Local/wp-env 등 선호 스택 사용. 테마는 `wp-content/themes/theme02-refactor` 경로에 배치.

## 코딩 스타일 및 네이밍 규칙

- PHP: WordPress Coding Standards 준수. 출력 시 `esc_html`, `esc_attr`, `esc_url` 사용, 폼은 nonce로 보호.
- SCSS: 2칸 들여쓰기. 토큰은 `helpers/_variables.scss`, `helpers/_mixins.scss`에 정의. 신규 파셜은 `components/` 또는 `layouts/`에 추가 후 `project.scss`/`core.scss`에 임포트.
- CSS/JS: 케밥 케이스 클래스와 서술적 이름. 파일명은 소문자-대시 표기(예: `page-contact.php`).

## 테스트 가이드라인

- 수동 시나리오: `study`, `project`, `portfolio` 단일/아카이브와 각 taxonomy 템플릿 동작 확인. 페이지네이션, 오프캔버스, 배너, no-results 상태 점검.
- 브라우저 호환: 헤더/푸터 스크립트와 Lightbox/Swiper/Prism 연동 기본 동작 확인.
- 정적 검사/스타일: `php -l` 실행, SCSS에서 CSS가 정상 컴파일되는지 시각 확인(컴파일 산출물 직접 수정 금지).

## 커밋 & PR 가이드

- 커밋: 명령형 어조 + 스코프 태그 사용 `functions:`, `templates:`, `scss:`, `js:`, `vendor:` (예: `templates: add portfolio tag archive header`).
- PR: 요약, 연결 이슈, 영향 파일/템플릿, 변경 전·후 스크린샷, 빌드 메모(SCSS 변경 시), 검증 절차를 포함.

## 보안 및 구성 팁

- 저장 시 sanitize(`sanitize_text_field` 등), 렌더 시 escape, 액션은 `wp_nonce_field`/`check_admin_referer`로 보호.
- 에셋은 `functions.php`의 `wp_enqueue_scripts`로 등록·로딩하고, 템플릿 직접 `<script>`/`<link>` 삽입은 피합니다.

## AI 요청 처리 및 응답 원칙

- 모든 AI의 요청 처리 과정과 최종 응답은 한국어 존댓말로 작성합니다.
- 진행 상황 안내와 계획 공유(예: 사전 안내 메시지, TODO/Plan 업데이트)도 동일 원칙을 따릅니다.
- 코드, 명령어, 파일 경로는 원문으로 표기하되, 설명과 주석은 존댓말로 보충합니다.
- 불확실하거나 선택지가 있는 경우, 정중하게 질문드리고 확인 후 진행합니다.
