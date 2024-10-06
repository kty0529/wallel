<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	function page_assets() {
    // lightbox
    wp_enqueue_style( 'lightbox', get_theme_file_uri( '/assets/vendor/lightbox2/css/lightbox.min.css' ), false, '2.11.3', 'all' );
    wp_enqueue_script( 'lightbox', get_theme_file_uri( '/assets/vendor/lightbox2/js/lightbox.min.js' ), false, '2.11.3', false );

    // pages style
    wp_enqueue_style( 'page-style', get_theme_file_uri( '/assets/css/portfolio.css' ), false, time(), 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'page_assets' );

  get_header();

  the_post();
?>
<main id="main" <?php post_class( 'portfolio-article' ); ?>>
  <div class="container">
    <article id="portfolio-entry">
      <header id="portfolio-entry-header">
        <h2 class="title"><?php the_title(); ?></h2>

        <ul class="data">
          <?php if ( portfolio_meta( 'date' ) ) { ?>
            <li class="row date">
              <span class="label">작업 기간</span>
              <span class="value">
                <?php echo portfolio_meta( 'date' )['start']; ?>
                ~
                <?php
                  if ( $end_date = portfolio_meta( 'date' )['end'] ) {
                    echo $end_date;
                  } else {
                    echo '진행중';
                  }
                ?>
              </span>
            </li>
          <?php } ?>

          <li class="row part">
            <span class="label">담당 파트</span>
            <span class="value">
              <?php
                $part_text = [
                  'planning' => '기획',
                  'design'   => '디자인',
                  'develop'  => '개발',
                ];

                $part_data = portfolio_meta( 'part' );
                $part_arr = [];

                foreach($part_data as $key => $part) {
                  $part_arr[] = $part_text[$key] . ': ' . $part . '%';
                };

                echo join( ', ', $part_arr );
              ?>
            </span>
          </li>

          <?php
            if ( $url = portfolio_meta( 'url' ) ) {
          ?>
              <li class="row preview">
                <span class="label">바로가기</span>
                <span class="value">
                  <a href="<?php echo $url ?>" target="_blank" title="사이트 바로가기"><?php echo $url; ?></a>
                  <br>* 클라이언트의 사정에 따라 연결되지 않을 수 있습니다.
                </span>
              </li>
          <?php
            }
          ?>

          <li class="row skils">
            <span class="label">사용 스킬</span>
            <span class="value">
              <?php
                $terms = get_the_terms( get_the_ID(), 'portfolio-tag' );
                if ( $terms && ! is_wp_error( $terms ) ) {
                  $terms_arr = [];

                  foreach( $terms as $term ) {
                    $term_link = get_term_link( $term->term_id, $term->taxonomy );
                    $terms_arr[] = '<a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a>';
                  }
                  echo join( ', ', $terms_arr );
                }
              ?>
            </span>
          </li>
        </ul>
      </header>

      <div id="portfolio-entry-container">
        <div class="sec-content">
          <?php the_content(); ?>
        </div>

        <?php
          if ( $screenshots = portfolio_meta( 'screenshots', array( 'size' => 'thumbnail' ) ) ) {
        ?>
            <ul class="sec-screenshots grid-<?php echo count($screenshots); ?>">
              <?php
                $i = 0;
                foreach ( $screenshots as $image ) {
                  $i++;
              ?>
                  <li>
                    <a href="<?php echo $image[ 'url' ] ?>" data-lightbox="screenshot">
                      <?php echo wp_get_attachment_image( $image['ID'], 'small' ); ?>
                    </a>
                  </li>
              <?php
                }
              ?>
            </ul>
        <?php
          }
        ?>
      </div>
    </article>

    <?php get_sidebar(); ?>
  </div>
</main>

<?php
  get_footer();
