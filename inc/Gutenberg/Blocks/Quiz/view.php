<?php
/**
 * Quiz Block Template.
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
$class_name = 'fp-block fp-quiz-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

$wrapper_attributes = get_block_wrapper_attributes(
	[
		'class' => esc_attr( $class_name ),
	]
);

\FP\Gutenberg\Blocks\Quiz\Block::enqueue_script();

$context = \Timber\Timber::get_context();

$data = [
	'fields'    => get_fields(),
	'attribute' => $wrapper_attributes,
	'block_id'  => $block['id'],
	'post_id'   => $post_id,
	'submit'  	=> get_field( 'quiz_submit', 'options' ),
	'votes'  	=> get_field( 'quiz_votes', 'options' ),
];

$context = array_merge( $context, $data );

\Timber\Timber::render( './view.twig', $context );

