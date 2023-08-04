<?php

namespace FP\Gutenberg\Blocks\Contact_Form;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-contact-form';

	public function init_fields() {

		$this->add_field( [
			'name'          => 'title',
			'label'         => __( 'Title', 'fp' ),
			'type'          => 'text',
			'default_value' => __( 'Contact Us', 'fp' ),
		] );

		$this->add_field( [
			'name'          => 'contact_form',
			'label'         => __( 'Contact Form', 'fp' ),
			'type'          => 'post_object',
			'return_format' => 'id',
			'post_type'     => [
				0 => 'wpcf7_contact_form',
			],
		] );

		$this->add_field( [
			'name'          => 'thank_you_title',
			'label'         => __( 'Thank You Title', 'fp' ),
			'type'          => 'text',
			'default_value' => 'Thank you, the data was sent successfully!'
		] );

		$this->add_field( [
			'name'          => 'thank_you_description',
			'label'         => __( 'Thank You Description', 'fp' ),
			'type'          => 'text',
			'default_value' => 'We will contact you soon'
		] );

		$this->add_field( [
			'name'          => 'thank_you_link',
			'label'         => __( 'Thank You Link', 'fp' ),
			'type'          => 'link',
		] );

	}

}
