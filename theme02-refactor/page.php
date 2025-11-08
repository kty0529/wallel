<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  function page_assets() {
    // pages style
    wp_enqueue_style( 'page-style', get_theme_file_uri( '/assets/css/page.css' ), false, time(), 'all' );
  }
	add_action( 'wp_enqueue_scripts', 'page_assets' );


  get_header();

  the_post();
?>
<main id="main" <?php post_class( 'page-default' ); ?> itemscope itemtype="http://schema.org/Article">
  <meta itemprop="url" content="<?php echo get_permalink(); ?>">

  <div class="container">
    <article id="entry">
      <header id="entry-header">
        <h1 itemprop="name headline" class="title"><?php the_title(); ?></h1>

        <div class="data">
          <time itemprop="dateCreated datePublished" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>">
            <span class="material-symbols-outlined icon" aria-hidden="true">
              calendar_today
            </span>

            <?php echo get_the_date('Y-m-d'); ?>
          </time>
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
