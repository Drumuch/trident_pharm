<?php

namespace FP\Plugins\Acf\Options;

defined( 'ABSPATH' ) || exit;

use FP\Plugins\Acf\Options_Page;

class Settings extends Options_Page {

	public function title(): string {
		return __( 'Settings', 'fp' );
	}

	public function init_fields() {
		$this->add_field( [
			'name'       => 'settings',
			'label'      => __( 'Settings', 'fp' ),
			'type'       => 'group',
			'layout'     => 'block',
			'sub_fields' => [
				[
					'label'          => __( 'Accent 1', 'fp' ),
					'name'           => 'accent_1',
					'type'           => 'color_picker',
					'default_value'  => '#AE90FF',
					'wrapper'        => [
						'width' => '50',
					],
					'enable_opacity' => 0,
					'return_format'  => 'array',
					'instructions'   => 'default value is #AE90FF'
				],
				[
					'label'          => __( 'Accent 2', 'fp' ),
					'name'           => 'accent_2',
					'type'           => 'color_picker',
					'default_value'  => '#5A63FE',
					'wrapper'        => [
						'width' => '50',
					],
					'enable_opacity' => 0,
					'return_format'  => 'array',
					'instructions'   => 'default value is #5A63FE'
				],
				[
					'label'          => __( 'Body Color', 'fp' ),
					'name'           => 'body',
					'type'           => 'color_picker',
					'default_value'  => '#FFFFFF',
					'wrapper'        => [
						'width' => '50',
					],
					'enable_opacity' => 0,
					'return_format'  => 'string',
					'instructions'   => 'default value is #FFFFFF'
				],
				[
					'label'          => __( 'Text 1', 'fp' ),
					'name'           => 'text_1',
					'type'           => 'color_picker',
					'default_value'  => '#343434',
					'wrapper'        => [
						'width' => '50',
					],
					'enable_opacity' => 0,
					'return_format'  => 'array',
					'instructions'   => 'default value is #343434'
				],
			],
		] );
	}

}
