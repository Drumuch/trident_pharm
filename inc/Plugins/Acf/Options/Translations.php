<?php

namespace FP\Plugins\Acf\Options;

defined( 'ABSPATH' ) || exit;

use FP\Plugins\Acf\Options_Page;

class Translations extends Options_Page {

	public function title(): string {
		return __( 'Translations', 'fp' );
	}

	public function init_fields() {

		$this->add_tab( 'Category Page' );
		$this->add_field( [
			'name'       => 'category_page',
			'label'      => __( 'Category Page', 'fp' ),
			'type'       => 'group',
			'sub_fields' => [
				[
					'label'         => __( 'Category Sidebar', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'Category',
				],
			],
		] );

		$this->add_tab( 'Product Page' );
		$this->add_field( [
			'name'       => 'product_page',
			'label'      => __( 'Product Page', 'fp' ),
			'type'       => 'group',
			'sub_fields' => [
				[
					'label'         => __( 'Products Sidebar', 'fp' ),
					'type'          => 'text',
					'name'          => 'title',
					'default_value' => 'Products',
				],
				[
					'label'         => __( 'Product Card Title', 'fp' ),
					'type'          => 'text',
					'name'          => 'product_card',
					'default_value' => 'More about product',
				],
				[
					'label'         => __( 'Related Products Section', 'fp' ),
					'type'          => 'text',
					'name'          => 'related_products',
					'default_value' => 'Related Products',
				],
			],
		] );

		$this->add_tab( 'Search Page' );
		$this->add_field( [
			'name'       => 'search_page',
			'label'      => __( 'Search Page', 'fp' ),
			'type'       => 'group',
			'sub_fields' => [
				[
					'label'         => __( 'Search Title', 'fp' ),
					'type'          => 'text',
					'name'          => 'title',
					'default_value' => 'Search results for',
				],
				[
					'label'         => __( 'No Result', 'fp' ),
					'type'          => 'text',
					'name'          => 'no_result',
					'default_value' => 'No results',
				],
			],
		] );

		$this->add_tab( '404 Page' );
		$this->add_field( [
			'name'       => '404_page',
			'label'      => __( '404 Page', 'fp' ),
			'type'       => 'group',
			'sub_fields' => [
				[
					'label'         => __( 'Title', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'OOOPS... Page not found',
				],
				[
					'label' => __( 'Link', 'fp' ),
					'type'  => 'link',
					'name'  => 'link',
				],
			],
		] );
	}

}
