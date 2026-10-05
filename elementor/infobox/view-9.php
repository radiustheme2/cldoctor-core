<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/infobox/view-9.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Icons_Manager;

extract( $data );

$attr = $tf = '';
if ( !empty( $url['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( !empty( $url['url'] ) && $data['infobox_btn_visibility'] == 'hidden' ) {
    $heading_tag_html = sprintf( '<%1$s %2$s class="item-title" data-cursor="-opaque"><a '.$attr.' class="item-btn">%3$s</a></%1$s>', $data['heading_tag'], $this->get_render_attribute_string( 'title' ), $data['title'] );
} else {
    $heading_tag_html = sprintf( '<%1$s %2$s class="item-title" data-cursor="-opaque">%3$s</%1$s>', $data['heading_tag'], $this->get_render_attribute_string( 'title' ), $data['title'] );
}

?>

<div class="cldoctor-info-box cldoctor-info-box-9 <?php echo esc_attr( $css_classes.' '.$icon_position); ?> info-box">
    <?php if ($icon_image['url'] || $data['icon']['value']) { ?>
        <div class="item-icon-box">
            <?php 
                if ($icon_image['url']) {
                    echo wp_get_attachment_image( $icon_image['id'], 'full' ); 
                } else {
                    Icons_Manager::render_icon( $data['icon'] ); 
                }
            ?>
        </div>
    <?php } ?>
    <div class="content">
	    <?php echo wp_kses_post( $heading_tag_html ); ?>
        <div class="description-text">
	        <?php echo wp_kses_post( $data['desc'] ); ?>
        </div>
        <?php if ( !empty( $url['url'] ) && $data['infobox_btn_visibility'] == 'visible' ) { ?>
            <div class="btn-wrap">
                <a <?php echo wp_kses_post($attr); ?> class="item-btn">
                    <?php echo esc_html( $data['btntext'] ); ?>
                    <?php Icons_Manager::render_icon( $data['btnicon'] ); ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>