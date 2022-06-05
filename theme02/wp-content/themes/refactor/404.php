<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();
?>
<main id="main">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <section id="notfound">
          <header id="notfound-header">
            <h2 class="title">페이지를 찾을 수 없습니다.</h2>
          </header>

          <div id="notfound-container">
            요청하신 페이지를 찾을 수 없습니다.
            <br>이 페이지가 계속 될 경우 관리자에게 문의해주세요.
          </div>
        </section>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
