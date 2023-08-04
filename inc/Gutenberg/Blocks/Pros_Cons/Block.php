<?php

namespace FP\Gutenberg\Blocks\Pros_Cons;

defined( 'ABSPATH' ) || exit;

use FP\Gutenberg\Gutenberg_Block;

class Block extends Gutenberg_Block {

	// dashes only
	const NAME = 'fp-pros-cons';

	public function init_fields() {

		$this->add_field( [
			'name'          => 'title_list_1',
			'label'         => __( 'Title', 'fp' ),
			'type'          => 'text',
			'default_value' => __( 'Pros', 'fp' ),
		] );

		$this->add_field( [
			'label'        => __( 'List', 'fp' ),
			'name'         => 'list_1',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => __( 'Add Item', 'fp' ),
			'min'          => 1,
			'sub_fields'   => [
				[
					'label'         => __( 'Title', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'Online'
				],
				[
					'label'           => __( 'Icon', 'fp' ),
					'name'            => 'icon',
					'type'            => 'font-awesome',
					'icon_sets'       => [
						0 => 'solid',
						1 => 'regular',
					],
					'custom_icon_set' => '',
					'default_label'   => '',
					'default_value'   => '{ "style" : "regular", "id" : "star", "label" : "Star", "unicode" : "f005" }',
					'save_format'     => 'element',
					'enqueue_fa'      => 1,
				],
				[
					'label'         => __( 'Description', 'fp' ),
					'name'          => 'description',
					'type'          => 'textarea',
					'row'           => '4',
					'default_value' => 'You can easily buy our medicine online by one click. Onlinesjukvård (telemedicin) är en form av sjukvård som ges via informations- och kommunikationsteknik (IKT). Oftast är detta en distanskonsultation med en läkare som beställer läkemedel för leverans, via en onlinekatalog av läkemedel.'
				],
			],
		] );

		$this->add_field( [
			'name'          => 'title_list_2',
			'label'         => __( 'Title', 'fp' ),
			'type'          => 'text',
			'default_value' => __( 'Cons', 'fp' ),
		] );

		$this->add_field( [
			'label'        => __( 'List', 'fp' ),
			'name'         => 'list_2',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => __( 'Add Item', 'fp' ),
			'min'          => 1,
			'sub_fields'   => [
				[
					'label'         => __( 'Title', 'fp' ),
					'name'          => 'title',
					'type'          => 'text',
					'default_value' => 'Price'
				],
				[
					'label'           => __( 'Icon', 'fp' ),
					'name'            => 'icon',
					'type'            => 'font-awesome',
					'icon_sets'       => [
						0 => 'solid',
						1 => 'regular',
					],
					'custom_icon_set' => '',
					'default_label'   => '',
					'default_value'   => '{ "style" : "regular", "id" : "star", "label" : "Star", "unicode" : "f005" }',
					'save_format'     => 'element',
					'enqueue_fa'      => 1,
				],
				[
					'label'         => __( 'Description', 'fp' ),
					'name'          => 'description',
					'type'          => 'textarea',
					'row'           => '4',
					'default_value' => 'Oftast är detta en distanskonsultation med en läkare som beställer läkemedel för leverans, via en onlinekatalog av läkemedel.'
				],
			],
		] );

	}

}
