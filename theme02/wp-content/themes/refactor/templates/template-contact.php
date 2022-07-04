<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  /*
    Template Name: 문의하기
  */

  get_header();
?>
<main id="main" <?php post_class(); ?>>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div id="contact">
          <?php
            echo do_shortcode('[contact-form-7 id="7803" title="문의하기"]');

            // 양식 자꾸 분실해서 백업..
            // <div class="form">
            //  <div class="form-row">
            //    <label for="your-name" class="form-label">이름</label>[text* your-name id:your-name]
            //  </div>
            //  <div class="form-row">
            //    <label for="your-email" class="form-label">이메일주소</label>[email* your-email id:your-email]
            //  </div>
            //  <div class="form-row">[textarea* your-message id:your-message]</div>
            //  <div class="form-row form-row-submit">[submit]</div>
            // </div>
          ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
