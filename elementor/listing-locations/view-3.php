<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/locations/view-2.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Rtcl\Helpers\Link;

extract( $data );

$class = $data['display_count'] ? 'rtin-has-count' : '';

$cols_list = '';
$cols = [
    'xl' => $data['desktop_grid_column'],
    'lg' => $data['medium_desktop_grid_column'],
    'md' => $data['tablet_grid_column'],
    'sm' => $data['mobile_grid_column'],
    'xs' => $data['samll_mobile_grid_column']
];

foreach( $cols as $key => $value ) {
    $cols_list .= 'row-cols-'.$key.'-'.$value.' ';
}

?>

<div class="listing-box-wrap listing-shortcode location-shortcode listing-grid-shortcode">
    <div class="row <?php echo esc_attr( $cols_list ); ?> row-cols-1 gx-<?php echo esc_attr( $data['columns_gap'] ); ?> gy-<?php echo esc_attr( $data['rows_gap'] ); ?> elementor-addon justify-content-center">
        <?php
            foreach ( $data['locations'] as $item ) {
                $term = get_term( $item['location_name'], 'rtcl_location' );
                if ( $term && !is_wp_error( $term ) ) {
                    $item['title']     = $term->name;
                    $item['count']     = $this->rt_term_post_count( $term->term_id );
                    $item['permalink'] = Link::get_location_page_link( $term );
                } else {
                    $item['permalink'] = '';
                    $item['title'] = esc_html__( 'Please Select a Location and Background image', 'cldoctor-core' );
                    $item['count'] = 0;
                    $item['display_count'] = $data['display_count'] = false;
                }
                $count_html = number_format_i18n( $item['count'] );
                ?>
                <div class="col">
                    <div class="location-box-layout-3 common-style">
                        <div class="location-information">
                            <div class="item-img">
                                <?php echo wp_get_attachment_image( $item['location_img']['id'], 'full' ); ?>
                            </div>
                            <div class="location-count">
                                <h3 class="item-title">
                                    <a href="<?php echo esc_url( $item['permalink']); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                                </h3>
                                <?php if ( $data['display_count'] || $data['count_label'] ): ?>
                                    <div class="listing-number">
                                        <?php echo esc_html( $count_html ); ?>
                                        <?php if (!empty($data['count_label'])){ ?>
                                            <span class="count-name"><?php echo esc_html($data['count_label']); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
</div>