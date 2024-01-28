<?php

/**
 * Assets Class.
 *
 * @package promoted-product
 */

 namespace PromotedProduct;
 
 
 /**
  * Class Assets.
  */
class Assets {
// Enqueue custom scripts and styles
    public function enqueue_custom_scripts_and_styles() {
        // Enqueue JavaScript file
        wp_enqueue_script('custom-scripts', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'scripts.js', array('jquery'), null, true);

        // Enqueue CSS file
        wp_enqueue_style('custom-styles', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'styles.css');
    }

    public function enqueue_promoted_admin_scripts_and_styles(){
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('promoted-admin-scripts', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'admin.scripts.js', array('jquery'), null, true);
        wp_enqueue_style('promoted-admin-styles', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'admin.styles.css');
    }
}