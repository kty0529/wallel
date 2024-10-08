<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
<button id="toggle-offcanvas">
  <span class="material-symbols-outlined icon_deactive">menu</span>
  <span class="material-symbols-outlined icon_active">menu_open</span>
</button>

<div id="offcanvas">
  <div class="widget widget-search">
    <form action="/">
      <input type="text" name="s" placeholder="통합검색" enterkeyhint="search" required value="<?php echo get_search_query(); ?>">
    </form>
  </div>

  <div class="widget widget-category">
    <div class="widget-title">블로그</div>

    <ul class="cat">
      <?php
        wp_list_categories( array(
          'title_li' => '',
          'show_count' => true,
          'hide_title_if_empty' => false,
        ) );
      ?>
    </ul>
  </div>

  <div class="widget widget-category">
    <div class="widget-title">프로젝트</div>

    <ul class="cat">
      <?php
        wp_list_categories( array(
          'taxonomy' => 'project-type',
          'title_li' => '',
          'show_count' => true,
          'hide_title_if_empty' => false,
        ) );
      ?>
    </ul>
  </div>

  <div class="widget widget-category">
    <div class="widget-title">스터디</div>

    <ul class="cat">
      <?php
        wp_list_categories( array(
          'taxonomy' => 'study-type',
          'title_li' => '',
          'show_count' => true,
          'hide_title_if_empty' => false,
        ) );
      ?>
    </ul>
  </div>

  <div class="widget widget-category">
    <div class="widget-title">포트폴리오</div>

    <ul class="cat">
      <?php
        wp_list_categories( array(
          'taxonomy' => 'portfolio-type',
          'title_li' => '',
          'show_count' => true,
          'hide_title_if_empty' => false,
        ) );
      ?>
    </ul>
  </div>
</div>
