<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $thumbnail = get_the_post_thumbnail_url( $post->ID );
  $content = apply_filters( 'the_content', get_the_content( false ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card' ); ?>>
  <?php if ( $thumbnail ) { ?>
    <div class="project-card-thumbnail">
      <a href="<?php echo get_permalink(); ?>">
        <img loading="lazy" src="<?php echo $thumbnail; ?>" alt="프로젝트 대표 이미지">
      </a>

      <div class="categories">
        <?php
          $terms = get_the_terms( $post->ID, 'project-type' );

          if ( $terms && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
              $icon = strtolower($term->name);
              if ( $file = file_get_contents( get_template_directory_uri() . '/assets/icons/svg/' . $icon . '.svg' ) ) {
                echo '<a href="' . get_term_link( $term->slug, $term->taxonomy ) . '" class="icon icon-' . $icon . '" data-tooltip="' . strtoupper($term->name) . '">' . $file . '</a>';
              }
            }
          }
        ?>
      </div>
    </div>
  <?php } ?>

  <div class="project-card-container">
    <a href="<?php echo get_permalink(); ?>"><h3 class="title"><?php echo get_the_title(); ?></h3></a>

    <div class="description"><?php echo $content; ?></div>

    <ul class="languages">
      <li class="label">사용 언어</li>
      <?php
        $languages = explode(', ', project_meta( 'tech' ));

        foreach ( $languages as $v ) {
          $icon = strtolower($v);

          if ( $file = file_get_contents( get_template_directory_uri() . '/assets/icons/svg/' . $icon . '.svg' ) ) {
            echo '<li class="icon-' . $icon . '" data-tooltip="' . strtoupper($v) . '">' . $file . '</li>';
          }
        }
      ?>
    </ul>
  </div>
</article>
