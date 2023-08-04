<?php
/**
 * Order_Button Block Template.
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
$class_name = 'fp-block fp-order-button-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
$block_aligment = '';
// Block text alignment
if ( ! empty( $block['alignText'] ) ) {
	$block_aligment = "has-text-align-" . $block['alignText'];
}

$wrapper_attributes = get_block_wrapper_attributes(
	[
		'class' => esc_attr( $class_name ),
	]
);

$context = \Timber\Timber::get_context();

$data = [
	'link' => get_field( 'link' ),
];

$context = array_merge( $context, $data );

\Timber\Timber::render( './view.twig', $context );
