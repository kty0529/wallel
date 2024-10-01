<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	// CPT 생성
	function create_post_type__portfolio() {
		$labels = array(
			'name'           => '포트폴리오',
			'singular_name'  => '포트폴리오',
			'menu_name'      => '포트폴리오',
			'all_items'      => '모든 포트폴리오',
			'add_new'        => '새 포트폴리오 추가',
			'add_new_item'   => '새 포트폴리오 추가',
			'edit_item'      => '포트폴리오 편집',
			'search_items'   => '포트폴리오 검색',
			'name_admin_bar' => '포트폴리오',
			'archives'       => '포트폴리오 아카이브',
		);

		$args = array(
			'label'         => '포트폴리오',
			'description'   => '포트폴리오를 등록할 수 있습니다.',
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'tags', 'thumbnail', 'taxonomy', 'revisions' ),
			'menu_position' => 5,
			'taxonomies'    => false,
			'show_in_rest'  => true,
			'rest_base'     => 'portfolio',
		);

		register_post_type( 'portfolio', $args );
	}
	add_action( 'init', 'create_post_type__portfolio', 200 );


	// Taxonomy(카테고리) 생성
	function create__portfolio__taxonomies() {
		$labels = array(
			'name'          => '포트폴리오 카테고리', // 관리자 화면 글 목록의 카테고리 컬럼명
			'singular_name' => '카테고리',
			'menu_name'     => '카테고리',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
		);

		register_taxonomy( 'portfolio-type', array( 'portfolio' ), $args );
	}
	add_action( 'init', 'create__portfolio__taxonomies', 201 );


	// Tag 생성
	function create__portfolio__tags() {
		$labels = array(
			'name'          => '포트폴리오 태그',
			'singular_name' => '태그',
			'menu_name'     => '태그',
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
		);

		register_taxonomy( 'portfolio-tag', array( 'portfolio' ), $args );
	}
	add_action( 'init', 'create__portfolio__tags', 202 );


	// 사용자단에서 한 페이지에 보여지는 개수 수정
	function custom_portfolio_posts_per_page( $query ) {
		if ( ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio-type' ) ) && ! is_admin() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 9 );
		}
	}
	add_action( 'pre_get_posts', 'custom_portfolio_posts_per_page' );


	// 메타박스 필드 추가
	function portfolio__meta_boxes( $meta_boxes ) {
		$post_type = 'portfolio';
		$prefix    = $post_type.'_meta_';


		// 기본 데이터
		$meta_boxes[] = array(
			'id'         => 'default_data',
			'title'      => '정보',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'date',
					'name'              => '작업 소요 기간',
					'label_description' => '작업 소요 기간을 선택해주세요.',
					'type'              => 'group',
					'fields'            => [
						[
							'id'   => 'start',
							'name' => '시작',
							'type' => 'date',
						],
						[
							'id'   => 'end',
							'name' => '종료',
							'type' => 'date',
						],
					],
				),

				array(
					'type' => 'divider',
				),

				array(
					'id'                => $prefix.'part',
					'name'              => '담당 파트',
					'label_description' => '담당 파트의 기여율을 정의해주세요.',
					'type'              => 'group',
					'fields'            => [
						[
							'id'         => 'planning',
							'name'       => '기획',
							'type'       => 'slider',
							'suffix'     => '%',
							'js_options' => [
								'min'  => 0,
								'max'  => 100,
								'step' => 10,
							],
							'std'        => 0,
						],
						[
							'id'         => 'design',
							'name'       => '디자인',
							'type'       => 'slider',
							'suffix'     => '%',
							'js_options' => [
								'min'  => 0,
								'max'  => 100,
								'step' => 10,
							],
							'std'        => 0,
						],
						[
							'id'         => 'develop',
							'name'       => '개발',
							'type'       => 'slider',
							'suffix'     => '%',
							'js_options' => [
								'min'  => 0,
								'max'  => 100,
								'step' => 10,
							],
							'std'        => 0,
						],
					],
				),

				array(
					'type' => 'divider',
				),

				array(
					'id'                => $prefix.'screenshots',
					'name'              => '스크린샷',
					'type'              => 'file_advanced',
					'force_delete'      => false,
					'label_description' => '스크린샷을 등록해주세요.',
				),

				array(
					'type' => 'divider',
				),

				array(
					'id'                => $prefix.'url',
					'name'              => '바로가기 URL',
					'type'              => 'text',
					'label_description' => '바로가기 URL이 있다면 등록해주세요.<br>(http://, https:// 포함)',
				),
			),
		);

		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'portfolio__meta_boxes' );


	// 메타박스 호출 방식 변경
	function portfolio_meta( $key, $array = false ) {
		return $array ? rwmb_meta( 'portfolio_meta_'.$key, $array ) : rwmb_meta( 'portfolio_meta_'.$key );
	}
