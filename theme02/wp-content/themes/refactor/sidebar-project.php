<aside class="sidebar">
  <h2 class="blind">사이드바</h2>

  <div class="widget widget-search">
    <form method="get" action="<?php echo home_url() ?>">
      <input type="hidden" name="post_type" value="project">
      <input type="text" name="s" placeholder="Find Project" required value="<?php echo get_search_query(); ?>">
      <button type="submit" aria-label="검색">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
  </div>

  <div class="widget widget-category">
    <h3 class="widget-title">Category</h3>

    <ul class="menu">
      <?php
        wp_list_categories( array(
          'taxonomy' => 'project-type',
          'title_li' => '',
          'show_count' => false,
          'hide_title_if_empty' => false,
          'orderby' => 'name',
          'order' => 'ASC',
        ) );
      ?>
    </ul>
  </div>
</aside>
