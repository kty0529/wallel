<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();

  the_post();
?>
<main id="main" <?php post_class(); ?>>
  <div class="container">
    <div class="row">
      <div class="col-9 col-tb-9">
        <article id="project-entry">
          <header id="project-entry-header">
            <h2 class="title"><?php the_title(); ?></h2>
          </header>

          <div id="project-entry-container">
            <?php the_content(); ?>
          </div>
        </article>
      </div>

      <div class="col-3 col-tb-3">
        <?php get_sidebar( 'project' ); ?>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
