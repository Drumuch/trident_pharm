<?php

namespace FP\Taxonomy;

defined( 'ABSPATH' ) || exit;

class Blog_Category extends Taxonomy {
	const NAME = 'blog_category';
	const POST_TYPE = 'blog';

	public function config(): array {
		$singular = __( 'Category', 'fp' );
		$plural   = __( 'Categories', 'fp' );

		$labels = [
			'name'              => $plural,
			'singular_name'     => $singular,
			'search_items'      => sprintf( __( 'Search %s', 'fp' ), $plural ),
			'all_items'         => sprintf( __( 'All %s', 'fp' ), $plural ),
			'view_item'         => sprintf( __( 'View %s', 'fp' ), $singular ),
			'parent_item'       => sprintf( __( 'Parent %s', 'fp' ), $singular ),
			'parent_item_colon' => sprintf( __( 'Parent %s:', 'fp' ), $singular ),
			'edit_item'         => sprintf( __( 'Edit %s', 'fp' ), $singular ),
			'update_item'       => sprintf( __( 'Update %s', 'fp' ), $singular ),
			'add_new_item'      => sprintf( __( 'Add %s', 'fp' ), $singular ),
			'new_item_name'     => sprintf( __( 'New %s', 'fp' ), $singular ),
			'menu_name'         => $plural,
			'back_to_items'     => sprintf( __( '← Back to %s', 'fp' ), $singular ),
		];

		$args = [
			'labels'             => $labels,
			//'description'        => '',
			'public'             => true,
			'publicly_queryable' => true, // = public
			'show_in_nav_menus'  => true, // = public
			'show_ui'            => true, // = public
			//'show_in_menu'       => true, // = show_ui
			//'show_tagcloud'      => true, // = show_ui
			//'show_in_quick_edit' => null, // = show_ui
			'hierarchical'       => true,
			//'query_var'          => $taxonomy,
			//'capabilities'       => [],
			'rewrite'            => [
				'slug' => 'categories'
			],
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		];

		return $args;
	}
}
