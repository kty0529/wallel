<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();

  the_post();
?>
<main id="main" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
  <meta itemprop="url" content="<?php echo get_permalink(); ?>">

  <div class="container">
    <div class="row">
      <div class="col-12">
        <article id="entry">
          <header id="entry-header">
            <h2 itemprop="name headline" class="title"><?php the_title(); ?></h2>

            <div class="data">
              <time itemprop="dateCreated datePublished" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>"><?php echo get_the_date('Y-m-d'); ?></time>
            </div>
          </header>

          <div itemprop="articleBody" id="entry-container">
            <?php the_content(); ?>
          </div>
        </article>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
