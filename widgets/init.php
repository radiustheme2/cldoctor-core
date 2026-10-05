<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use RadiusTheme\Cldoctor\Options;

class Custom_Widgets_Init {

	public $widgets;
	protected static $instance = null;

	public function __construct() {
		$widgets1 =  array(
			'about'   	 => 'About_Widget',
			'newsletter' => 'Newsletter_Widget',
			'post' 		 => 'Post_Widget',
			'contact'    => 'Contact_Widget',
		);

		$widgets2 = array(
			'advanced-search' => 'Rt_Advanced_Search_Widget',
		);
		if ( class_exists('Rtcl') && class_exists( 'RtclPro' ) ) {
			$widgets = array_merge($widgets1, $widgets2);
		} else {
			$widgets = $widgets1;
		}
		$this->widgets = $widgets;
		if (class_exists('Cldoctor_Main')) {
			add_action( 'widgets_init', array( $this, 'register_extra_sidebars' ), 100 );
			add_action( 'widgets_init', array( $this, 'custom_widgets' ) );
		}

		//Custom class hook
		add_filter( 'widget_form_callback', array( $this, 'rt_widget_form_extend' ), 10, 2);
		add_filter( 'widget_update_callback', array( $this, 'rt_widget_update' ), 10, 2 );
		add_filter( 'dynamic_sidebar_params', array( $this, 'rt_dynamic_sidebar_params' ), 0 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function register_extra_sidebars() {
		//Footer 2
		$footer_widget_titles2 = array(
			'1' => esc_html__( 'Footer (Style 2) 1', 'cldoctor-core' ),
			'2' => esc_html__( 'Footer (Style 2) 2', 'cldoctor-core' ),
			'3' => esc_html__( 'Footer (Style 2) 3', 'cldoctor-core' ),
			'4' => esc_html__( 'Footer (Style 2) 4', 'cldoctor-core' ),
			'5' => esc_html__( 'Footer (Style 2) 5', 'cldoctor-core' ),
			'6' => esc_html__( 'Footer (Style 2) 6', 'cldoctor-core' ),
		);
		$f2_widgets_area = Options::$options['f2_widgets_area'];
		for ( $i = 1; $i <= $f2_widgets_area; $i++ ) {
			register_sidebar( array(
				'name'          => $footer_widget_titles2[$i],
				'id'            => 'footer-widget-2-'.$i,
				'before_widget' => '<div id="%1$s" class="widget footer-'.$i.'-widgets %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		//Footer 3
		$footer_widget_titles3 = array(
			'1' => esc_html__( 'Footer (Style 3) 1', 'cldoctor-core' ),
			'2' => esc_html__( 'Footer (Style 3) 2', 'cldoctor-core' ),
			'3' => esc_html__( 'Footer (Style 3) 3', 'cldoctor-core' ),
			'4' => esc_html__( 'Footer (Style 3) 4', 'cldoctor-core' ),
			'5' => esc_html__( 'Footer (Style 3) 5', 'cldoctor-core' ),
			'6' => esc_html__( 'Footer (Style 3) 6', 'cldoctor-core' ),
		);
		$f3_widgets_area = Options::$options['f3_widgets_area'];
		for ( $i = 1; $i <= $f3_widgets_area; $i++ ) {
			register_sidebar( array(
				'name'          => $footer_widget_titles3[$i],
				'id'            => 'footer-widget-3-'.$i,
				'before_widget' => '<div id="%1$s" class="widget footer-'.$i.'-widgets %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		//Footer 4
		$footer_widget_titles4 = array(
			'1' => esc_html__( 'Footer (Style 4) 1', 'cldoctor-core' ),
			'2' => esc_html__( 'Footer (Style 4) 2', 'cldoctor-core' ),
			'3' => esc_html__( 'Footer (Style 4) 3', 'cldoctor-core' ),
			'4' => esc_html__( 'Footer (Style 4) 4', 'cldoctor-core' ),
			'5' => esc_html__( 'Footer (Style 4) 5', 'cldoctor-core' ),
			'6' => esc_html__( 'Footer (Style 4) 6', 'cldoctor-core' ),
		);
		$f4_widgets_area = Options::$options['f4_widgets_area'];
		for ( $i = 1; $i <= $f4_widgets_area; $i++ ) {
			register_sidebar( array(
				'name'          => $footer_widget_titles4[$i],
				'id'            => 'footer-widget-4-'.$i,
				'before_widget' => '<div id="%1$s" class="widget footer-'.$i.'-widgets %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
	}

	public function custom_widgets() {
		if ( !class_exists( 'RT_Widget_Fields' ) ) return;

		foreach ( $this->widgets as $filename => $classname ) {

			$template_name = '/widgets/' . $filename . '.php';

			if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
				$file = get_stylesheet_directory() . $template_name;
			}
			elseif ( file_exists( get_stylesheet_directory() . $template_name ) ) {
				$file = get_stylesheet_directory() . $template_name;
			}
			else {
				$file  = dirname( __FILE__ ) . '/' . $filename . '.php';
			}

			require_once $file;

			$class = __NAMESPACE__ . '\\' . $classname;
			register_widget( $class );
		}
	}

	/*====================================================================*/ 
	/* - Add a custom class in every widget
	/*====================================================================*/ 
	public function rt_widget_form_extend( $instance, $widget ) {
		$row = '';
		if ( !isset($instance['classes']) )
		$instance['classes'] = null;   
		$row .= "<p><label>Custom Class:</label>\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
		$row .= "</p>\n";
		echo $row;
		return $instance;
	}

	public function rt_widget_update( $instance, $new_instance ) {
		$instance['classes'] = $new_instance['classes'];
		return $instance;
	}

	// Value add in widget
	public function rt_dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;
		$widget_id    = $params[0]['widget_id'];
		$widget_obj   = $wp_registered_widgets[$widget_id];
		$widget_opt   = get_option($widget_obj['callback'][0]->option_name);
		$widget_num   = $widget_obj['params'][0]['number'];    
		if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
			$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
		return $params;
	}
}

Custom_Widgets_Init::instance();