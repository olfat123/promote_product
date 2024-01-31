<?php

/**
 * Promotion Class.
 *
 * @package promoted-product
 */

namespace PromotedProduct\views;

use PromotedProduct\inc\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Promotion.
 */
class Promotion {
	// Add the div under the header
	function add_promotion_div() {
		$functions        = new Functions();
		$promoted_product = $functions->get_promoted_product();
		if ( $promoted_product ) {
			$product_id                = $promoted_product->get_id();
			$promoted_background_color = esc_html( get_option( 'promoted_background_color' ) );
			$promoted_text_color       = esc_html( get_option( 'promoted_text_color' ) );
			$promoted_heading_field    = esc_html( get_option( 'promoted_heading_field' ) ) ?: 'FLASH SALE:';
			$promotion_custom_title    = esc_html( get_post_meta( $product_id, 'promotion_custom_title', true ) ) ?: $promoted_product->get_title();
			echo '<div style="background-color:' . $promoted_background_color . '" id="full-width-div"><h3 class="promoted_heading_field" style="color:' . $promoted_text_color . '">' . $promoted_heading_field . '</h3><a style="color:' . $promoted_text_color . '" href="' . $promoted_product->get_permalink() . '" class="promotion_custom_title">' . $promotion_custom_title . '</a></div>';
		}
	}
}
