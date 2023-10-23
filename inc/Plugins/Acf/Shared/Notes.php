<?php

namespace FP\Plugins\Acf\Shared;

defined( 'ABSPATH' ) || exit;

use FP\Plugins\Acf\Post_Type;

class Notes extends Post_Type {
	public function init(): void {

		$this->init_fields();

		$this->handle_sub_fields();

		if ( empty( $this->fields ) ) {
			return;
		}

		$args = [
			'key'    => $this->get_key( 'group' ),
			'title'  => __( 'Post Notes', 'fp' ),
			'fields' => $this->fields,
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
			'label' => __( 'Notes', 'fp' ),
			'name'  => 'notes',
			'type'  => 'textarea',
			'rows'  => 12,
		] );

	}
}
