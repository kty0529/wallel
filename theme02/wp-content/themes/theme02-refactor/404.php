<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  global $wp;
  $current_url = add_query_arg( array(), $wp->request );

  if ( $current_url == '179' ) {
    // square 스킨 예전 URL로 접속 시 redirect
    wp_redirect( home_url( add_query_arg( array(), '/project/square/' ) ) );
  } else {
    // 이상한 주소로 접근 시 메인으로 redirect
    wp_redirect( home_url() );
  }

  // 죽어랏
  die();
