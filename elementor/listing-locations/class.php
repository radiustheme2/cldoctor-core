<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rt_Listing_Locations extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Locations', 'cldoctor-core' );
		$this->rt_base = 'rt-listing-locations';
		parent::__construct( $data, $args );
	}
    public function get_script_depends() {
		return [
			'swiper',
		];
	}
	protected function register_controls() {
        $this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'cldoctor-core' ),
				'options' => array(
					'1' => esc_html__( 'Style 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Style 2', 'cldoctor-core' ),
					'3' => esc_html__( 'Style 3', 'cldoctor-core' ),
					'4' => esc_html__( 'Style 4', 'cldoctor-core' ),
				),
				'default' => '3',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'location_name', [
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Select Location', 'cldoctor-core' ),
				'description' => esc_html__( 'Location background image', 'cldoctor-core' ),
				'options' => $this->rt_get_categories_by_id('rtcl_location'),
				'multiple' => false,
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'location_img', [
				'type'    => Controls_Manager::MEDIA,
				'label'   => esc_html__( 'Background Image', 'cldoctor-core' ),
				'description' => esc_html__( 'Select location background image', 'cldoctor-core' ),
				'show_label' => false,
			]
		);
        $this->add_control(
			'locations',
			[
				'label'     => __( 'Add as many locations as you want', 'cldoctor-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Box Height', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors' => [
					'{{WRAPPER}} .listing-box-wrap .common-style' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'display_count',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Show Listing Counts', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
			]
		);
		$this->add_control(
			'count_label',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Counts label', 'cldoctor-core' ),
				'default'     => 'Doctor Listing',
				'condition'   => array( 'display_count' => 'yes' ),
			]
		);
		$this->add_control(
			'enable_link',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Enable Link', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'condition'   => array( 'style' => array( '2' ) ),
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Item Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .listing-box-wrap .common-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Image Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .listing-box-wrap .common-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .listing-box-wrap .common-style .item-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
        $this->end_controls_section();

		/* - Grid Settings
		======================================= */
		$this->start_controls_section(
			'sec_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'columns_gap',
			[
				'label'   => esc_html__( 'Columns Gap', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => esc_html__( 'Gap 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Gap 2', 'cldoctor-core' ),
					'3' => esc_html__( 'Gap 3', 'cldoctor-core' ),
					'4' => esc_html__( 'Gap 4', 'cldoctor-core' ),
					'5' => esc_html__( 'Gap 5', 'cldoctor-core' ),
					'6' => esc_html__( 'Gap 6', 'cldoctor-core' ),
					'7' => esc_html__( 'Gap 7', 'cldoctor-core' ),
					'8' => esc_html__( 'Gap 8', 'cldoctor-core' ),
					'9' => esc_html__( 'Gap 9', 'cldoctor-core' ),
					'10' => esc_html__( 'Gap 10', 'cldoctor-core' ),
					'11' => esc_html__( 'Gap 11', 'cldoctor-core' ),
					'12' => esc_html__( 'Gap 12', 'cldoctor-core' ),
				],
			]
		);
		$this->add_control(
			'rows_gap',
			[
				'label'   => esc_html__( 'Rows Gap', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => esc_html__( 'Gap 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Gap 2', 'cldoctor-core' ),
					'3' => esc_html__( 'Gap 3', 'cldoctor-core' ),
					'4' => esc_html__( 'Gap 4', 'cldoctor-core' ),
					'5' => esc_html__( 'Gap 5', 'cldoctor-core' ),
					'6' => esc_html__( 'Gap 6', 'cldoctor-core' ),
					'7' => esc_html__( 'Gap 7', 'cldoctor-core' ),
					'8' => esc_html__( 'Gap 8', 'cldoctor-core' ),
					'9' => esc_html__( 'Gap 9', 'cldoctor-core' ),
					'10' => esc_html__( 'Gap 10', 'cldoctor-core' ),
					'11' => esc_html__( 'Gap 11', 'cldoctor-core' ),
					'12' => esc_html__( 'Gap 12', 'cldoctor-core' ),
				],
			]
		);
		$this->add_control(
			'desktop_grid_column',
			[
				'label'   => esc_html__( 'Desktop items', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'medium_desktop_grid_column',
			[
				'label'   => esc_html__( 'Medium Desktop items', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'tablet_grid_column',
			[
				'label'   => esc_html__( 'Tablet items', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'mobile_grid_column',
			[
				'label'   => esc_html__( 'Mobile items', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'samll_mobile_grid_column',
			[
				'label'   => esc_html__( 'Small Mobile items', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->end_controls_section();

		/* Box Style
		-------------------------------*/
		$this->start_controls_section(
			'locations_style',
			[
				'label' => __( 'Item Style', 'cldoctor-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => esc_html__( 'Box Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Box Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .common-style',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'cldoctor-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .location-information .location-count .item-title a' => 'color: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .item-title a',
				'fields_options' => [
					'typography' => [
						'label' => esc_html__('Title Typography', 'cldoctor-core'),
					]
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Title Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .location-information .location-count .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_control(
			'count_color',
			[
				'label'     => __( 'Count Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .common-style .location-information .location-count .listing-number' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .common-style .location-information .location-count .listing-number span' => 'color: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'count_typo',
				'label'    => esc_html__( 'Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .location-information .location-count .listing-number',
				'fields_options' => [
					'typography' => [
						'label' => esc_html__('Count Typography', 'cldoctor-core'),
					]
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .common-style .location-information .btn-box a' => 'color: {{VALUE}} !important',
				],
				'condition' => ['style' => ['1', '2' ]]
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'box_style_hover',
			[
				'label' => __( 'Hover', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'title_h_color',
			[
				'label'     => __( 'Title Color', 'cldoctor-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .common-style:hover .location-information .location-count .item-title a' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'count_h_color',
			[
				'label'     => __( 'Count Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .common-style:hover .location-information .location-count .listing-number' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .common-style:hover .location-information .location-count .listing-number span' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'icon_h_color',
			[
				'label'     => __( 'Icon Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .common-style:hover .location-information .btn-box a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .common-style:hover .location-information .location-count i' => 'color: {{VALUE}} !important',
				],
				'condition' => ['style' => [ '1', '2' ]]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_hover_bg',
				'label'    => esc_html__( 'Box Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Box Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '
					{{WRAPPER}} .location-box-layout-1::before,
					{{WRAPPER}} .location-box-layout-4::before,
					{{WRAPPER}} .location-box-layout-2 .state-overlay,
					{{WRAPPER}} .location-box-layout-3 .location-information::before
				',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
    }

    protected function rt_term_post_count( $term_id ) {
		$args = [
			'nopaging'            => true,
			'fields'              => 'ids',
			'post_type'           => 'rtcl_listing',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'suppress_filters'    => false,
			'tax_query'           => [
				[
					'taxonomy' => 'rtcl_location',
					'field'    => 'term_id',
					'terms'    => $term_id,
				],
			],
		];
		$posts = get_posts( $args );
		return count( $posts );
	}
	protected function render() {
		$data = $this->get_settings();
		
		$template = 'view-1';
		$template = 'view-'.$data['style'];

		$this->rt_template( $template, $data );
	}

}