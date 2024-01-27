<?php
/**
 * Plugin Class.
 *
 * @package promoted-product
 */

namespace PromotedProduct;

/**
 * Class Plugin.
 */
class Plugin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
	}

	public function activate() {}
	public function deactivate() {}

	/**
	 * Initialize plugin
	 */
	private function init() {
		define( 'PROMOTED_PRODUCT_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __DIR__ ) ) );
		define( 'PROMOTED_PRODUCT_PLUGIN_URL', untrailingslashit( plugin_dir_url( __DIR__ ) ) );
		define( 'PROMOTED_PRODUCT_PLUGIN_BUILD_PATH', PROMOTED_PRODUCT_PLUGIN_PATH . '/src/assets/build/' );
		define( 'PROMOTED_PRODUCT_PLUGIN_BUILD_URL', PROMOTED_PRODUCT_PLUGIN_URL . '/src/assets/build/' );
		define( 'PROMOTED_PRODUCT_PLUGIN_VERSION', '1.0.0' );

		//new Assets();
		
	}

	
}