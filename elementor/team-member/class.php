<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rt_Team_Member extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Team Member', 'cldoctor-core' );
		$this->rt_base = 'rt-team-member';
		parent::__construct( $data, $args );

	}
    public function get_script_depends() {
		return [
			'swiper',
		];
	}
	protected function register_controls() {

		/* -- Settings Options -- */
		$this->__team_member_fileds_settings();
		$this->__social_lists_settings();
		$this->__full_box_style_settings();
		$this->__picture_style_settings();
		$this->__name_style_settings();
		$this->__designation_style_settings();
		$this->__social_style_settings();
    }
	// Fields
    protected function __team_member_fileds_settings(){
		$this->start_controls_section(
			'sec_fields',
			[
				'label' => esc_html__( 'General', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'picture',
			[
				'type'    => Controls_Manager::MEDIA,
				'label'   => esc_html__( 'Picture', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'name',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Name', 'cldoctor-core' ),
				'default' => 'Marvin McKinney',
				'label_block' => true,
			]
		);
		$this->add_control(
			'designation',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Designation', 'cldoctor-core' ),
				'default' => 'Accountance',
				'label_block' => true,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'cldoctor-core' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
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
					'{{WRAPPER}} .team-card' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	//Social List
    protected function __social_lists_settings(){
		$this->start_controls_section(
			'social_list',
			[
				'label' => esc_html__( 'Social List', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'social_icon', [
				'label' => __( 'Icon', 'cldoctor-core' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_link', [
				'label' => __( 'List', 'cldoctor-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
        
		$this->add_control(
			'social_lists',
			[
				'label'     => __( 'Lists', 'cldoctor-core' ),
				'type'      => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => array(
					array( 
						'social_icon' => 'fa-brands fa-facebook-f',
						'social_link' => '#',
					),
					array( 
						'social_icon' => 'fa-brands fa-twitter',
						'social_link' => '#',
					),
				),
			]
		);
        $this->end_controls_section();
	}

	//Full Box Style
	protected function __full_box_style_settings(){
		$this->start_controls_section(
			'full_box_style',
			[
				'label' => esc_html__( 'Full Box', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'full_box',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Full Box', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'full_box_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .team-card',
			]
		);
		$this->add_responsive_control(
			'full_box_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .team-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_responsive_control(
			'full_box_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'cldoctor-core' ),               
				'selectors' => array(
					'{{WRAPPER}} .team-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	//Picture Style
	protected function __picture_style_settings() {
		$this->start_controls_section(
			'picture_style',
			[
				'label' => esc_html__( 'Picture', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'picture_size',
			[
				'label' => esc_html__( 'Verticle Slider Height', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-card .team-img-wrapper' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'picture_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .team-card .team-img-wrapper',
			]
		);
		
		$this->add_responsive_control(
			'picture_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .team-card .team-img-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'picture_border',
				'label'     => __( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .team-card .team-img-wrapper',
			]
		);
		$this->add_responsive_control(
			'picture_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .team-card .team-img-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                   
				),
			]
		);
		$this->end_controls_section();
	}

	//Name Style
	protected function __name_style_settings() {
		$this->start_controls_section(
			'name_style',
			[
				'label' => esc_html__( 'Name', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'name_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .team-card .team-content .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .team-card .team-content .title a' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_control(
			'name_hover_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Hover Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .team-card .team-content .title a:hover' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .team-card .team-content .title, {{WRAPPER}} .team-card .team-content .title a',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .team-card .team-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	//Designation Style
	protected function __designation_style_settings() {
		$this->start_controls_section(
			'designation_style',
			[
				'label' => esc_html__( 'Designation', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'designation_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .team-card .team-content .designation' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .team-card .team-content .designation',
			]
		);
		$this->add_responsive_control(
			'designation_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .team-card .team-content .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	//Social Style
	protected function __social_style_settings() {
		$this->start_controls_section(
			'social_style',
			[
				'label' => esc_html__( 'Social Buttons', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'social_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .social-item a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .social-item a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'social_box_size',
			[
				'label' => esc_html__( 'Icon Box Size', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .social-item a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'social_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'social_style_normal',
			[
				'label' => __( 'Normal', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'social_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .social-item a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .social-item a svg path' => 'fill: {{VALUE}}',
				),
			]
		);
		$this->add_control(
			'social_bgcolor',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Background Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .social-item a' => 'background-color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'     => esc_html__( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .social-item a',
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'social_style_hover',
			[
				'label' => esc_html__( 'Hover', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'social_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .social-item a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .social-item a:hover svg path' => 'fill: {{VALUE}}',
				),
			]
		);
		$this->add_control(
			'social_h_bgcolor',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Background Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .social-item a:hover' => 'background-color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => esc_html__( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .social-item a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'social_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .social-item a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
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
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		
		$template = 'view';

		$this->rt_template( $template, $data );
	}

}