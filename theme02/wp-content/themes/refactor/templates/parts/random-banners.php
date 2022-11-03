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
      $thumbnail = get_the_post_thumbnail_url( $post->ID );

      if ( study_meta( 'type' ) == 'live' ) {
?>
        <a href="<?php echo study_meta( 'courses' ) ?>" target="_blank">
          <img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?> 스터디 대표 이미지">
        </a>
<?php
      }
    }
  }
?>
