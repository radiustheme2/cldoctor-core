<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

 namespace RadiusTheme\Cldoctor_Core;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rt_Testimonial extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Testimonial', 'cldoctor-core' );
		$this->rt_base = 'rt-testimonial';
		parent::__construct( $data, $args );
	}
	public function get_script_depends() {
		return [
			'swiper',
		];
	}
	protected function register_controls() {
		$this->__general_settings();
		$this->__grid_settings();
		$this->__carousel_settings();
		$this->__thumbnail_settings();
		$this->__name_settings();
		$this->__designation_settings();
		$this->__content_settings();
		$this->__rating_settings();
		$this->__quote_icon_settings();
		$this->__full_box_settings();
	}

	protected function __general_settings(){
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Reviewer Image', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'company_logo',
			[
				'label'   => __( 'Company Logo', 'cldoctor-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'cldoctor-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'cldoctor-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'profile_link',
			[
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'Link', 'cldoctor-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'cldoctor-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'cldoctor-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'cldoctor-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Enter Designation', 'cldoctor-core' ),
			]
		);
		$repeater->add_control(
            'rating', [
                'type' => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Rating', 'cldoctor-core' ),
				'options' => array(
					'1' => esc_html__( 'Rating 1', 'cldoctor-core' ),
					'2' => esc_html__( 'Rating 2', 'cldoctor-core' ),
					'3' => esc_html__( 'Rating 3', 'cldoctor-core' ),
					'4' => esc_html__( 'Rating 4', 'cldoctor-core' ),
					'5' => esc_html__( 'Rating 5', 'cldoctor-core' ),
				),
            ]
        );

		$this->add_control(
			'layout',
			[
				'type'    	  => Controls_Manager::SELECT,
				'label'   	  => esc_html__( 'Layout', 'cldoctor-core' ),
				'options' 	  => array(
					'slider'  => esc_html__( 'Slider', 'cldoctor-core' ),
					'grid' 	  => esc_html__( 'Grid', 'cldoctor-core' ),
				),
				'default' 	  => 'grid',
				'description' => esc_html__( 'Testimonial Layout. Default: Grid', 'cldoctor-core' ),
			]
		);
		$this->add_control(
			'grid_style',
			[
				'type'    	  => Controls_Manager::SELECT,
				'label'   	  => esc_html__( 'Layout', 'cldoctor-core' ),
				'options' 	  => array(
					'1'  	  => esc_html__( 'Grid layout 1', 'cldoctor-core' ),
					'2' 	  => esc_html__( 'Grid layout 2', 'cldoctor-core' ),
				),
				'default' 	  => '1',
				'description' => esc_html__( 'Testimonial Layout. Default: 1', 'cldoctor-core' ),
				'condition'   => array( 'layout' => array( 'grid' ) ),
			]
		);
		$this->add_control(
			'slider_style',
			[
				'type'    	  => Controls_Manager::SELECT,
				'label'   	  => esc_html__( 'Layout', 'cldoctor-core' ),
				'options' 	  => array(
					'1'  	  => esc_html__( 'Slider layout 1', 'cldoctor-core' ),
					'2' 	  => esc_html__( 'Slider layout 2', 'cldoctor-core' ),
					'3' 	  => esc_html__( 'Slider layout 3', 'cldoctor-core' ),
				),
				'default' 	  => '1',
				'description' => esc_html__( 'Testimonial Layout. Default: 1', 'cldoctor-core' ),
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'cldoctor-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Maria Zokatti', 'cldoctor-core' ),
						'designation' => __( 'CEO, PSDBOSS', 'cldoctor-core' ),
						'content'     => __( 'Engage with our professional real estate agents sell Following buy or rent your home.Get emails directly to your area reach inbox and manage the lead with.',
							'cldoctor-core' ),
					],
					[
						'name'        => __( 'John Doe', 'cldoctor-core' ),
						'designation' => __( 'WordPress Developer', 'cldoctor-core' ),
						'content'     => __( 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a',
							'cldoctor-core' ),
					],
					[
						'name'        => __( 'Kent Odeldan', 'cldoctor-core' ),
						'designation' => __( 'Web Designer', 'cldoctor-core' ),
						'content'     => __( 'Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a', 'cldoctor-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
			]
		);
		$this->add_control(
			'quote_icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Quote Icon', 'cldoctor-core' ),
				'default' => array(
					'value' => 'fas fa-quote-left',
					'library' => 'fa-solid',
				),
			]
		);
		$this->add_control(
			'rating',
			[
				'label'        => __( 'Rating', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
					'{{WRAPPER}} .testimonial-item' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __grid_settings(){
		/* = Grid Settings
		======================================= */
		$this->start_controls_section(
			'grid_settings',
			[
				'label'     => esc_html__( 'Grid Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition'   => array( 'layout' => array( 'grid' ) ),
			]
		);
		$this->add_control(
			'grid_column',
			[
				'label'   => esc_html__( 'Grid Columns', 'cldoctor-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
				'condition'   => array( 'layout' => array( 'grid' ) ),
			]
		);
		$this->end_controls_section();
	}

	protected function __carousel_settings(){
		/* = Carousel Settings
		======================================= */
		$this->start_controls_section(
			'carousel_settings',
			[
				'label'     => esc_html__( 'Carousel Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);

		$this->add_control(
			'slider_per_view',
			[
				'label'        => __( 'Slider Per View', 'cldoctor-core' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		
		$this->add_control(
			'slider_per_group',
			[
				'label'        => __( 'Slider Per Group', 'cldoctor-core' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);

		$this->add_control(
			'arrows',
			[
				'label'        => __( 'Arrow', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'cldoctor-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cldoctor-core' ),
				'label_off'    => __( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		
		$this->add_control(
			'slider_loop',
			[
				'label'        => __( 'Infinite', 'cldoctor-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cldoctor-core' ),
				'label_off'    => __( 'No', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'        => __( 'Autoplay', 'cldoctor-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cldoctor-core' ),
				'label_off'    => __( 'No', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);

		$this->add_control(
			'slider_autoplay_delay',
			[
				'label'     => __( 'Autoplay Speed', 'cldoctor-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 15000,
				'step'      => 500,
				'default'   => 3000,
				'condition' => [
					'slider_autoplay' => 'yes',
					'layout' => 'slider',
				],
			]
		);

		$this->add_control(
			'centeredSlides',
			[
				'label'        => __( 'Centered Slides', 'cldoctor-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'cldoctor-core' ),
				'label_off'    => __( 'No', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'description'  => __( 'If you use centered slider options then default column will not working.', 'cldoctor-core' ),
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 5000,
				'step'    => 100,
				'default' => 2000,
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->add_control(
			'space',
			[
				'label'   => __( 'Space', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'size_units' => [ 'px'],
				'default' 	 => [
					'size' 	 => 10,
				],
				'condition'  => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->add_control(
			'item',
			[
				'label'   => __( 'Desktop items', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 3,
				],
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->add_control(
			'medium_item',
			[
				'label'   => __( 'Medium Desktop items', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->add_control(
			'item_tablet',
			[
				'label'   => __( 'Tablet items', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->add_control(
			'item_mobile',
			[
				'label'   => __( 'Mobile items', 'cldoctor-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 1,
				],
				'condition'   => array( 'layout' => array( 'slider' ) ),
			]
		);
		$this->end_controls_section();
	}

	protected function __thumbnail_settings(){
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => esc_html__( 'Thumbnail Style', 'cldoctor-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thum_display',
			[
				'label' => esc_html__( 'Thumb', 'cldoctor-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'cldoctor-core' ),
				'label_off' => esc_html__( 'Hide', 'cldoctor-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'thumb_size_width',
			[
				'label'      => __( 'Thumb Size Width', 'cldoctor-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'thumb_size_height',
			[
				'label'      => __( 'Thumb Size Height', 'cldoctor-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-img img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cldoctor-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->end_controls_section();
	}

	protected function __name_settings(){
		$this->start_controls_section(
			'name_settings',
			[
				'label'     => esc_html__( 'Name Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'name_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'cldoctor-core' ),
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .name' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-item .name a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typography', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .testimonial-item .name, {{WRAPPER}} .testimonial-item .name a',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'cldoctor-core' ),                 
				'selectors' => array(
					'{{WRAPPER}} .testimonial-item .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',           
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __designation_settings(){
		$this->start_controls_section(
			'designation_settings',
			[
				'label'     => esc_html__( 'Designation Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'cldoctor-core' ),
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .testimonial-item .designation',
			]
		);
		$this->end_controls_section();
	}

	protected function __content_settings(){
		$this->start_controls_section(
			'content_settings',
			[
				'label'     => esc_html__( 'Content Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'cldoctor-core' ),
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Content', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .testimonial-item .testimonial-text',
			]
		);
		$this->end_controls_section();
	}

	protected function __rating_settings(){
		$this->start_controls_section(
			'rating_settings',
			[
				'label'     => esc_html__( 'Rating Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'rating_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Star Color', 'cldoctor-core' ),
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .rating li i' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'rating_active_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Star Active Color', 'cldoctor-core' ),
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .rating li i.active' => 'color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_section();
	}

	protected function __quote_icon_settings(){
		$this->start_controls_section(
			'quote_icon_settings',
			[
				'label'     => esc_html__( 'Quote Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'quote_sign_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Quote Icon', 'cldoctor-core' ),
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .quote-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-item .quote-icon svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);
		$this->add_responsive_control(
			'quote_sign_size',
			[
				'label' => esc_html__( 'Icon Size', 'cldoctor-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .quote-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-item .quote-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __full_box_settings(){
		$this->start_controls_section(
			'full_box_settings',
			[
				'label'     => esc_html__( 'Full Box Settings', 'cldoctor-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_color',
				'label'    => esc_html__( 'Background', 'cldoctor-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'cldoctor-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .testimonial-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => esc_html__( 'Border', 'cldoctor-core' ),
				'selector' => '{{WRAPPER}} .testimonial-item',
			]
		);
		$this->add_responsive_control(
			'verticle_slider_height',
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
					'{{WRAPPER}} .swiper-vertical' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		if($data['slider_autoplay'] == 'yes'){
			$data['slider_autoplay'] = true;
		}
		else{
			$data['slider_autoplay'] = false;
		}
		$slider_data_thumb = array(
			'slidesPerView' 	  => $data['slider_per_view']['size'],
			'loop'				  => $data['slider_loop'] == 'yes' ? true :false,
			'centeredSlides'	  => $data['centeredSlides'] == 'yes' ? true :false,
			'slideToClickedSlide' => true,
			'spaceBetween'		  => $data['space']['size'],
			'sliderPerView'	  	  => $data['slider_per_view']['size'],
			'slidesPerGroup'	  => $data['slider_per_group']['size'],
			'autoplay'			  => array(
				'delay'  		  => $data['slider_autoplay_delay'],
			),
			'speed'      		  => $data['speed'],
			'auto'			      => $data['slider_autoplay'], 
			'breakpoints' => array(
				'0'    	  => array('slidesPerView' => 1 ),
				'480'     => array('slidesPerView' => $data['item_mobile']['size']),
				'768'     => array('slidesPerView' => $data['item_tablet']['size']),
				'992'     => array('slidesPerView' => $data['medium_item']['size']),			
				'1200'    => array('slidesPerView' => $data['item']['size'])
			),
		);
		$data['slider_data_thumb'] = json_encode( $slider_data_thumb );

		$template = 'view-1';

		if ( 'slider' == $data['layout'] ) {
			$template = 'view-2';
		}

		$this->rt_template( $template, $data );
	}

}