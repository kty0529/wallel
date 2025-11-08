<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $content = apply_filters( 'the_content', get_the_content( false ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
  <a itemprop="url" href="<?php echo get_permalink(); ?>">
    <h3 itemprop="name headline" class="title"><?php the_title(); ?></h3>
  </a>

  <p class="description">
    <?php echo mb_strimwidth( strip_tags( $content ), '0', '200', '...', 'utf-8' ); ?>
  </p>

  <div class="data">
    <time itemprop="dateCreated datePublished" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>">
      <span class="material-symbols-outlined icon" aria-hidden="true">
        calendar_today
      </span>

      <?php echo get_the_date('Y-m-d'); ?>
    </time>

    <div class="categories">
      <span class="material-symbols-outlined icon" aria-hidden="true">
        folder
      </span>

      <?php
        $categories = get_the_category();

        $category_arr = array();
        foreach ( $categories as $k => $v ) {
          $category_arr[] = '<a href="'.get_term_link( $v->term_id ).'">'.$v->name.'</a>';
        }
        echo implode( ', ', $category_arr );
      ?>
    </div>

    <div itemprop="author" class="author">
      <span class="material-symbols-outlined icon" aria-hidden="true">
        person
      </span>

      <?php echo get_the_author_nickname(); ?>
    </div>
  </div>
</article>
