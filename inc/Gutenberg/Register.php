<?php

namespace FP\Gutenberg;

defined( 'ABSPATH' ) || exit;

class Register {

	const BLOCKS = [
		Blocks\Faq\Block::class,
		Blocks\Bullet\Block::class,
		Blocks\Pros_Cons\Block::class,
		Blocks\Latest_Products\Block::class,
		Blocks\Contact_Form\Block::class,
		Blocks\Product_Item\Block::class,
		Blocks\Product_Banner\Block::class,
		Blocks\Simple_Banner\Block::class,
		Blocks\Order_Button\Block::class,
		Blocks\Pop_Up\Block::class,
	];

	const BLOCKS_DIR = 'Blocks';
	const SCRIPT_DIST_DIR = 'dist';

	public function __construct() {
		add_action( 'acf/init', array( $this, 'register_blocks' ) );
	}

	public function register_blocks( $registered_blocks ):void {
		foreach ( self::BLOCKS as $block ) {
			$block_name = $this->get_block_name( $block );
			if ( empty( $block_name ) ) {
				continue;
			}

			$block = new $block( $this->get_block_path( $block_name ), $this->get_block_script_uri( $block_name ) );
			$block->init();
			$block->register_block();
		}
	}

	private function get_block_name( string $block_class ): string {
		$block_path = str_replace( __NAMESPACE__ . '\\' . self::BLOCKS_DIR . '\\', '', $block_class );
		$block_path = explode( '\\', $block_path );

		return $block_path[0] ?? '';
	}

	private function get_block_path( string $block_name ): string {
		return __DIR__ . '/' . self::BLOCKS_DIR . "/{$block_name}/";
	}

	private function get_block_script_uri( string $block_name ): string {
		$block_script_uri = str_replace( THEME_DIR, '', __DIR__ );

		return THEME_URI . "inc/Gutenberg/" . self::BLOCKS_DIR . "/{$block_name}/" . self::SCRIPT_DIST_DIR;
	}

}
