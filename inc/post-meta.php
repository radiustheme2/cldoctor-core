<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

use RadiusTheme\Cldoctor\Helper;
use \RT_Postmeta;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = CLDOCTOR_CORE_THEME_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( [ 'fields' => 'id=>name' ] );
$nav_menus = [ 'default' => esc_html__( 'Default', 'cldoctor-core' ) ] + $nav_menus;

$Postmeta->add_meta_box( "{$prefix}_page_settings", esc_html__( 'Layout Settings', 'cldoctor-core' ), [
	'page',
	'post',
	'rtcl_builder'
], '', '', 'high', [
	'fields' => [
		"{$prefix}_layout_settings" => [
			'label' => esc_html__( 'Layouts', 'cldoctor-core' ),
			'type'  => 'group',
			'value' => [
				'layout'        => [
					'label'   => esc_html__( 'Layout', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default'       => esc_html__( 'Default', 'cldoctor-core' ),
						'full-width'    => esc_html__( 'Full Width', 'cldoctor-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'cldoctor-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'cldoctor-core' ),
					],
					'default' => 'default',
				],				
				'header_style'  => [
					'label'   => esc_html__( 'Header Layout', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cldoctor-core' ),
						'1'       => esc_html__( 'Layout 1', 'cldoctor-core' ),
					],
					'default' => 'default',
				],
				'header_width' => [
					'label'   => esc_html__( 'Header Width', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default'    => esc_html__( 'Default', 'cldoctor-core' ),
						'box-width'  => esc_html__( 'Box width', 'cldoctor-core' ),
						'fullwidth'  => esc_html__( 'Fullwidth', 'cldoctor-core' ),
					],
					'default' => 'default',
				],
				'menu_alignment'       => [
					'label'   => esc_html__( 'Menu Alignment', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cldoctor-core' ),
						'menu-left'   => esc_html__( 'Left Alignment', 'cldoctor-core' ),
						'menu-center' => esc_html__( 'Center Alignment', 'cldoctor-core' ),
						'menu-right'  => esc_html__( 'Right Alignment', 'cldoctor-core' ),
					],
					'default' => 'menu-center',
				],
				'footer_style'  => [
					'label'   => esc_html__( 'Footer Style', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cldoctor-core' ),
						'1'       => esc_html__( 'Layout 1', 'cldoctor-core' ),
						'2'       => esc_html__( 'Layout 2', 'cldoctor-core' ),
						'3'       => esc_html__( 'Layout 3', 'cldoctor-core' ),
						'4'       => esc_html__( 'Layout 4', 'cldoctor-core' ),
					],
					'default' => 'default',
				],
				'banner'        => [
					'label'   => esc_html__( 'Banner', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cldoctor-core' ),
						'on'      => esc_html__( 'Enable', 'cldoctor-core' ),
						'off'     => esc_html__( 'Disable', 'cldoctor-core' ),
					],
					'default' => 'default',
				],
				'breadcrumb'    => [
					'label'   => esc_html__( 'Breadcrumb', 'cldoctor-core' ),
					'type'    => 'select',
					'options' => [
						'default' => esc_html__( 'Default', 'cldoctor-core' ),
						'on'      => esc_html__( 'Enable', 'cldoctor-core' ),
						'off'     => esc_html__( 'Disable', 'cldoctor-core' ),
					],
					'default' => 'default',
				],
				'bgimg'         => [
					'label' => esc_html__( 'Banner Search Background Image', 'cldoctor-core' ),
					'type'  => 'image',
					'desc'  => esc_html__( 'If not selected, default will be used', 'cldoctor-core' ),
				],
			]
		]
	]
] );