<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
    <footer id="footer">
      <h2 class="blind">푸터</h2>

      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="title ff-lemon"><a href="<?php echo home_url(); ?>">Wallel</a></div>

            <div class="copyright">Copyright 2014 ~ <?php echo date('Y'); ?></div>

            <div class="navigation">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'footer_menu',
                  'container'      => false,
                ) );
              ?>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <div id="overlay"></div>
  <div id="noscript" style="display: none; position: fixed; top: 0; left: 0; z-index: 9999999999; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.9);"><div style="display: table; width: 100%; height: 100%;"><div style="display: table-cell; width: 100%; height: 100%; font-family: sans-serif; font-size: 13px; color: #fff; text-align: center; vertical-align: middle;">※ 원활한 사이트 이용을 위해 자바스크립트 사용을 허용해주세요.</div></div></div>

  <?php
    get_template_part('templates/parts/mobileOffcanvas');

    wp_footer();
  ?>
</body>
</html>
