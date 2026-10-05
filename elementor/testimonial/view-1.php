<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Icons_Manager;
?>

<div class="rt-el-testimonial grid-testimonial style-<?php echo esc_attr($data['align']); ?>">
    <div class="row row-cols-lg-<?php echo esc_attr( $data['grid_column'] ); ?> row-cols-sm-2 row-cols-1 justify-content-center">
        <?php foreach ( $data['items'] as $item ): 
                if ( ! empty( $item['profile_link']['url'] ) ) {
                    $this->add_link_attributes( 'link', $item['profile_link'] );
                }
            ?>
            <div class="col">
                <div class="testimonial-item style-<?php echo esc_attr($data['style']); ?>">
                    <?php if ($data['grid_style'] == 1) { ?>
                        <div class="testimonial-content">
                            <?php 
                                if ( $item['image']['id'] && $data['thum_display']=='yes') { ?>
                                    <div class='testimonial-img'>
                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
                                        <?php if (!empty($data['quote_icon'])) { ?>
                                            <div class="quote-icon d-flex justify-content-center align-items-center">
                                                <?php Icons_Manager::render_icon( $data['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php if ( $data['rating'] ) : ?>
                                <ul class="rating ul-ol">
                                    <?php for ( $i=0; $i <=4 ; $i++ ) {
                                        if ( $i < $item['rating'] ) {
                                            $full = 'active';
                                        } else {
                                            $full = 'deactive';
                                        }
                                        ?>
                                        <li class="has-rating"><i class="fa-solid fa-star <?php echo esc_attr( $full ); ?>"></i></li>
                                    <?php } ?>
                                </ul>
                            <?php endif; ?>
                            <p class="testimonial-block__text">
                                <?php echo esc_html( $item['content'] ); ?>
                            </p>
                            <div class="content-info">
                                <h3 class="testimonial-block__heading">
                                    <?php if ( ! empty( $item['link']['url'] ) ) { ?>
                                        <a <?php $this->print_render_attribute_string( 'link' ); ?>>
                                            <?php echo esc_html( $item['name'] ); ?>
                                        </a>
                                    <?php 
                                    } else { 
                                        echo esc_html( $item['name'] ); 
                                    } ?>
                                </h3>
                                <?php if ( $item['designation'] ): ?>
                                    <span class="testimonial-block__designation"><?php echo esc_html( $item['designation'] ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($data['grid_style'] == 2) { ?>
                        <?php if ( $data['rating'] ) : ?>
                            <ul class="rating ul-ol">
	                            <?php for ( $i=0; $i <=4 ; $i++ ) {
		                            if ( $i < $item['rating'] ) {
			                            $full = 'active';
		                            } else {
			                            $full = 'deactive';
		                            }
		                            ?>
                                    <li class="has-rating"><i class="fa-solid fa-star <?php echo esc_attr( $full ); ?>"></i></li>
	                            <?php } ?>
                            </ul>
                        <?php endif; ?>
                        <p class="testimonial-block__text">
                            <?php echo esc_html( $item['content'] ); ?>
                        </p>
                        <div class="testimonial-content">
                            <?php 
                                if ( $item['image']['id'] && $data['thum_display']=='yes') {
                                    echo "<div class='testimonial-img'>";
                                    echo wp_get_attachment_image( $item['image']['id'], 'full' );
                                    echo "</div>";
                                }
                            ?>
                            <div class="content-info">
                                <h3 class="testimonial-block__heading"><?php echo esc_html( $item['name'] ); ?></h3>
                                <?php if ( $item['designation'] ): ?>
                                    <span class="testimonial-block__designation"><?php echo esc_html( $item['designation'] ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

