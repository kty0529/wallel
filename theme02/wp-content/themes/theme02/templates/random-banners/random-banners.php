<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $args = array(
    'numberposts' => 2,
    'post_type' => 'study',
    'orderby' => 'rand',
    'meta_key' => 'study_meta_type'
  );

  $study = get_posts($args);

  if ( $study ) {
    foreach ( $study as $post ) {
?>
      <a href="<?php echo study_meta( 'courses' ) ?>" target="_blank">
        <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
      </a>
<?php
    }
  }
?>
