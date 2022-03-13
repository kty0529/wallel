<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	// 페이지 스타일 load
	function archive__template_stylesheet() {
		wp_enqueue_style( 'tpl_archive', get_theme_file_uri( '/assets/css/archive.min.css' ), false, time(), 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'archive__template_stylesheet' );

	get_header();
?>

<main id="main" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<?php /* content */ ?>
			<div class="col-9">
				<div id="post-list">
					<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();

								get_template_part( 'templates/parts/list' );
							}
						}
					?>

					<!-- <article class="post format-link">
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
					</article> -->

					<!-- <article class="post format-images">
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
					</article> -->
				</div>

				<?php
					$pagination = get_the_posts_pagination( array(
						'mid_size'  => 1,
						'prev_text' => '<i class="fas fa-chevron-left"></i><span class="text"> PREV</span>',
						'next_text' => '<span class="text">NEXT </span><i class="fas fa-chevron-right"></i>',
					) );

					if ( $pagination ) {
						echo $pagination;
					}
				?>
			</div>

			<?php /* sidebar */ ?>
			<div class="col-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</main>

<?php
	get_footer();
