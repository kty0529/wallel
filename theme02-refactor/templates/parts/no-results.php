<?php
  defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

  $emoji_arr = [
    '(｡•́︿•̀｡)',
    '(>⌓<｡)',
    '(T⌓T)'
  ];
  $random_emoji = $emoji_arr[ array_rand( $emoji_arr ) ];
?>
<div class="no-results">
  <div class="emoji"><?php echo $random_emoji; ?></div>
  <div class="text">이런, 검색 결과가 없습니다.</div>
</div>
