<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // 데이터 구성
  $thumbnail = get_the_post_thumbnail( $post->ID, 'large' );
  $terms = get_the_terms( $post->ID, 'portfolio-type' );
  $terms_arr = array();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-card' ); ?>>
  <a href="<?php echo get_permalink(); ?>">
    <?php if ( $thumbnail ) { ?>
      <div class="thumbnail">
        <?php echo $thumbnail; ?>
      </div>
    <?php } ?>

    <div class="data">
      <h3 class="title"><?php echo get_the_title(); ?></h3>

      <p class="category">
        <?php
          if ( $terms && ! is_wp_error( $terms ) ) {
            // var_dump($terms);
            foreach ( $terms as $term ) {
              if ( $term->parent !== 0 ) {
                $terms_arr[] = $term->name;
              }
            }
            echo join( ', ', $terms_arr );
          }
        ?>
      </p>
    </div>
  </a>
</article>
