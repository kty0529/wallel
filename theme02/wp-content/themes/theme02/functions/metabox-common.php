<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // 메타박스용 스타일 추가
	function prefix_enqueue_custom_style() {
		wp_enqueue_style( 'metabox-style', get_template_directory_uri() . '/assets/css/metabox-admin.css' );
	}
	add_action( 'rwmb_enqueue_scripts', 'prefix_enqueue_custom_style' );
