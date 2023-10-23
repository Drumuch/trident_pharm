<?php

namespace FP\Gutenberg\Blocks\Pop_Up;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-pop-up';

	public function init_fields() {
		$this->add_field( [
			'name'          => 'timer',
			'label'         => __( 'Timer', 'fp' ),
			'type'          => 'number',
			'default_value' => '5',
			'wrapper'       => [
				'width' => '50',
			],
		] );

		$this->add_field( [
			'name'          => 'display',
			'label'         => __( 'Display', 'fp' ),
			'type'          => 'button_group',
			'choices'       => [
				'hide' => __( 'Hide', 'fp' ),
				'show' => __( 'Show', 'fp' ),
			],
			'default_value' => 'show',
			'wrapper'       => [
				'width' => '50',
			],
		] );

		$this->add_field( [
			'name'          => 'title',
			'label'         => __( 'Title', 'fp' ),
			'type'          => 'text',
			'default_value' => 'Lorem ipsum',
		] );

		$this->add_field( [
			'name'          => 'description',
			'label'         => __( 'Description', 'fp' ),
			'type'          => 'textarea',
			'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis, lectus magna',
		] );

		$this->add_field( [
			'name'          => 'promo_code',
			'label'         => __( 'Promo Code', 'fp' ),
			'type'          => 'text',
			'default_value' => 'ED2566767878778988888',
		] );

		$this->add_field( [
			'name'  => 'link',
			'label' => __( 'Link', 'fp' ),
			'type'  => 'link',
		] );

	}

}
