<?php

namespace FP\Plugins\Acf\Shared;

defined( 'ABSPATH' ) || exit;

use FP\Plugins\Acf\Post_Type;

class Popup extends Post_Type {
	public function init(): void {

		$this->init_fields();

		$this->handle_sub_fields();

		if ( empty( $this->fields ) ) {
			return;
		}

		$args = [
			'key'      => $this->get_key( 'group' ),
			'title'    => __( 'Popup', 'fp' ),
			'fields'   => $this->fields,
			'location' => [
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					],
				],
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					],
				],
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'blog',
					],
				],

			],
		];

		acf_add_local_field_group( $args );
	}

	public function init_fields() {
		$this->add_field( [
			'name'       => 'popup',
			'type'       => 'group',
			'sub_fields' => [
				[
					'name'          => 'timer',
					'label'         => __( 'Timer', 'fp' ),
					'type'          => 'number',
					'default_value' => '5',
					'wrapper'       => [
						'width' => '50',
					],
				],
				[
					'name'          => 'display',
					'label'         => __( 'Display', 'fp' ),
					'type'          => 'button_group',
					'choices'       => [
						'hide' => __( 'Hide', 'fp' ),
						'show' => __( 'Show', 'fp' ),
					],
					'default_value' => 'hide',
					'wrapper'       => [
						'width' => '50',
					],
				],
				[
					'name'          => 'title',
					'label'         => __( 'Title', 'fp' ),
					'type'          => 'text',
					'default_value' => 'Lorem ipsum',
				],
				[
					'name'          => 'description',
					'label'         => __( 'Description', 'fp' ),
					'type'          => 'textarea',
					'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis, lectus magna',
				],
				[
					'name'          => 'promo_code',
					'label'         => __( 'Promo Code', 'fp' ),
					'type'          => 'text',
					'default_value' => 'ED2566767878778988888',
				],
				[
					'name'  => 'link',
					'label' => __( 'Link', 'fp' ),
					'type'  => 'link',
				]
			]
		] );

	}
}
