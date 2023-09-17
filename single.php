<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

defined( 'ABSPATH' ) || exit;

$context         = Timber\Timber::context();
$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

$related_products_args = [
	'posts_per_page' => 10,
	'post__not_in'   => [ $context['post']->ID ],
];

$load_type = get_field( 'settings_load_type' );

if ( $load_type == 'manual' ) {
	$related_products_args['post__in'] = get_field( 'settings_related_product' );
	$related_products_args['orderby']  = 'post__in';
}

$related_products = new Timber\PostQuery( $related_products_args );
$data             = [
	'sidebar_title'          => get_field( 'product_page_title', 'options' ) ?: __( 'Products', 'fp' ),
	'related_products_title' => get_field( 'product_page_related_products', 'options' ),
	'related_products'       => $related_products,
	'archive_link'           => get_option( 'page_for_posts' ),
	'settings'               => get_field( 'settings' ),
	'banners'                => get_field( 'banners' ),
];

$context = array_merge( $context, $data );

Timber\Timber::render( 'single.twig', $context );
