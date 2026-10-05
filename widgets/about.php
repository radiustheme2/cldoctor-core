<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use \WP_Widget;
use \RT_Widget_Fields;

class About_Widget extends WP_Widget {
	public function __construct() {
		$id = CLDOCTOR_CORE_THEME_PREFIX . '_about';
		parent::__construct(
			$id, // Base ID
			esc_html__( 'A1::About', 'cldoctor-core' ), // Name
			[
				'description' => esc_html__( 'Cldoctor: About widget', 'cldoctor-core' )
			] );
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		$title = '';

		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		if (!empty($instance['title'] || $instance['logo'])) {
			$title_logo = '';
		} else {
			$title_logo = 'title-logo-none';
		}
		?>
		<div class="widget-about <?php echo esc_attr( $title_logo ); ?>">
			<div class="rt-footer-logo">
				<?php if ( ! empty( $instance['logo'] ) ) { ?>
					<div class="widget-title">
					<a href="<?php echo esc_url( home_url('/') ); ?>">
						<?php echo wp_get_attachment_image( $instance['logo'], 'full' ); ?>
					</a>
					</div>
				<?php } else { ?>
					<h3 class="widget-title">
						<?php echo wp_kses_post( $title ); ?>
					</h3>
				<?php } ?>
			</div>
			<?php if ( ! empty( $instance['description'] ) ) { ?>
				<p class="rtin-des">
					<?php echo wp_kses_post( $instance['description'] ); ?>
				</p>
			<?php } ?>
			<?php if ( ! empty( $instance['phone_label'] || $instance['phone_number'] ) ) { ?>
				<div class="call-now-item d-inline-flex align-items-center">
					<div class="icon">
						<i class="icon-phone-2"></i>
					</div>
					<div class="content">
						<p><?php echo esc_attr($instance['phone_label']); ?></p>
						<a href="tel:<?php echo esc_attr($instance['phone_number']); ?>" class="call-number">
							<?php echo esc_html($instance['phone_number']); ?>
						</a>
					</div>
				</div>
			<?php } ?>
			<?php if ( ! empty( $instance['app_logo'] || $instance['app_link'] || $instance['play_logo'] || $instance['play_link'] ) ) { ?>
				<div class="app-download-area d-flex gap-1">
					<?php if ( ! empty( $instance['app_link'] ) ) { ?>
						<a href="<?php echo esc_url($instance['app_link']); ?>">
							<?php 
								if ( ! empty( $instance['app_logo'] ) ) {
									echo wp_get_attachment_image( $instance['app_logo'], 'full' );
								}
							?>
						</a>
					<?php } if ( ! empty( $instance['play_link'] ) ) { ?>
						<a href="<?php echo esc_url($instance['play_link']); ?>">
							<?php 
								if ( ! empty( $instance['play_logo'] ) ) {
									echo wp_get_attachment_image( $instance['play_logo'], 'full' );
								}
							?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?php 
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = [];
		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['logo']         = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
		$instance['description']  = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['phone_label']  = ( ! empty( $new_instance['phone_label'] ) ) ? sanitize_text_field( $new_instance['phone_label'] ) : '';
		$instance['phone_number'] = ( ! empty( $new_instance['phone_number'] ) ) ? sanitize_text_field( $new_instance['phone_number'] ) : '';
		// Style 2
		$instance['app_logo']    = ( ! empty( $new_instance['app_logo'] ) ) ? sanitize_text_field( $new_instance['app_logo'] ) : '';
		$instance['app_link']    = ( ! empty( $new_instance['app_link'] ) ) ? sanitize_text_field( $new_instance['app_link'] ) : '';
		$instance['play_logo']   = ( ! empty( $new_instance['play_logo'] ) ) ? sanitize_text_field( $new_instance['play_logo'] ) : '';
		$instance['play_link']   = ( ! empty( $new_instance['play_link'] ) ) ? sanitize_text_field( $new_instance['play_link'] ) : '';
		
		return $instance;
	}

	public function form( $instance ) {
		$defaults = [
			'title'        => '',
			'logo'         => '',
			'description'  => '',
			'phone_label'  => '',
			'phone_number' => '',
			// Style 2
			'app_logo'    => '',
			'app_link'    => '',
			'play_logo'   => '',
			'play_link'   => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'        => [
				'label'    => esc_html__( 'Title', 'cldoctor-core' ),
				'type'     => 'text',
			],
			'logo'         => [
				'label'    => esc_html__( 'Logo', 'cldoctor-core' ),
				'type'     => 'image',
			],
			'description'  => [
				'label'    => esc_html__( 'Description', 'cldoctor-core' ),
				'type'     => 'textarea',
			],
			'phone_label'  => [
				'label'    => esc_html__( 'Phone Label', 'cldoctor-core' ),
				'type'     => 'text',
			],
			'phone_number' => [
				'label'    => esc_html__( 'Phone Number', 'cldoctor-core' ),
				'type'     => 'text',
			],
			// Style 2
			'app_logo'        => [
				'label' => esc_html__( 'App Store Image', 'cldoctor-core' ),
				'type'  => 'image',
			],
			'app_link'     => [
				'label' => esc_html__( 'App Store URL', 'cldoctor-core' ),
				'type'  => 'url',
			],
			'play_logo'    => [
				'label' => esc_html__( 'Play Store Image', 'cldoctor-core' ),
				'type'  => 'image',
			],
			'play_link'   => [
				'label' => esc_html__( 'Play Store URL', 'cldoctor-core' ),
				'type'  => 'url',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}