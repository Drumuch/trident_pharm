<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

defined( 'ABSPATH' ) || exit;

$category_query = [
	'taxonomy'   => 'category',
	'hide_empty' => true,
	'parent'     => 0
];

$context  = Timber\Timber::get_context();
$category = get_category( get_query_var( 'cat' ) );

$breadcrumbs = [
	[
		'name' => get_the_title( get_option( 'page_for_posts', true ) ),
		'link' => get_post_type_archive_link( 'post' ),
	],
	[
		'name' => $category->cat_name,
	]
];

$data = [
	'sidebar_title'   => get_field( 'category_page_title', 'options' ) ?: __( 'Category', 'fp' ),
	'title'           => $category->cat_name,
	'categories'      => Timber\Timber::get_terms( $category_query ),
	'posts'           => new Timber\PostQuery(),
	'active_category' => $category,
	'breadcrumbs'     => $breadcrumbs,
	'aaa' => apply_filters('the_content', get_queried_object()->description)
];

$context = array_merge( $context, $data );

Timber\Timber::render( 'category.twig', $context );