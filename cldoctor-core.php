<?php
/*
Plugin Name: Cldoctor Core
Plugin URI: https://www.radiustheme.com
Description: This plugin is developed for CLDoctor Theme.
Version: 2.2.3
Author: RadiusTheme
Author URI: https://www.radiustheme.com
Text Domain: cldoctor-core
Domain Path: /languages
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use RadiusTheme\Cldoctor\Options;

if ( ! defined( 'CLDOCTOR_CORE' ) ) {
	define( 'CLDOCTOR_CORE', '2.2.3' );
	define( 'CLDOCTOR_CORE_THEME_PREFIX', 'cldoctor' );
	define( 'CLDOCTOR_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'CLDOCTOR_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
	define( 'CLDOCTOR_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . 'demo-content/' );
	define( 'CLDOCTOR_CORE_DEMO_IMPORTER', plugin_dir_path( __FILE__ ) . 'demo-importer/' );
}

class Cldoctor_Core {

	public $plugin = 'cldoctor-core';
	public $action = 'cldoctor_theme_init';
	protected static $instance;

	public function __construct() {
		add_filter( 'body_class', [ $this, 'cldoctor_core_body_classes' ] );
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );
		add_action( 'after_setup_theme', [ $this, 'after_theme_loaded' ] );
		add_action( 'admin_enqueue_scripts', array( $this, 'cldoctor_core_admin_enqueue_scripts' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'cldoctor_core_enqueue_scripts' ), 40 );
		add_filter( 'upload_mimes',	array( $this, 'cldoctor_mime_types' ));

		// Restrict Admin Area
		add_action( 'after_setup_theme', [ $this, 'remove_admin_bar' ], 999 );

		// Ensure listing authors always get the radius_booking_employee WP role
		// after the radius-booking sync runs (priority 20), even when a profile
		// already existed and add_role() was skipped by the plugin.
		add_action( 'save_post_rtcl_listing', [ $this, 'ensure_listing_author_booking_role' ], 30, 2 );
		add_action( 'rtcl_listing_form_after_save_or_update', [ $this, 'ensure_listing_author_booking_role_frontend' ], 30, 2 );

		if ( isset( $_GET['export_user'] ) && $_GET['export_user'] == 1 ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			Cldoctor_Core_Demo_User_Import::export_users();
		}
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function cldoctor_core_admin_enqueue_scripts() {
		//CSS
		wp_enqueue_style( 'cldoctor-admin', CLDOCTOR_CORE_BASE_URL . 'assets/css/admin.css' );
		if ( is_rtl() ) {
			wp_enqueue_style( 'cldoctor-elementor', CLDOCTOR_CORE_BASE_URL . 'assets/css/rtl-cldoctor-elementor.css' );
			wp_enqueue_style( 'cldoctor-core', CLDOCTOR_CORE_BASE_URL . 'assets/css/rtl-cldoctor-core.css' );
		} else {
			wp_enqueue_style( 'cldoctor-elementor', CLDOCTOR_CORE_BASE_URL . 'assets/css/cldoctor-elementor.css' );
			wp_enqueue_style( 'cldoctor-core', CLDOCTOR_CORE_BASE_URL . 'assets/css/cldoctor-core.css' );
		}
		//JS
		wp_enqueue_script( 'cldoctor-admin', CLDOCTOR_CORE_BASE_URL . 'assets/js/admin.js', array( 'jquery' ), CLDOCTOR_CORE, true );
		wp_enqueue_script( 'headroom', CLDOCTOR_CORE_BASE_URL . 'assets/js/headroom.js', array( 'jquery' ), CLDOCTOR_CORE, true );
	}

	public function cldoctor_core_enqueue_scripts(){
		/* Deregister */
		wp_deregister_style( 'swiper' );
		wp_deregister_script( 'swiper' );

		// CSS
		wp_enqueue_style( 'swiper', CLDOCTOR_CORE_BASE_URL . 'assets/css/swiper.min.css' );
		if ( is_rtl() ) {
			wp_enqueue_style( 'cldoctor-listing-elementor', CLDOCTOR_CORE_BASE_URL . 'assets/css/rtl-cldoctor-listing-elementor.css' );
			wp_enqueue_style( 'cldoctor-elementor', CLDOCTOR_CORE_BASE_URL . 'assets/css/rtl-cldoctor-elementor.css' );
			wp_enqueue_style( 'cldoctor-core', CLDOCTOR_CORE_BASE_URL . 'assets/css/rtl-cldoctor-core.css' );
		} else {
			wp_enqueue_style( 'magnific-popup', CLDOCTOR_CORE_BASE_URL . 'assets/css/magnific-popup.css' );
			wp_enqueue_style( 'cldoctor-listing-elementor', CLDOCTOR_CORE_BASE_URL . 'assets/css/cldoctor-listing-elementor.css' );
			wp_enqueue_style( 'cldoctor-elementor', CLDOCTOR_CORE_BASE_URL . 'assets/css/cldoctor-elementor.css' );
			wp_enqueue_style( 'cldoctor-core', CLDOCTOR_CORE_BASE_URL . 'assets/css/cldoctor-core.css' );
		}

		// JS
		wp_enqueue_script( 'headroom', CLDOCTOR_CORE_BASE_URL . 'assets/js/headroom.js', array( 'jquery' ), CLDOCTOR_CORE, true );
		wp_enqueue_script( 'isotope', CLDOCTOR_CORE_BASE_URL . 'assets/js/isotope.pkgd.min.js', array( 'jquery' ), CLDOCTOR_CORE, true );
		wp_enqueue_script( 'parallax', CLDOCTOR_CORE_BASE_URL . 'assets/js/parallax.min.js', array( 'jquery' ), CLDOCTOR_CORE, true );
		wp_enqueue_script( 'swiper', CLDOCTOR_CORE_BASE_URL . 'assets/js/swiper.min.js', array( 'jquery' ), CLDOCTOR_CORE, true );
		wp_enqueue_script( 'magnific-popup', CLDOCTOR_CORE_BASE_URL . 'assets/js/magnific-popup.js', array( 'jquery' ), CLDOCTOR_CORE, true );
		wp_enqueue_script( 'cldoctor-core', CLDOCTOR_CORE_BASE_URL . 'assets/js/cldoctor-core.js', array( 'jquery' ), CLDOCTOR_CORE, true );
	}

	public function cldoctor_core_body_classes( $classes ) {
		$theme = wp_get_theme();
		if ( 'CLDoctor' == $theme->name || 'CLDoctor' == $theme->parent_theme ) {
			$classes[] = Options::$options['sticky_header'] ? 'sticky-header-enable' : '';
		}
		return $classes;
	}

	public function remove_admin_bar(){
		$theme = wp_get_theme();
		if ( 'CLDoctor' == $theme->name || 'CLDoctor' == $theme->parent_theme ) {
			$remove_admin_bar = get_theme_mod( 'remove_admin_bar' );
			if ( $remove_admin_bar && ! current_user_can( 'administrator' ) && ! is_admin() ) {
				show_admin_bar( false );
			}
		}
	}

	/**
	 * After radius-booking syncs the employee (priority 20), ensure the listing
	 * author has the radius_booking_employee WordPress role. The plugin only
	 * calls add_role() when creating a brand-new profile; if a profile already
	 * existed (e.g. from demo import) the role is silently skipped.
	 */
	public function ensure_listing_author_booking_role( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}
		if ( ! class_exists( '\RadiusTheme\RadiusBooking\Repositories\UserProfileRepository' ) ) {
			return;
		}

		$wp_user = get_userdata( (int) $post->post_author );
		if ( ! $wp_user ) {
			return;
		}
		if ( in_array( 'radius_booking_employee', (array) $wp_user->roles, true ) ) {
			return;
		}

		$profile = ( new \RadiusTheme\RadiusBooking\Repositories\UserProfileRepository() )
			->findProfileByWPId( $wp_user->ID );

		if ( $profile ) {
			$wp_user->add_role( 'radius_booking_employee' );
		}
	}

	/**
	 * Same role-assignment check for the frontend listing form flow.
	 */
	public function ensure_listing_author_booking_role_frontend( $listing, $posting_type ) {
		if ( ! $listing ) {
			return;
		}
		$post = get_post( $listing->get_id() );
		if ( $post ) {
			$this->ensure_listing_author_booking_role( $post->ID, $post );
		}
	}

	public function after_theme_loaded(){
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once CLDOCTOR_CORE_BASE_DIR . 'inc/helper.php'; // Widgets
			require_once CLDOCTOR_CORE_BASE_DIR . 'inc/category.php'; // Categories
			require_once CLDOCTOR_CORE_BASE_DIR . 'inc/post-meta.php'; // Post Meta
			require_once CLDOCTOR_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		}

		if ( did_action( 'elementor/loaded' ) ){
			require_once CLDOCTOR_CORE_BASE_DIR . 'elementor/hooks.php'; // Hooks
			require_once CLDOCTOR_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
		}
	}

	public function demo_importer(){
		require_once CLDOCTOR_CORE_BASE_DIR . 'demo-importer/init.php';
	}

	public static function social_share( $sharer = [] ){
		include CLDOCTOR_CORE_BASE_DIR . 'inc/social-share.php';
	}

	public function cldoctor_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}

Cldoctor_Core::instance();