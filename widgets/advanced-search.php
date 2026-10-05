<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use \WP_Widget;
use \RT_Widget_Fields;
use Rtcl\Helpers\Functions;
use RadiusTheme\Cldoctor\Helper;
use RadiusTheme\Cldoctor\Listing_Functions;

class Rt_Advanced_Search_Widget extends WP_Widget {

	public function __construct() {
		$id = CLDOCTOR_CORE_THEME_PREFIX . '_advanced_search';
		parent::__construct(
			$id, // Base ID
			esc_html__( 'A3: Advanced Search', 'cldoctor-core' ), // Name
			[
				'description' => esc_html__( 'Add advanced search field', 'cldoctor-core' ),
			] );
	}

	public function widget( $args, $instance ) {
		$data = [
			'orientation'                   => ! empty( $instance['orientation'] ) ? $instance['orientation'] : 'inline',
			'style'                   		=> ! empty( $instance['style'] ) ? $instance['style'] : 'standard',
			'icon'                          => ! empty( $instance['icon'] ) ? $instance['icon'] : 'icon',
			'can_search_by_keyword'         => ! empty( $instance['search_by_keyword'] ) ? 1 : 0,
			'can_search_by_type'   			=> ! empty( $instance['search_by_listing_type'] ) ? 1 : 0,
			'can_search_by_category'        => ! empty( $instance['search_by_category'] ) ? 1 : 0,
			'can_search_by_location'        => ! empty( $instance['search_by_location'] ) ? 1 : 0,
			'can_search_by_radius_search'   => ! empty( $instance['search_by_radius_search'] ) ? 1 : 0,
			'can_search_by_radius_distance' => ! empty( $instance['search_by_radius_distance'] ) ? 1 : 0,
			'can_search_by_price'           => ! empty( $instance['search_by_price'] ) ? 1 : 0,
			'can_search_by_custom_field'    => ! empty( $instance['search_by_custom_field'] ) ? 1 : 0,
			'min_price'                     => ! empty( $instance['min_price'] ) ? $instance['min_price'] : 0,
			'max_price'                     => ! empty( $instance['max_price'] ) ? $instance['max_price'] : 5000,
			'btn_text'                     	=> ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : 'Search',
			'classes'                     	=> ! empty( $instance['classes'] ) ? $instance['classes'] : '',
			'instance'                      => $instance,
		];

		$data['args'] = $args;
		$data['data'] = $data;

		$widget_class = '';

		echo wp_kses_post( $args['before_widget'] );
		echo "<div class='" . esc_attr( 'orientation-' . $data['orientation'] . ' ' . $widget_class ) . "'>";

		global $wp;
    	$current_url = home_url( add_query_arg( array(), $wp->request ) );
		?>
		<div class="title-btn">
			<?php
                $title = $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
                $sanitized_title = filter_var($title, FILTER_SANITIZE_STRING);
			    echo wp_kses_post( $sanitized_title );

			?>
			<?php if ($data['orientation'] !== 'inline') { ?>
			<div class="reset-btn">
		        <a href="<?php echo esc_url( $current_url ); ?>">
		            <?php echo esc_html__( 'Clear', 'cldoctor-core' ); ?>
		        </a>
		    </div>
			<?php } ?>
		</div>
		
	    <?php
		$template = 'listing-search-widget';
		Helper::get_custom_listing_template( $template, true, $data );
		echo "</div>";
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']                     = ! empty( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['orientation']               = ! empty( $new_instance['orientation'] ) ? wp_strip_all_tags( $new_instance['orientation'] ) : '';
		$instance['style']                     = ! empty( $new_instance['style'] ) ? wp_strip_all_tags( $new_instance['style'] ) : '';
		$instance['search_by_category']        = ! empty( $new_instance['search_by_category'] ) ? 1 : 0;
		$instance['search_by_location']        = ! empty( $new_instance['search_by_location'] ) ? 1 : 0;
		$instance['search_by_listing_type']    = ! empty( $new_instance['search_by_listing_type'] ) ? 1 : 0;
		$instance['search_by_price']           = ! empty( $new_instance['search_by_price'] ) ? 1 : 0;
		$instance['search_by_keyword']         = ! empty( $new_instance['search_by_keyword'] ) ? 1 : 0;
		$instance['search_by_custom_field']    = ! empty( $new_instance['search_by_custom_field'] ) ? 1 : 0;
		$instance['search_by_radius_search']   = ! empty( $new_instance['search_by_radius_search'] ) ? 1 : 0;
		$instance['search_by_radius_distance'] = ! empty( $new_instance['search_by_radius_distance'] ) ? 1 : 0;
		$instance['min_price']                 = ! empty( $new_instance['min_price'] ) ? absint( $new_instance['min_price'] ) : 0;
		$instance['max_price']                 = ! empty( $new_instance['max_price'] ) ? absint( $new_instance['max_price'] ) : 5000;
		$instance['btn_text']                  = ! empty( $new_instance['btn_text'] ) ? wp_strip_all_tags( $new_instance['btn_text'] ) : '';
		$instance['classes']                   = ! empty( $new_instance['classes'] ) ? wp_strip_all_tags( $new_instance['classes'] ) : '';

		return $instance;
	}

	public function form( $instance ) {
		$listing_price_range = Listing_Functions::listing_price_range();
		// Define the array of defaults
		$defaults = [
			'title'                     => 'Advanced Search',
			'orientation'        	    => 'block',
			'style'        				=> 'standard',
			'search_by_keyword'         => 1, 
			'search_by_listing_type'   	=> 1, 
			'search_by_category'        => 1,
			'search_by_location'        => 1,
			'search_by_radius_search'   => '',
			'search_by_radius_distance' => '',
			'search_by_custom_field'    => '',
			'search_by_price'           => 1,
			'min_price'                 => $listing_price_range['min_price'],
			'max_price'                 => $listing_price_range['max_price'],
			'btn_text'                  => 'Search',
			'classes'           		=> '',
		];

		if ( 'local' !== Functions::location_type() ) {
			$defaults['search_by_location'] = 0;
		}

		// Parse incoming $instance into an array and merge it with $defaults
		$instance = wp_parse_args(
			(array) $instance,
			$defaults
		);

		$fields = [
			'title'                     => [
				'label' => esc_html__( 'Title', 'cldoctor-core' ),
				'type'  => 'text',
			],
			'orientation' => [
				'label'   => esc_html__( 'Orientation', 'cldoctor-core' ),
				'type'    => 'select',
				'options' => [
					'inline'   => esc_html__( 'Inline', 'cldoctor-core' ),
					'block' => esc_html__( 'Block', 'cldoctor-core' ),
				],
			],
			'style'      => array(
				'label'   => esc_html__( 'Search Style', 'cldoctor-core' ),
				'type'    => 'select',
				'options' => array(
					'popup'      => esc_html__('Popup', 'cldoctor-core'),
					'suggestion' => esc_html__('Auto Suggestion', 'cldoctor-core'),
					'dependency' => esc_html__('Dependency Selection', 'cldoctor-core'),
					'standard'   => esc_html__('Standard', 'cldoctor-core'),
				),
			),
			'search_by_listing_type'   => [
				'label' => esc_html__( 'Search by Listing Types', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_keyword'         => [
				'label' => esc_html__( 'Search by Keyword', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_location'        => [
				'label' => esc_html__( 'Search by Local Location', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_radius_search'   => [
				'label' => esc_html__( 'Search by Google Location', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_radius_distance' => [
				'label' => esc_html__( 'Search by Radius Distance', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_category'        => [
				'label' => esc_html__( 'Search by Category', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_custom_field'    => [
				'label' => esc_html__( 'Search by Custom Fields', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'search_by_price'           => [
				'label' => esc_html__( 'Search by Price', 'cldoctor-core' ),
				'type'  => 'checkbox',
			],
			'min_price'                 => [
				'label' => esc_html__( 'Minimum Price', 'cldoctor-core' ),
				'type'  => 'number',
			],
			'max_price'                 => [
				'label' => esc_html__( 'Maximum Price', 'cldoctor-core' ),
				'type'  => 'number',
			],
			'btn_text' => [
				'label' => esc_html__( 'Button Text', 'cldoctor-core' ),
				'type'  => 'text',
			],
			'classes'                     => [
				'label' => esc_html__( 'Style Class', 'cldoctor-core' ),
				'type'  => 'text',
			],
		];

		if ( 'local' !== Functions::location_type() ) {
			unset( $fields['search_by_location'] );
		}

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}