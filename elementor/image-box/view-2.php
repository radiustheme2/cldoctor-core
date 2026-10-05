<?php
/**
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace RadiusTheme\Ayo_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

extract( $data );

$mainImage = $main_image['url'];
//Others Images
$img1 = $image1['url'];
$img2 = $image2['url'];
$img3 = $image3['url'];
$img4 = $image4['url'];
//Animation Images
$animImage1 = $anim_image1['url'];
$animImage2 = $anim_image2['url'];

?>

<div class="image-box image-box-2">
    <div class="item-img">
        <?php echo wp_get_attachment_image( $main_image['id'], 'full', "", array( "class" => "wow rtFadeInLeft", "data-wow-delay" => "1s" ) ); ?>
        <div class="shape wow rtFadeInLeft" data-wow-delay="1.2s">
            <div class="rt-shape"></div>
        </div>
    </div>
</div>