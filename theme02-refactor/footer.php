<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
    <footer id="footer" aria-label="사이트 정보">
      <div class="container">
        <div class="title">
          <a href="<?php echo home_url(); ?>" aria-label="Wallel">
            <?php echo GET_SVG('Wallel')['code']; ?>
          </a>
        </div>

        <div class="copyright">Copyright 2014 ~ <?php echo date('Y'); ?></div>

        <div class="other">
          <?php
            wp_nav_menu( array(
              'theme_location' => 'footer_menu',
              'container'      => false,
            ) );
          ?>

          <div class="vultr">
            <a href="https://www.vultr.com/?ref=6993867" target="_blank" data-tooltip="Server by Vultr">
              <img src="<?php echo GET_SVG('Vultr')['path']; ?>" alt="Vultr Logo">
            </a>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <div id="overlay"></div>
  <div id="noscript" style="display: none; position: fixed; top: 0; left: 0; z-index: 9999999999; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.9);"><div style="display: table; width: 100%; height: 100%;"><div style="display: table-cell; width: 100%; height: 100%; font-family: sans-serif; font-size: 13px; color: #fff; text-align: center; vertical-align: middle;">※ 원활한 사이트 이용을 위해 자바스크립트 사용을 허용해주세요.</div></div></div>

  <?php
    get_template_part('templates/parts/offcanvas');

    wp_footer();
  ?>
</body>
</html>
