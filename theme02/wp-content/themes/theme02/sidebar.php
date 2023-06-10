<?php
  $post_type = get_post_type() ? get_post_type() : $_REQUEST['post_type']; // post, study, project

  $taxonomy_arr = array(
    'post' => 'category',
    'study' => 'study-type',
    'project' => 'project-type',
  );

  $search_placeholder_arr = array(
    'post' => '글 찾기',
    'study' => '스터디 찾기',
    'project' => '프로젝트 찾기',
  );
?>

<aside class="sidebar">
  <h2 class="screen-reader-text">사이드바</h2>

  <div class="widget widget-search">
    <form method="get" action="<?php echo home_url() ?>">
      <input type="hidden" name="post_type" value="<?php echo $post_type; ?>">
      <input type="text" name="s" placeholder="<?php echo $search_placeholder_arr[$post_type]; ?>" required value="<?php echo get_search_query(); ?>">
      <button type="submit" aria-label="검색">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
  </div>

  <div class="widget widget-category">
    <h3 class="widget-title">카테고리</h3>

    <ul class="cat">
      <?php
        wp_list_categories( array(
          'taxonomy' => $taxonomy_arr[$post_type],
          'title_li' => '',
          'show_count' => true,
          'hide_title_if_empty' => false,
        ) );
      ?>
    </ul>
  </div>

  <div class="widget widget-banners">
    <h3 class="widget-title">스터디</h3>

    <div class="widget-content">
      <?php get_template_part( '/templates/random-banners/random-banners' ); ?>
    </div>
  </div>
</aside>
