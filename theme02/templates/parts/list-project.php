<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $thumbnail = get_the_post_thumbnail( $post->ID, 'large' );
  $content = apply_filters( 'the_content', get_the_content( false ) );
  $closed = array(
    'status' => false,
    'class' => '',
  );

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

      <?php if ( $closed['status'] ) { ?>
        <div class="closed">프로젝트 운영 종료</div>
      <?php } ?>
    </div>
  <?php } ?>

  <div class="content">
    <a href="<?php echo get_permalink(); ?>"><h3 class="title"><?php echo get_the_title(); ?></h3></a>

    <?php
      $category_terms = get_the_terms( $post->ID, 'project-type' );
      $tag_terms = get_the_terms( $post->ID, 'project-tag' );
      $category_links = array();
      $tag_links = array();

      if ( $category_terms && ! is_wp_error( $category_terms ) ) {
        foreach ( $category_terms as $term ) {
          $term_link = get_term_link( $term->term_id, $term->taxonomy );
          $category_links[] = '<a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a>';
        }
      }

      if ( $tag_terms && ! is_wp_error( $tag_terms ) ) {
        foreach ( $tag_terms as $term ) {
          $term_link = get_term_link( $term->term_id, $term->taxonomy );
          $tag_links[] = '<a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a>';
        }
      }
    ?>

    <?php if ( ! empty( $category_links ) || ! empty( $tag_links ) ) { ?>
      <div class="data">
        <?php if ( ! empty( $category_links ) ) { ?>
          <div class="cms">
            <span class="material-symbols-outlined icon" aria-hidden="true">
              folder
            </span>

            <?php echo join( ', ', $category_links ); ?>
          </div>
        <?php } ?>

        <?php if ( ! empty( $tag_links ) ) { ?>
          <div class="languages">
            <span class="material-symbols-outlined icon" aria-hidden="true">
              sell
            </span>

            <?php echo join( ', ', $tag_links ); ?>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <div class="description"><?php echo $content; ?></div>
  </div>
</article>
