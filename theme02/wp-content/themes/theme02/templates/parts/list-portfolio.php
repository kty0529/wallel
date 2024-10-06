<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // 데이터 구성
  $thumbnail = get_the_post_thumbnail( $post->ID, 'large' );
  $terms = get_the_terms( $post->ID, 'portfolio-type' );
  $terms_arr = array();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-card' ); ?>>
    <?php if ( $thumbnail ) { ?>
      <a class="thumbnail" href="<?php echo get_permalink(); ?>">
        <?php echo $thumbnail; ?>
      </a>
    <?php } ?>

    <div class="data">
      <a href="<?php echo get_permalink(); ?>">
        <h3 class="title"><?php echo get_the_title(); ?></h3>
      </a>

      <p class="category">
        <span class="material-symbols-outlined icon">folder</span>
        <?php
          if ( $terms && ! is_wp_error( $terms ) ) {
            // var_dump($terms);
            foreach ( $terms as $term ) {
              if ( $term->parent !== 0 ) {
                $terms_arr[] = '<a href="' . get_term_link( $term->slug, $term->taxonomy ) . '">'. $term->name . '</a>';
              }
            }
            echo join( ', ', $terms_arr );
          }
        ?>
      </p>

      <div class="part">
        <span class="material-symbols-outlined icon">handyman</span>

        <?php
          $part_text = [
            'planning' => '기획',
            'design'   => '디자인',
            'develop'  => '개발',
          ];

          $part_data = portfolio_meta( 'part' );
          $part_arr = [];

          foreach($part_data as $key => $part) {
            $part_arr[] = $part_text[$key];
          };

          echo join( ', ', $part_arr );
        ?>
      </div>
    </div>
  </a>
</article>
