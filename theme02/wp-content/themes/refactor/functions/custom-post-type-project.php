<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

	function create_post_type__project() {
		$labels = array(
			'name'           => '프로젝트',
			'singular_name'  => '프로젝트',
			'menu_name'      => '프로젝트',
			'all_items'      => '모든 프로젝트',
			'add_new'        => '새 프로젝트 추가',
			'add_new_item'   => '새 프로젝트 추가',
			'edit_item'      => '프로젝트 편집',
			'search_items'   => '프로젝트 검색',
			'name_admin_bar' => '프로젝트',
			'archives'       => '프로젝트 아카이브',
		);

		$args = array(
			'label'               => '프로젝트',
			'description'         => '프로젝트를 등록할 수 있습니다.',
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => true,
			'supports'            => array( 'title', 'editor', 'tags', 'thumbnail', 'revisions' ),
			'menu_position'       => 5,
			'taxonomies'          => false
		);

		register_post_type( 'project', $args );
	}
	add_action( 'init', 'create_post_type__project', 200 );


	function create__project__taxonomies() {
		$labels = array(
			'name'          => '프로젝트 카테고리', // 관리자 화면 글 목록의 카테고리 컬럼명
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

		register_taxonomy( 'project-type', array( 'project' ), $args );
	}
	add_action( 'init', 'create__project__taxonomies', 201 );


	function create__project__tags() {
		$labels = array(
			'name'          => '프로젝트 태그',
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

		register_taxonomy( 'project-tag', array( 'project' ), $args );
	}
	add_action( 'init', 'create__project__tags', 202 );


	function custom_project_posts_per_page( $query ) {
		if ( ( is_post_type_archive( 'project' ) || is_tax( 'project-type' ) ) && ! is_admin() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 6 );
		}
	}
	add_action( 'pre_get_posts', 'custom_project_posts_per_page' );


	/**
	 * 메타박스 추가
	 */
	// 메타박스용 스타일 추가
	function prefix_enqueue_custom_style() {
		wp_enqueue_style( 'metabox-style', get_template_directory_uri() . '/assets/css/metabox-admin.css' );
	}
	add_action( 'rwmb_enqueue_scripts', 'prefix_enqueue_custom_style' );

	// 메타박스 필드 추가
	function prefix_register_meta_boxes( $meta_boxes ) {
		$post_type = 'project';
		$prefix    = $post_type.'_meta_';

		/**
		 * 기본 데이터
		 */
		$meta_boxes[] = array(
			'id'         => 'default_data',
			'title'      => '기본 데이터',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
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
					'desc'              => '',
					'std'               => '',
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


		/**
		 * 프로젝트 상세 소개
		 */
		$meta_boxes[] = array(
			'id'         => 'detail',
			'title'      => '프로젝트 상세 소개',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'detail',
					'name'              => '프로젝트 상세 소개',
					'label_description' => '프로젝트에대한 상세 소개를 입력해주세요.',
					'type'              => 'wysiwyg',
				),
			),
		);


		/**
		 * 스크린샷
		 */
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

		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'prefix_register_meta_boxes' );


	/**
	 * Metabox를 쉽게 사용하기 위해서 제작
	 *
	 * 기존 방식
	 * rwmb_meta( 'project_meta_mockup', array( 'limit' => 1 ) ); 또는 rwmb_meta( 'project_meta_mockup' );
	 * 변경된 방식
	 * project_meta( 'mockup', array( 'limit' => 1 ) ); 또는 project_meta( 'mockup' );
	 */
	function project_meta( $key, $array = false ) {

		if ( $array ) {
			return rwmb_meta( 'project_meta_'.$key, $array );
		} else {
			return rwmb_meta( 'project_meta_'.$key );
		}

		return false;
	}
