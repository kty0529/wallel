<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // pages style
  wp_enqueue_style( 'style', get_theme_file_uri( '/assets/css/study.min.css' ), array( 'core' ), wp_get_theme()->get( 'Version' ), 'all' );

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

            get_template_part('templates/parts/pagination');
          }
        ?>
      </div>
    </section>

    <?php get_sidebar( 'study' ); ?>
  </div>
</main>
<?php
  get_footer();
