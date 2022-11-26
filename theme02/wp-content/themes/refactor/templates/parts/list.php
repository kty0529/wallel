<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $detect_post_type = in_array( get_post_type(), array( 'project', 'study' ) );

  if ( $post_type ) {
    get_template_part( 'templates/parts/list', get_post_type() );
  } else {
    get_template_part( 'templates/parts/list', 'default' );
  }
?>
