<?php

namespace FP\Plugins;

defined( 'ABSPATH' ) || exit;

use Timber\Image;
use Timber\Menu;
use Timber\Site;
use Timber\Timber;
use Twig\Extension\StringLoaderExtension;
use Twig\TwigFilter;

new Timber();

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'twigs', 'inc/Gutenberg/Blocks' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

class Timber_Settings extends Site {
	public function __construct() {
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		parent::__construct();
	}

	/** This is where you add some context
	 *
	 * @param array $context context['this'] Being the Twig's {{ this }}.
	 *
	 * @return array
	 */
	public function add_to_context( $context ) {
		$registered_menus = get_registered_nav_menus();
		$menus            = [];

		if ( ! empty( $registered_menus ) ) {
			foreach ( $registered_menus as $key => $menu ) {
				$menus[ $key ] = new Menu( $key );
			}
		} else {
			$menus = new Menu();
		}
		$context['menu']               = $menus;
		$context['svg_sprite']         = THEME_URI . 'dist/assets/images/svg-sprite.svg';
		$context['header']             = get_field( 'header', 'options' );
		$context['footer']             = get_field( 'footer', 'options' );
		$context['footer_policy_menu'] = get_field( 'policy_menu', 'options' );
		$context['footer_first_menu']   = get_field( 'first_menu', 'options' );
		$context['footer_second_menu'] = get_field( 'second_menu', 'options' );
		$context['footer_third_menu']  = get_field( 'third_menu', 'options' );
		$context['product_card_title'] = get_field( 'product_page_product_card', 'options' );

		return $context;
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $string being 'foo', then returned 'foo bar!'.
	 *
	 * @return string
	 */
	public function phone_url_filter( $string ) {
		$string = preg_replace( '/[^0-9+]/', '', $string );

		return $string;
	}

	/** This Would return conver text to slug.
	 *
	 * @param string $string being 'foo', then returned 'foo bar!'.
	 *
	 * @return string
	 */
	public function slug_filter( $string ) {
		$divider = '-';
		// replace non letter or digits by divider
		$string = preg_replace( '~[^\pL\d]+~u', $divider, $string );

		// transliterate
		$string = iconv( 'utf-8', 'us-ascii//TRANSLIT', $string );

		// remove unwanted characters
		$string = preg_replace( '~[^-\w]+~', '', $string );

		// trim
		$string = trim( $string, $divider );

		// remove duplicate divider
		$string = preg_replace( '~-+~', $divider, $string );

		// lowercase
		$string = strtolower( $string );

		if ( empty( $string ) ) {
			return 'n-a';
		}

		return $string;
	}

	/** This Would return text with no tags except line tags.
	 *
	 * @param string $string being 'foo', then returned 'foo bar!'.
	 *
	 * @return string
	 */
	public function only_line_tags( $string ) {
		$string = strip_tags( $string, '<b><strong><br><span><em><i><a>' );

		return $string;
	}

	/** This function return text with highlight text.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public function highlight_text( string $string ): string {
		return preg_replace( "/__(.*?)__/", '<span class="fp-highlight">$1</span>', $string );
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 *
	 * @return string $twig
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new StringLoaderExtension() );
		$twig->addFilter( new TwigFilter( 'phone_url', array( $this, 'phone_url_filter' ) ) );
		$twig->addFilter( new TwigFilter( 'line_tags', array( $this, 'only_line_tags' ) ) );
		$twig->addFilter( new TwigFilter( 'slug', array( $this, 'slug_filter' ) ) );
		$twig->addFilter( new TwigFilter( 'highlight', array( $this, 'highlight_text' ) ) );

		return $twig;
	}
}
