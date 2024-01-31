<?php

/**
 * PromotedSettingsTabFunctions Class.
 *
 * @package promoted-product
 */

namespace PromotedProduct;

use PromotedProduct\inc\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class PromotedSettingsTabFunctions.
 */
class PromotedSettingsTabFunctions {

	// Add a new section under the "WooCommerce > Settings > Products" tab


	public function promoted_product_settings_section( $sections ) {
		$sections['promoted_section'] = __( 'Promoted Section', 'promoted' );
		return $sections;
	}


	/**
	 * Add settings to the promoted section we created before
	 */
	public function promoted_section( $settings, $current_section ) {

		/**
		 * Check the current section is what we want
		*/

		if ( $current_section == 'promoted_section' ) {
			$settings = array();
			// Add Title to the Settings
			$settings[] = array(
				'name' => __( 'Promotion section settings', 'promoted' ),
				'type' => 'title',
				'desc' => __( 'The following options are used to configure promotion section.', 'promoted' ),
				'id'   => 'mysettings',
			);
			$settings[] = array(
				'type' => 'promoted_section_dynamic_field',
				'id'   => 'promoted_section_dynamic_field',
			);
			$settings[] = array(
				'type' => 'sectionend',
				'id'   => 'mysettings',
			);
		}

		return $settings;
	}

	/**
	 * Add custom fields to the promoted section we created before
	 */
	public function admin_field_promoted_section_dynamic_field( $value ) {
		$promoted_heading_field    = get_option( 'promoted_heading_field' );
		$promoted_background_color = get_option( 'promoted_background_color' );
		$promoted_text_color       = get_option( 'promoted_text_color' );
		echo '<div class="promoted_options_group">';
			// Add a text field
			woocommerce_wp_text_input(
				array(
					'id'          => 'promoted_heading_field',
					'label'       => __( 'Title Field', 'promoted' ),
					'placeholder' => '',
					'desc_tip'    => 'true',
					'description' => __( 'Title of the promoted product.', 'promoted' ),
					'value'       => $promoted_heading_field,
				)
			);

			// Add a color picker field
			woocommerce_wp_text_input(
				array(
					'id'          => 'promoted_background_color',
					'label'       => __( 'Background Color', 'promoted' ),
					'placeholder' => __( 'Enter a color code', 'promoted' ),
					'desc_tip'    => 'true',
					'description' => __( 'Select a background color.', 'promoted' ),
					'type'        => 'color',
					'value'       => $promoted_background_color,
				)
			);

			// Add a color picker field
			woocommerce_wp_text_input(
				array(
					'id'          => 'promoted_text_color',
					'label'       => __( 'Text Color', 'promoted' ),
					'placeholder' => __( 'Enter a color code', 'promoted' ),
					'desc_tip'    => 'true',
					'description' => __( 'Select a text color.', 'promoted' ),
					'type'        => 'color',
					'value'       => $promoted_text_color,
				)
			);
			$functions        = new Functions();
			$promoted_product = $functions->get_promoted_product();
			$product_id       = $promoted_product->get_id();

			// Get product edit page link
			$product_edit_link = get_edit_post_link( $product_id );
		if ( $promoted_product ) {
			echo "<br><label>The promoted product is </label> : <a href='" . esc_url( $product_edit_link ) . "'>" . $promoted_product->get_title() . '</a>';
		}
			echo '</div>';
	}

	public function update_option_promoted_section_dynamic_field( $value ) {
		$promoted_text_color = isset( $_POST['promoted_text_color'] ) ? sanitize_text_field( $_POST['promoted_text_color'] ) : '';
		update_option( 'promoted_text_color', $promoted_text_color );

		$promoted_background_color = isset( $_POST['promoted_background_color'] ) ? sanitize_text_field( $_POST['promoted_background_color'] ) : '';
		update_option( 'promoted_background_color', $promoted_background_color );

		$promoted_heading_field = isset( $_POST['promoted_heading_field'] ) ? sanitize_text_field( $_POST['promoted_heading_field'] ) : '';
		update_option( 'promoted_heading_field', $promoted_heading_field );
	}
}
