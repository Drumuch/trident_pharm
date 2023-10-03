<?php

namespace FP\Gutenberg\Blocks\Faq;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-faq';

	public function init_fields() {

		$this->add_field( [
			'label'        => __( 'Google Markup', 'fp' ),
			'name'         => 'google_markup',
			'type'         => 'button_group',
			'choices'      => [
				'yes'  => __( 'Yes', 'fp' ),
				'no' => __( 'No', 'fp' ),
			],
			'return_format' => 'value',
			'default_value' => 'no',
		]);

		$this->add_field( [
			'label'        => __( 'FAQ', 'fp' ),
			'name'         => 'faq',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => __( 'Add Card', 'fp' ),
			'min'          => 1,
			'sub_fields'   => [
				[
					'label'         => __( 'Title', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'Läkemedelspriserna är föremål för allmänna ?'
				],
				[
					'label'         => __( 'Description', 'fp' ),
					'name'          => 'description',
					'type'          => 'wysiwyg',
					'default_value' => 'Läkemedelspriserna är föremål för allmänna ?',
					'toolbar'       => 'full',
					'media_upload'  => 1,
				],
			],
		] );

	}

}
