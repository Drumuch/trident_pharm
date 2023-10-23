<?php

defined( 'ABSPATH' ) || exit;

require_once dirname( __FILE__ ) . "/vendor/autoload.php";

/* Define Constants */
$theme_version = wp_get_theme()->get( 'Version' );
define( 'THEME_VERSION', $theme_version );
define( 'THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'THEME_URI', trailingslashit( esc_url( get_stylesheet_directory_uri() ) ) );

/* Theme */
new FP\Theme\Support();
new FP\Theme\Enqueue();
new FP\Theme\Comments();
new FP\Theme\Shortcodes();

/* Post Types */
new FP\Post_Type\Manager();

/* Taxonomies */
new FP\Taxonomy\Manager();

/* Gutenberg */
new FP\Gutenberg\Core();
new FP\Gutenberg\Categories();
new FP\Gutenberg\Register();

/* Plugins */
new FP\Plugins\Acf\Manager();
new FP\Plugins\Cf7();
new FP\Plugins\Timber_Settings();
new FP\Plugins\Yoast();

