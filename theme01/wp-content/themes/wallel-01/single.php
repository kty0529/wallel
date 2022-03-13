<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	// 페이지 스타일 load
	function archive__template_stylesheet() {
		wp_enqueue_style( 'tpl_archive', get_theme_file_uri( '/assets/css/single.min.css' ), false, time(), 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'archive__template_stylesheet' );

	get_header();
?>

<main id="main" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<?php /* content */ ?>
			<div class="col-9">
				<div id="post-detail">
					<article class="entry">
						<header class="entry-header">
							<h2 class="title">국내외 웹사이트 빌더 업체 리스트</h2>
						</header>

						<div class="entry-content">
							<p>코딩 지식이 없어도 손쉽게 웹사이트를 만들 수 있는 서비스를 제공하는 업체를 알아두기 위해 모아봤다.</p>
							<h3>해외</h3>
							<h4>1. Squarespace (<a aria-label=" (새탭으로 열기)" rel="noreferrer noopener" href="https://www.squarespace.com/" target="_blank">https://www.squarespace.com/</a>)</h4>
							<ol><li>반응형</li><li>템플릿</li><li>쇼핑몰</li><li>유료</li></ol>
							<h4>2. Wix (<a aria-label=" (새탭으로 열기)" rel="noreferrer noopener" href="https://ko.wix.com/" target="_blank">https://ko.wix.com/</a>)</h4>
							<ol><li>반응형</li><li><strong>한국어 지원</strong></li><li>템플릿</li><li>쇼핑몰</li><li>무료/유료</li></ol>
							<h3>국내</h3>
							<h4>1. 아임웹 (<a aria-label=" (새탭으로 열기)" rel="noreferrer noopener" href="https://imweb.me/" target="_blank">https://imweb.me/</a>)</h4>
							<ol><li>반응형</li><li>템플릿</li><li>쇼핑몰</li><li>무료/유료</li><li>상세 기능 – <a href="https://imweb.me/features" target="_blank" rel="noreferrer noopener" aria-label="https://imweb.me/features (새탭으로 열기)">https://imweb.me/features</a></li></ol>
							<h4>2. <strong>모두</strong> (<a aria-label=" (새탭으로 열기)" rel="noreferrer noopener" href="https://www.modoo.at/" target="_blank">https://www.modoo.at/</a>)</h4>
							<ol><li><strong>네이버 자회사</strong></li><li>PC/Mobile</li><li>템플릿</li><li>네이버 톡톡 연동</li><li>네이버 스마트 스토어 연동</li><li>상세 기능 – <a rel="noreferrer noopener" aria-label="https://www.modoo.at/home/main/promote (새탭으로 열기)" href="https://www.modoo.at/home/main/promote" target="_blank">https://www.modoo.at/home/main/promote</a></li></ol>
							<h4>3. 크리에이터링크 (<a aria-label=" (새탭으로 열기)" rel="noreferrer noopener" href="https://creatorlink.net/" target="_blank">https://creatorlink.net/</a>)</h4>
							<h4>4. 식스샵 (<a aria-label=" (새탭으로 열기)" rel="noreferrer noopener" href="https://www.sixshop.com/" target="_blank">https://www.sixshop.com/</a>)</h4>

							<h2>h2</h2>
							<h3>h3</h3>
							<h4>h4</h4>
							<h5>h5</h5>
							<h6>h6</h6>
						</div>

						<div class="entry-data">
							<div class="data">
								<div class="data-label">카테고리</div>
								<div class="data-value">
									<a href="javascript:void(0);">북마크</a>,
									<a href="javascript:void(0);">북마크</a>,
									<a href="javascript:void(0);">북마크</a>,
									<a href="javascript:void(0);">북마크</a>
								</div>
							</div>

							<div class="data">
								<div class="data-label">태그</div>
								<div class="data-value">
									<a href="javascript:void(0);">빌더</a>,
									<a href="javascript:void(0);">빌더</a>,
									<a href="javascript:void(0);">빌더</a>,
									<a href="javascript:void(0);">빌더</a>
								</div>
							</div>

							<div class="data">
								<div class="data-label">작성자</div>
								<div class="data-value">김 태영</div>
							</div>

							<div class="data">
								<div class="data-label">작성일</div>
								<div class="data-value">
									<time datetime="2021-12-23 12:12">2021-12-23 12:12</time>
								</div>
							</div>
						</div>

						<div class="entry-comment">comment</div>
					</article>
				</div>
			</div>

			<?php /* sidebar */ ?>
			<div class="col-3">
				<aside id="sidebar">
					<h2 class="blind">사이드바</h2>

					<div class="widget widget-index">
						<h3 class="widget-title">Index</h3>

						<div class="widget-content">
							<ul class="indexes"></ul>
						</div>
						<script>
							document.addEventListener('DOMContentLoaded', () => {
								const indexes = new Indexes('.entry h3, .entry h4, .entry h5, .entry h6', '#sidebar .widget-index .indexes');
							});
						</script>
					</div>
				</aside>
			</div>
		</div>
	</div>
</main>

<?php
	get_footer();
