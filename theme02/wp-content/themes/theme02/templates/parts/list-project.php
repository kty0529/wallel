<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $thumbnail = get_the_post_thumbnail( $post->ID, 'large' );
  $content = apply_filters( 'the_content', get_the_content( false ) );

  if ( project_meta( 'closed' ) ) {
    $closed = array(
      'status' => true,
      'class' => ' closed'
    );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card' . $closed['class'] ); ?>>
  <?php if ( $thumbnail ) { ?>
    <div class="thumbnail">
      <a href="<?php echo get_permalink(); ?>">
        <?php echo $thumbnail; ?>
      </a>

      <div class="categories">
        <?php
          $terms = get_the_terms( $post->ID, 'project-type' );

          if ( $terms && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
              $icon = GET_SVG($term->name);

              if ( ! empty( $icon ) ) {
                echo '<a href="' . get_term_link( $term->slug, $term->taxonomy ) . '" class="icon icon-' . $icon['name'] . '" data-tooltip="' . strtoupper($icon['name']) . '">' . $icon['code'] . '</a>';
              }
            }
          }
        ?>
      </div>

      <?php if ( $closed['status'] ) { ?>
        <div class="closed">프로젝트 운영 종료</div>
      <?php } ?>
    </div>
  <?php } ?>

  <div class="content">
    <a href="<?php echo get_permalink(); ?>"><h3 class="title"><?php echo get_the_title(); ?></h3></a>

    <div class="description"><?php echo $content; ?></div>

    <ul class="languages">
      <li class="label">사용 언어</li>
      <?php
        $languages = explode(', ', project_meta( 'tech' ));

        if ( $languages && ! is_wp_error( $languages ) ) {
          foreach ( $languages as $language ) {
            $language_icon = GET_SVG($language);

            if ( ! empty( $language_icon ) ) {
              echo '<li class="icon-' . $language_icon['name'] . '" data-tooltip="' . strtoupper( $language_icon['name'] ) . '">' . $language_icon['code'] . '</li>';
            }
          }
        }
      ?>
    </ul>
  </div>
</article>
