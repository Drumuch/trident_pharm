<?php

namespace FP\Theme;

defined( 'ABSPATH' ) || exit;

class Enqueue {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'global_assets' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'cf7_js_styles' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'login_stylesheet' ), 20 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'admin_styles_and_scripts' ), 999, 2 );
//		add_action( 'init', array( $this, 'admin_editor_style' ) );
	}

	public function admin_editor_style() {
		add_editor_style( THEME_URI . 'dist/assets/css/admin-editor.css' );
	}

	public function admin_styles_and_scripts() {
		wp_enqueue_style( 'custom-admin', THEME_URI . 'dist/assets/css/admin-editor.css', null, THEME_VERSION, 'all' );
		wp_enqueue_script( 'custom-admin', THEME_URI . 'dist/assets/js/admin.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), THEME_VERSION, false );

		$this->global_variables( 'custom-admin' );

	}

	public function global_assets() {

		wp_enqueue_style( 'app', THEME_URI . 'dist/assets/css/app.css', array(), THEME_VERSION, 'all' );
		wp_enqueue_script( 'app', THEME_URI . 'dist/assets/js/app.js', null, THEME_VERSION, true );
		wp_localize_script( 'app', 'custom', array(
			'restURL' => rest_url(),
			'nonce'   => wp_create_nonce( 'wp_rest' ),
		) );

		$this->global_variables( 'app' );


		if ( ! is_user_logged_in() ) {
			// Deregister the jquery version bundled with WordPress.
			wp_deregister_script( 'jquery' );
			// Deregister the jquery-migrate version bundled with WordPress.
			wp_deregister_script( 'jquery-migrate' );
		}

		wp_dequeue_style( 'bodhi-svgs-attachment' );
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
		wp_dequeue_style( 'global-styles' );
		wp_deregister_script( 'wp-embed' );
	}

	public function login_stylesheet() {
		wp_enqueue_style( 'custom-login', THEME_URI . 'dist/assets/css/login.css', array(), THEME_VERSION, 'all' );
		$this->global_variables( 'custom-login' );
	}

	// Dequeue cf7/captcha scripts and styles, preventing them from loading everywhere
	public function cf7_js_styles() {
		if ( ! has_block( 'acf/fp-contact-form' ) ) {
			wp_dequeue_script( 'contact-form-7' );
			wp_dequeue_style( 'contact-form-7' );
			remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20 );
		}
	}

	public function global_variables( $handle ) {
		$accent_1 = get_field( 'settings_accent_1', 'options' ) ?: ['red' => '174', 'green' => '144', 'blue' => '255'];
		$accent_2 = get_field( 'settings_accent_2', 'options' ) ?: ['red' => '90', 'green' => '99', 'blue' => '254'];
		$body     = get_field( 'settings_body', 'options' ) ?: '#FFFFFF';
		$text   = get_field( 'settings_text_1', 'options' ) ?: ['red' => '52', 'green' => '52', 'blue' => '52'];
		$css = "body: {background: red !important} :root { --accent-1: {$accent_1['red']}, {$accent_1['green']}, {$accent_1['blue']}; --accent-2: {$accent_2['red']}, {$accent_2['green']}, {$accent_2['blue']}; --body: $body; --text: {$text['red']}, {$text['green']}, {$text['blue']};}";

		wp_add_inline_style( $handle, $css );
	}
}
