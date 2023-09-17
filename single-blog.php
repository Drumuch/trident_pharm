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

$related_posts_args = [
	'post_type'      => 'blog',
	'posts_per_page' => 6,
	'post__not_in'   => [ $context['post']->ID ],
];

$related_posts = new Timber\PostQuery( $related_posts_args );

$data = [
	'related_posts' => $related_posts
];

$context = array_merge( $context, $data );

Timber\Timber::render( [ 'single-blog.twig' ], $context );
