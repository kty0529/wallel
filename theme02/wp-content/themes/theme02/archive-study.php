<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  function page_assets() {
    // pages style
    wp_enqueue_style( 'page-style', get_theme_file_uri( '/assets/css/page-study.css' ), false, time(), 'all' );
  }
	add_action( 'wp_enqueue_scripts', 'page_assets' );

  get_header();
?>
<main id="main" <?php post_class( 'page-archive-study' ); ?>>
  <div class="container">
    <section id="study">
      <header id="study-header">
        <h2 class="screen-reader-text">스터디</h2>
      </header>

      <div id="study-container">
        <?php
          if ( have_posts() ) {
            while ( have_posts() ) {
              the_post();

              get_template_part( 'templates/parts/list' );
            }
          } else {
            get_template_part( 'templates/parts/no-results' );
          }
        ?>
      </div>

      <?php get_template_part( 'templates/parts/pagination' ); ?>
    </section>

    <?php get_sidebar(); ?>
  </div>
</main>
<?php
  get_footer();
