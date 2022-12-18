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

  // pages style
  /*
  wp_enqueue_style( 'style', get_theme_file_uri( '/assets/css/404.min.css' ), array( 'core' ), wp_get_theme()->get( 'Version' ), 'all' );

  get_header();
?>
<main id="main">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <section id="notfound">
          <header id="notfound-header">
            <h2 class="title">페이지를 찾을 수 없습니다.</h2>
          </header>

          <div id="notfound-container">
            요청하신 페이지를 찾을 수 없습니다.
            <br>이 페이지가 계속 될 경우 관리자에게 문의해주세요.
          </div>
        </section>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
