<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
<div id="offcanvas" aria-hidden="true">
  <div class="widget widget-menu">
    <div class="widget-title">Menu</div>

    <?php
      wp_nav_menu(array(
        'theme_location' => 'main_menu',
        'container'      => false,
      ));
    ?>
  </div>

  <div class="widget widget-category">
    <div class="widget-title">Blog</div>

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
    <div class="widget-title">Project</div>

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
</div>

<button id="toggle-offcanvas" aria-hidden="true">
  <span class="material-symbols-outlined icon_deactive">menu</span>
  <span class="material-symbols-outlined icon_active">menu_open</span>
</button>
