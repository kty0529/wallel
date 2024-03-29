<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  function page_assets() {
    // pages style
    wp_enqueue_style( 'page-style', get_theme_file_uri( '/assets/css/page-index.css' ), false, time(), 'all' );
  }
	add_action( 'wp_enqueue_scripts', 'page_assets' );

  get_header();
?>
<main id="main" <?php post_class( 'page-index' ); ?>>
  <div class="container">
    <section id="posts">
      <header id="posts-header">
        <h2 class="screen-reader-text">블로그</h2>
      </header>

      <div id="posts-container">
        <?php
          if ( have_posts() ) {
            $i = 0;
            while ( have_posts() ) {
              the_post();

              if ( $i === 2 ) {
                get_template_part( 'templates/parts/adsense', 'infeed' );
              }

              get_template_part( 'templates/parts/list' );

              $i++;
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

