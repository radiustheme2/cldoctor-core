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

class Rt_Button extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Button', 'cldoctor-core' );
		$this->rt_base = 'rt-button';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* -- Settings Options -- */
		$this->__button_settings();
	}
	
	//Options Settings
	protected function __button_settings() {
		$this->start_controls_section(
			'btn_section',
			[
				'label' => esc_html__( 'Button', 'cldoctor-core' ),
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
		$this->add_control(
			'icon_position',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Styles', 'cldoctor-core' ),
				'options' => array(
					'after' => esc_html__( 'After', 'cldoctor-core' ),
					'before' => esc_html__( 'Before', 'cldoctor-core' ),
				),
				'default' => 'after',
			]
		);
		/* -- Settings Styles -- */
		$this->__button_style_settings();
		$this->end_controls_section();
	}

	// Button Style
	protected function __button_style_settings() {
		$this->add_control(
			'btn_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Button Style', 'cldoctor-core' ),
				'separator' => 'before',
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
					'{{WRAPPER}} button.button-style-1::before' => 'background-color: {{VALUE}}',
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
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		$template = 'view-'.$data['style'];

		return $this->rt_template( $template, $data );
	}
}