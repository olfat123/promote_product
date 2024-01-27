<?php
/**
 * Promoted Product Plugin
 *
 * @package promoted-product
 * @author  Olfat Rashad
 *
 * @wordpress-plugin
 * Plugin Name:       Promoted Product
 * Description:       Choose product to promote.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.2
 * Author:            Olfat Rashad
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       promoted-product
 * Domain Path:       /languages
 */


/**
 * Exit if accessed directly
 **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Check if WooCommerce is active
 **/
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return;
}

/**
 * Bootstrap the plugin.
 */
require_once 'vendor/autoload.php';
require_once untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/src/inc/custom-functions.php';

use PromotedProduct\PromotedPlugin;

if ( class_exists( 'PromotedProduct\PromotedPlugin' ) ) {
	$the_plugin = new PromotedPlugin();
}

register_activation_hook( __FILE__, [ $the_plugin, 'activate' ] );
register_deactivation_hook( __FILE__, [ $the_plugin, 'deactivate' ] );

