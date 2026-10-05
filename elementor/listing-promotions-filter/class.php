<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

 namespace RadiusTheme\Cldoctor_Core;

use Elementor\Group_Control_Background;
use Elementor\Controls_Manager;
use \WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Listing_Isotope extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Isotope', 'cldoctor-core' );
		$this->rt_base = 'rt-listing-isotope';
		parent::__construct( $data, $args );
	}

	protected function register_controls(){
		$this->__general_settings();
		$this->__visibility_settings();
		$this->__responsive_settings();
		$this->__style_tab_settings();
	}

	protected function __general_settings() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'promotions',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => __( 'Items to Show', 'cldoctor-core' ),
				'options' => array(
					'popular'  => __( 'Popular', 'cldoctor-core' ),
					'featured' => __( 'Featured', 'cldoctor-core' ),
					'new'      => __( 'New', 'cldoctor-core' ),
					'top'      => __( 'Top', 'cldoctor-core' ),
				),
				'multiple' => true,
				'default' => array( 'popular', 'featured'),
			]
		);
		$this->add_control(
			'number',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Number of Items per', 'cldoctor-core' ),
				'default'    => '8',
				'description' => __( 'Write -1 to show all', 'cldoctor-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'random',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'change items on every page load', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
			]
		);

		$this->add_control(
			'orderby',
			[
				'type'      => Controls_Manager::SELECT2,
				'label'     => __( 'Order By', 'cldoctor-core' ),
				'options'   => array(
					'date'   => __( 'Date (Recents comes first', 'cldoctor-core' ),
					'title'  => __( 'Title', 'cldoctor-core' ),
				),
				'default'   => 'date',
				'condition' => array( 'random' => array( '' ) ),
			]
		);
		$this->end_controls_section();
	}

	protected function __visibility_settings() {
		$this->start_controls_section(
			'sec_visibility',
			[
				'label' => esc_html__( 'Visibility', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'thumb_area',
			[
				'type'        => Controls_Manager::HEADING,
				'label'       => esc_html__( 'Thumbnail Area Control', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'display_cat',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Category', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable Category. Default: On', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_status',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'On/Off Status', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Open or Close status tag on/off', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_location',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Location', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Location tag on/off', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_poster',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Listing Author', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Listing Author Information', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_rating',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Listing Rating', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Listing Rating', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'content_area',
			[
				'type'        => Controls_Manager::HEADING,
				'label'       => esc_html__( 'Content Area Control', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'display_badge',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Badge', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Listing Badge', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_address',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Address', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Address', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_phone',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Phone', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Phone Number', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_website',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Website', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Website', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_date',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Date', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Date', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'display_view',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Views', 'cldoctor-core' ),
				'label_on'    => esc_html__( 'On', 'cldoctor-core' ),
				'label_off'   => esc_html__( 'Off', 'cldoctor-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Listing Views', 'cldoctor-core' ),
			]
		);
		$this->end_controls_section();
	}

	protected function __responsive_settings() {
		$this->start_controls_section(
			'sec_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'col_xl',
			[
				'label'   => esc_html__( 'Desktops: > 1199px', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'col_lg',
			[
				'label'   => esc_html__( 'Desktops: > 991px', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'col_md',
			[
				'label'   => esc_html__( 'Tablets: > 767px', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'col_sm',
			[
				'label'   => esc_html__( 'Phones: > 575px', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->add_control(
			'col_mobile',
			[
				'label'   => esc_html__( 'Small Phones: < 576px', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => $this->rt_grid_options(),
			]
		);
		$this->end_controls_section();
	}

	protected function __style_tab_settings() {
		$this->start_controls_section(
			'sec_style_color',
			[
				'label' => esc_html__( 'Color', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .listing-grid-each .rtin-item',
			]
		);
		$this->add_control(
			'cat_color',
			[
				'label'     => __( 'Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .listing-grid-each .rtin-item .rtin-content .rtin-cat' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->end_controls_section();
	}

	private function rt_isotope_query( $data ) {

		$result = array();

		// Get plugin settings
		$settings = get_option( 'rtcl_moderation_settings' );
		$min_view = !empty( $settings['popular_listing_threshold'] ) ? (int) $settings['popular_listing_threshold'] : 500;
		$new_threshold = !empty( $settings['new_listing_threshold'] ) ? (int) $settings['new_listing_threshold'] : 3;

		// Post type
		$args = array(
			'post_type'      => 'rtcl_listing',
			'post_status'    => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $data['number'],
		);

		// Ordering
		if ( $data['random'] ) {
			$args['orderby'] = 'rand';
		} else {
			$args['orderby'] = $data['orderby'];
			if ( $data['orderby'] == 'title' ) {
				$args['order'] = 'ASC';
			}
		}

		// Date and Meta Query results
		$args2 = array();
		if ( in_array( 'new' , $data['promotions'] ) ) {
			$args2['date_query'] = array(
				array(
					'after' => $new_threshold . ' day ago',
				),
			);
			$result['new'] = new WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'featured' , $data['promotions'] ) ) {
			$args2['meta_key'] = 'featured';
			$args2['meta_value'] = '1';
			$result['featured'] = new WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'top' , $data['promotions'] ) ) {
			$args2['meta_key'] = '_top';
			$args2['meta_value'] = '1';
			$result['top'] = new WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'popular' , $data['promotions'] ) ) {
			$args2['meta_key'] = '_views';
			$args2['meta_value'] = $min_view;
			$args2['meta_compare'] = '>=';
			$result['popular'] = new WP_Query( $args + $args2 );
			$args2 = array();
		}
		return $result;
	}

	private function rt_isotope_navigation( $data ) {
		$navs = array(
			'featured' => __( 'Featured', 'cldoctor-core' ),
			'new'      => __( 'New', 'cldoctor-core' ),
			'popular'  => __( 'Popular', 'cldoctor-core' ),
			'top'      => __( 'Top', 'cldoctor-core' ),
		);
		$navs = apply_filters( 'cldoctor_isotope_navigations', $navs );
		foreach ( $navs as $key => $value ) {
			if ( !in_array( $key , $data['promotions'] ) ) {
				unset($navs[$key]);
			}
		}
		return $navs;
	}

	protected function render() {
		$data = $this->get_settings();

		$data['queries']  = $this->rt_isotope_query( $data );
		$data['navs']     = $this->rt_isotope_navigation( $data );

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}