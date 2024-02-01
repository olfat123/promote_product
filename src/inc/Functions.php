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

		$products = wc_get_products(
			array(
				'promoted_only'  => true,
				'posts_per_page' => 1,
				'post_status'    => 'publish',

			)
		);
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
	 * Handle a custom meta query vars to get products.
	 *
	 * @param array $query - Args for WP_Query.
	 * @param array $query_vars - Query vars from WC_Product_Query.
	 * @return array modified $query
	 */
	function custom_add_meta_query_to_product_query( $query, $query_vars ) {
		if ( isset( $query_vars['promoted_only'] ) && $query_vars['promoted_only'] ) {
			$query['meta_query'][] = array(
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
		}

		// Add limit per page parameter
		if ( isset( $query_vars['posts_per_page'] ) ) {
			$query['posts_per_page'] = $query_vars['posts_per_page'];
		}
		// Add status parameter
		if ( isset( $query_vars['post_status'] ) ) {
			$query['post_status'] = $query_vars['post_status'];
		}

		return $query;
	}
}
