<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	// 페이지 스타일 load
	function archive__template_stylesheet() {
		wp_enqueue_style( 'tpl_archive', get_theme_file_uri( '/assets/css/single.min.css' ), false, time(), 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'archive__template_stylesheet' );

	get_header();

	the_post();
	$categories = get_the_category();
	$tags = get_the_tags();
?>

<main id="main" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
	<meta itemprop="url" content="<?php echo get_permalink(); ?>">

	<div class="container">
		<div class="row">
			<?php /* content */ ?>
			<div class="col-12">
				<div id="post-detail">
					<article class="entry">
						<header class="entry-header">
							<h2 class="title" itemprop="name">
								<?php the_title(); ?>
							</h2>
						</header>

						<div class="entry-content" itemprop="articleBody">
							<?php the_content(); ?>
						</div>

						<div class="entry-data">
							<?php if ( $categories ) { ?>
								<div class="data">
									<div class="data-label">카테고리</div>
									<div class="data-value">
										<?php
											$category_arr = array();
											foreach ( $categories as $k => $v ) {
												$category_arr[] = '<a href="'.get_term_link( $v->term_id ).'">'.$v->name.'</a>';
											}
											echo implode( ', ', $category_arr );
										?>
									</div>
								</div>
							<?php } ?>

							<?php if ( $tags ) { ?>
								<div class="data">
									<div class="data-label">태그</div>
									<div class="data-value">
										<?php
											$tag_arr = array();
											foreach ( $tags as $v ) {
												$tag_arr[] = '<a href="'.get_tag_link( $v->term_id ).'">'.$v->name.'</a>';
											}
											echo implode( ', ', $tag_arr );
										?>
									</div>
								</div>
							<?php } ?>

							<div class="data">
								<div class="data-label">작성자</div>
								<div class="data-value" itemprop="author"><?php echo get_the_author(); ?></div>
							</div>

							<div class="data">
								<div class="data-label">작성일</div>
								<div class="data-value">
									<time datetime="<?php echo get_the_date( 'Y-m-d H:i' ); ?>" itemprop="dateCreated"><?php echo get_the_date( 'Y-m-d H:i' ); ?></time>
								</div>
							</div>
						</div>

						<div class="entry-comment">
							<div style="padding: 30px 15px; font-size: 13px; text-align: center; background-color: #fff;">
								<p>게시글에 문제가 있거나, 다른 문의가 있을 경우 <strong>kty0529@gmail.com</strong>으로 연락 부탁드립니다.<br>감사합니다.</p>
							</div>
						</div>
					</article>
				</div>
			</div>

			<?php /* sidebar ?>
			<div class="col-3">
				<aside id="sidebar">
					<h2 class="screen-reader-text">사이드바</h2>

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
			<?php */ ?>
		</div>
	</div>
</main>

<?php
	get_footer();
