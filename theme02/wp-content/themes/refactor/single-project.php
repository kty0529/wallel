<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  get_header();

  the_post();
?>
<main id="main" <?php post_class(); ?>>
  <div class="container">
    <div class="row">
      <div class="col-9 col-tb-9">
        <article id="project-entry">
          <header id="project-entry-header">
            <h2 class="title"><?php the_title(); ?></h2>

            <div class="data">
              <div class="release">
                <span class="label">최초 배포:</span>
                <span class="value"><?php echo project_meta( 'release' ); ?></span>
              </div>

              <div class="cms">
                <span class="label">CMS:</span>
                <span class="value">
                  <?php
                    $terms = get_the_terms( get_the_ID(), 'project-type' );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                      $terms = array_values( $terms );
                      $term = $terms[0];
                      $term_link = get_term_link( $term->term_id, 'project-type' );
                      echo '<a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a>';
                    }
                  ?>
                </span>
              </div>

              <div class="languages">
                <span class="label">사용 언어:</span>
                <span class="value">
                  <?php echo project_meta( 'tech' ); ?>
                </span>
              </div>
            </div>

          </header>

          <div id="project-entry-container">
            <div class="description">
              <?php the_content(); ?>
            </div>

            <div class="sec sec-infomation">
              <h3 class="sec-title">기본정보</h3>

              <div class="content">
                <?php echo project_meta( 'detail' ); ?>
              </div>
            </div>

            <div class="sec sec-screenshot">
              <h3 class="sec-title">스크린샷</h3>

              <div class="wrapper">
                <ul>
                  <?php
                    $screenshot = project_meta( 'screenshot', array( 'size' => 'large' ) );

                    $i = 0;
                    foreach ( $screenshot as $image ) {
                      $i++;
                  ?>
                      <li>
                        <a href="<?php echo $image[ 'full_url' ] ?>" data-lightbox="screenshot">
                          <img loading="lazy" src="<?php echo $image[ 'url' ] ?>" alt="screenshot <?php echo $i; ?>">
                        </a>
                      </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </div>

            <div class="sec sec-download">
              <h3 class="sec-title">다운로드</h3>

              <div class="wrapper">
                <ul>
                  <?php if ( $repository = project_meta( 'github_link' ) ) { ?>
                    <li>
                      <a class="download github" href="<?php echo $repository; ?>" target="_blank">
                        <?php echo file_get_contents( get_template_directory_uri() . '/assets/icons/svg/github.svg' ); ?>
                        Github Repository
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </article>
      </div>

      <div class="col-3 col-tb-3">
        <?php get_sidebar( 'project' ); ?>
      </div>
    </div>
  </div>
</main>
<?php
  get_footer();
