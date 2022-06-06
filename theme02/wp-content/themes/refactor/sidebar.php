<aside class="sidebar">
  <h2 class="blind">사이드바</h2>

  <div class="widget widget-search">
    <form method="get" action="<?php echo home_url() ?>">
      <input type="hidden" name="post_type" value="post">
      <input type="text" name="s" placeholder="Search" required value="<?php echo get_search_query(); ?>">
      <button type="submit" aria-label="검색">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
  </div>

  <div class="widget widget-category">
    <h3 class="widget-title">Category</h3>

    <?php
      wp_nav_menu(array(
        'theme_location' => 'blog_categories',
        'container'      => false,
      ));
    ?>
  </div>
</aside>
