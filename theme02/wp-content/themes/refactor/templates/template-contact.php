<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  /*
    Template Name: 문의하기
  */

  // p 태그 제거
  // https://pineco.de/snippets/remove-p-tag-from-contact-form-7/
  add_filter('wpcf7_autop_or_not', '__return_false');

  // pages style
  wp_enqueue_style( 'style', get_theme_file_uri( '/assets/css/contact-form.min.css' ), array( 'core' ), wp_get_theme()->get( 'Version' ), 'all' );

  get_header();
?>
<main id="main" <?php post_class( 'page-contact-form' ); ?>>
  <div class="container">
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
</main>
<?php
  get_footer();
