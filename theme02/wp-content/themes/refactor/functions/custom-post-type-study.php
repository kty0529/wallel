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
					'id'                => $prefix.'level',
					'name'              => '난이도',
					'type'              => 'select',
					'select_all_none'   => true,
					'options'           => [
						'beginner'                 => '초급',
						'beginner or intermediate' => '초중급',
						'intermediate'             => '중급',
						'intermediate or advanced' => '중고급',
						'advanced'                 => '고급',
						'other'                    => '기타',
					],
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'type',
					'name'              => '스터디 타입',
					'type'              => 'select',
					'select_all_none'   => true,
					'options'           => [
						'live'   => '라이브 세션 강의',
						'video'  => '영상 강의',
						'mogako' => '모각코',
						'other'  => '기타',
					],
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'   => $prefix.'release',
					'name' => '최초 개설일',
					'type' => 'date',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'   => $prefix.'courses',
					'name' => '외부 플랫폼 URL',
					'type' => 'text',
				),
			),

			// 유효성 검사
			'validation' => array(
				'rules'  => array(
					$prefix.'courses' => array(
						'url' => true,
					),
				),
				'messages' => array(
					$prefix.'courses' => array(
						'url' => '도메인 형식이 잘못됐습니다. http:// 또는 https://를 붙여주시거나 주소를 다시 확인해주세요.'
					),
				)
			),
		);


		// 라이브 세션 정보
		$meta_boxes[] = array(
			'id'         => 'live',
			'title'      => '라이브 세션 정보',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'   => $prefix.'start_at',
					'name' => '모집 시작일',
					'type' => 'date',
				),
				array(
					'id'   => $prefix.'end_at',
					'name' => '모집 종료일',
					'type' => 'date',
				),
				array(
					'id'   => $prefix.'total_student',
					'name' => '모집 인원',
					'type' => 'number',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'   => $prefix.'lecture_start_at',
					'name' => '강의 시작일',
					'type' => 'date',
				),
				array(
					'id'   => $prefix.'lecture_end_at',
					'name' => '강의 종료일',
					'type' => 'date',
				),

				array(
					'type' => 'divider',
				),
				array(
					'id'   => $prefix.'location',
					'name' => '스터디 장소',
					'type' => 'text',
				),
			),
		);

		// 추천 대상 및 기대 효과
		$meta_boxes[] = array(
			'id'         => 'recommended',
			'title'      => '추천 대상 및 기대 효과',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'   => $prefix.'recommended',
					'type' => 'wysiwyg',
				),
			),
		);

		// 강사 소개
		$meta_boxes[] = array(
			'id'         => 'instructor',
			'title'      => '강사 소개',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'   => $prefix.'instructor',
					'type' => 'wysiwyg',
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
