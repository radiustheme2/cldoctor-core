<?php
/**
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $data );
$align = $data['align'];
$heading_tag_html = sprintf( '<%1$s %2$s class="heading-title">%3$s</%1$s>', $data['heading_tag'], $this->get_render_attribute_string( 'title' ), $data['title'] );

$allowed_tags = array(
	$data['heading_tag'] => array(
		'class' => array(),
		'id' => array(),
		'style' => array()
	)
);

$tf = '';
if ( ! empty( $data['url']['url'] ) ) {
	$this->add_link_attributes( 'url', $data['url'] );
}

if (!empty($data['title_line_switcher'])) {
    $tf = 'tf';
}

?>

<div class="section-heading <?php echo esc_attr( $tf ); ?>">
	<?php if ( !empty( $data['subtitle'] ) ){ ?>
        <span class="heading-subtitle"><?php echo esc_html( $data['subtitle'] ); ?></span>
    <?php } 
        if ( !empty( $data['title'] ) ){
	        echo wp_kses( $heading_tag_html, $allowed_tags );
        }
    ?>
    <?php echo wp_kses_post( $data['desc'] ); ?>
    <?php if ( !empty( $url['url'] ) ) { ?>
        <div class="btn-wrap btn-v2">
            <a <?php $this->print_render_attribute_string( 'url' ); ?> class="item-btn">
                <?php echo esc_html( $data['btntext'] ); ?>
            </a>
        </div>
	<?php } ?>
</div>