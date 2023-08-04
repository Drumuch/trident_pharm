<?php

namespace FP\Theme;

defined( 'ABSPATH' ) || exit;

class Support {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

		if( ! class_exists('ACF') && ! is_admin() ) {
		    wp_die('Pls activate ACF Plugin');
		}
	}

	public function theme_support() {
		register_nav_menus(
			array(
				'desktop_nav' => esc_html__( 'Desktop Nav', 'fp' ),
				'footer_nav'  => esc_html__( 'Footer Nav', 'fp' ),
			)
		);
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );

		add_filter( 'acf/fields/wysiwyg/toolbars', array( $this, 'custom_header_toolbar' ) );
	}

	public function custom_header_toolbar( $toolbars ) {
		$toolbars['FP Header Toolbar'][1] = [
			'bold',
			'italic',
			'underline',
			'link',
			'unlink',
		];

		return $toolbars;
	}
}
