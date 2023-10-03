<?php

namespace FP\Post_Type;

defined( 'ABSPATH' ) || exit;

abstract class Post_Type {

	const NAME = '';
	const SLUG = '';

	protected $post;

	public function config() : array {
		return [];
	}

	/**
	 * Register post type
	 */
	public function register() : void {
		register_post_type( static::NAME, $this->config() );
	}

}
