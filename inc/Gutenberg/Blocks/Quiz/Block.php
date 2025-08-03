<?php

namespace FP\Gutenberg\Blocks\Quiz;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-quiz';

	public function init_fields() {

		$this->add_field( [
			'label'         => __( 'Question', 'fp' ),
			'name'          => 'question',
			'type'          => 'text',
			'default_value' => '??',
		] );

		$this->add_field( [
			'label'        => __( 'Quiz', 'fp' ),
			'name'         => 'quiz',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => __( 'Add answer', 'fp' ),
			'min'          => 2,
			'sub_fields'   => [
				[
					'label'         => __( 'Answer', 'fp' ),
					'name'          => 'answer',
					'type'          => 'text',
					'default_value' => 'answer'
				],
			],
		] );

	}
	
	public static function enqueue_script() {
		wp_enqueue_script( 'block-' . static::NAME );
		wp_localize_script('block-' . static::NAME, 'acfWidgetAjax', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('acf_widget_nonce')
		]);
	}

}
