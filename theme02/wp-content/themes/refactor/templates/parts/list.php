<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $post_type = get_post_type();

  if ( $post_type === 'project' ) {
    get_template_part( 'templates/parts/list', 'project' );
  } else {
    get_template_part( 'templates/parts/list', 'default' );
  }
?>
