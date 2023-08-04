<?php
/**
 * Latest_Product Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 */

defined( 'ABSPATH' ) || exit;

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'fp-block fp-latest-product-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

$wrapper_attributes = get_block_wrapper_attributes(
	[
		'class' => esc_attr( $class_name ),
	]
);

$context = \Timber\Timber::get_context();

$products_query = [
	'post_type' => 'post'
];

$load_type = get_field( 'load_type' );
if ( $load_type == 'manual' ) {
	$products_query = array_merge( $products_query, array(
		'post__in'       => get_field( 'products' ),
		'orderby'        => 'post__in',
		'posts_per_page' => - 1,
	) );
} else {
	$products_query = array_merge( $products_query, array(
		'posts_per_page' => 10,
	) );
}

$products = new Timber\PostQuery( $products_query );

$data = [
	'anchor'    => $anchor,
	'attribute' => $wrapper_attributes,
	'title'     => get_field( 'title' ),
	'products'  => $products,
	'link'      => get_field( 'link' )
];

$context = array_merge( $context, $data );

\Timber\Timber::render( './view.twig', $context );

