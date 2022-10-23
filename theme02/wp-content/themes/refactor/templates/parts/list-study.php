<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $thumbnail = get_the_post_thumbnail_url( $post->ID );
  $content = apply_filters( 'the_content', get_the_content( false ) );

  // var_dump(study_meta( 'type' ) == 'live', @date('Y-m-d') > study_meta( 'end_at' ));
  if ( study_meta( 'type' ) == 'live' && @date('Y-m-d') > study_meta( 'end_at' ) ) {
    $closed = array(
      'status' => true,
      'class' => ' closed'
    );
  }

  $level_text_arr = array(
    'beginner'                 => '초급',
    'beginner or intermediate' => '초중급',
    'intermediate'             => '중급',
    'intermediate or advanced' => '중고급',
    'advanced'                 => '고급',
    'other'                    => '기타',
  );

  $type_text_arr = array(
    'live'   => '라이브 세션 강의',
    'video'  => '영상 강의',
    'mogako' => '모각코',
    'other'  => '기타',
  )
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'study-card' . $closed['class'] ); ?>>
  <div class="thumbnail">
    <span class="common level"><?php echo $level_text_arr[ study_meta( 'level' ) ]; ?></span>

    <a href="<?php echo study_meta( 'courses' ); ?>" target="_blank">
      <img loading="lazy" src="<?php echo $thumbnail; ?>" alt="스터디 대표 이미지">
    </a>

    <?php if ( $closed['status'] ) { ?>
      <div class="closed">스터디 모집 마감</div>
    <?php } ?>
  </div>

  <div class="content">
    <a href="<?php echo study_meta( 'courses' ); ?>" target="_blank"><h3 class="title"><?php echo get_the_title(); ?></h3></a>

    <div class="description"><?php echo $content; ?></div>

    <ul class="infomation">
      <li>
        <span class="label"><b>강의 형식</b>: </span>
        <span class="value"><?php echo $type_text_arr[ study_meta( 'type' ) ]; ?></span>
      </li>
      <?php if ( study_meta( 'type' ) == 'live' ) { ?>
        <li>
          <span class="label"><b>모집 기간</b>: </span>
          <span class="value"><?php echo study_meta( 'start_at' ); ?> ~ <?php echo study_meta( 'end_at' ); ?></span>
        </li>
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