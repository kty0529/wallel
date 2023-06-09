<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lemon&text=Wwallel&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

  <?php wp_head(); ?>

  <script>
    window.ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
  </script>

  <noscript>
    <style> #noscript { display: block !important; } </style>
    <?php
      // 만약 메인페이지가 아닌 곳에서 자바스크립트 사용을 허용하지 않았다면, 메인페이지로 날리기
      if ( ! is_front_page() ) { ?><meta http-equiv="refresh" content="0;url=<?php echo home_url(); ?>"><?php } ?>
  </noscript>
</head>

<body <?php body_class(); ?>>
  <div id="wrap">

    <header id="header">
      <div class="container">
        <h1 class="title ff-lemon"><a href="<?php echo home_url(); ?>">Wallel</a></h1>

        <nav class="navigation">
          <h2 class="screen-reader-text">네비게이션</h2>

          <?php
            wp_nav_menu(array(
              'theme_location' => 'main_menu',
              'container'      => false,
            ));
          ?>
        </nav>
      </div>
    </header>
