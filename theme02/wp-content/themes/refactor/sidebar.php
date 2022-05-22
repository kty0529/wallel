<aside id="sidebar">
  <h2 class="blind">사이드바</h2>

  <div class="widget widget-search">
    <form method="get" action="<?php echo home_url() ?>">
      <input type="text" name="s" placeholder="Search" required>
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

<button id="toggle-sidebar" aria-hidden="true">
  <span class="material-symbols-outlined">filter_alt</span>
</button>

<script>
  const toggleSidebarButton = document.querySelector('#toggle-sidebar');
  toggleSidebarButton.addEventListener('click', (e) => {
    e.preventDefault();

    wallel.overlay.classList.toggle('active');
    ['scroll-lock', 'sidebar-active'].map(el => wallel.root.classList.toggle(el));
  });
</script>
