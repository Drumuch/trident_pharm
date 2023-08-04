<?php

namespace FP\Gutenberg\Blocks\Order_Button;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

    // dashes only
    const NAME = 'fp-order-button';

    public function init_fields() {

        $this->add_field( [
            'name'         => 'link',
            'label'        => __( 'Link', 'fp' ),
            'type'         => 'link',
        ] );

    }

}
