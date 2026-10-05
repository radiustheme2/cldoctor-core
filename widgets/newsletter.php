<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use \WP_Widget;
use \RT_Widget_Fields;

class Newsletter_Widget extends WP_Widget {
	public function __construct() {
		$id = CLDOCTOR_CORE_THEME_PREFIX . '_newsletter';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'A2: Newsletter', 'cldoctor-core' ), // Name
            array( 'description' => esc_html__( 'Cldoctor: Newsletter Widget', 'cldoctor-core' )
        ) );
	}

	public function widget( $args, $instance ){

		echo wp_kses_post( $args['before_widget'] );

		$image = $instance['image'] ? $instance['image'] : '';
		$title = $instance['title'] ? $instance['title'] : '';
		$desc = $instance['desc'] ? $instance['desc'] : '';
		$form = $instance['form'] ? $instance['form'] : '';

		?>
		<div class="newsletter-form">
			<?php if ( !empty($image) ) { ?>
			<div class="image">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			</div>
			<?php } ?>
			<div class="newsletter-content">
				<?php if ( !empty($title) ) { ?>
				<div class="title">
					<h3 class="widget-title"><?php CldoctorCoreHelper::sanitize_content_print( $title ); ?></h3>
				</div>
				<?php } if ( !empty($desc) ) { ?>
				<div class="desc">
					<p><?php CldoctorCoreHelper::sanitize_content_print( $desc ); ?></p>
				</div>
				<?php } if ( !empty($form) ) { ?>
				<div class="form">
					<?php echo do_shortcode( $form ); ?>
				</div>
				<?php } ?>
			</div>
        </div>
        <?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance          = array();

		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? sanitize_text_field( $new_instance['image'] ) : '';
		$instance['title']  = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['desc']  = ( ! empty( $new_instance['desc'] ) ) ? sanitize_text_field( $new_instance['desc'] ) : '';
		$instance['form'] = ( ! empty( $new_instance['form'] ) ) ? wp_kses_post( $new_instance['form'] ) : '';

		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'image'  => '',
			'title' => '',
			'desc'  => '',
			'form'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'image'      => array(
				'label'   => esc_html__( 'Image', 'cldoctor-core' ),
				'type'    => 'image',
			),
			'title'       => array(
				'label'   => esc_html__( 'Title', 'cldoctor-core' ),
				'type'    => 'text',
			),
			'desc'        => array(
				'label'   => esc_html__( 'Description', 'cldoctor-core' ),
				'type'    => 'textarea',
			),
			'form' => array(
				'label'   => esc_html__( 'Form Shortcode', 'cldoctor-core' ),
				'type'    => 'textarea',
			),

		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}