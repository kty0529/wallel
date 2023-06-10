<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // pages style
  wp_enqueue_style( 'style', get_theme_file_uri( '/assets/css/page-index.min.css' ), array( 'core' ), wp_get_theme()->get( 'Version' ), 'all' );

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
