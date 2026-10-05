<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use \WP_Widget;
use \RT_Widget_Fields;

class Contact_Widget extends WP_Widget {
	public function __construct() {
		$id = CLDOCTOR_CORE_THEME_PREFIX . '_contact';
		parent::__construct(
			$id, // Base ID
			esc_html__( 'A6::Contact', 'cldoctor-core' ), // Name
			[
				'description' => esc_html__( 'Cldoctor: Contact Widget', 'cldoctor-core' )
			] );
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		$title = '';

		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		?>
		<div class="widget-contact">
			<?php if ( ! empty( $instance['title'] ) ) { ?>
			<div class="rt-footer-logo">
				<h3 class="widget-title">
					<?php echo wp_kses_post( $title ); ?>
				</h3>
			</div>
			<?php } if ( ! empty( $instance['description'] ) ) { ?>
				<p class="description"><?php echo wp_kses_post( $instance['description'] ); ?></p>
			<?php } if ( ! empty( $instance['address'] || $instance['email'] ) ) { ?>
			<ul class="contact-info-list">
				<?php if ( ! empty( $instance['address'] ) ) { ?>
					<li class="d-flex">
						<i class="icon-location-1"></i>
						<?php echo wp_kses_post( $instance['address'] ); ?>
					</li>
				<?php } if ( ! empty( $instance['phone'] ) ) { ?>
					<li class="d-flex align-items-center">
						<a href="tel:<?php echo esc_attr( $instance['phone'] ); ?>" class="d-flex align-items-center">
							<i class="icon-phone-2"></i>
							<?php echo esc_html( $instance['phone'] ); ?>
						</a>
					</li>
				<?php } ?>
				<?php if ( ! empty( $instance['email'] ) ) { ?>
					<li class="d-flex align-items-center">
						<a href="mailto:<?php echo esc_attr( $instance['email'] ); ?>" class="d-flex align-items-center">
							<i class="icon-email"></i>
							<?php echo esc_html( $instance['email'] ); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
			<?php } ?>
			<?php if ( ! empty( $instance['form_title'] || $instance['form_shortcode'] ) ) { ?>
				<div class="form-wrapper">
					<?php if ( ! empty( $instance['form_title'] ) ) { ?>
						<h5 class="subscribe-heading"><?php echo esc_html( $instance['form_title'] ); ?></h5>
					<?php } if ( ! empty( $instance['form_shortcode'] ) ) { ?>
						<div class="content">
							<?php echo do_shortcode($instance['form_shortcode']); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?php 
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 	= [];
		$instance['title']        	= ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['description']    = ( ! empty( $new_instance['description'] ) ) ? sanitize_text_field( $new_instance['description'] ) : '';
		$instance['address']      	= ( ! empty( $new_instance['address'] ) ) ? sanitize_text_field( $new_instance['address'] ) : '';
		$instance['phone']      	= ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';
		$instance['email']  		= ( ! empty( $new_instance['email'] ) ) ? wp_kses_post( $new_instance['email'] ) : '';
		$instance['form_title']  	= ( ! empty( $new_instance['form_title'] ) ) ? wp_kses_post( $new_instance['form_title'] ) : '';
		$instance['form_shortcode'] = ( ! empty( $new_instance['form_shortcode'] ) ) ? wp_kses_post( $new_instance['form_shortcode'] ) : '';
		
		return $instance;
	}

	public function form( $instance ) {
		$defaults = [
			'title'        	 => '',
			'description'    => '',
			'address'        => '',
			'phone'  		 => '',
			'email'  		 => '',
			'form_title'  	 => '',
			'form_shortcode' => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'        => [
				'label'    => esc_html__( 'Title', 'cldoctor-core' ),
				'type'     => 'text',
			],
			'description'         => [
				'label'    => esc_html__( 'Description', 'cldoctor-core' ),
				'type'     => 'textarea',
			],
			'address'         => [
				'label'    => esc_html__( 'Address', 'cldoctor-core' ),
				'type'     => 'textarea',
			],
			'phone'  => [
				'label'    => esc_html__( 'Phone', 'cldoctor-core' ),
				'type'     => 'text',
			],
			'email'  => [
				'label'    => esc_html__( 'Email', 'cldoctor-core' ),
				'type'     => 'text',
			],
			'form_title'  => [
				'label'    => esc_html__( 'Form Title', 'cldoctor-core' ),
				'type'     => 'text',
			],
			'form_shortcode' => [
				'label'    => esc_html__( 'Form Shortcode', 'cldoctor-core' ),
				'type'     => 'textarea',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}