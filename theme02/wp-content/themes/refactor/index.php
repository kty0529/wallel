<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();
?>
<main id="main">
  <div class="container">
    <div class="row">
      <div class="col-9 col-tb-9">
        <section id="posts">
          <header id="posts-header">
            <h2 class="blind">블로그</h2>
          </header>

          <div id="posts-container">
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
      </div>

      <div class="col-3 col-tb-3">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
