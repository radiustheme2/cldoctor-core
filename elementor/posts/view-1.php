<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 use RadiusTheme\Obitore\Helper;

$thumb_size = $data['post_thumbnail_size'] ? $data['post_thumbnail_size'] : 'rdtheme-size2';
$grid_column_desktop = ( $data['grid_column_desktop'] ? $data['grid_column_desktop'] : '3' );
$grid_column_tab     = ( $data['grid_column_tab'] ? $data['grid_column_tab'] : '2' );
$grid_column_mobile  = ( $data['grid_column_mobile'] ? $data['grid_column_mobile'] : '1' );
$col_class = "row-cols-lg-{$grid_column_desktop} row-cols-md-{$grid_column_tab} row-cols-sm-{$grid_column_mobile}";

$has_entry_meta  = ( $data['cat_visibility'] && has_category() ) || $data['author_visibility'] || $data['comment_visibility'] || $data['date_visibility'] || $data['time_visibility'];

$args = [
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $data['post_limit'],
	'post_status'         => 'publish',
];
if ( $data['orderby'] ) {
	$args['orderby'] = $data['orderby'];
}
if ( $data['order'] ) {
	$args['order'] = $data['order'];
}

if ( $data['post_source'] == 'by_category' && $data['categories'] ) :
	$args = wp_parse_args(
		[
			'cat' => $data['categories'],
		]
		, $args );
endif;

if ( $data['post_source'] == 'by_tags' && $data['tags'] ) :
	$args = wp_parse_args(
		[
			'tag_slug__in' => $data['tags'],
		]
		, $args );
endif;

if ( $data['post_source'] == 'by_title' && !empty( $data['titles'] ) ) {
	$args['post__in'] = $titles;
}


if ( $data['exclude'] ) :
	$excluded_ids         = explode( ',', $data['exclude'] );
	$args['post__not_in'] = $excluded_ids;
endif;


if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

$query               = new \WP_Query( $args );

?>

<div class="rt-el-post-wrapper style1">
	<?php if ( $query->have_posts() ) : ?>
        <div class="row <?php echo esc_attr($col_class); ?> row-cols-1 justify-content-center">
			<?php 
				$i = 0;
				while ( $query->have_posts() ) : $query->the_post(); 
				$i++;

				if ( $data['cat_visibility'] && has_category() ) {
					$catClass = 'cat-enable'.' translate-up-down'.$i;
				} else {
					$catClass = 'cat-none'.' translate-up-down'.$i;
				}
                $has_thumbnail = has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail'; ?>
                <div class="col">
                    <div class="blog-post blog-grid <?php echo esc_attr( $has_thumbnail.' '.$catClass ) ?>">
						<?php if ( has_post_thumbnail() && !empty($data['thumbnail_display'])){
							$thumb = get_the_post_thumbnail( get_the_ID(), $thumb_size);
							?>
                            <div class="blog-post-thumb">
                                <a href="<?php the_permalink(); ?>" class="thumb-wrap">
                                    <?php echo wp_kses_post($thumb); ?>
                                </a>
								<?php if ( $data['cat_visibility'] ) : ?>
									<div class="category-meta">
										<?php
										    $category_list = get_the_category_list( ', ', '', get_the_ID() );
										    // Sanitize output with wp_kses()
										    echo wp_kses( $category_list, wp_kses_allowed_html( 'post' ) );  // Adjust allowed tags if needed
										?>
									</div>
								<?php endif; ?>
                            </div>
						<?php } ?>
                        <div class="blog-post-content">
							<?php
								$title = strip_shortcodes( wp_strip_all_tags( get_the_title() ) );
								$title = wp_trim_words( $title, $data['title_limit'], '' );
							?>
							<div class="blog-post-meta">
                                <ul class="list-inline">
									<?php if ( $data['author_visibility'] ) : ?>
                                        <li class="author-meta">
                                            <span class="author vcard">
                                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                                    <?php
                                                    if ( 'image' == $data['author_avatar'] ) {
														echo get_avatar( get_the_author_meta( 'user_email' ), 35 );
                                                    } elseif ( 'icon' == $data['author_avatar'] ) {
														echo '<i class="icon-ei_user"></i>';
                                                    }
                                                    echo esc_html( get_the_author() );
                                                    ?>
                                                </a>
                                            </span>
                                        </li>
									<?php endif; ?>

									<?php if ( $data['date_visibility'] ) : ?>
										<li class="date-meta">
											<?php
											if ( 'default' == $data['p_date_format'] ) {
												?>
												<i class="icon-calendar"></i>
												<?php the_time( get_option( 'date_format' ) ); ?>
												<?php
											} else {
												?>
												<i class="icon-clock"></i>
												<?php
                                                    $dateTime = class_exists( 'RadiusTheme\Obitore\Helper' ) ? Helper::obitore_reading_time() : get_the_time( get_option( 'date_format' ) );
												    echo esc_html( $dateTime );
                                                ?>
												<?php
											}
											?>
										</li>
									<?php endif; ?>

									<?php if ( $data['comment_visibility'] ) : ?>
                                        <li class="comments-meta">
                                        	<i class="fa-regular fa-comments"></i>
											<span class="post-comments-number">
                                                <?php
                                                comments_popup_link(
													esc_html__( 'No Comment', 'cldoctor-core' ),
													esc_html__( '1 Comment', 'cldoctor-core' ),
													esc_html__( '% Comments', 'cldoctor-core' ), '',
													esc_html__( 'Comments are Closed', 'cldoctor-core' )
                                                ); ?>
                                            </span>
                                        </li>
									<?php endif; ?>

                                </ul>
                            </div>
							<h2 class="blog-post-heading"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $title ); ?></a></h2>
							<?php if ( 'visible' == $data['content_visibility'] ) : ?>
								<div class="content-excerpt">
									<?php
										$content = strip_shortcodes( wp_strip_all_tags( get_the_content() ) );
										$content = wp_trim_words( $content, $data['content_limit'], '' );
										echo wp_kses_post( $content );
									?>
								</div>
							<?php endif; ?>
							<?php if($data['read_more_btn_visibility'] == 'visible'){ ?>
								<div class="read-more">
									<a href="<?php the_permalink(); ?>" class="button-style-2">
										<span class="btn__text"><?php echo esc_html( $data['read_more_btn_text'] ); ?></span>
										<i class="icon-arrow"></i>
									</a>
								</div>
							<?php } ?>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
        </div>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>


