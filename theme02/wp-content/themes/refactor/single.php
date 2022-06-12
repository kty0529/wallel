<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();

  the_post();
?>
<main id="main" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
  <meta itemprop="url" content="<?php echo get_permalink(); ?>">

  <div class="container">
    <div class="row">
      <div class="col-9 col-tb-9">
        <article id="entry">
          <header id="entry-header">
            <h2 itemprop="name headline" class="title"><?php the_title(); ?></h2>

            <div class="data">
              <time itemprop="dateCreated datePublished" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>"><?php echo get_the_date('Y-m-d'); ?></time>

              <span itemprop="keywords" class="categories">
                <?php
                  $categories = get_the_category();

                  $category_arr = array();
                  foreach ( $categories as $k => $v ) {
                    $category_arr[] = '<a href="'.get_term_link( $v->term_id ).'">'.$v->name.'</a>';
                  }
                  echo implode( ', ', $category_arr );
                ?>
              </span>

              <span itemprop="author" class="author"><?php echo get_the_author_nickname(); ?></span>
            </div>
          </header>

          <div itemprop="articleBody" id="entry-container">
            <?php the_content(); ?>
          </div>

          <?php if ( $tags = get_the_tags() ) { ?>
            <div id="entry-tags">
              <?php
                // $tag_arr = array();
                foreach ( $tags as $v ) {
                  // $tag_arr[] = '<a href="'.get_tag_link( $v->term_id ).'">'.$v->name.'</a>';
                  echo '<a href="'.get_tag_link( $v->term_id ).'">'.$v->name.'</a>';
                }
                // echo implode( ', ', $tag_arr );
              ?>
            </div>
          <?php } ?>
        </article>
      </div>

      <div class="col-3 col-tb-3">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
