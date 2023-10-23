<?php

namespace FP\Theme;

defined( 'ABSPATH' ) || exit;

class Support {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );
		add_theme_support( 'admin-bar', [ 'callback' => '__return_false' ] );
		add_theme_support( 'title-tag' );
		if ( ! class_exists( 'ACF' ) && ! is_admin() ) {
			wp_die( 'Pls activate ACF Plugin' );
		}

		add_action( 'init', [ $this, 'change_post_object' ] );
		add_action( 'admin_menu', [ $this, 'reusable_blocks_link_wp_admin' ] );

	}

	// Change dashboard Posts to News
	function change_post_object() {
		$get_post_type = get_post_type_object( 'post' );
		$singular      = __( 'Product', 'fp' );
		$plural        = __( 'Products', 'fp' );

		$labels                     = $get_post_type->labels;
		$labels->name               = $plural;
		$labels->singular_name      = $singular;
		$labels->add_new            = sprintf( __( 'Add %s', 'fp' ), $singular );
		$labels->add_new_item       = sprintf( __( 'Add New %s', 'fp' ), $singular );
		$labels->edit_item          = sprintf( __( 'Edit %s', 'fp' ), $singular );
		$labels->new_item           = $singular;
		$labels->view_item          = sprintf( __( 'View %s', 'fp' ), $plural );
		$labels->search_items       = sprintf( __( 'Search %s', 'fp' ), $plural );
		$labels->not_found          = sprintf( __( 'No %s found', 'fp' ), $plural );
		$labels->not_found_in_trash = sprintf( __( 'No %s found in Trash', 'fp' ), $plural );
		$labels->all_items          = sprintf( __( 'All %s', 'fp' ), $plural );
		$labels->menu_name          = $plural;
		$labels->name_admin_bar     = $plural;
	}

	public function reusable_blocks_link_wp_admin() {
		add_menu_page( 'linked_url', 'Reusable Blocks', 'read', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
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
