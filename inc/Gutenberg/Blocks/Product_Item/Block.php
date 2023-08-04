<?php

namespace FP\Gutenberg\Blocks\Product_Item;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-product-item';

	public function init_fields() {

		$this->add_field( [
			'label'         => __( 'Image', 'fp' ),
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'id',
		] );

		$this->add_field( [
			'label'         => __( 'Title', 'fp' ),
			'name'          => 'title',
			'type'          => 'text',
			'default_value' => 'Var är det mest överkomliga priset för __Ozempic i Sverige?__',
			'instruction'   => __( 'if you want to highlight a word use this rule __TEXT__', 'fp' ),
		] );

		$this->add_field( [
			'label'         => __( 'Description', 'fp' ),
			'name'          => 'description',
			'type'          => 'textarea',
			'rows'          => '4',
			'default_value' => 'Läkemedelspriserna är föremål för allmänna marknadstrender. Tillverkaren justerar Ozempics pris utifrån produktionskostnaderna. Om du hittar ett misstänkt billigt erbjudande bör du tacka nej till det.',
		] );

		$this->add_field( [
			'label' => __( 'Link', 'fp' ),
			'name'  => 'link',
			'type'  => 'link',
		] );

	}

}
