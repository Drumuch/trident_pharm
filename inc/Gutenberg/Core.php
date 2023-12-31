<?php

namespace FP\Gutenberg;

defined( 'ABSPATH' ) || exit;

class Core {
	const DEFAULT_BLOCKS = [
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/quote',
		'core/table',
		'core/table-of-contents',
		'core/block',
		'core/template',
	];

	// TODO: Refactor to use the main block array from Register.php
	const CUSTOM_BLOCKS = [
		'acf/fp-faq',
		'acf/fp-bullet',
		'acf/fp-pros-cons',
		'acf/fp-latest-products',
		'acf/fp-contact-form',
		'acf/fp-product-item',
		'acf/fp-product-banner',
		'acf/fp-simple-banner',
		'acf/fp-order-button',
	];


	public function __construct() {
		// remove core blocks
		add_filter( 'allowed_block_types_all', [ $this, 'allowed_blocks' ] );
		// disable gutenberg editor
		add_filter( 'gutenberg_can_edit_post_type', [ $this, 'disable_gutenberg_editor' ], 10, 2 );
		add_filter( 'use_block_editor_for_post_type', [ $this, 'disable_gutenberg_editor' ], 10, 2 );
		// remove blocks pattern
		add_action( 'init', [ $this, 'remove_block_pattern' ] );

	}

	public function remove_block_pattern() {
		remove_theme_support( 'core-block-patterns' );
	}

	/**
	 * Templates and Page IDs without editor
	 */
	function disable_editor( $id = false ) {

		$excluded_templates = [//			'page-templates/contact-us.php',
		];

		$excluded_ids = [ get_option( 'page_for_posts' ) ];

		if ( empty( $id ) ) {
			return false;
		}

		$id       = intval( $id );
		$template = get_page_template_slug( $id );

		return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
	}

	/**
	 * Disable Gutenberg by template
	 */
	function disable_gutenberg_editor( $can_edit, $post_type ) {

		if ( ! ( is_admin() && ! empty( $_GET['post'] ) ) ) {
			return $can_edit;
		}

		if ( $this->disable_editor( $_GET['post'] ) ) {
			$can_edit = false;
		}

		return $can_edit;

	}

	public function allowed_blocks( $allowed_blocks ): array {

		$blocks = array_merge( static::DEFAULT_BLOCKS, static::CUSTOM_BLOCKS );

		return $blocks;
	}
}
