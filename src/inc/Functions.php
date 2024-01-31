<?php

/**
 * Functions Class.
 *
 * @package promoted-product
 */

namespace PromotedProduct\inc;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class Functions.
 */
class Functions {

	public function __construct() {
		add_filter( 'woocommerce_product_data_store_cpt_get_products_query', array( $this, 'custom_add_meta_query_to_product_query' ), 10, 2 );
	}

	public function get_promoted_product() {

		$args = array(
			'limit'  => 1,
			'status' => 'publish',
		);

		$products = wc_get_products( $args );
		if ( $products > 0 ) {
			$latest_promoted_post = $products[0];
		} else {
			// No posts found
			$latest_promoted_post = 0;
		}

		// Output the post ID
		return $latest_promoted_post;
	}

	/**
	 * Add a filter to modify the product query.
	 *
	 * @param array $query - Args for WP_Query.
	 * @param array $query_vars - Query vars from WC_Product_Query.
	 * @return array modified $query
	 */
	public function custom_add_meta_query_to_product_query( $query ) {
		// Add your custom meta query parameters
		$meta_query = array(
			'relation' => 'AND',
			array(
				'key'     => '_is_promoted',
				'value'   => 'yes',
				'compare' => '=',
			),
			array(
				'relation' => 'OR',
				array(
					'key'     => 'promotion_expiration_date',
					'value'   => date( 'Y-m-d' ), // Current date
					'compare' => '>=',
					'type'    => 'DATE',
				),
				array(
					'key'     => '_will_expire',
					'value'   => 'no',
					'compare' => '=',
				),
			),
		);

		// Merge with existing meta query if any
		if ( isset( $query['meta_query'] ) ) {
			$meta_query = array_merge( $meta_query, $query['meta_query'] );
		}

		$query['meta_query'] = $meta_query;

		return $query;
	}
}
