<?php

namespace FP\Plugins\Acf\Post_Types;

defined( 'ABSPATH' ) || exit;

use FP\Plugins\Acf\Post_Type;

class Post extends Post_Type {

	const POST_TYPE = 'post';

	public function init(): void {

		$this->init_fields();

		$this->handle_sub_fields();

		if ( empty( $this->fields ) ) {
			return;
		}

		$args = [
			'key'    => $this->get_key( 'group' ),
			'title'  => $this->title(),
			'fields' => $this->fields,
		];

		$args['location'][] = [
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => static::POST_TYPE,
			],
		];

		acf_add_local_field_group( $args );
	}

	public function init_fields() {
		$this->add_tab( __( 'Settings', 'fp' ) );
		$this->add_field( [
			'label'      => __( 'Settings', 'fp' ),
			'name'       => 'settings',
			'type'       => 'group',
			'sub_fields' => [
				[
					'label'         => __( 'Load Type', 'fp' ),
					'name'          => 'load_type',
					'type'          => 'button_group',
					'choices'       => [
						'auto'   => __( 'Auto', 'fp' ),
						'manual' => __( 'Manual', 'fp' ),
					],
					'default_value' => 'auto',
					'return_format' => 'value',
					'instructions'  => __( 'If you choose manual, you will have the opportunity to select products yourself, by default they will be loaded 10 latest ones.', 'fp' ),
				],
				[
					'label'             => __( 'Related Product', 'fp' ),
					'name'              => 'related_product',
					'type'              => 'relationship',
					'min'               => 1,
					'max'               => 10,
					'instructions'      => __( 'Max 10 products posts are allowed. You can easily manage the order by dragging.', 'fp' ),
					'return_format'     => 'id',
					'conditional_logic' => [
						[
							'field'    => $this->get_key( 'settings_load_type' ),
							'operator' => '==',
							'value'    => 'manual',
						]
					],
					'post_type'         => [
						0 => 'post',
					],
					'post_status'       => [
						0 => 'publish',
					],
					'filters'           => [
						0 => 'search',
						1 => 'taxonomy',
					]
				]
			],
		] );

		$this->add_tab( __( 'Gallery', 'fp' ) );
		$this->add_field( [
			'label' => __( 'Gallery', 'fp' ),
			'name'  => 'gallery',
			'type'  => 'gallery',
		] );

		$this->add_tab( __( 'Intro Banners', 'fp' ) );

		$this->add_field( [
			'label'        => __( 'Intro Banners', 'fp' ),
			'name'         => 'banners',
			'type'         => 'repeater',
			'button_label' => __( 'Add Banner', 'fp' ),
			'sub_fields'   => [
				[
					'label'         => __( 'Description', 'fp' ),
					'name'          => 'description',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'Endast originalläkemedel från världens bästa tillverkare...'
				],
				[
					'label'         => __( 'Banner Title', 'fp' ),
					'name'          => 'banner_title',
					'type'          => 'text',
					'wrapper'       => [
						'width' => '50',
					],
					'default_value' => 'Online service: Belgie'
				],
				[
					'label'   => __( 'Banner Link', 'fp' ),
					'name'    => 'banner_link',
					'type'    => 'link',
					'wrapper' => [
						'width' => '50',
					],
				],
			],
			'min'          => 0,
			'max'          => 2,
			'layout'       => 'block'
		] );

		$this->add_tab( __( 'Ads Banners', 'fp' ) );

		$this->add_field( [
			'label'        => __( 'Ads Banners', 'fp' ),
			'name'         => 'ads_banners',
			'type'         => 'repeater',
			'button_label' => __( 'Add Banner', 'fp' ),
			'sub_fields'   => [
				[
					'label'         => __( 'Title', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'KÖPA Priligy Piller Panatet',
					'required'      => 1
				],
				[
					'label'    => __( 'Image', 'fp' ),
					'name'     => 'image',
					'type'     => 'image',
					'wrapper'  => [
						'width' => '50',
					],
					'required' => 1
				],
				[
					'label'    => __( 'Link', 'fp' ),
					'name'     => 'link',
					'type'     => 'link',
					'wrapper'  => [
						'width' => '50',
					],
					'required' => 1
				],
			],
			'min'          => 0,
			'max'          => 3,
			'layout'       => 'block'
		] );

	}
}
