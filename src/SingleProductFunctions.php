<?php

/**
 * SingleProductFunctions Class.
 *
 * @package promoted-product
 */

 namespace PromotedProduct;
 
 
 /**
  * Class SingleProductFunctions.
  */
class SingleProductFunctions {

    // Add custom fields to the product settings page
    public function custom_product_settings_fields() {
        global $woocommerce, $post;

        $promotion_custom_title = get_post_meta($post->ID,'promotion_custom_title',true);
        $is_promoted = get_post_meta($post->ID,'_is_promoted',true);
        $will_expire = get_post_meta($post->ID,'_will_expire',true);
        $promotion_expiration_date = get_post_meta($post->ID,'promotion_expiration_date',true);

        echo '<div class="options_group"><h2>Promoted Settings</h2>';
        // Add a text field
        woocommerce_wp_text_input(
            array(
                'id'          => 'promotion_custom_title',
                'label'       => __('Custom Title', 'promoted'),
                'placeholder' => '',
                'desc_tip'    => 'true',
                'value'       => $promotion_custom_title,
                'description' => __('Enter custom title that will be shown instead of the product title.', 'promoted'),
            )
        );

        // Add a checkbox field
        woocommerce_wp_checkbox(
            array(
                'id'          => '_is_promoted',
                'label'       => __('Promote this product', 'promoted'),
                'description' => __('Promote this product.', 'promoted'),
                'value'       => $is_promoted == 'yes'?1:0,
                'cbvalue'     => 1,
            )
        );

        // Add a checkbox field
        woocommerce_wp_checkbox(
            array(
                'id'          => '_will_expire',
                'label'       => __('Promotion will expire after time?', 'promoted'),
                'class'       => 'expire',
                'description' => __('Check this if you want to set an expiration date and time.', 'promoted'),
                'value'       => $will_expire == 'yes'?1:0,
                'cbvalue'     => 1
            )
        );
        echo "<div class='picker_container' style='display:none' >";
        woocommerce_wp_text_input(
            array(
                'id'          => 'promotion_expiration_date',
                'label'       => __('Date time', 'promoted'),
                'placeholder' => '',
                'desc_tip'    => 'true',
                'class'       => 'datepicker',
                'value'       => $promotion_expiration_date,
                'description' => __('Enter Expiration date and time.', 'promoted'),
            )
        );

        echo "</div></div>";

    }

    // Enqueue jQuery UI Datepicker script
    public function enqueue_datepicker_script() {
        wp_enqueue_script('jquery-ui-datepicker');
    }

    // Initialize Datepicker
    public function initialize_datepicker() {
        ?>
        <script>
            jQuery(function($) {
                $('.datepicker').datepicker({
                    dateFormat: 'yy-mm-dd',
                    showTime: true, // You can customize this based on your requirements
                    controlType: 'select',
                    oneLine: true,
                    timeFormat: 'HH:mm',
                    stepMinute: 5
                });
            });
            jQuery(document).ready(function($) {
                $("#_will_expire").change(function(){
                    if ($(this).prop('checked')) {
                        $('.picker_container').show();
                    } else {
                        $('.picker_container').hide();
                    }
                });
                if ($('#_will_expire').prop('checked')) {
                    $('.picker_container').show();
                } else {
                    $('.picker_container').hide();
                }
            });
        </script>
        <?php
    }

    // Save custom fields
    public function save_custom_product_settings_fields($post_id) {
        // Save custom text field
        $promotion_custom_title = isset($_POST['promotion_custom_title']) ? sanitize_text_field($_POST['promotion_custom_title']) : '';
        update_post_meta($post_id, 'promotion_custom_title', $promotion_custom_title);

        // Save custom checkbox
        $is_promoted = isset($_POST['_is_promoted']) ? 'yes' : 'no';
        update_post_meta($post_id, '_is_promoted', $is_promoted);

        $will_expire = isset($_POST['_will_expire']) ? 'yes' : 'no';
        update_post_meta($post_id, '_will_expire', $will_expire);

        $promotion_expiration_date = isset($_POST['promotion_expiration_date']) ? $_POST['promotion_expiration_date'] : '';
        update_post_meta($post_id, 'promotion_expiration_date', $promotion_expiration_date);

    }
}