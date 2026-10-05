<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\Cldoctor_Core;

class CldoctorCoreHelper {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function __construct() {
		//Add user contact info
	}

	/**
	 * @param $title
	 *
	 * @return void
	 */
	public static function rt_page_title( $title, $post_type = 'page' ) {
		$page = get_posts( array(
			'post_type'   => $post_type,
			'name'        => sanitize_title( $title ),
			'post_status' => 'publish',
			'numberposts' => 1
		) );

		if ( $page ) {
			$page = $page[0];
			return $page->ID;
		} else {
			return null;
		}
	}

	/**
	 * Get the allowed HTML tags for sanitization.
	 *
	 * @return array Allowed HTML tags and their attributes.
	 */
	public static function get_allowed_tags() {
		return [
			'a' => [
				'href' => true,
				'title' => true,
				'target' => true,
				'rel' => true,
			],
			'abbr' => [
				'title' => true,
			],
			'b' => [],
			'blockquote' => [
				'cite' => true,
			],
			'cite' => [],
			'code' => [],
			'del' => [
				'datetime' => true,
			],
			'dd' => [],
			'div' => [
				'class' => true,
				'id' => true,
				'style' => true,
			],
			'dl' => [],
			'dt' => [],
			'em' => [],
			'h1' => [
				'class' => true,
				'id' => true,
			],
			'h2' => [
				'class' => true,
				'id' => true,
			],
			'h3' => [
				'class' => true,
				'id' => true,
			],
			'h4' => [
				'class' => true,
				'id' => true,
			],
			'h5' => [
				'class' => true,
				'id' => true,
			],
			'h6' => [
				'class' => true,
				'id' => true,
			],
			'i' => [],
			'img' => [
				'src' => true,
				'alt' => true,
				'title' => true,
				'width' => true,
				'height' => true,
			],
			'li' => [
				'class' => true,
			],
			'ol' => [
				'class' => true,
			],
			'p' => [
				'class' => true,
				'style' => true,
			],
			'q' => [
				'cite' => true,
			],
			'span' => [
				'class' => true,
				'id' => true,
				'style' => true,
			],
			'strike' => [],
			'strong' => [],
			'sub' => [],
			'sup' => [],
			'table' => [
				'class' => true,
				'style' => true,
			],
			'tbody' => [],
			'td' => [
				'class' => true,
				'style' => true,
				'colspan' => true,
				'rowspan' => true,
			],
			'tfoot' => [],
			'th' => [
				'class' => true,
				'style' => true,
				'colspan' => true,
				'rowspan' => true,
			],
			'thead' => [],
			'tr' => [
				'class' => true,
				'style' => true,
			],
			'u' => [],
			'ul' => [
				'class' => true,
			],
			'select' => [
				'name' => true,
				'id' => true,
				'class' => true,
				'multiple' => true,
			],
			'option' => [
				'value' => true,
				'selected' => true,
			],
			'textarea' => [
				'name' => true,
				'id' => true,
				'class' => true,
				'rows' => true,
				'cols' => true,
			],
			'input' => [
				'type' => true,
				'name' => true,
				'value' => true,
				'placeholder' => true,
				'class' => true,
				'id' => true,
				'checked' => true,
				'disabled' => true,
				'readonly' => true,
			],
			'button' => [
				'type' => true,
				'name' => true,
				'value' => true,
				'class' => true,
				'id' => true,
			],
			'form' => [
				'action' => true,
				'method' => true,
				'enctype' => true,
				'class' => true,
				'id' => true,
			],
			'label' => [
				'for' => true,
				'class' => true,
			],
		];
	}

	/**
	 * Sanitize content using the allowed tags.
	 *
	 * @param string $content The content to sanitize.
	 * @return string Sanitized content.
	 */
	public static function sanitize_content_print( $content ) {
		echo wp_kses( $content, self::get_allowed_tags() );
	}

}

CldoctorCoreHelper::instance();
