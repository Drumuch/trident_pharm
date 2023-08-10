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
			'name'       => 'form',
			'label'      => __( 'Form Translations', 'fp' ),
			'type'       => 'group',
			'sub_fields' => [
				[
					'name'          => 'label_name',
					'label'         => __( 'Label Name', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Your name*', 'fp' )
				],
				[
					'name'          => 'placeholder_name',
					'label'         => __( 'Placeholder Name', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Enter your name', 'fp' )
				],
				[
					'name'          => 'label_email',
					'label'         => __( 'Label Email', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Your email*', 'fp' )
				],
				[
					'name'          => 'placeholder_email',
					'label'         => __( 'Placeholder Email', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Enter your email*', 'fp' )
				],
				[
					'name'          => 'label_message',
					'label'         => __( 'Label Message', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Your message', 'fp' )
				],
				[
					'name'          => 'placeholder_message',
					'label'         => __( 'Placeholder Message', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Enter your message...', 'fp' )
				],
				[
					'name'          => 'label_acceptance',
					'label'         => __( 'Label Acceptance', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'I agree to the terms of use*', 'fp' )
				],
				[
					'name'          => 'submit',
					'label'         => __( 'Submit', 'fp' ),
					'type'          => 'text',
					'default_value' => __( 'Submit', 'fp' )
				]
			]
		] );

		$this->add_field( [
			'name'          => 'thank_you_title',
			'label'         => __( 'Thank You Title', 'fp' ),
			'type'          => 'text',
			'default_value' => __( 'Thank you, the data was sent successfully!', 'fp' )
		] );

		$this->add_field( [
			'name'          => 'thank_you_description',
			'label'         => __( 'Thank You Description', 'fp' ),
			'type'          => 'text',
			'default_value' => __( 'We will contact you soon', 'fp' )
		] );

		$this->add_field( [
			'name'  => 'thank_you_link',
			'label' => __( 'Thank You Link', 'fp' ),
			'type'  => 'link',
		] );

	}

}
