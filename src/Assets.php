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
    Public function enqueue_custom_scripts_and_styles() {
        // Enqueue JavaScript file
        wp_enqueue_script('custom-scripts', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'scripts.js', array('jquery'), null, true);

        // Enqueue CSS file
        wp_enqueue_style('custom-styles', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'styles.css');
    }
}