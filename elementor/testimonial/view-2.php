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

<?php if ($data['slider_style'] == 1) { ?>
<!-- Start testimonial section -->
<div class="testimonial-section testimonial-style-1 section-padding" data-slider-options="<?php echo esc_attr($data['slider_data_thumb']); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 wow animate__fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
                <div class="reviewers position-relative">
                    <div class="SwiperThumb">
                        <div class="swiper-wrapper">
                            <?php foreach ( $data['items'] as $testi_thumb ): ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-author-wrapper">
                                        <div class="testimonial-author-info d-flex align-items-center">
                                            <?php 
                                                if ( $testi_thumb['image']['id'] && $data['thum_display']=='yes') {
                                                    echo "<div class='testimonial-img'>";
                                                    echo wp_get_attachment_image( $testi_thumb['image']['id'], 'full' );
                                                    echo "</div>";
                                                }
                                            ?>
                                            <div class="info">
                                                <div class="author-name"><?php echo esc_html( $testi_thumb['name'] ); ?></div>
                                                <p class="designation">
                                                    <?php echo esc_html( $testi_thumb['designation'] ); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($data['dots']) { ?>
                            <div class="swiper-pagination d-flex justify-content-center"></div>
                        <?php } ?>
                        <?php if ($data['arrows']) { ?>
                            <div class="slider-navigation">
                                <div class="slider-nav swiper-button-prev"></div>
                                <div class="slider-nav swiper-button-next"></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 wow animate__fadeInUp" data-wow-duration="1200ms" data-wow-delay="600ms">
                <div class="testimonial-slider-wrapper">
                    <div class="testimonial-item">
                        <div class="rt-slider">
                            <div class="swiper SwiperContent">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $data['items'] as $testi_content ): 
                                            if ( ! empty( $testi_content['profile_link']['url'] ) ) {
                                                $this->add_link_attributes( 'link', $testi_content['profile_link'] );
                                            }
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="testimonial-content">
                                                <?php if ( !empty($testi_content['company_logo']['id']) || !empty( $data['quote_icon']['value'])) { ?>
                                                    <div class="icon">
                                                        <?php 
                                                            if ( $testi_content['company_logo']['id']) {
                                                                echo "<div class='company-logo'>";
                                                                echo wp_get_attachment_image( $testi_content['company_logo']['id'], 'full' );
                                                                echo "</div>";
                                                            }
                                                        ?>
                                                        <div class="quote-icon">
                                                            <?php Icons_Manager::render_icon( $data['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="testimonial-text">
                                                    <?php echo wp_kses_post( $testi_content['content'] ); ?>
                                                </div>
            
                                                <div class="testimonial-commentor-identity">
                                                    <?php if ( $data['rating'] ) : ?>
                                                        <ul class="rating ul-ol">
	                                                        <?php for ( $i=0; $i <=4 ; $i++ ) {
		                                                        if ( $i < $testi_content['rating'] ) {
			                                                        $full = 'active';
		                                                        } else {
			                                                        $full = 'deactive';
		                                                        }
		                                                        ?>
                                                                <li class="has-rating"><i class="fa-solid fa-star <?php echo esc_attr( $full ); ?>"></i></li>
	                                                        <?php } ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <?php if ( ! empty( $testi_content['link']['url'] ) ) { ?>
                                                    <h5 class="name">
                                                        <a <?php $this->print_render_attribute_string( 'link' ); ?>>
                                                            <?php echo esc_html( $testi_content['name'] ); ?>
                                                        </a>
                                                    </h5>
                                                    <?php } ?>
                                                    <p class="designation">
                                                        <?php echo esc_html( $testi_content['designation'] ); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Slider End -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End testimonial section -->
<?php } ?>

<?php if ($data['slider_style'] == 2) { ?>
    <div class="testimonial-slider-wrapper testimonial-style-2 cldoctor-carouser-slider" data-slider-options="<?php echo esc_attr($data['slider_data_thumb']); ?>">
        <div class="rt-slider swiper">
            <div class="element-carousel">
                <div class="swiper-wrapper">
                    <?php foreach ( $data['items'] as $item ): 
                            if ( ! empty( $item['profile_link']['url'] ) ) {
                                $this->add_link_attributes( 'link', $item['profile_link'] );
                            }
                        ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item testimonial-content">
                            <?php
                                if ( !empty($item['company_logo']['id']) || !empty( $data['quote_icon']['value'])) { ?>
                                <div class="icon">
                                    <?php 
                                        if ( $item['company_logo']['id']) {
                                            echo "<div class='company-logo'>";
                                            echo wp_get_attachment_image( $item['company_logo']['id'], 'full' );
                                            echo "</div>";
                                        }
                                    ?>
                                    <div class="quote-icon">
                                        <?php Icons_Manager::render_icon( $data['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="testimonial-text">
                                    <?php echo wp_kses_post( $item['content'] ); ?>
                                </div>
                                <div class="testimonial-commentor-identity">
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
                                    <div class="testimonial-footer">
                                        <div class="name-designation">
                                            <h5 class="name"> 
                                                <?php if ( ! empty( $item['link']['url'] ) ) { ?>
                                                    <a <?php $this->print_render_attribute_string( 'link' ); ?>>
                                                        <?php echo esc_html( $item['name'] ); ?>
                                                    </a>
                                                <?php } else {
                                                   echo esc_html( $item['name'] ); 
                                                } ?>
                                            </h5>
                                            <p class="designation">
                                                <?php echo esc_html( $item['designation'] ); ?>
                                            </p>
                                        </div>
                                        <?php 
                                            if ( $item['image']['id'] && $data['thum_display']=='yes') {
                                                echo "<div class='testimonial-img'>";
                                                echo wp_get_attachment_image( $item['image']['id'], 'full' );
                                                echo "</div>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php if ($data['dots']) { ?>
        <div class="swiper-pagination"></div>
        <?php } if ($data['arrows']) { ?> 
        <div class="slider-navigation-btn-wrapper d-none d-xl-block">
            <div class="circle-nav swiper-button-prev">
                <i class="fa-solid fa-chevron-left"></i>
            </div>
            <div class="circle-nav swiper-button-next">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if ( $data['slider_style'] == 3 ) { ?>
    
<div class="testimonial-section testimonial-style-3" data-slider-options="<?php echo esc_attr($data['slider_data_thumb']); ?>">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-7 col-lg-8 col-xl-6 wow animate__fadeInUp" data-wow-duration="1200ms" data-wow-delay="600ms">
            <div class="testimonial-slider-wrapper">
                <div class="user-saying">
                    <div class="rt-slider">
                        <div class="swiper mySwiper5">
                            <div class="swiper-wrapper">
                                <?php foreach ( $data['items'] as $item ): 
                                    if ( ! empty( $item['profile_link']['url'] ) ) {
                                        $this->add_link_attributes( 'link', $item['profile_link'] );
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item testimonial-content">
                                        <?php
                                        if ( !empty($item['company_logo']['id']) || !empty( $data['quote_icon']['value'])) { ?>
                                        <div class="icon">
                                            <?php 
                                                if ( $item['company_logo']['id']) {
                                                    echo "<div class='company-logo'>";
                                                    echo wp_get_attachment_image( $item['company_logo']['id'], 'full' );
                                                    echo "</div>";
                                                }
                                            ?>
                                            <div class="quote-icon">
                                                <?php Icons_Manager::render_icon( $data['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="name-designation">
                                            <h5 class="name">
                                                <?php if ( ! empty( $item['link']['url'] ) ) { ?>
                                                    <a <?php $this->print_render_attribute_string( 'link' ); ?>>
                                                        <?php echo esc_html( $item['name'] ); ?>
                                                    </a>
                                                <?php } else {
                                                    echo esc_html( $item['name'] );
                                                } ?>
                                            </h5>
                                            <p class="designation">
                                                <?php echo esc_html( $item['designation'] ); ?>
                                            </p>
                                        </div>
                                        <div class="testimonial-text">
                                            <?php echo wp_kses_post( $item['content'] ); ?>
                                        </div>
                                        <div class="testimonial-commentor-identity">
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
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>    
                        </div>
                        <div class="swiper-pagination d-flex justify-content-center"></div>
                    </div>
                    <!-- Slider End -->
                </div>
                
            </div>
        </div>

        <div class="col-md-5 col-lg-4 col-xl-6 wow animate__fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
            <div class="reviewers position-relative">

                <div class="swiper mySwiperx">
                    <div class="swiper-wrapper">
                        <?php foreach ( $data['items'] as $itemthumb ): ?>
                            <div class="swiper-slide">
                                <div class="testimonial-img-wrapper">
                                    <?php 
                                        if ( $item['image']['id'] && $data['thum_display']=='yes') {
                                            echo "<div class='testimonial-img'>";
                                            echo wp_get_attachment_image( $itemthumb['image']['id'], 'full' );
                                            echo "</div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php } ?>