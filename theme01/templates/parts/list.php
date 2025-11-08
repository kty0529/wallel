<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	/**
	 * 필터를 사용하여 content를 가져오는 이유는, the_content()를 제어하는 외부 플러그인의 영향을 받지 않기 위함이다.
	 */
	$content = apply_filters( 'the_content', get_the_content( false ) );

	$thumbnail = get_the_post_thumbnail_url( $post->ID, 'full' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
	<?php if ( $thumbnail ) { ?>
		<div class="post-thumb" style="background-image: url('<?php echo $thumbnail; ?>');">
			<meta itemprop="image" content="<?php echo $thumbnail; ?>">
		</div>
	<?php } ?>

	<h2 class="post-title" itemprop="name headline"><a href="<?php echo get_permalink(); ?>" itemprop="url"><?php the_title(); ?></a></h2>

	<div class="post-info">
		<time class="date" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>" itemprop="dateCreated datePublished"><?php the_date('Y-m-d'); ?></time>
		<div class="categories">
			<?php
				$categories = get_the_category();

				$category_arr = array();
				foreach ( $categories as $k => $v ) {
					$category_arr[] = '<a href="'.get_term_link( $v->term_id ).'">'.$v->name.'</a>';
				}
				echo implode( ', ', $category_arr );
			?>
		</div>
		<div class="author" itemprop="author"><?php echo get_the_author_nickname(); ?></div>
	</div>

	<p class="post-desc">
		<?php
			echo mb_strimwidth( strip_tags( $content ), '0', '200', '...', 'utf-8' );
		?>
	</p>
</article>
