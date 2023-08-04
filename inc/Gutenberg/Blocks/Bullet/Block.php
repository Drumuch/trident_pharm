<?php

namespace FP\Gutenberg\Blocks\Bullet;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-bullet';

	public function init_fields() {

		$this->add_field( [
			'name'          => 'style',
			'label'         => __( 'Style', 'fp' ),
			'type'          => 'button_group',
			'choices'       => [
				'unordered' => __( 'Unordered', 'fp' ),
				'ordered'   => __( 'Ordered', 'fp' ),
			],
			'default_value' => 'unordered'
		] );

		$this->add_field( [
			'label'        => __( 'List', 'fp' ),
			'name'         => 'list',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => __( 'Add Item', 'fp' ),
			'min'          => 1,
			'sub_fields'   => [
				[
					'label'         => __( 'Title', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'Kopalakemedel.com'
				],
				[
					'label'         => __( 'Description', 'fp' ),
					'name'          => 'description',
					'type'          => 'textarea',
					'row'           => '4',
					'default_value' => 'Kopalakemedel.com är en informationswebbplats för dig som vill lära dig mer om populära läkemedel och säkra sätt att köpa dem online. På denna webbplats kommer du inte att kunna få medicinska tjänster, men du kan dygnet runt få gratis recensioner av läkemedel, onlineapotek, och medicinska forum. Denna information ska inte användas för självmedicinering, men den kan vara till stor hjälp för den som letar efter läkemedel på Internet.'
				],
			],
		] );

	}

}
