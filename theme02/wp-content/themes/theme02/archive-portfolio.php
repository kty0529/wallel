<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  function page_assets() {
    // pages style
    wp_enqueue_style( 'page-style', get_theme_file_uri( '/assets/css/page-portfolio.css' ), false, time(), 'all' );
  }
	add_action( 'wp_enqueue_scripts', 'page_assets' );

  get_header();
?>
<main id="main" <?php post_class( 'page-archive-portfolio' ); ?>>
  <div class="container">
    <section id="portfolio">
      <header id="portfolio-header">
        <h2 class="screen-reader-text">포트폴리오</h2>
      </header>

      <div id="portfolio-container">
        <?php
          if ( have_posts() ) {
            while ( have_posts() ) {
              the_post();

              get_template_part( 'templates/parts/list' );
            }

            get_template_part( 'templates/parts/pagination' );
          } else {
            get_template_part( 'templates/parts/no-results' );
          }
        ?>
      </div>
    </section>

    <?php get_sidebar(); ?>
  </div>
</main>
<?php
  get_footer();