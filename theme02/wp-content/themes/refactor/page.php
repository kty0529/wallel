<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  // pages style
  wp_enqueue_style( 'style', get_theme_file_uri( '/assets/css/page.min.css' ), array( 'core' ), wp_get_theme()->get( 'Version' ), 'all' );

  get_header();

  the_post();
?>
<main id="main" <?php post_class( 'page' ); ?> itemscope itemtype="http://schema.org/Article">
  <meta itemprop="url" content="<?php echo get_permalink(); ?>">

  <div class="container">
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
</main>
<?php
  get_footer();
