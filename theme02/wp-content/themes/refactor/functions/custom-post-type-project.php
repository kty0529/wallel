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
	function prefix_enqueue_custom_style() {
		wp_enqueue_style( 'metabox-style', get_template_directory_uri() . '/css/metabox-admin.css' );
	}
	add_action( 'rwmb_enqueue_scripts', 'prefix_enqueue_custom_style' );

	function prefix_register_meta_boxes( $meta_boxes ) {
		$post_type = 'project';
		$prefix    = $post_type.'_meta_';

		/**
		 * 목업
		 */
		$meta_boxes[] = array(
			'id'         => 'mockup',
			'title'      => '목업',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'mockup',
					'name'              => '목업',
					'label_description' => '페이지 상단에 나타나는 목업 선택하세요.',
					'type'              => 'image_upload',
					'desc'              => '최대 1장 업로드 가능',
					'max_file_uploads'  => 1,
					'force_delete'      => true,
				),
			), // end fields array
		); // end $meta_boxes[] array


		/**
		 * 기본 정보
		 */
		$meta_boxes[] = array(
			'id'         => 'default_data',
			'title'      => '기본 정보',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'tech',
					'name'              => '사용 기술',
					'label_description' => '사이트 제작에 사용된 기술 나열하세요.',
					'type'              => 'text',
					'desc'              => 'ex) jQuery, PHP, HTML5, CSS3, SASS',
					'std'               => 'HTML5, CSS3, jQuery',
				),
				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'client',
					'name'              => 'CLIENT',
					'label_description' => '클라이언트명 입력하세요.',
					'type'              => 'text',
					'desc'              => 'ex) Naver',
					'std'               => '',
				),
				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'release',
					'name'              => 'RELEASE',
					'label_description' => '공개한 날짜 선택하세요.',
					'type'              => 'date',
					'desc'              => '',
					'std'               => '',
				),
				array(
					'type' => 'divider',
				),
				array(
					'id'                => $prefix.'cms',
					'name'              => 'CMS',
					'label_description' => '사용한 CMS 선택하세요.',
					'type'              => 'radio',
					'options'           => array(
						'wordpress' => 'Wordpress',
						'tistory'   => 'Tistory',
						'kboard'    => 'KBoard',
					),
					'inline'            => false,
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
			), // end fields array

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
		); // end $meta_boxes[] array


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
			), // end fields array
		); // end $meta_boxes[] array


		/**
		 * 기능 소개
		 */
		$meta_boxes[] = array(
			'id'         => 'support',
			'title'      => '기능 소개',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				/**
				 * 기본기능
				 */
				array(
					'id'        => $prefix.'enable_support',
					'name'      => 'Section 사용 여부',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => '예',
					'off_label' => '아니오',
				),

				array(
					'id'                => $prefix.'support_1',
					'name'              => '기본 기능 List 1',
					'label_description' => '기본 기능을 나열하세요.',
					'type'              => 'text',
					'clone'             => true,
					'sort_clone'        => true,
					'add_button'        => '항목 추가',
				),
				array(
					'id'                => $prefix.'support_2',
					'name'              => '기본 기능 List 2',
					'label_description' => '기본 기능을 나열하세요.',
					'type'              => 'text',
					'clone'             => true,
					'sort_clone'        => true,
					'add_button'        => '항목 추가',
				),
				array(
					'id'                => $prefix.'support_3',
					'name'              => '기본 기능 List 3',
					'label_description' => '기본 기능을 나열하세요.',
					'type'              => 'text',
					'clone'             => true,
					'sort_clone'        => true,
					'add_button'        => '항목 추가',
				),

				array(
					'type' => 'divider',
				),

				/**
				 * 강조기능
				 */
				array(
					'id'        => $prefix.'enable_import_tech',
					'name'      => 'Section 사용 여부',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => '예',
					'off_label' => '아니오',
				),
				array(
					'id'                => $prefix.'import_tech',
					'name'              => '강조 기능',
					'label_description' => '강조할 기능의 스크린샷 선택하세요.',
					'type'              => 'image_advanced',
					'desc'              => '이미지 편집 기능을 통해 이미지 자체에 <strong>타이틀</strong>과 <strong>설명</strong>을 기입해야 합니다.',
				),
			), // end fields array
		); // end $meta_boxes[] array


		/**
		 * 브라우저 지원
		 */
		$meta_boxes[] = array(
			'id'         => 'browser_support',
			'title'      => '브라우저 지원',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'        => $prefix.'enable_browser_support',
					'name'      => 'Section 사용 여부',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => '예',
					'off_label' => '아니오',
				),
				array(
					'id'                => $prefix.'browser_support',
					'name'              => '브라우저 지원',
					'label_description' => '지원 하는 브라우저를 선택하세요.',
					'type'              => 'checkbox_list',
					'options'           => array(
						'chrome'                => 'Chrome',
						'firefox'               => 'Firefox',
						'internet explorer 9+'  => 'Internet Explorer 9+',
						'internet explorer 10+' => 'Internet Explorer 10+',
						'internet explorer 11+' => 'Internet Explorer 11+',
						'opera'                 => 'Opera',
						'safari'                => 'Safari',
					),
				),
			), // end fields array
		); // end $meta_boxes[] array


		/**
		 * 판매 및 배포 옵션
		 */
		$meta_boxes[] = array(
			'id'         => 'selling',
			'title'      => '판매 및 배포 옵션',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'tabs'       => array(
				'default'       => array(
					'label' => '기본 옵션',
				),
				'free'          => array(
					'label' => 'FREE',
				),
				'license'       => array(
					'label' => 'LICENSE',
				),
				'support'  => array(
					'label' => 'SUPPORT',
				),
			),

			'tab_style'  => 'left',

			'fields'     => array(

				array(
					'id'                => $prefix.'best_selling',
					'name'              => '베스트 라벨',
					'label_description' => '카드에 BEST 라벨을 붙일 타입을 선택하세요.',
					'type'              => 'radio',
					'options'           => array(
						'free'    => 'FREE',
						'license' => 'LICENSE',
						'support' => 'SUPPORT',
					),
					'tab'               => 'default',
				),
				array(
					'type' => 'divider',
					'tab'  => 'default',
				),
				array(
					'id'                => $prefix.'select_download_file',
					'name'              => '파일 선택',
					'label_description' => 'Downloads에 등록된 파일을 선택하세요.',
					'type'              => 'post',
					'post_type'         => 'dlm_download',
					'field_type'        => 'select',
					'query_args'  => array(
						'post_status'    => 'publish',
						'posts_per_page' => -1,
					),
					'tab'               => 'default',
				),
				array(
					'type' => 'divider',
					'tab'  => 'default',
				),
				array(
					'id'        => $prefix.'enable_free_selling',
					'name'      => 'FREE 사용 여부',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => '예',
					'off_label' => '아니오',
					'tab'       => 'default',
				),
				array(
					'id'        => $prefix.'enable_license_selling',
					'name'      => 'LICENSE 사용 여부',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => '예',
					'off_label' => '아니오',
					'tab'       => 'default',
				),
				array(
					'id'        => $prefix.'enable_support_selling',
					'name'      => 'SUPPORT 사용 여부',
					'type'      => 'switch',
					'style'     => 'square',
					'on_label'  => '예',
					'off_label' => '아니오',
					'tab'       => 'default',
				),


				/**
				 * Free 텝
				 */
				array(
					'id'      => $prefix.'free_scope',
					'name'    => '지원 범위',
					'type'    => 'checkbox_list',
					'options' => array(
						'file_download'  => '파일제공',
						'normal_support' => '일반문의 지원',
						'remove_license' => '라이센스 제거',
						'tech_support'   => '기술문의 지원',
					),
					'tab'     => 'free',
				),


				/**
				 * License 텝
				 */
				array(
					'id'   => $prefix.'license_amount',
					'name' => '판매가',
					'type' => 'number',
					'desc' => '단위: 원',
					'tab'  => 'license',
				),
				array(
					'type' => 'divider',
					'tab'  => 'license',
				),
				array(
					'id'      => $prefix.'license_scope',
					'name'    => '지원 범위',
					'type'    => 'checkbox_list',
					'options' => array(
						'file_download'  => '파일제공',
						'normal_support' => '일반문의 지원',
						'remove_license' => '라이센스 제거',
						'tech_support'   => '기술문의 지원',
					),
					'tab'     => 'license',
				),


				/**
				 * Tech Support 텝
				 */
				array(
					'id'   => $prefix.'support_amount',
					'name' => '판매가',
					'type' => 'number',
					'desc' => '단위: 원',
					'tab'  => 'support',
				),
				array(
					'type' => 'divider',
					'tab'  => 'support',
				),
				array(
					'id'      => $prefix.'support_scope',
					'name'    => '지원 범위',
					'type'    => 'checkbox_list',
					'options' => array(
						'file_download'  => '파일제공',
						'normal_support' => '일반문의 지원',
						'remove_license' => '라이센스 제거',
						'tech_support'   => '기술문의 지원',
					),
					'tab'     => 'support',
				),

			),
		); // end $meta_boxes[] array

		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'prefix_register_meta_boxes' );


	/**
	 * Metabox를 쉽게 사용하기 위해서 제작
	 *
	 * 기존 방식
	 * rwmb_meta( 'project_meta_mockup', array( 'limit' => 1 ) ); 또는 rwmb_meta( 'project_meta_mockup' );
	 * 변경된 방식
	 * metabox( 'mockup', array( 'limit' => 1 ) ); 또는 metabox( 'mockup' );
	 */
	function metabox( $key, $array = false ) {

		if ( $array ) {
			return rwmb_meta( 'project_meta_'.$key, $array );
		} else {
			return rwmb_meta( 'project_meta_'.$key );
		}

		return false;
	}
