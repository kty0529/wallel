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
          <?php echo do_shortcode('[contact-form-7 id="7803" title="문의하기"]'); ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
