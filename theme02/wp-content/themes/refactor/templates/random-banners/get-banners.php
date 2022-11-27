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
      /*
        Return
        array(4) {
          string Image source URL.
          1 int Image width in pixels.
          2 int Image height in pixels.
          3 bool Whether the image is a resized image.
        }
      */
      $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

      if ( study_meta( 'type' ) == 'live' ) {
?>
        <a href="<?php echo study_meta( 'courses' ) ?>" target="_blank">
          <img width="<?php echo $thumbnail[1]; ?>" height="<?php echo $thumbnail[2]; ?>" src="<?php echo $thumbnail[0]; ?>" alt="<?php echo get_the_title(); ?> 스터디 대표 이미지">
        </a>
<?php
      }
    }
  }
?>
