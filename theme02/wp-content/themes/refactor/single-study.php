<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // wp_redirect( get_post_type_archive_link( 'study' ) );

  $redirect_arr = array('live', 'video');

  if ( in_array( study_meta( 'type' ), $redirect_arr ) ) {
    wp_redirect( study_meta( 'courses' ) );
  }
