<?php
// Enqueue custom scripts and styles
function enqueue_custom_scripts_and_styles() {
    // Enqueue JavaScript file
    wp_enqueue_script('custom-scripts', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'scripts.js', array('jquery'), null, true);

    // Enqueue CSS file
    wp_enqueue_style('custom-styles', PROMOTED_PRODUCT_PLUGIN_BUILD_URL . 'styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts_and_styles');