<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $args = array(
    'numberposts' => 2,
    'post_type' => 'study',
    'orderby' => 'rand',
    'meta_key' => 'study_meta_type'
  );

  $type_text_arr = array(
    'live'   => '라이브 세션',
    'video'  => '동영상',
    'mogako' => '모각코',
    'other'  => '기타',
  );

  $study = get_posts($args);

  if ( $study ) {
    foreach ( $study as $post ) {
      // if ( study_meta( 'type' ) == 'live' ) {
?>
        <a href="<?php echo study_meta( 'courses' ) ?>" target="_blank">
          <span class="label"><?php echo $type_text_arr[ study_meta( 'type' ) ]; ?></span>
          <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
        </a>
<?php
      // }
    }
  }
?>
