<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */
defined( 'ABSPATH' ) || exit;

$context = Timber\Timber::get_context();

$data = [
	'posts'        => Timber\Timber::get_posts(),
	'title'        => get_the_title( get_option( 'page_for_posts', true ) ),
	'categories'   => Timber\Timber::get_terms( 'category' ),
	'archive_link' => get_permalink( get_option( 'page_for_posts' ) )
];

$context = array_merge( $context, $data );

Timber\Timber::render( 'index.twig', $context );
