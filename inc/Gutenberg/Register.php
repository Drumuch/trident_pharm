<?php

namespace FP\Gutenberg;

defined( 'ABSPATH' ) || exit;

class Register {

    private $blocks = [
        Blocks\Faq\Block::class,
        Blocks\Bullet\Block::class,
        Blocks\Pros_Cons\Block::class,
        Blocks\Latest_Products\Block::class,
        Blocks\Contact_Form\Block::class,
        Blocks\Product_Item\Block::class,
        Blocks\Product_Banner\Block::class,
        Blocks\Simple_Banner\Block::class,
        Blocks\Order_Button\Block::class,
    ];

	public function __construct() {
        add_action( 'acf/init', array( $this, 'register_blocks') );
	}

	public function register_blocks( $registered_blocks ) {
        foreach ( $this->blocks as $block ) {
            // TODO: This should be refactored
            $block_path = str_replace( "FP\Gutenberg\Blocks\\", '', $block );
            $block_path = str_replace( "\Block", '', $block_path );

            // Do not move this line it must be before we add the __DIR__
            $block_assets_uri = get_stylesheet_directory_uri() . "/inc/Gutenberg/Blocks/{$block_path}/dist";

            $block_path = __DIR__ . "/Blocks/{$block_path}/";

            $block = new $block( $block_path, $block_assets_uri );
            $block->init();
            $block->register_block();
        }

		return $registered_blocks;
	}

}
