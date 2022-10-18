<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	// CPT 생성
	function create_post_type__study() {
		$labels = array(
			'name'           => '스터디',
			'singular_name'  => '스터디',
			'menu_name'      => '스터디',
			'all_items'      => '모든 스터디',
			'add_new'        => '새 스터디 추가',
			'add_new_item'   => '새 스터디 추가',
			'edit_item'      => '스터디 편집',
			'search_items'   => '스터디 검색',
			'name_admin_bar' => '스터디',
			'archives'       => '스터디 아카이브',
		);

		$args = array(
			'label'               => '스터디',
			'description'         => '스터디를 등록할 수 있습니다.',
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => true,
			'supports'            => array( 'title', 'editor', 'tags', 'thumbnail', 'revisions' ),
			'menu_position'       => 5,
			'taxonomies'          => false
		);

		register_post_type( 'study', $args );
	}
	add_action( 'init', 'create_post_type__study', 200 );


	// Taxonomy(카테고리) 생성
	function create__study__taxonomies() {
		$labels = array(
			'name'          => '스터디 카테고리', // 관리자 화면 글 목록의 카테고리 컬럼명
			'singular_name' => '카테고리',
			'menu_name'     => '카테고리',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'study-type', array( 'study' ), $args );
	}
	add_action( 'init', 'create__study__taxonomies', 201 );


	// Tag 생성
	function create__study__tags() {
		$labels = array(
			'name'          => '스터디 태그',
			'singular_name' => '태그',
			'menu_name'     => '태그',
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'study-tag', array( 'study' ), $args );
	}
	add_action( 'init', 'create__study__tags', 202 );


	// 사용자단에서 한 페이지에 보여지는 개수 수정
	function custom_study_posts_per_page( $query ) {
		if ( ( is_post_type_archive( 'study' ) || is_tax( 'study-type' ) ) && ! is_admin() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 6 );
		}
	}
	add_action( 'pre_get_posts', 'custom_study_posts_per_page' );


	// 메타박스 필드 추가
	function study__meta_boxes( $meta_boxes ) {
		$post_type = 'study';
		$prefix    = $post_type.'_meta_';


		// 기본 데이터
		$meta_boxes[] = array(
			'id'         => 'default_data',
			'title'      => '기본 데이터',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'closed',
					'name'              => '운영 종료 여부',
					'label_description' => '스터디가 종료되었다면 활성화 해주세요.',
					'type'              => 'switch',
					'style'             => 'rounded',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'tech',
					'name'              => '사용 기술',
					'label_description' => '사이트 제작에 사용된 기술 나열하세요.<br>콤마로 구분하여 입력해주세요.',
					'type'              => 'text',
					'desc'              => 'ex) jQuery, PHP, HTML5, CSS3, SASS',
					'std'               => 'HTML5, CSS3, jQuery',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'release',
					'name'              => 'RELEASE',
					'label_description' => '배포 날짜를 선택하세요.',
					'type'              => 'date',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'demo_link',
					'name'              => '데모 링크',
					'label_description' => '오픈된 사이트 혹은 데모 링크 주소 입력하세요.',
					'type'              => 'text',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'github_link',
					'name'              => 'Github 저장소 링크',
					'label_description' => 'Github 저장소 주소 입력하세요.',
					'type'              => 'text',
				),
			),

			// 유효성 검사
			'validation' => array(
				'rules'  => array(
					$prefix.'demo_link' => array(
						'url' => true,
					),
				),
				'messages' => array(
					$prefix.'demo_link' => array(
						'url' => '도메인 형식이 잘못됐습니다. http:// 또는 https://를 붙여주시거나 주소를 다시 확인해주세요.'
					),
				)
			),
		);


		// 스터디 상세 소개
		$meta_boxes[] = array(
			'id'         => 'detail',
			'title'      => '스터디 상세 소개',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'detail',
					'name'              => '스터디 상세 소개',
					'label_description' => '스터디에대한 상세 소개를 입력해주세요.',
					'type'              => 'wysiwyg',
				),
			),
		);


		// 스크린샷
		$meta_boxes[] = array(
			'id'         => 'screenshot',
			'title'      => '스크린샷',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'screenshot',
					'name'              => '스크린샷',
					'label_description' => '클릭하면 최대화면으로 노출되는 화면 스크린샷 선택하세요.',
					'type'              => 'image_advanced',
				),
			),
		);


		// Changelog(History) 기록하기
		$meta_boxes[] = array(
			'id'         => 'history',
			'title'      => '스터디 히스토리',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'history',
					'name'              => '스터디 히스토리',
					'label_description' => '스터디의 수정 기록을 남겨주세요.',
					'type'              => 'wysiwyg',
				),
			),
		);


		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'study__meta_boxes' );


	// 메타박스 호출 방식 변경
	function study_meta( $key, $array = false ) {
		return $array ? rwmb_meta( 'study_meta_'.$key, $array ) : rwmb_meta( 'study_meta_'.$key );
	}
