<?php

namespace FP\Theme;

defined( 'ABSPATH' ) || exit;

class Shortcodes {

	public function __construct() {
		add_shortcode( 'fp_list', [ $this, 'custom_list' ] );

	}

	public function custom_list( $atts, $content = null ) {
		$atts    = shortcode_atts(
			[
				'type' => 'ul',
			],
			$atts
		);
		$content = str_replace( '<br>', "\n", $content );

		$list_items = preg_split( '/\n+/', wp_kses_post( $content ), - 1, PREG_SPLIT_NO_EMPTY );

		$list_type = esc_attr( $atts['type'] );

		if ( empty( $list_items ) ) {
			return '';
		}

		$output = "<$list_type>";
		foreach ( $list_items as $item ) {
			$output .= "<li>$item</li>";
		}
		$output .= "</$list_type>";

		return $output;
	}
}
