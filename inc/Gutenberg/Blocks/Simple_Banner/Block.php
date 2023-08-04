<?php

namespace FP\Gutenberg\Blocks\Simple_Banner;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-simple-banner';

	public function init_fields() {

		$this->add_field( [
			'name'          => 'title',
			'label'         => __( 'Title', 'fp' ),
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => __( 'Online service: Belgie', 'fp' ),
		] );

		$this->add_field( [
			'name'  => 'link',
			'label' => __( 'Link', 'fp' ),
			'type'  => 'link',
		] );

	}

}
