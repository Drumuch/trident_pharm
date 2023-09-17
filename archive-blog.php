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

$context = Timber\Timber::get_context();

$breadcrumbs = [
	[
		'name' => 'Blog'
	]
];

$data = [
	'title'       => 'Blog',
	'posts'       => new Timber\PostQuery(),
	'breadcrumbs' => $breadcrumbs
];

$context = array_merge( $context, $data );

Timber\Timber::render( 'archive-blog.twig', $context );
