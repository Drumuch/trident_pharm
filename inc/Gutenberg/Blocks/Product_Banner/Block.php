<?php

namespace FP\Gutenberg\Blocks\Product_Banner;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-product-banner';

	public function init_fields() {


		$this->add_field( [
			'name'         => 'banners',
			'label'        => __( 'Banners', 'fp' ),
			'type'         => 'repeater',
			'layout'       => 'block',
			'min'          => 1,
			'max'          => 3,
			'button_label' => __( 'Add Banner', 'fp' ),
			'sub_fields'   => [
				[
					'label'         => __( 'Fill Type', 'fp' ),
					'name'          => 'fill_type',
					'type'          => 'button_group',
					'choices'       => [
						'auto'   => __( 'Auto', 'fp' ),
						'manual' => __( 'Manual', 'fp' ),
					],
					'default_value' => 'auto'
				],
				[
					'label'             => __( 'Product', 'fp' ),
					'name'              => 'product',
					'type'              => 'post_object',
					'post_type'         => [
						0 => 'post',
					],
					'post_status'       => [
						0 => 'publish',
					],
					'multiple'          => false,
					'ui'                => true,
					'allow_null'        => false,
					'return_format'     => 'object',
					'conditional_logic' => [
						[
							'field'    => $this->get_key( 'banners_fill_type' ),
							'operator' => '!=',
							'value'    => 'manual',
						]
					],
				],
				[
					'label'             => __( 'Title', 'fp' ),
					'name'              => 'title',
					'type'              => 'text',
					'default_value'     => 'Orlistat',
					'conditional_logic' => [
						[
							'field'    => $this->get_key( 'banners_fill_type' ),
							'operator' => '==',
							'value'    => 'manual',
						]
					],
				],
				[
					'label'         => __( 'Sub Title', 'fp' ),
					'name'          => 'subtitle',
					'type'          => 'text',
					'default_value' => 'För viktminskning'
				],
				[
					'label'             => __( 'Image', 'fp' ),
					'name'              => 'image',
					'type'              => 'image',
					'return_format'     => 'id',
					'conditional_logic' => [
						[
							'field'    => $this->get_key( 'banners_fill_type' ),
							'operator' => '==',
							'value'    => 'manual',
						]
					],
				],
				[
					'label' => __( 'Link', 'fp' ),
					'name'  => 'link',
					'type'  => 'link',
				],
			]
		] );

	}

}
