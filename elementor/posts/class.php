<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

 namespace RadiusTheme\Cldoctor_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rt_Post extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name      = esc_html__( 'Post', 'cldoctor-core' );
		$this->rt_base      = 'rt-post';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* -- Content Settings -- */
		$this->__post_content_settings();
		/* -- Style Settings -- */
		$this->__post_box_style_settings();
		$this->__post_thumbnail_style_settings();
		$this->__post_title_style_settings();
		$this->__post_content_style_settings();
		$this->__post_meta_style_settings();
		$this->__post_read_more_style_settings();
	}

	/* -- Content Settings -- */
	protected function __post_content_settings() {
		// Post Content Settings
		$this->start_controls_section(
			'rt_post_settings',
			[
				'label' => esc_html__( 'Post Settings', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( 'Style 1', 'cldoctor-core' ),
					'2' => __( 'Style 2', 'cldoctor-core' ),
					'3' => __( 'Style 3', 'cldoctor-core' ),
				],

			]
		);
		
		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'cldoctor-core' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'cldoctor-core' ),
				'label_on'     => __( 'Custom', 'cldoctor-core' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();

		$this->add_control(
			'grid_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'grid_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'grid_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => $this->rt_grid_options(),

			]
		);
		$this->end_popover();

		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'cldoctor-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'cldoctor-core' ),
				'description' => __( 'Enter number of post to show.', 'cldoctor-core' ),
				'default'     => '3',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'cldoctor-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'cldoctor-core' ),
					'by_title'       => __( 'By Post ID', 'cldoctor-core' ),
					'by_category' => __( 'By Category', 'cldoctor-core' ),
					'by_tags'     => __( 'By Tags', 'cldoctor-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'titles',
			[
				'label'       => __( 'Choose Titles', 'cldoctor-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_blog_posts_title(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_title',
				],
				'description' => __( 'Select post title\'s.', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'cldoctor-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_blog_categories(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'cldoctor-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_blog_tags(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'cldoctor-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'cldoctor-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'cldoctor-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'cldoctor-core' ),
				'type'    =>Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'cldoctor-core' ),
					'ID'             => __( 'Order by post ID', 'cldoctor-core' ),
					'author'         => __( 'Author', 'cldoctor-core' ),
					'title'          => __( 'Title', 'cldoctor-core' ),
					'modified'       => __( 'Last modified date', 'cldoctor-core' ),
					'comment_count'  => __( 'Number of comments', 'cldoctor-core' ),
					'rand'           => __( 'Random order', 'cldoctor-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'cldoctor-core' ),
					'DESC' => __( 'DESC', 'cldoctor-core' ),
				],
			]
		);
		$this->end_controls_section();
	}

	/* -- Style Settings -- */
	protected function __post_box_style_settings() {
		// Title Settings
		$this->start_controls_section(
			'post_box_style',
			[
				'label' => __( 'Post Box', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'post_box_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'cldoctor-core'),
					]
				],
				'selector' => '{{WRAPPER}} .blog-post',
			]
		);
		$this->add_responsive_control(
			'post_box_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Content Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .blog-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
				'condition' => [
					'layout' => '2',
				],
			]
		);
		$this->add_responsive_control(
			'post_box_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Box Border Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .blog-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',               
				),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'post_box_shadow',
				'selector' => '{{WRAPPER}} .blog-post',
				'fields_options' => [
					'box_shadow_type' =>
					[ 
						'default' =>'no' 
					],
				]
			]
		);
		$this->add_responsive_control(
			'post_box_image_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Image Radius', 'cldoctor-core' ),                 
				'selectors' => array(                  
					'{{WRAPPER}} .blog-post-thumb a.thumb-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					'{{WRAPPER}} .blog-post-thumb a.thumb-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
				),
			]
		);
		$this->add_control(
			'post_content_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Post Content Style', 'cldoctor-core' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'post_box_content_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Box Content Padding', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .blog-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',               
				),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'post-content_box_shadow',
				'selector' => '{{WRAPPER}} .blog-post-content',
				'fields_options' => [
					'box_shadow_type' =>
					[ 
						'default' =>'no' 
					],
				]
			]
		);
		$this->end_controls_section();
	}

	protected function __post_thumbnail_style_settings() {
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'thumbnail_display',
			[
				'label'   => __( 'Feature Image Visibility', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'cldoctor-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'cldoctor-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);

		$this->add_control(
			'post_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'cldoctor-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->rt_get_all_image_sizes(),
				'condition' => [
					'thumbnail_display' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'post_thumbnail_height',
			[
				'label'      => __( 'Image Height', 'cldoctor-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range'      => [
					'%' => [
						'min'  => 20,
						'max'  => 100,
					],
					'px' => [
						'min'  => 300,
						'max'  => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-post-thumb a img' => 'height: {{SIZE}}{{UNIT}}; object-fit:cover',
				],
				'condition' => [
					'thumbnail_display' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'post_thumbnail_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .blog-post-thumb a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                  
					'{{WRAPPER}} .blog-post-thumb a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                  
				),
				'condition' => [
					'thumbnail_display' => 'visible',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __post_title_style_settings() {
		// Title Settings
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .blog-post-heading a',
			]
		);
		$this->add_responsive_control(
			'title_limit',
			[
				'label'     => __( 'Title Character Limit', 'cldoctor-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '30',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Margin', 'cldoctor-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'selectors'          => [
					'{{WRAPPER}} .blog-post-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'title_style_tabs'
		);
		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-heading a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-heading a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __post_content_style_settings() {
		// Content Settings
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'cldoctor-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'cldoctor-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'cldoctor-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);
		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'cldoctor-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '24',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .content-excerpt',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'cldoctor-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .content-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'cldoctor-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __post_meta_style_settings() {
		// Meta Information Settings
		//=====================================================================

		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .blog-post-meta ul li',
			]
		);

		$this->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$this->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'post_meta_color',
			[
				'label'     => __( 'Meta Color', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-meta ul li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .blog-post-meta ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Box Hover', 'cldoctor-core' ),
			]
		);

		$this->add_control(
			'post_meta_color_hover',
			[
				'label'     => __( 'Meta Color Hover', 'cldoctor-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-meta ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'author_avatar',
			[
				'label'     => __( 'Author Avatar Style', 'cldoctor-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => [
					'icon'      => __( 'Author Icon', 'cldoctor-core' ),
					'image'     => __( 'Author Image', 'cldoctor-core' ),
					'no-avatar' => __( 'No Avatar', 'cldoctor-core' ),
				],
				'condition' => [
					'author_visibility' => 'yes',
				],
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		
		$this->add_control(
			'cat_visibility',
			[
				'label'        => __( 'Category Visibility', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => false
			]
		);

		$this->add_control(
			'p_date_format',
			[
				'label'     => __( 'Date Format', 'cldoctor-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'time_ago',
				'options'   => [
					'default'  => __( 'Default From Settings', 'cldoctor-core' ),
					'time_ago' => __( 'Time Ago Format', 'cldoctor-core' ),
				],
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comment Visibility', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);
		$this->end_controls_section();
	}

	protected function __post_read_more_style_settings() {
		// Read More Settings
		$this->start_controls_section(
			'read_more_btn',
			[
				'label' => __( 'Button Settings', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'read_more_btn_visibility',
			[
				'label'   => __( 'Button Visibility', 'cldoctor-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'cldoctor-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'cldoctor-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);
		$this->add_control(
			'read_more_btn_text',
			[
				'label'        => __( 'Button Text', 'cldoctor-core' ),
				'type'         => Controls_Manager::TEXT,
				'default'	   =>__('More Details','cldoctor-core'),
				'condition' => [
					'read_more_btn_visibility' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'read_more_btn_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .blog-post-content .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',               
				),
			]
		);
		
		$this->start_controls_tabs(
			'read_more_btn_tabs'
		);
			$this->start_controls_tab(
				'read_more_btn_normal_tab',
				[
					'label' => __( 'Normal', 'cldoctor-core' ),
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->add_control(
				'read_more_btn_color',
				[
					'label'     => __( 'Button Color', 'cldoctor-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .blog-post-content .button-style-2' => 'color: {{VALUE}}',
					],
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'read_more_btn_bg_color',
					'label'    => esc_html__( 'Background', 'cldoctor-core' ),
					'types' => [ 'classic', 'gradient' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'cldoctor-core'),
						]
					],
					'selector' => '{{WRAPPER}} .blog-post-content .button-style-2',
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->add_responsive_control(
				'read_more_btn_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Radius', 'cldoctor-core' ),                 
					'selectors' => array(
						'{{WRAPPER}} .blog-post-content .button-style-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
					),
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'read_more_btn_hover_tab',
				[
					'label' => __( 'Button Hover', 'cldoctor-core' ),
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->add_control(
				'read_more_btn_hover_color',
				[
					'label'     => __( 'Button Color Hover', 'cldoctor-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .blog-post-content .button-style-2:hover' => 'color: {{VALUE}}',
					],
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'read_more_btn_hover_bg_color',
					'label'    => esc_html__( 'Background', 'cldoctor-core' ),
					'types' => [ 'classic', 'gradient' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'cldoctor-core'),
						]
					],
					'selector' => '{{WRAPPER}} .blog-post-content a.button-style-2::before',
					'condition' => [
						'read_more_btn_visibility' => 'visible',
					],
				]
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		$template = 'view-'.$data['layout'];
		$this->rt_template( $template, $data );
	}

}