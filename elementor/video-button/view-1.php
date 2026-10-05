<?php
/**
 *
 * This file can be overridden by copying it to yourtheme/elementor-custom/button/view-1.php
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

if ( ! empty( $data['btnlink']['url'] ) ) {
    $this->add_link_attributes( 'btnlink', $data['btnlink'] );
}
?>

<div class="video-button">
    <a <?php $this->print_render_attribute_string( 'btnlink' ); ?> class="button-style-<?php echo esc_attr($style); ?> popup-youtube">
        <?php Icons_Manager::render_icon( $data['icon'], [ 'aria-hidden' => 'true' ] ); ?>
    </a>
    <svg viewBox="0 0 100 100" width="150" height="150" class="round-text rotating">
        <defs>
            <path id="circle" d="
                M 50, 50
                m -37, 0
                a 37,37 0 1,1 74,0
                a 37,37 0 1,1 -74,0"/>
        </defs>
        <text>
            <textPath xlink:href="#circle">
                <?php echo esc_html( $btntext ); ?>
            </textPath>
        </text>
    </svg>
</div>