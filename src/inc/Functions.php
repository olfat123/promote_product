<?php

/**
 * Functions Class.
 *
 * @package promoted-product
 */

namespace PromotedProduct\inc;

/**
 * Class Functions.
 */
class Functions {

	public function get_promoted_product() {
		$today = date( 'Y-m-d' ); // Current date in 'YYYY-MM-DD' format

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => 1,
			'meta_query'     => array(
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
						'value'   => $today,
						'compare' => '>=', // Date comparison, greater than or equal to today
						'type'    => 'DATE',
					),
					array(
						'key'     => '_will_expire',
						'value'   => 'no',
						'compare' => '=',
					),
				),

			),
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		$products = wc_get_products( $args );
		if ( $products > 0 ) {
			$latest_promoted_post_id = $products[0]->id;
		} else {
			// No posts found
			$latest_promoted_post_id = 0;
		}

		// Output the post ID
		return $latest_promoted_post_id;
	}
}
