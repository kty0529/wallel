<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $thumbnail = get_the_post_thumbnail_url( $post->ID );
  $content = apply_filters( 'the_content', get_the_content( false ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card' ); ?>>
  <div class="project-card-thumbnail">
    <?php if ( $thumbnail ) { ?>
      <img loading="lazy" src="<?php echo $thumbnail; ?>" alt="프로젝트 대표 이미지">
    <?php } ?>

    <div class="categories">
      <?php
        $terms = get_the_terms( $post->ID, 'project-type' );

        if ( $terms && ! is_wp_error( $terms ) ) {
          foreach ( $terms as $term ) {
            $icon = strtolower($term->name);
            if ( $file = file_get_contents( get_template_directory_uri() . '/assets/icons/svg/' . $icon . '.svg' ) ) {
              echo '<div class="icon icon-' . $icon . '" data-tooltip="' . strtoupper($term->name) . '">' . $file . '</div>';
            }
          }
        }
      ?>
    </div>
  </div>

  <div class="project-card-container">
    <a href="<?php echo get_permalink(); ?>"><h3 class="title"><?php echo get_the_title(); ?></h3></a>

    <div class="description"><?php
      // strip_tags($text, allow_tags)
      // 두번째 인자인 allow_tags는 php 7.4 이상부터 사용할 수 있다 ㅠ
      // 어차피 내가 쓰는것이기 때문에 모든 태그를 허용하기로 했다.
      // 가능하면 나중에 p 태그만 사용 가능하게 해야할듯.
      echo $content;
    ?></div>

    <ul class="languages">
      <li class="label">Languages</li>
      <?php
        $languages = explode(', ', project_meta( 'tech' ));

        foreach ( $languages as $v ) {
          $icon = strtolower($v);

          if ( $file = file_get_contents( get_template_directory_uri() . '/assets/icons/svg/' . $icon . '.svg' ) ) {
            echo '<li class="icon-' . $icon . '" data-tooltip="' . strtoupper($v) . '">' . $file . '</li>';
          }
        }
      ?>
    </ul>
  </div>
</article>
