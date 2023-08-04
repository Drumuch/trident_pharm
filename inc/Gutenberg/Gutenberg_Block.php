<?php

namespace FP\Gutenberg;

defined( 'ABSPATH' ) || exit;

use FP\Plugins\Acf\Group;

abstract class Gutenberg_Block extends Group {

	// dashes only
    const NAME = '';

	private $path;
	private $script_uri;

	public function __construct( $path, $script_uri  ) {
		$this->path       = $path;
		$this->script_uri = $script_uri;
	}

	/**
	 * ACF form init
	 *
	 * @return void
	 *
	 * @action acf/init
	 */
	public function init(): void {
		$this->init_fields();

		$this->handle_sub_fields();

		if ( empty( $this->fields ) ) {
			return;
		}

		$args = [
			'key'    => $this->get_key( 'group' ),
			'title'  => $this->title(),
			'fields' => $this->fields,
		];

		if ( static::NAME ) {
			$args['location'][] = [
				[
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'acf/' . static::NAME,
				],
			];
		}

		acf_add_local_field_group( $args );
	}

	public function register_block() {
		register_block_type( $this->path );
		$this->register_script();
	}

	public function register_script() {
		$file = $this->script_uri . '/app.js';
		wp_register_script( 'block-' . static::NAME, $file, [], THEME_VERSION, true );
	}

	public static function enqueue_script() {
		wp_enqueue_script( 'block-' . static::NAME );
	}

}
