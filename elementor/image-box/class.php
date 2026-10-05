<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/image-box/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

 namespace RadiusTheme\Cldoctor_Core;

use Elementor\Utils;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Image_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Image Box', 'cldoctor-core' );
		$this->rt_base = 'rt-image-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'image_box_section',
			[
				'label' => esc_html__( 'Image Box', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'styles',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'cldoctor-core' ),
				'options' => array(
					'1' => esc_html__( 'Style 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Style 2', 'cldoctor-core' ),
				),
				'default' => '1',
			]
		);
		$this->add_control(
			'main_image',
			[
				'label'   => __( 'Main Image', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'others_images',
			[
				'label' => esc_html__( 'Other Images', 'cldoctor-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'other_image1',
			[
				'label'   => __( 'Image 1', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'other_image2',
			[
				'label'   => __( 'Image 2', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Title Alignment', 'cldoctor-core' ),
				'options' => $this->rt_alignment_options(),
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .image-box' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		/* -- Styles Options -- */
		$this->__animate_image_settings();
	}

	/* -- List Options -- */
	protected function __animate_image_settings() {
		$this->start_controls_section(
			'mpving_shape_image',
			[
				'label' => esc_html__( 'Mouse Moving Shape', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shape_image1',
			[
				'label'   => __( 'Shape 1', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'shape_image2',
			[
				'label'   => __( 'Shape 2', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'shape_image3',
			[
				'label'   => __( 'Shape 3', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		$template = 'view-'.$data['styles'];
		return $this->rt_template( $template, $data );
	}
}