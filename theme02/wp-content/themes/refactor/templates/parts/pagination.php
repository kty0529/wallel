<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $pagination = get_the_posts_pagination( array(
    'mid_size'  => 1,
    'prev_text' => '<span class="material-symbols-outlined icon">chevron_left</span><span class="text">PREV</span>',
    'next_text' => '<span class="text">NEXT</span><span class="material-symbols-outlined icon">chevron_right</span>',
  ) );

  if ( $pagination ) {
    echo $pagination;
  }
