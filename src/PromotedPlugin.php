<?php
/**
 * PromotedPlugin Class.
 *
 * @package promoted-product
 */

namespace PromotedProduct;

use PromotedProduct\views\Promotion;

/**
 * Class PromotedPlugin.
 */
class PromotedPlugin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
	}

	public function activate() {}
	public function deactivate() {}

	/**
	 * Initialize Promotedplugin
	 */
	private function init() {
		define( 'PROMOTED_PRODUCT_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __DIR__ ) ) );
		define( 'PROMOTED_PRODUCT_PLUGIN_URL', untrailingslashit( plugin_dir_url( __DIR__ ) ) );
		define( 'PROMOTED_PRODUCT_PLUGIN_BUILD_PATH', PROMOTED_PRODUCT_PLUGIN_PATH . '/assets/' );
		define( 'PROMOTED_PRODUCT_PLUGIN_BUILD_URL', PROMOTED_PRODUCT_PLUGIN_URL . '/assets/' );
		define( 'PROMOTED_PRODUCT_PLUGIN_VERSION', '1.0.0' );

		$promoted_settings_tab = new PromotedSettingsTabFunctions();
		$single_product_settings = new SingleProductFunctions();
		$assets = new Assets();
		$template = new Promotion();

		add_action('woocommerce_product_options_general_product_data', array($single_product_settings,'custom_product_settings_fields'));
		add_action('admin_enqueue_scripts', array($single_product_settings,'enqueue_datepicker_script'));
		add_action('admin_footer', array($single_product_settings,'initialize_datepicker'));
		add_action('woocommerce_process_product_meta', array($single_product_settings,'save_custom_product_settings_fields'));
		add_filter('woocommerce_get_sections_products', array($promoted_settings_tab,'promoted_product_settings_section'));
		add_filter( 'woocommerce_get_settings_products', array($promoted_settings_tab,'promoted_section'), 10, 2 );
		add_action('woocommerce_admin_field_promoted_section_dynamic_field',array($promoted_settings_tab,'admin_field_promoted_section_dynamic_field'));
		add_action('woocommerce_update_option_promoted_section_dynamic_field',array($promoted_settings_tab,'update_option_promoted_section_dynamic_field'));
		add_action('wp_enqueue_scripts', array($assets,'enqueue_custom_scripts_and_styles'));
    	add_action('wp_head', array($template,'add_promotion_div'));

		
		// include_once(PROMOTED_PRODUCT_PLUGIN_PATH.'src/views/promotion.php');
		// add_action('wp_head', 'add_promotion_div');

		//new SingleProductFunctions();
		
	}

	
}