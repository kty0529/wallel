<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	// 페이지 스타일 load
	function archive__template_stylesheet() {
		wp_enqueue_style( 'tpl_archive', get_theme_file_uri( '/assets/css/archive.min.css' ), false, time(), 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'archive__template_stylesheet' );

	get_header();
?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-3">
				<aside id="sidebar">
					<h2 class="blind">사이드바</h2>

					<div class="widget widget-category">
						<h3 class="widget-title">Category</h3>

						<div class="widget-content">
							<ul id="menu-%eb%b8%94%eb%a1%9c%ea%b7%b8-%ec%b9%b4%ed%85%8c%ea%b3%a0%eb%a6%ac" class="menu">
								<li id="menu-item-2352" class="menu-item menu-item-type-taxonomy menu-item-object-category current-menu-item menu-item-has-children menu-item-2352">
									<a href="https://wallel.com/category/scrap/" aria-current="page">스크랩</a>
									<ul class="sub-menu">
										<li id="menu-item-2353" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2353"><a href="https://wallel.com/category/scrap/css/">CSS</a></li>
										<li id="menu-item-2354" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2354"><a href="https://wallel.com/category/scrap/html/">HTML</a></li>
										<li id="menu-item-2356" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2356"><a href="https://wallel.com/category/scrap/script/">Script</a></li>
										<li id="menu-item-2355" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2355"><a href="https://wallel.com/category/scrap/php/">PHP</a></li>
										<li id="menu-item-7661" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7661"><a href="https://wallel.com/category/scrap/sublime-text/">Sublime Text</a></li>
										<li id="menu-item-2358" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2358"><a href="https://wallel.com/category/scrap/bookmark/">북마크</a></li>
										<li id="menu-item-2357" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2357"><a href="https://wallel.com/category/scrap/etc/">그밖의</a></li>
									</ul>
								</li>
								<li id="menu-item-2359" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2359">
									<a href="https://wallel.com/category/wordpress/">워드프레스</a>
									<ul class="sub-menu">
										<li id="menu-item-2362" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2362"><a href="https://wallel.com/category/wordpress/wp-scrap/">WP스크랩</a></li>
										<li id="menu-item-2363" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2363"><a href="https://wallel.com/category/wordpress/wp-plugins/">WP플러그인</a></li>
										<li id="menu-item-7602" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-7602"><a href="https://wallel.com/category/wordpress/%ec%9a%b0%ec%bb%a4%eb%a8%b8%ec%8a%a4/">우커머스</a></li>
										<li id="menu-item-2360" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2360"><a href="https://wallel.com/category/wordpress/kboard/">KBoard</a>
											<ul class="sub-menu">
												<li id="menu-item-2361" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2361"><a href="https://wallel.com/category/wordpress/kboard/kb-scrap/">KB스크랩</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li id="menu-item-2364" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2364">
									<a href="https://wallel.com/category/tistory/">티스토리</a>
									<ul class="sub-menu">
										<li id="menu-item-2365" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2365"><a href="https://wallel.com/category/tistory/ts-scrap/">TS스크랩</a></li>
									</ul>
								</li>
								<li id="menu-item-2350" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2350"><a href="https://wallel.com/category/uncategorized/">미분류</a></li>
								<li id="menu-item-2351" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2351"><a href="https://wallel.com/category/secret/">비공개</a></li>
							</ul>
						</div>
					</div>
				</aside>
			</div>

			<div class="col-9">
				<div id="post-list">
					<article class="post">
						<h2 class="post-title"><a href="./single.html">국내외 웹사이트 빌더 업체 리스트</a></h2>
						<div class="post-info">
							<time class="date" datetime="2021-12-23 12:12:41">2021-12-23</time>
							<div class="categories">
								<a href="javascript:void(0);">북마크</a>,
								<a href="javascript:void(0);">스크랩</a>
							</div>
							<div class="author">김 태영</div>
						</div>
						<p class="post-desc">코딩 지식이 없어도 손쉽게 웹사이트를 만들 수 있는 서비스를 제공하는 업체를 알아두기 위해 모아봤다. 해외 1. Squarespace (https://www.squarespace.com/) 반응형템플릿쇼핑몰유료 2. Wix (htt...</p>
					</article>

					<article class="post format-link">
						<h2 class="post-title"><a href="./single.html">국내외 웹사이트 빌더 업체 리스트</a></h2>
						<div class="post-info">
							<time class="date" datetime="2021-12-23 12:12:41">2021-12-23</time>
							<div class="categories">
								<a href="javascript:void(0);">북마크</a>,
								<a href="javascript:void(0);">스크랩</a>
							</div>
							<div class="author">김 태영</div>
						</div>
						<p class="post-desc">코딩 지식이 없어도 손쉽게 웹사이트를 만들 수 있는 서비스를 제공하는 업체를 알아두기 위해 모아봤다. 해외 1. Squarespace (https://www.squarespace.com/) 반응형템플릿쇼핑몰유료 2. Wix (htt...</p>
						<a class="post-external" href="https://naver.com" target="_blank" rel="noopener"><i class="ico ico-north-east" aria-hidden="true"></i> http://psd-to-css-shadows.com/</a>
					</article>

					<article class="post format-images">
						<div class="post-thumb" style="background-image: url('https://picsum.photos/500/250');"></div>
						<h2 class="post-title"><a href="javascript:void(0);">Lorem Picsum</a></h2>
						<div class="post-info">
							<time class="date" datetime="2021-12-23 12:12:41">2021-12-23</time>
							<div class="categories">
								<a href="javascript:void(0);">북마크</a>,
								<a href="javascript:void(0);">스크랩</a>
							</div>
							<div class="author">김 태영</div>
						</div>
						<p class="post-desc">Easy to use, stylish placeholders</p>
					</article>
				</div>

				<nav class="navigation pagination" role="navigation" aria-label="글">
					<h2 class="screen-reader-text">글 내비게이션</h2>
					<div class="nav-links">
						<a class="prev page-numbers" href="javascript:void(0);">PREV</a>
						<span aria-current="page" class="page-numbers current">1</span>
						<a class="page-numbers" href="javascript:void(0);">2</a>
						<span class="page-numbers dots">…</span>
						<a class="page-numbers" href="javascript:void(0);">18</a>
						<a class="next page-numbers" href="javascript:void(0);">NEXT</a>
					</div>
				</nav>
			</div>
		</div>
	</div>
</main>

<?php
	get_footer();
?>
