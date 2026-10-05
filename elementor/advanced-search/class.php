<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/advanced-search/class.php
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

class Rt_Advanced_Search extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Advanced Search', 'cldoctor-core' );
		$this->rt_base = 'rt-advanced-search';
		parent::__construct( $data, $args );
	}

	protected function register_controls(){
		$this->__general();
		$this->__fields_wrapper();
		$this->__title();
		$this->__type();
		$this->__location();
		$this->__category();
		$this->__keyword();
		$this->__button();
	}

	protected function __general() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Layout 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Layout 2', 'cldoctor-core' ),
				],
			]
		);
		$this->add_control(
			'title',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'cldoctor-core' ),
				'default' => 'Title',
				'label_block' => true,
			]
		);
		$this->add_control(
			'orientation',
			[
				'label'   => esc_html__( 'Orientation', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => esc_html__( 'Inline', 'cldoctor-core' ),
					'block' => esc_html__( 'Block', 'cldoctor-core' ),
				],
			]
		);
		$this->add_control(
			'search_by_listing_type',
			[
				'label'        => __( 'Search by Type', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'search_by_listing_category',
			[
				'label'        => __( 'Search by Category', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'search_by_listing_location',
			[
				'label'        => __( 'Search by Location', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'search_by_geo_location',
			[
				'label'        => __( 'Search by Geo Location', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'search_by_radius_distance',
			[
				'label'        => __( 'Search by Radius Location', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'search_by_price',
			[
				'label'        => __( 'Search by Price', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'search_by_keyword',
			[
				'label'        => __( 'Search by Keyword', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'price_range_min',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Price Range Min', 'cldoctor-core' ),
				'default' => '50',
				'label_block' => true,
			]
		);
		$this->add_control(
			'price_range_max',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Price Range Max', 'cldoctor-core' ),
				'default' => '5000',
				'label_block' => true,
			]
		);
		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'cldoctor-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard' => esc_html__( 'Standard', 'cldoctor-core' ),
					'popup' => esc_html__( 'Popup', 'cldoctor-core' ),
					'suggestion' => esc_html__( 'Auto Suggestion', 'cldoctor-core' ),
					'dependency' => esc_html__( 'Dependency Selection', 'cldoctor-core' ),
				],

			]
		);
		$this->end_controls_section();
	}

	protected function __fields_wrapper(){
		$this->start_controls_section(
			'fields_wrapper',
			[
				'label' => esc_html__( 'Form Fields Wrapper', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'fields_gap',
			[
				'label' => esc_html__( 'Field Gap', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .form-fields-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'form_fields_wrapper_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .form-fields-wrapper',
			]
		);
		$this->add_responsive_control(
			'form_fields_wrapper_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .form-fields-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                  
				),
			]
		);
		$this->add_responsive_control(
			'form_fields_wrapper_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .form-fields-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                  
				),
			]
		);
		$this->add_responsive_control(
			'form_fields_wrapper_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .form-fields-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                  
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __title() {
		$this->start_controls_section(
			'title_settings',
			[
				'label'     => esc_html__( 'Title', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .section-heading .heading-title' => 'color: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .section-heading .heading-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .section-heading .heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __type() {
		$this->start_controls_section(
			'type_settings',
			[
				'label'     => esc_html__( 'Type', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'type_gap',
			[
				'label' => esc_html__( 'Type Gap', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-inline' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dot_possition',
			[
				'label' => esc_html__( 'Dot Possition Form Top', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-radio-check li label::after' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'type_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .search-radio-check li label' => 'color: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'type_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .search-radio-check li label',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'type_bg_color',
				'label'    => esc_html__( 'Type Button Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Type Button Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .search-radio-check li label',
			]
		);
		$this->add_responsive_control(
			'type_button_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Type Button Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .search-radio-check li label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                  
				),
			]
		);
		$this->add_responsive_control(
			'type_button_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Type Button Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .search-radio-check li label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                  
				),
			]
		);
		$this->add_responsive_control(
			'type_button_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Type Button Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .search-radio-check li label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                  
				),
			]
		);
		$this->add_control(
			'type_active_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Active Color', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'type_active_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .search-radio-check li label.active' => 'color: {{VALUE}}'
				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'type_active_bg_color',
				'label'    => esc_html__( 'Type Active Button Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Type Button Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .search-radio-check li label.active',
			]
		);
		$this->end_controls_section();
	}

	protected function __location() {
		$this->start_controls_section(
			'location_settings',
			[
				'label'     => esc_html__( 'Location', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'location_field_size',
			[
				'label' => esc_html__( 'Field Size', 'cldoctor-core' ),
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
					'{{WRAPPER}} .search-radius.rtin-input-item' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .search-geo-address.rtin-input-item' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rtcl-search-input-button.rtin-location' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'location_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rtin-loc-space.rtin-input-item i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .search-radius.rtin-input-item .form-control' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-loc-space.rtin-input-item .form-control' => 'color: {{VALUE}}',
					'{{WRAPPER}} .search-geo-address .form-control::placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .search-radius.rtin-input-item .form-control::placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-loc-space.rtin-input-item .select2-selection__arrow b:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-loc-space.rtin-input-item .select2-container--classic .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'location_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .rtin-loc-space.rtin-input-item .select2-container--classic .select2-selection--single .select2-selection__rendered',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'location_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon box background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '
					{{WRAPPER}} .rtcl-advanced-search-widget .search-radius .form-control,
					{{WRAPPER}} .rtcl-advanced-search-widget .search-geo-address .form-control,
					{{WRAPPER}} .rtcl-advanced-search-widget .rtin-loc-space.rtin-input-item .select2-container--classic .select2-selection--single 
				',
			]
		);
		$this->add_responsive_control(
			'location_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rtcl-advanced-search-widget .search-radius .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					'{{WRAPPER}} .rtcl-advanced-search-widget .search-geo-address .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					'{{WRAPPER}} .rtcl-widget-search-form .rtin-loc-space.rtin-input-item .select2-container--classic .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'                   
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __category() {
		$this->start_controls_section(
			'category_settings',
			[
				'label'     => esc_html__( 'Category', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'category_field_size',
			[
				'label' => esc_html__( 'Field Size', 'cldoctor-core' ),
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
					'{{WRAPPER}} .rtcl-search-input-button.rtin-category' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'category_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rtin-cat-space.rtin-input-item i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-cat-space.rtin-input-item .select2-selection__arrow b:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-cat-space.rtin-input-item .select2-container--classic .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .rtin-cat-space.rtin-input-item .select2-container--classic .select2-selection--single .select2-selection__rendered',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'category_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon box background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rtcl-widget-search-form .rtin-cat-space.rtin-input-item .select2-container--classic .select2-selection--single',
			]
		);
		$this->add_responsive_control(
			'category_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rtcl-widget-search-form .rtin-cat-space.rtin-input-item .select2-container--classic .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __keyword() {
		$this->start_controls_section(
			'keyword_settings',
			[
				'label'     => esc_html__( 'Keyword', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'keyword_field_size',
			[
				'label' => esc_html__( 'Field Size', 'cldoctor-core' ),
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
					'{{WRAPPER}} .rtcl-search-input-button.rtin-keyword' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'keyword_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rtin-key-space.rtin-input-item .form-control' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-key-space.rtin-input-item .form-control::placeholder' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'keyword_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .rtin-key-space.rtin-input-item .select2-container--classic .select2-selection--single .select2-selection__rendered',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'keyword_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon box background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rtin-key-space.rtin-input-item .form-control',
			]
		);
		$this->add_responsive_control(
			'keyword_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rtin-key-space.rtin-input-item .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __pricing() {
		$this->start_controls_section(
			'pricing_settings',
			[
				'label'     => esc_html__( 'Pricing', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'pricing_field_size',
			[
				'label' => esc_html__( 'Field Size', 'cldoctor-core' ),
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
					'{{WRAPPER}} .price-item-box.rtin-input-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'pricing_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'cldoctor-core' ),
				'selectors' => array( 
					'{{WRAPPER}} .rtcl-advanced-search-widget.rtcl-search-inline .price-item-box .price-filter-title' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .rtcl-advanced-search-widget.rtcl-search-inline .price-item-box .price-filter-title',
			]
		);
		$this->end_controls_section();
	}

	protected function __button() {
		// Button Style
		$this->start_controls_section(
			'btn_style',
			[
				'label'     => esc_html__( 'Button', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg_color',
				'label'     => __( 'Background', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'     => __( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2',
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
					'{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2:hover' => 'color: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_hbg_color',
				'label'     => __( 'Background', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2::before',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => __( 'Border', 'cldoctor-core' ),
				'selector'  => '{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'cldoctor-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rtcl-advanced-search-widget .button-style-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
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