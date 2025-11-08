<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $thumbnail = get_the_post_thumbnail( $post->ID, 'large' );
  $content = apply_filters( 'the_content', get_the_content( false ) );

  $level_text_arr = array(
    'beginner'                 => '초급',
    'beginner or intermediate' => '초중급',
    'intermediate'             => '중급',
    'intermediate or advanced' => '중고급',
    'advanced'                 => '고급',
    'other'                    => '기타',
  );

  $type_text_arr = array(
    'live'   => '라이브 세션',
    'video'  => '동영상',
    'mogako' => '모각코',
    'other'  => '기타',
  );

  // 스터디 운영 여부 체크
  // return ['running', 'stop', '']
  $running = study_meta( 'running' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( [ 'study-card ', $running ] ); ?>>
  <div class="thumbnail">
    <div class="status">
      <span class="common level"><?php echo $level_text_arr[ study_meta( 'level' ) ]; ?></span>
    </div>

    <?php if ( $running !== 'stop' ) { ?>
      <a href="<?php echo study_meta( 'courses' ); ?>" target="_blank">
        <?php echo $thumbnail; ?>
      </a>
    <?php } else { ?>
      <?php echo $thumbnail; ?>
      <div class="closed">스터디 운영 종료</div>
    <?php } ?>
  </div>

  <div class="content">
    <?php if ( $running !== 'stop' ) { ?>
      <a href="<?php echo study_meta( 'courses' ); ?>" target="_blank"><h2 class="title"><?php echo get_the_title(); ?></h2></a>
    <?php } else { ?>
      <h2 class="title"><?php echo get_the_title(); ?></h2>
    <?php } ?>


    <div class="description"><?php echo $content; ?></div>

    <ul class="infomation">
      <li>
        <span class="label"><b>강의 형식</b>: </span>
        <span class="value"><?php echo $type_text_arr[ study_meta( 'type' ) ]; ?></span>
      </li>
      <?php if ( study_meta( 'type' ) == 'live' ) { ?>
        <li>
          <span class="label"><b>모집 인원</b>: </span>
          <span class="value"><?php echo study_meta( 'total_student' ); ?></span>
        </li>
      <?php } ?>
    </ul>

    <div class="languages">
      <?php
        $terms = get_the_terms( $post->ID, 'study-tag' );

        if ( $terms && ! is_wp_error( $terms ) ) {
          foreach ( $terms as $term ) {
            echo '<a href="' . get_term_link( $term -> slug, $term -> taxonomy ) . '">' . strtoupper( $term -> name ) . '</a>';
          }
        }
      ?>
    </div>
  </div>
</article>
