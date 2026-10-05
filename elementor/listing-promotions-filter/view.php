<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use RtclPro\Helpers\Fns;
global $listing;
extract( $data );

$col_class  = "row-cols-xl-{$data['col_xl']} row-cols-lg-{$data['col_lg']} row-cols-md-{$data['col_md']} row-cols-sm-{$data['col_sm']} row-cols-{$data['col_mobile']} row-cols-1";

$uniqueid = time().wp_rand( 1, 99 );
$count = 0;

?>
<div class="rt-el-listing-isotope listing-shortcode rt-el-isotope-container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="rt-el-isotope-tab rtin-btn">
				<a href="#" class="current nav-item" data-filter="*"><?php esc_html_e( 'All', 'cldoctor-core' ); ?></a>
				<?php 
					foreach ( $data['navs'] as $key => $value ): ?>
					<?php
						$count++;
						$navclass = '';
					?>
					<a class= "nav-item" href="#" data-filter=".<?php echo esc_attr( $uniqueid.$key );?>"><?php echo esc_html( $value );?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="row <?php echo esc_attr( $col_class ); ?> rt-el-isotope-wrapper listing-shortcode listing-grid-shortcode rtcl-grid-view justify-content-center">
		<?php foreach ( $data['queries'] as $key => $query ): ?>
			<?php if ( $query->have_posts() ) :?>
				<?php 
					while ( $query->have_posts() ) : $query->the_post(); 
					if ( $listing && Fns::is_enable_mark_as_sold() && Fns::is_mark_as_sold( $listing->get_id() ) ) {
						$action_class = 'is-sold';
					} else {
						$action_class = '';
					}
				?>
					<div class="col product-box listygo-rating <?php echo esc_attr( $uniqueid.$key.' '.$action_class );?>">
						<?php
							/**
							 * Hook: rtcl_before_listing_loop_item.
							 *
							 * @hooked rtcl_template_loop_product_link_open - 10
							 */
							do_action( 'rtcl_before_listing_loop_item' );

							/**
							 * Hook: rtcl_listing_loop_item.
							 *
							 * @hooked listing_thumbnail - 10
							 */
							do_action( 'rtcl_listing_loop_item_start' ); 
							
							/**
							 * Hook: rtcl_listing_loop_item.
							 *
							 * @hooked loop_item_wrap_start - 10
							 * @hooked loop_item_listing_title - 20
							 * @hooked loop_item_labels - 30
							 * @hooked loop_item_listable_fields - 40 
							 * @hooked loop_item_meta - 50
							 * @hooked loop_item_excerpt - 60
							 * @hooked loop_item_wrap_end - 100
							 */
							do_action('rtcl_listing_loop_item');

							// do_action( 'rtcl_listing_loop_item_end' );

							/**
							 * Hook: rtcl_after_listing_loop_item.
							 *
							 * @hooked listing_loop_map_data - 50
							 */
							do_action( 'rtcl_after_listing_loop_item' );
						?>
					</div>
				<?php endwhile;?>
			<?php else: ?>
				<div class="rtin-no-item col-sm-12 col-12 <?php echo esc_attr( $uniqueid.$key );?>"><?php esc_html_e( 'No Items Available', 'cldoctor-core' );?></div>
			<?php endif;?>
			<?php wp_reset_postdata();?>
		<?php endforeach; ?>
	</div>
</div>

<?php
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
	?>
    <script>jQuery( '.rt-el-isotope-container' ).isotope();</script>
	<?php
}