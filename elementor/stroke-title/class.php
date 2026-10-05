<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/title/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Stroke_Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Stroke Title', 'cldoctor-core' );
		$this->rt_base = 'rt-stroke-title';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'general_section',
			[
				'label' => esc_html__( 'General', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'cldoctor-core' ),
				'default' => 'Stroke Title',
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'heading_tag',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'HTML Tag', 'cldoctor-core' ),
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h2',
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Alignment', 'cldoctor-core' ),
				'options' => $this->rt_alignment_options(),
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .stroke-title' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stroke_title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Style', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'stroke_title_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .stroke-title .heading-title' => 'color: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'stroke_title_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .stroke-title .heading-title',
			]
		);
		$this->add_responsive_control(
			'stroke_title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .stroke-title .heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_responsive_control(
			'stroke_title_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .stroke-title .heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'stroke_title_border',
				'label'     => __( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .stroke-title .heading-title',
			]
		);
		$this->add_responsive_control(
			'stroke_title_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .stroke-title .heading-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_responsive_control(
			'stroke_title_transform',
			[
				'label' => esc_html__( 'Rotation', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stroke-title' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}