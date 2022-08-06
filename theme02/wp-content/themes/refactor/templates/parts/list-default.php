<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $post_format = get_post_format();
  $content = apply_filters( 'the_content', get_the_content( false ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
  <a itemprop="url" href="<?php echo get_permalink(); ?>">
    <h3 itemprop="name headline" class="title"><?php the_title(); ?></h3>
  </a>

  <div class="data">
    <time itemprop="dateCreated datePublished" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>"><?php echo get_the_date('Y-m-d'); ?></time>

    <span class="categories">
      <?php
        $categories = get_the_category();

        $category_arr = array();
        foreach ( $categories as $k => $v ) {
          $category_arr[] = '<a href="'.get_term_link( $v->term_id ).'">'.$v->name.'</a>';
        }
        echo implode( ', ', $category_arr );
      ?>
    </span>

    <span itemprop="author" class="author"><?php echo get_the_author_nickname(); ?></span>
  </div>

  <p class="description">
    <?php
      echo mb_strimwidth( strip_tags( $content ), '0', '200', '...', 'utf-8' );
    ?>
  </p>

  <div class="buttons">
    <a href="<?php echo get_permalink(); ?>" class="view-more">자세히 보기</a>

    <?php if ( $get_url = get_url_in_content( $content ) && get_post_format() === 'link' ) { ?>
      <a href="<?php echo $get_url; ?>" class="external-link" target="_blank" data-tooltip="외부링크 바로가기" aria-label="외부링크 바로가기">
        <span class="material-symbols-outlined">north_east</span>
      </a>
    <?php } ?>
  </div>
</article>
