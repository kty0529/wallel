<?php
	function prefix_register_meta_boxes_dlm_download( $meta_boxes ) {
		$post_type = 'dlm_download';
		$prefix    = $post_type.'_meta_';

		/**
		 * 목업
		 */
		$meta_boxes[] = array(
			'id'         => 'document_url',
			'title'      => '가이드 문서',
			'post_types' => $post_type,
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'id'                => $prefix.'document_url',
					'name'              => '가이드 문서 주소',
					'label_description' => '가이드 문서의 URL을 입력해주세요.',
					'type'              => 'text',
					'size'              => 100,
				),
			), // end fields array
		); // end $meta_boxes[] array

		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'prefix_register_meta_boxes_dlm_download' );
