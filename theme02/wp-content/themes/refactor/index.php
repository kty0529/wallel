<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();
?>
<main id="main">
  <div class="container">
    <div class="row">
      <div class="col-9 col-tb-9">
        <section class="posts">
          <header class="posts-header">
            <h2 class="blind">블로그</h2>
          </header>

          <div class="posts-container">
            <?php
              if ( have_posts() ) {
                while ( have_posts() ) {
                  the_post();

                  get_template_part( 'templates/parts/list' );
                }
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
