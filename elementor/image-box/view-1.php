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

$mainImage = $main_image['url'];
//Others Images
$otherImage1 = $other_image1['url'];
$otherImage2 = $other_image2['url'];
//Shape Images
$shapeImage1 = $shape_image1['url'];
$shapeImage2 = $shape_image2['url'];
$shapeImage3 = $shape_image3['url'];

?>

<div class="image-box image-box-1">
    <?php echo wp_get_attachment_image( $main_image['id'], 'full', "", array( "class" => "wow rtFadeInUp", "data-wow-delay" => "1s" ) ); ?>
    <?php if ( $otherImage1 || $otherImage2 ){ ?>
    <ul class="image-list">
        <?php if ( $otherImage1 ){ ?>
            <li class="image-item">
                <?php echo wp_get_attachment_image( $other_image1['id'], 'full' ); ?>
            </li> 
        <?php } if ( $otherImage2 ){ ?>
            <li class="image-item">
                <?php echo wp_get_attachment_image( $other_image2['id'], 'full' ); ?>
            </li> 
        <?php } ?>
    </ul>
    <?php } ?>
    <?php if ( $shapeImage1 || $shapeImage1 || $shapeImage1 ){ ?>
    <ul class="shape-parallax-list d-none d-lg-block">
        <?php if ( $shapeImage1 ){ ?>
        <li class="rt-mouse-parallax">
            <div data-depth="1.00">
                <?php echo wp_get_attachment_image( $shape_image1['id'], 'full' ); ?>
            </div>
        </li>
        <?php } if ( $shapeImage2 ){ ?>
        <li class="rt-mouse-parallax">
            <div data-depth="2.00">
                <?php echo wp_get_attachment_image( $shape_image2['id'], 'full' ); ?>
            </div>
        </li>
        <?php } if ( $shapeImage3 ){ ?>
        <li class="rt-mouse-parallax">
            <div data-depth="2.00">
                <?php echo wp_get_attachment_image( $shape_image3['id'], 'full' ); ?>
            </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>