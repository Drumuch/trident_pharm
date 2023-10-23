<?php

namespace FP\Plugins;

defined( 'ABSPATH' ) || exit;

class Yoast {
	public function __construct() {
		add_filter( 'wpseo_metabox_prio', function () {
			return 'low';
		} );
	}
}
