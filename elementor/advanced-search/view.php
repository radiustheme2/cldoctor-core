<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/advanced-search/view.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 use RadiusTheme\Cldoctor\Helper;

$template = 'listing-search-banner';
Helper::get_custom_listing_template( $template, true, $data );