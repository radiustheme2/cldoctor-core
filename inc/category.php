<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Rtcl\Resources\Options;

class Category_Setup {
      public function __construct() {
            //Icon
            add_action( 'listygo_car_category_add_form_fields', [$this, 'listygo_icon_field_add_new_category'] );
            add_action( 'listygo_car_category_edit_form_fields', [$this, 'listygo_icon_field_edit_category'] );
            add_action( 'created_listygo_car_category', [$this, 'listygo_icon_save_term_meta'] );
            add_action( 'edited_listygo_car_category', [$this, 'listygo_icon_save_term_meta'] );
            //Image
            add_action( 'listygo_car_category_add_form_fields', [$this, 'listygo_image_field_add_new_category'] );
            add_action( 'listygo_car_category_edit_form_fields', [$this, 'listygo_image_field_edit_category'] );
            add_action( 'created_listygo_car_category', [$this, 'listygo_image_save_term_meta'] );
            add_action( 'edited_listygo_car_category',  [$this, 'listygo_image_save_term_meta'] );

            //Color
            add_action( 'rtcl_category_add_form_fields', [$this, 'cldoctor_colorpicker_field_add_new_category'] );
            add_action( 'rtcl_category_edit_form_fields', [$this, 'cldoctor_colorpicker_field_edit_category'] );
            add_action( 'created_rtcl_category', [$this, 'cldoctor_color_save_term_meta'] );
            add_action( 'edited_rtcl_category',  [$this, 'cldoctor_color_save_term_meta'] );

            //Admin Columns
            add_filter( 'manage_edit-rtcl_category_columns', [$this, 'cldoctor_admin_edit_term_columns'], 20, 3 );
            add_filter( 'manage_rtcl_category_custom_column', [$this, 'cldoctor_admin_manage_term_custom_column'], 20, 3 );
      }

      /* = Add category icon field 
      =======================================================================*/
      function listygo_icon_field_add_new_category( $taxonomy ) {
            // $icons = Helper::get_font_awesome_5_icons();
            $icons = Options::get_icon_list();
            ?>

            <div class="form-field rtcl-term-group-wrap">
                  <label for="tag-rtcl-icon"><?php esc_html_e('Icon', 'cldoctor-core'); ?></label>
                  <p><select name="_rtcl_icon" class="rtcl-select2-icon" id="tag-rtcl-icon">
                        <option value=""><?php esc_html_e("Select one", "cldoctor-core") ?></option>
                        <?php
                          foreach ($icons as $icon) {
                              echo sprintf(
	                              '<option value="%1$s" data-icon="%1$s">%2$s</option',
                                  esc_attr($icon),
                                  esc_html($icon)
                              );
                          }
                        ?>
                  </select></p>
            </div>
            <?php
      }

      function listygo_icon_field_edit_category( $term ) {
            $icons = Options::get_icon_list();
            $t_id = $term->term_id;
            $f_icon = esc_attr(get_term_meta($t_id, "_rtcl_icon", true));
            ?>
            <tr class="form-field">
                  <th scope="row" valign="top">
                  <label for="tag-rtcl-icon"><?php esc_html_e('Icon', 'cldoctor-core'); ?></label>
                  </th>
                  <td>
                  <select name="_rtcl_icon" class="rtcl-select2-icon" id="tag-rtcl-icon">
                        <option value=""><?php esc_html_e("Select one", "cldoctor-core") ?></option>
                        <?php
                            foreach ($icons as $icon) {
                                  $slt = $icon == $f_icon ? " selected" : null;
                                  echo sprintf(
                                      '<option value="%1$s"%2$s class="%1$s" data-icon="%1$s"><span>%3$s</span></option>',
                                      esc_attr( $icon ),
                                      esc_attr( $slt ),
                                      esc_html( $icon )
                                  );
                            }
                        ?>
                  </select>
                  </td>
            </tr>
            <?php
      }
      function listygo_icon_save_term_meta( $term_id ) {
            $nonce_add  = isset( $_POST['_wpnonce_add-tag'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce_add-tag'] ) ) : '';
            $nonce_edit = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
            if ( ! wp_verify_nonce( $nonce_add, 'add-tag' ) && ! wp_verify_nonce( $nonce_edit, 'update-tag_' . $term_id ) ) {
                  return;
            }
            if (isset($_POST['_rtcl_icon'])) {
                  update_term_meta($term_id, '_rtcl_icon', sanitize_text_field( wp_unslash( $_POST['_rtcl_icon'] ) ) );
            } else {
                  delete_term_meta( $term_id, '_rtcl_icon' );
            }
      }

      /* = Add category image field 
      =======================================================================*/
      function listygo_image_field_add_new_category( $taxonomy ) {
            // $icons = Helper::get_font_awesome_5_icons();
            ?>
            <div class="form-field term-group">
                  <label for=""><?php esc_html_e( 'Upload and Image', 'cldoctor-core' ); ?></label>
                  <div class="category-image"></div> 
                  <input type="button" id="upload_image_btn" class="button" value="<?php esc_attr_e( 'Upload an Image', 'cldoctor-core' ); ?>" />
            </div>
            <?php
      }

      function listygo_image_field_edit_category( $term ) {
            $image = get_term_meta( $term->term_id, 'rt_category_image', true );
            ?>
            <tr class="form-field term-image-wrap">
                  <th scope="row"><label for="term-image"><?php esc_html_e( 'Image', 'cldoctor-core' ); ?></label></th>
                  <td> 
                        <div class="category-image">
                        <?php if ( $image ) { ?>
                              <div class="category-image-wrap">
                                    <img src='<?php echo esc_url( wp_get_attachment_image_src($image, 'thumbnail')[0] ); ?>' width='200' />
                                    <input type="hidden" name="rt_category_image" value="<?php echo esc_attr( $image ); ?>" class="category-image-id"/>
                                    <button>x</button>
                              </div>
                        <?php } ?>
                        </div>
                        <input type="button" id="upload_image_btn" class="button" value="<?php esc_attr_e( 'Upload an Image', 'cldoctor-core' ); ?>" />
                  </td>
            </tr>
            <?php
      }

      function listygo_image_save_term_meta( $term_id ) {
            $nonce_add  = isset( $_POST['_wpnonce_add-tag'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce_add-tag'] ) ) : '';
            $nonce_edit = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
            if ( ! wp_verify_nonce( $nonce_add, 'add-tag' ) && ! wp_verify_nonce( $nonce_edit, 'update-tag_' . $term_id ) ) {
                  return;
            }
            // Save term image if possible
            if( isset( $_POST['rt_category_image'] ) && ! empty( $_POST['rt_category_image'] ) ) {
                  update_term_meta( $term_id, 'rt_category_image', absint( $_POST['rt_category_image'] ) );
            } else {
                  delete_term_meta( $term_id, 'rt_category_image' );
            }
      }

      /* = Add category color field 
      =======================================================================*/
      function cldoctor_colorpicker_field_add_new_category( $taxonomy ) {
            ?>

            <div class="form-field term-colorpicker-wrap">
                  <label for="term-colorpicker"><?php esc_html_e( 'Category Color', 'cldoctor-core' ); ?></label>
                  <input name="rt_category_color" value="#111111" class="colorpicker" id="term-colorpicker" />
                  <p><?php esc_html_e( 'This is category background color.', 'cldoctor-core' ); ?></p>
            </div>
            <?php
      }

      function cldoctor_colorpicker_field_edit_category( $term ) {
            $color = get_term_meta( $term->term_id, 'rt_category_color', true );
            $color = ( ! empty( $color ) ) ? "#{$color}" : '#111111';

            ?>
            <tr class="form-field term-colorpicker-wrap">
                  <th scope="row"><label for="term-colorpicker"><?php esc_html_e( 'Category Color', 'cldoctor-core' ); ?></label></th>
                  <td>
                        <input name="rt_category_color" value="<?php echo esc_attr( $color ); ?>" class="colorpicker" id="term-colorpicker" />
                        <p class="description"><?php esc_html_e( 'This is category background color.', 'cldoctor-core' ); ?></p>
                  </td>
            </tr>
            <?php
      }

      function cldoctor_color_save_term_meta( $term_id ) {
            $nonce_add  = isset( $_POST['_wpnonce_add-tag'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce_add-tag'] ) ) : '';
            $nonce_edit = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
            if ( ! wp_verify_nonce( $nonce_add, 'add-tag' ) && ! wp_verify_nonce( $nonce_edit, 'update-tag_' . $term_id ) ) {
                  return;
            }
            // Save term color if possible
            if( isset( $_POST['rt_category_color'] ) && ! empty( $_POST['rt_category_color'] ) ) {
                  update_term_meta( $term_id, 'rt_category_color', sanitize_hex_color_no_hash( wp_unslash( $_POST['rt_category_color'] ) ) );
            } else {
                  delete_term_meta( $term_id, 'rt_category_color' );
            }
      }


      /* = Category columns for custom meta
      =======================================================================*/
      //Category Icon column
      function cldoctor_admin_edit_term_columns( $columns ) {
            $columns['rt_category_icon'] = esc_html__( 'Image/Icon', 'cldoctor-core' );
            $columns['rt_category_color'] = esc_html__( 'Color', 'cldoctor-core' );
            return $columns;
      }

      // Category icon column icon
      function cldoctor_admin_manage_term_custom_column( $out, $column, $term_id ) {
            if ( 'rt_category_icon' === $column ) {
                  $image  = get_term_meta( $term_id , '_rtcl_image', true );
                  $icon = get_term_meta( $term_id, "_rtcl_icon", true );
                  if ( $image && $icon ) {
                        $out = '<img src='.wp_get_attachment_image_src($image, 'thumbnail')[0].' width="20" />';
                        $out .= sprintf( '<i class="%s">', esc_attr( $icon ) );
                  } elseif ( $image ) {
                        $out = '<img src='.wp_get_attachment_image_src($image, 'thumbnail')[0].' width="20" />';
                  } elseif ( $icon ) {
                        $out = sprintf( '<i class="%s">', esc_attr( $icon ) );
                  } else {
                        $out = ''; 
                  }
            }

            if ( 'rt_category_color' === $column ) {
                  $value  = get_term_meta( $term_id , 'rt_category_color', true );
                  if ( ! $value )
                  $value = '';
                  $out = sprintf( '<span class="term-meta-color-block" style="background: #%s" ></span>', esc_attr( $value ) );
            }

            return $out;
      }

}
new Category_Setup;
