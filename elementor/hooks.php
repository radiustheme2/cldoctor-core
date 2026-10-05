<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

class Plugins_Hooks {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

    public function __construct() {
	    if (class_exists( 'Cldoctor_Main' ) ) {
			add_filter( 'rtcl_listing_cat_box_column', [ $this, 'cldoctor_listing_cat_box_column' ], 10 );
			add_filter( 'rtcl_el_category_box_style', [ $this, 'cldoctor_listing_category_box_layout' ], 10 );
	        add_filter( 'rtcl_el_listing_category_widget_general_field', [ $this, 'category_settings_new_fields'], 10, 2 );
	        // add_filter( 'rtcl_el_listing_category_widget_general_field', [ $this, 'category_settings_cols_modity'], 10, 2 );
	        add_filter( 'rtcl_el_listing_category_widget_style_field', [ $this, 'category_settings_style_modity'], 10, 2 );
	        add_filter( 'rtcl_el_listing_category_widget_style_field', [ $this, 'category_settings_add_new_controls'], 10, 2 );
	        add_filter( 'rtcl_el_listing_category_widget_style_field', [ $this, 'category_add_arrow_icon_section_controls'], 10, 2 );

			add_filter( 'rtcl_el_listings_grid_style', [ __CLASS__, 'el_listings_style_grid' ], 10 );
			add_filter( 'rtcl_el_listings_list_style', [ __CLASS__, 'el_listings_style_list' ], 10 );
			add_filter('rtcl_el_listing_widget_general_field', [ $this, 'listing_general_settings_new_control'], 10, 2 );
			add_filter('rtcl_el_listing_widget_style_field', [ $this, 'listing_general_settings_image_new_control'], 10, 2 );
			add_filter('el_listing_widget_content_visibility_fields', [ $this, 'listing_grid_settings_new_control'], 10, 2 );
	    }
    }

	/**
	 * Alignment settings snipate
	 *
	 * @return array
	 */
	public function alignment_options() {
		return [
			'left'   => [
				'title' => esc_html__( 'Left', 'cldoctor-core' ),
				'icon'  => 'eicon-text-align-left',
			],
			'center' => [
				'title' => esc_html__( 'Center', 'cldoctor-core' ),
				'icon'  => 'eicon-text-align-center',
			],
			'right'  => [
				'title' => esc_html__( 'Right', 'cldoctor-core' ),
				'icon'  => 'eicon-text-align-right',
			],
		];
	}

	public static function cldoctor_listing_category_box_layout( $data ) {
		$data['style-3'] = esc_html__( 'Style 3', 'cldoctor-core' );
		return $data;
	}

	public function rt_alignment_options(){
		return array(
			'left'    => array(
				'title' => __( 'Left', 'cldoctor-core' ),
				'icon' => 'eicon-text-align-left',
			),
			'center' => array(
				'title' => __( 'Center', 'cldoctor-core' ),
				'icon' => 'eicon-text-align-center',
			),
			'right' => array(
				'title' => __( 'Right', 'cldoctor-core' ),
				'icon' => 'eicon-text-align-right',
			),
			'justify' => array(
				'title' => __( 'Justified', 'cldoctor-core' ),
				'icon' => 'eicon-text-align-justify',
			),
		);
	}

	// Listing Categories
	public function category_settings_new_fields( $fields, $obj ){

		if( 'rtcl-listing-cat-box' == $obj->rtcl_base ){

			$cat_label = array(
				array(
					'id'      => 'cat_label',
					'type'    => Controls_Manager::TEXT,
					'label'   => esc_html__( ' Category Label', 'cldoctor-core' ),
					'condition'   => [ 'rtcl_cats_style' => 'style-3'],		
					'description' => esc_html__( 'Keyword field position', 'cldoctor-core' ),
				),
				array(
					'type'      => Controls_Manager::CHOOSE,
					'id'      => 'cats_row_alignment',
					'label'   => esc_html__( ' Row Box Alignment', 'cldoctor-core' ),
					'options'   => [
						'start'   => [
							'title' => esc_html__( 'Left', 'cldoctor-core' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'cldoctor-core' ),
							'icon'  => 'eicon-text-align-center',
						],
						'end'  => [
							'title' => esc_html__( 'Right', 'cldoctor-core' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'condition'   => [ 'rtcl_cats_style' => 'style-3'],		
					'description' => esc_html__( 'Categories box alignments', 'cldoctor-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_cats', $cat_label, $fields );
		}

		return $fields;
	}

	public function cldoctor_listing_cat_box_column(){
		$cols = array(
			'1' => __( '1 Col', 'cldoctor-core' ),
			'2'  => __( '2 Col', 'cldoctor-core' ),
			'3'  => __( '3 Col', 'cldoctor-core' ),
			'4'  => __( '4 Col', 'cldoctor-core' ),
			'5'  => __( '5 Col', 'cldoctor-core' ),
			'6'  => __( '6 Col', 'cldoctor-core' ),
		);
		return $cols;
	}

	public function category_settings_cols_modity( $fields, $obj ){
		$modify_array = array(
			array(
				'id'        => 'rtcl_sec_responsive',
				'condition'   => [ 'rtcl_cats_style' => ['style-1', 'style-2']],	
			),			
			array(
				'id'        => 'rtcl_col_xl',
				'condition'   => [ 'rtcl_cats_style' => ['style-1', 'style-2']],	
			),			
		);
		$fields = $obj->modify_controls( $modify_array, $fields );

		return $fields;
	}

	public function category_settings_style_modity( $fields, $obj ){
		$modify_array = array(
			array(
				'id'        => 'rtcl_background_body',
				'condition'   => [ 'rtcl_cats_style' => ['style-2', 'style-3']],	
			),
			array(
				'id'        => 'rtcl_icon_bg_hover',
				'selectors' => array(
					'{{WRAPPER}} .cat-item-wrap .cat-details .icon a:after' => 'background-color: {{VALUE}}',
				),
			),		
		);
		$fields = $obj->modify_controls( $modify_array, $fields );

		return $fields;
	}

	public function category_settings_add_new_controls( $fields, $obj ){
		if( 'rtcl-listing-cat-box' == $obj->rtcl_base ){
			$label_color = array(
				array(
					'id'      => 'label_color',
					'mode'    => 'responsive',
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'label Color', 'cldoctor-core' ),
					'selectors' => array( 
						'{{WRAPPER}} .cat-items-label' => 'color: {{VALUE}}'
					),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_title_color', $label_color, $fields );
		}
		return $fields;
	}

	public function category_add_arrow_icon_section_controls( $fields, $obj ){
		if( 'rtcl-listing-cat-box' == $obj->rtcl_base ){
			$category_link_arrow = array(
				array(
					'mode'      => 'section_start',
					'id'        => 'rtcl_cats_link_arrow',
					'tab'       => Controls_Manager::TAB_STYLE,
					'label'     => __( 'Link Arrow', 'cldoctor-core' ),
				),
				array(
					'label'     => __( 'Arrow Size', 'cldoctor-core' ),
					'type'      => Controls_Manager::SLIDER,
					'id'        => 'rtcl_cats_link_arrow_size',
					'range'     => array(
						'px' => array(
							'min' => 10,
							'max' => 300,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} .category-content .arrow-icon' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .category-content .arrow-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					),
				),
				// Wrapper style settings.
				array(
					'mode' => 'tabs_start',
					'id'   => 'rtcl_arrow_icon_tabs_start',
				),
					// Tab For Normal view.
					array(
						'mode'  => 'tab_start',
						'id'    => 'rtcl_arrow_icon_tab_normal',
						'label' => esc_html__( 'Normal', 'cldoctor-core' ),
					),
						array(
							'id'      => 'rtcl_arrow_icon_color',
							'mode'    => 'responsive',
							'type'    => Controls_Manager::COLOR,
							'label'   => esc_html__( 'Arrow Color', 'cldoctor-core' ),
							'selectors' => array( 
								'{{WRAPPER}} .category-content .arrow-icon' => 'color: {{VALUE}}'
							),
						),
						array(
							'type'      => Controls_Manager::COLOR,
							'id'        => 'rtcl_arrow_icon_background_color',
							'label'     => __( 'Head background', 'cldoctor-core' ),
							'selectors' => array(
								'{{WRAPPER}} .category-content .arrow-icon' => 'background-color: {{VALUE}}',
							),
						),
						array(
							'type'     => Group_Control_Border::get_type(),
							'mode'     => 'group',
							'id'       => 'rtcl_arrow_icon_border',
							'fields_options' => array(
								'border' => array(
									'default' => 'solid',
								),
								'width'  => array(
									'default' => array(
										'top'      => '1',
										'right'    => '1',
										'bottom'   => '1',
										'left'     => '1',
										'isLinked' => false,
									),
								),
								'color'  => array(
									'default' => 'rgba(0, 0, 0, 0.05)',
								),
							),
							'selector' => '{{WRAPPER}} .category-content .arrow-icon',
						),
					array(
						'mode' => 'tab_end',
					),
					// Tab For Hover view.
					array(
						'mode'  => 'tab_start',
						'id'    => 'rtcl_arrow_icon_tab_hover',
						'label' => esc_html__( 'Hover', 'cldoctor-core' ),
					),
					array(
						'id'      => 'rtcl_arrow_icon_hover_color',
						'mode'    => 'responsive',
						'type'    => Controls_Manager::COLOR,
						'label'   => esc_html__( 'Arrow Hover Color', 'cldoctor-core' ),
						'selectors' => array( 
							'{{WRAPPER}} .category-content .arrow-icon:hover' => 'color: {{VALUE}}'
						),
					),
					array(
						'type'      => Controls_Manager::COLOR,
						'id'        => 'rtcl_arrow_icon_hover_background_color',
						'label'     => __( 'Background Color', 'cldoctor-core' ),
						'selectors' => array(
							'{{WRAPPER}} .category-content .arrow-icon:hover' => 'background-color: {{VALUE}}',
						),
					),
					array(
						'type'     => Group_Control_Border::get_type(),
						'mode'     => 'group',
						'id'       => 'rtcl_arrow_icon_hover_border',
						'fields_options' => array(
							'border' => array(
								'default' => 'solid',
							),
							'width'  => array(
								'default' => array(
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => false,
								),
							),
							'color'  => array(
								'default' => 'rgba(0, 0, 0, 0.05)',
							),
						),
						'selector' => '{{WRAPPER}} .category-content .arrow-icon:hover',
					),
					array(
						'mode' => 'tab_end',
					),
				array(
					'mode' => 'tabs_end',
				),
				array(
					'mode' => 'section_end',
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_sec_short_description', $category_link_arrow, $fields );
		}
		return $fields;
	}

	// Listing Showcase
	public static function el_listings_style_grid( $data = [] ){
		$data['style-6'] = [
			'title' => esc_html__( 'Style 6', 'cldoctor-core' ),
			'url'   => CLDOCTOR_CORE_BASE_URL ."assets/img/grid-style-06.png",
		];
		$data['style-7'] = [
			'title' => esc_html__( 'Style 7', 'cldoctor-core' ),
			'url'   => CLDOCTOR_CORE_BASE_URL ."assets/img/grid-style-06.png",
		];
		return $data;
	}

	public static function el_listings_style_list( $data = [] ) {
		$data['style-6'] = [
			'title' => esc_html__( 'Style 6', 'cldoctor-core' ),
			'url'   =>  CLDOCTOR_CORE_BASE_URL ."assets/img/list-style-06.png",
		];
		$data['style-7'] = [
			'title' => esc_html__( 'Style 7', 'cldoctor-core' ),
			'url'   =>  CLDOCTOR_CORE_BASE_URL ."assets/img/list-style-06.png",
		];
		return $data;
	}

	public function listing_general_settings_new_control( $fields, $obj ){
		if( 'rtcl-listing-items' == $obj->rtcl_base ){
			$rtcl_el_listign_general_fields = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_enable_filter',
					'label'       => __( 'Enable FilterX', 'cldoctor-core' ),
					'label_on'    => __( 'On', 'cldoctor-core' ),
					'label_off'   => __( 'Off', 'cldoctor-core' ),
					'description' => __( 'Columns support 2-5', 'cldoctor-core' ),
					'condition' => [
						'rtcl_listings_view' => 'grid',
					],
				),
				array(
					'type'    => Controls_Manager::SELECT,
					'mode'    => 'responsive',
					'id'      => 'rtcl_listings_list_column',
					'label'   => __( 'Column', 'cldoctor-core' ),
					'options' => [
						'8' => __( 'Column 8', 'cldoctor-core' ),
						'7' => __( 'Column 7', 'cldoctor-core' ),
						'6' => __( 'Column 6', 'cldoctor-core' ),
						'5' => __( 'Column 5', 'cldoctor-core' ),
						'4' => __( 'Column 4', 'cldoctor-core' ),
						'3' => __( 'Column 3', 'cldoctor-core' ),
						'2' => __( 'Column 2', 'cldoctor-core' ),
						'1' => __( 'Column 1', 'cldoctor-core' ),
					],
					'default' => '3',
					'devices' => [ 'desktop', 'tablet_extra', 'tablet', 'mobile' ],
					'condition' => [
						'rtcl_listings_view' => 'list',
					],
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_listings_grid_style', $rtcl_el_listign_general_fields, $fields, true );
			
		}
		return $fields;
	}

	public function listing_grid_settings_new_control( $fields, $obj ){

		if( 'rtcl-listing-items' == $obj->rtcl_base ){
			$rtcl_show_designation = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_designation',
					'label'       => __( 'Show Designation', 'cldoctor-core' ),
					'label_on'    => __( 'On', 'cldoctor-core' ),
					'label_off'   => __( 'Off', 'cldoctor-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Designation. Default: On', 'cldoctor-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_image', $rtcl_show_designation, $fields, true );

			$rtcl_show_meet_time = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_meet_time',
					'label'       => __( 'Show Time', 'cldoctor-core' ),
					'label_on'    => __( 'On', 'cldoctor-core' ),
					'label_off'   => __( 'Off', 'cldoctor-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Time. Default: On', 'cldoctor-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_title', $rtcl_show_meet_time, $fields, true );
			$rtcl_show_reviews = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_reviews',
					'label'       => __( 'Show Reviews', 'cldoctor-core' ),
					'label_on'    => __( 'On', 'cldoctor-core' ),
					'label_off'   => __( 'Off', 'cldoctor-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Reviews. Default: On', 'cldoctor-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_favourites', $rtcl_show_reviews, $fields, true );
			$rtcl_show_appointment = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_appointment',
					'label'       => __( 'Show Appointment Button', 'cldoctor-core' ),
					'label_on'    => __( 'On', 'cldoctor-core' ),
					'label_off'   => __( 'Off', 'cldoctor-core' ),
					'default'     => 'yes',
					'description' => __( 'Show or Hide Appointment Button. Default: On', 'cldoctor-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_reviews', $rtcl_show_appointment, $fields, true );
			
		}

		return $fields;
	}

	public function listing_wrapper_settings_fields( $fields, $obj ){
		if( 'rtcl-listing-items' == $obj->rtcl_base ){
			$after_remove = $obj->remove_controls(
				array(
					'rtcl_listing_wrapper_box_shadow',
					'rtcl_listing_wrapper_hover_box_shadow',
				),
				$fields
			);
			$the_array = array(
				array(
					'id'        => 'rtcl_wrapper_bg_color',
					'selectors' => [
						'{{WRAPPER}} .el-listing-single-item' => 'background-color: {{VALUE}};',
					],
				),
				array(
					'id'        => 'rtcl_listing_border',
					'selector' => '{{WRAPPER}} .el-listing-single-item',
				),
			);
			$fields = $obj->modify_controls( $the_array, $after_remove );
		}
		return $fields;
	}

	public function listing_general_settings_image_new_control( $fields, $obj ){
		if( 'rtcl-listing-items' == $obj->rtcl_base ){
			$rtcl_el_listign_image_fields = array(
				[
					'id'         => 'rtcl_image_box_width',
					'mode'       => 'responsive',
					'label'      => __( 'Image Box Width', 'cldoctor-core' ),
					'type'       => Controls_Manager::SLIDER,
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
					'selectors'  => [
						'{{WRAPPER}} .listing-item .item-img' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .listing-item .listing-thumb' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'rtcl_listings_view' => 'list',
					],
				],
				[
					'id'         => 'rtcl_image_border_radius',
					'mode'       => 'responsive',
					'label'      => __( 'Image Border Radius', 'cldoctor-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .listing-item .item-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .listing-item .listing-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				],
			);
			$fields = $obj->insert_new_controls( 'rtcl_image_mobile_spacing', $rtcl_el_listign_image_fields, $fields, true );
			
		}
		return $fields;
	}

	// Listing Locations
	public static function add_listings_single_location_style( $style = [] ) {
		$style['style-4'] = esc_html__( 'Style 4', 'cldoctor-core' );
		return $style;
	}

	public function single_location_add_new_settings( $fields, $obj ){
		$location_image = array(
			array(
				'id'      => 'location_image',
				'mode'    => 'responsive',
				'type'    => Controls_Manager::MEDIA,
				'label'   => esc_html__( 'Location Image', 'cldoctor-core' ),
			),
		);
		$fields = $obj->insert_new_controls( 'box_icon', $location_image, $fields );
		return $fields;
	}
}
Plugins_Hooks::instance();