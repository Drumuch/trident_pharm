<?php

namespace FP\Gutenberg\Blocks\Latest_Products;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-latest-products';

	public function init_fields() {

		$this->add_field( [
			'name'          => 'title',
			'label'         => __( 'Title', 'fp' ),
			'type'          => 'text',
			'default_value' => __( 'Top products', 'fp' ),
		] );

		$this->add_field( [
			'name'          => 'load_type',
			'label'         => __( 'Load Type', 'fp' ),
			'type'          => 'button_group',
			'choices'       => [
				'auto'   => 'Auto',
				'manual' => 'Manual',
			],
			'default_value' => 'auto',
		] );

		$this->add_field( [
			'name'              => 'products',
			'label'             => __( 'Products', 'fp' ),
			'type'              => 'relationship',
			'post_status'       => [
				0 => 'publish',
			],
			'post_type'         => [
				0 => 'post',
			],
			'filters'           => [
				0 => 'search',
			],
			'return_format'     => 'id',
			'conditional_logic' => [
				[
					'field'    => $this->get_key( 'load_type' ),
					'operator' => '==',
					'value'    => 'manual',
				]
			],
		] );

		$this->add_field( [
			'name'          => 'link',
			'label'         => __( 'Link', 'fp' ),
			'type'          => 'link',
		] );

	}

}
