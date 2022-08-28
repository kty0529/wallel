<aside class="sidebar">
  <h2 class="blind">사이드바</h2>

  <div class="widget widget-search">
    <form method="get" action="<?php echo home_url() ?>">
      <input type="hidden" name="post_type" value="post">
      <input type="text" name="s" placeholder="글 찾기" required value="<?php echo get_search_query(); ?>">
      <button type="submit" aria-label="검색">
        <span class="material-symbols-outlined">search</span>
      </button>
    </form>
  </div>

  <div class="widget widget-category">
    <h3 class="widget-title">카테고리</h3>

    <ul class="cat">
      <?php
        wp_list_categories( array(
          'title_li' => '',
          'show_count' => true,
          'hide_title_if_empty' => false,
        ) );
      ?>
    </ul>
  </div>

  <div class="widget widget-banners">
    <h3 class="widget-title">스터디</h3>

    <div class="widget-content">
      <div id="event_banners"></div>
      <?php /* ?>
      <a href="<?php echo $banners[$rand_index]['url']; ?>" target="_blank">
        <img src="<?php echo $banners[$rand_index]['thumbnail']; ?>" alt="<?php echo $banners[$rand_index]['title']; ?> 썸네일 이미지">
      </a>
      <?php */ ?>
    </div>
  </div>
</aside>
<script>
  const banner_area = document.querySelector('#event_banners');
  const banners = [
    {
      'title': '만들면서 배우는 실전 퍼블리싱',
      'url': 'https://school.programmers.co.kr/learn/courses/14761',
      'thumbnail': `<?php echo get_theme_file_uri( '/assets/images/event-publishing-banner.jpeg' ); ?>`
    },
    {
      'title': '쉽게 구현해보는 자바 애플리케이션',
      'url': 'https://school.programmers.co.kr/learn/courses/14762',
      'thumbnail': `<?php echo get_theme_file_uri( '/assets/images/event-java-banner.png' ); ?>`
    }
  ];
  const max_count = banners.length - 1;
  const min_count = 0;
  const random_index = Math.floor( ( Math.random() * (max_count - min_count + 1) ) );

  const create_a = document.createElement('a');
  create_a.setAttribute('href', banners[random_index]['url']);
  create_a.setAttribute('target', '_blank');

  const create_img = document.createElement('img');
  create_img.setAttribute('src', banners[random_index]['thumbnail']);
  create_img.setAttribute('alt', banners[random_index]['title']);

  create_a.appendChild(create_img);
  banner_area.appendChild(create_a);
</script>
