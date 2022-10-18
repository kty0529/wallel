<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  /**
   * 테마 CSS
   */
  function wallel_theme_stylesheet() {
    // Vendor
    wp_enqueue_style( 'lightbox', get_theme_file_uri( '/assets/vendor/lightbox2/dist/css/lightbox.min.css' ), false, false, 'all' );
    wp_enqueue_style( 'prismjs', get_theme_file_uri( '/assets/vendor/prismjs/prism.css' ), false, '1.28.0', 'all' );

    // Core
    wp_enqueue_style( 'core', get_theme_file_uri( '/assets/css/core.min.css' ), false, time(), 'all' );
    wp_enqueue_style( 'style', get_theme_file_uri( '/style.css' ), array( 'core' ), wp_get_theme()->get( 'Version' ), 'all' );
  }
  add_action( 'wp_enqueue_scripts', 'wallel_theme_stylesheet' );


  /**
   * 테마 Script
   */
  function wallel_theme_script() {
    // jQuery
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0', false );

    // Vendor
    wp_enqueue_script( 'lightbox', get_theme_file_uri( '/assets/vendor/lightbox2/dist/js/lightbox.min.js' ), array( 'jquery' ), false, false );
    wp_enqueue_script( 'prismjs', get_theme_file_uri( '/assets/vendor/prismjs/prism.js' ), array( 'jquery' ), '1.28.0', false );

    // Core
    wp_enqueue_script( 'core-header', get_theme_file_uri( '/assets/js/core-header.js' ), array( 'jquery' ), time(), false );
    wp_enqueue_script( 'core-footer', get_theme_file_uri( '/assets/js/core-footer.js' ), array( 'jquery', 'core-header' ), time(), true );
  }
  add_action( 'wp_enqueue_scripts', 'wallel_theme_script' );


  /**
   * 테마 서포트
   */
  function custom_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', array( 'quote', 'image', 'link', 'video' ));
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
  }
  add_action( 'after_setup_theme', 'custom_theme_setup', 10000 );


  /**
   * 메뉴 추가
   */
  register_nav_menus(array(
    'main_menu'       => '메인메뉴',
    'footer_menu'     => '푸터메뉴',
    'blog_categories' => '블로그 카테고리',
    'mobile_menu'     => '모바일 메뉴',
  ));


  /**
   * 어드민바 버튼 제거
   * https://codex.wordpress.org/Function_Reference/remove_node
   */
  if ( ! current_user_can( 'manage_options' ) ) {
    // 관리자가 아닐 경우 어드민바 자체를 노출 X
    show_admin_bar(false);
  }

  function remove_admin_bar_node( $wp_admin_bar ) {
    // 워드프레스 기본
    $wp_admin_bar->remove_node( 'wp-logo' );
    $wp_admin_bar->remove_node( 'comments' );
    $wp_admin_bar->remove_node( 'search' );

    // 플러그인
    $wp_admin_bar->remove_node( 'notes' ); // 젯팩 노트 제거
    $wp_admin_bar->remove_node( 'aioseo-main' ); // All in One SEO 아이콘 제거
  }
  add_action( 'admin_bar_menu', 'remove_admin_bar_node', 9999999 );


  /**
   * 워드프레스 대시보드(알림판) 위젯 제거
   * http://www.wpbeginner.com/wp-tutorials/how-to-remove-wordpress-dashboard-widgets/
   */
  function remove_dashboard_widgets() {
    global $wp_meta_boxes;

    // normal
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );

    // plugins
    remove_meta_box('aioseo-rss-feed', 'dashboard', 'normal');
    remove_meta_box('aioseo-overview', 'dashboard', 'normal');
    remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal');
  }
  add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

  remove_action( 'welcome_panel', 'wp_welcome_panel' ); // 환영합니다 알림판 제거
  // remove_action( 'welcome_panel', 'kboard_welcome_panel' ); // KBoard 알림판 제거
  // remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' ); // 구텐베르그 알림판 제거


  /**
   * 관리자가 아닌 사람은 관리자 페이지 접근 금지시키기
   * current_user_can()을 변경하여 권한을 수정해서 사용하면 된다.
   * http://natko.com/block-access-to-wp-admin-and-wordpress-dashboard/
   */
  function stop_access_dashboard() {
    if ( ! current_user_can( 'administrator' ) && ! ( defined('DOING_AJAX') && DOING_AJAX ) ) {
      wp_redirect( home_url() );
      exit;
    }
  }
  add_action( 'admin_init', 'stop_access_dashboard' );


  /**
   * 관리자에 커스텀 스타일 추가하기
   */
  function custom_admin_style() {
    wp_enqueue_style( 'custom-admin-style', get_theme_file_uri( '/assets/css/admin/admin-style.css' ), false, time(), 'all' );

    // 구텐베르그 에디터 스타일
    wp_enqueue_style( 'gutenberg-editor-css', get_theme_file_uri( '/assets/css/admin/gutenberg_editor.css' ), false, time(), 'all' );
  }
  add_action( 'admin_head', 'custom_admin_style' );


  /**
	 * TinyMCE에 editor style 입히기
	 * https://codex.wordpress.org/TinyMCE
	 */
	function custom_TinyMCE_format( $in ) {
		$in['content_css'] = get_theme_file_uri( '/assets/css/editor-style.min.css' );
		return $in;
	}
	add_filter( 'tiny_mce_before_init', 'custom_TinyMCE_format' );


  /**
   * 관리자 > 사용자 목록에 특정 column 지우기
   * https://wordpress.stackexchange.com/questions/19180/how-to-remove-a-column-from-the-posts-page
   */
  function remove_user_list_columns( $columns ) {
    unset( $columns['posts'] );
    unset( $columns['role'] );
    return $columns;
  }

  function remove_user_list_columns_filter() {
    add_filter( 'manage_users_columns' , 'remove_user_list_columns' );
  }
  add_action( 'admin_init' , 'remove_user_list_columns_filter' );


  /**
   * 특정 플러그인 업데이트 알림 끄기
   * 플러그인의 폴더명/index파일명.php 를 작성하면 된다.
   * https://silvawebdesigns.com/wordpress-disable-update-notification-individual-plugins/
   */
  function disable_plugin_updates( $value ) {
    unset( $value->response['meta-box-columns/meta-box-columns.php'] );
    unset( $value->response['meta-box-tabs/meta-box-tabs.php'] );
    unset( $value->response['meta-box-group/meta-box-group.php'] );

    return $value;
  }
  add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );


  /**
   * 비밀글 제목 앞에 아이콘 추가
   */
  function custom_private_title_format( $format ) {
    return '[🔒] %s';
  }
  add_filter( 'private_title_format', 'custom_private_title_format' );


  /**
   * 보호글 제목 앞에 아이콘 추가
   */
  function custom_protacted_title_format( $format ) {
    return '[🔐] %s';
  }
  add_filter( 'protected_title_format', 'custom_protacted_title_format' );


  /**
	 * 추가 function 불러오기
	 */
	get_template_part( 'functions/metabox', 'common' );
	get_template_part( 'functions/custom-post-type', 'project' );
	get_template_part( 'functions/custom-post-type', 'study' );
