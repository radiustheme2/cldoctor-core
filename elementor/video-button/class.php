<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/button/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Video_Button extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Video Button', 'cldoctor-core' );
		$this->rt_base = 'rt-video-button';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* -- Settings Options -- */
		$this->__button_settings();
		$this->__full_box_settings();
		$this->__round_text_box_settings();
		$this->__play_button_style();
	}
	
	//Options Settings
	protected function __button_settings() {
		$this->start_controls_section(
			'btn_section',
			[
				'label' => esc_html__( 'Video Button', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Styles', 'cldoctor-core' ),
				'options' => array(
					'1' => esc_html__( 'Style 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Style 2', 'cldoctor-core' ),
				),
				'default' => '1',
			]
		);
		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Text', 'cldoctor-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btnlink',
			[
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'Link', 'cldoctor-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);
		$this->add_control(
			'icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'cldoctor-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
			]
		);
		$this->end_controls_section();
	}

	// Full Box Setting
	protected function __full_box_settings() {
		$this->start_controls_section(
			'full_box_style',
			[
				'label' => esc_html__( 'Box Setting Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_width',
			[
				'label' => esc_html__( 'Width', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'box_height',
			[
				'label' => esc_html__( 'Height', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_color',
				'label'     => __( 'Background', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .video-button',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'     => esc_html__( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .video-button',
			]
		);
		$this->add_responsive_control(
			'box_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Box Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .video-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                   
				),
			]
		);
		$this->end_controls_section();
	}

	// Round Text Box Setting
	protected function __round_text_box_settings() {
		$this->start_controls_section(
			'round_text_box_style',
			[
				'label' => esc_html__( 'Round Text Box', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'round_text_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .round-text' => 'fill: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'round_text_color',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .round-text',
			]
		);
		$this->add_control(
			'full_box_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Box Settings', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'round_text_box_width',
			[
				'label' => esc_html__( 'Width', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button .round-text' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'round_text_box_height',
			[
				'label' => esc_html__( 'Height', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button .round-text' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_section();
	}

	// Play Button Style
	protected function __play_button_style() {
		$this->start_controls_section(
			'play_btn_style',
			[
				'label' => esc_html__( 'Play Button Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'play_button_width',
			[
				'label' => esc_html__( 'Width', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button .button-style-1' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'play_button_height',
			[
				'label' => esc_html__( 'Height', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button .button-style-1' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->start_controls_tabs( 'btn_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'btn_style_normal',
			[
				'label' => __( 'Normal', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} a.button-style-1' => 'color: {{VALUE}}',
					'{{WRAPPER}} a.button-style-2' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} a.button-style-1, {{WRAPPER}} a.button-style-2',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} a.button-style-1, {{WRAPPER}} a.button-style-2',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} a.button-style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					'{{WRAPPER}} a.button-style-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'     => __( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} a.button-style-1, {{WRAPPER}} a.button-style-2',
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} a.button-style-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					'{{WRAPPER}} a.button-style-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'btn_style_hover',
			[
				'label' => __( 'Hover', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'btn_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array(
					'{{WRAPPER}} a.button-style-1:hover, {{WRAPPER}} a.button-style-2:hover' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_hbg_color',
				'label'     => __( 'Background', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} a.button-style-1:hover, {{WRAPPER}} a.button-style-2:hover',
			]
		);
		$this->add_control(
			'btn_h_anim_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Hover Animation Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} a.button-style-1::before' => 'background-color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => __( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} a.button-style-1:hover, {{WRAPPER}} a.button-style-2:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		$template = 'view-'.$data['style'];

		return $this->rt_template( $template, $data );
	}
}