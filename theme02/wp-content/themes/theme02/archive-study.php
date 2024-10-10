<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  function page_assets() {
    // pages style
    wp_enqueue_style( 'page-style', get_theme_file_uri( '/assets/css/study.css' ), false, time(), 'all' );
  }
	add_action( 'wp_enqueue_scripts', 'page_assets' );

  get_header();
?>
<main id="main" <?php post_class( 'study-archive' ); ?>>
  <div class="container">
    <section id="study">
      <header id="study-header">
        <h2 class="screen-reader-text">스터디</h2>
      </header>

      <?php
        if ( have_posts() ) {
          echo '<div id="study-container">';

          $i = 0;
          while ( have_posts() ) {
            the_post();

            if ( $i === 1 ) {
              get_template_part( 'templates/parts/adsense', 'infeed' );
            }

            get_template_part( 'templates/parts/list' );

            $i++;
          }

          echo '</div>';
        }
      ?>

      <?php
        if ( ! have_posts() ) {
          get_template_part( 'templates/parts/no-results' );
        }
      ?>

      <?php get_template_part( 'templates/parts/pagination' ); ?>
    </section>

    <?php get_sidebar(); ?>
  </div>
</main>
<?php
  get_footer();
