<?php

/**
 * Promotion Class.
 *
 * @package promoted-product
 */

 namespace PromotedProduct\views;
 
 
 /**
  * Class Promotion.
  */
class Promotion {
// Add the div under the header
    function add_promotion_div() {
        $promoted_product = get_promoted_product();
        if($promoted_product){
            $promoted_background_color = get_option('promoted_background_color');
            $promoted_text_color = get_option('promoted_text_color');
            $promoted_heading_field = get_option('promoted_heading_field')?:'FLASH SALE:';
            $promoted_product = get_promoted_product();
            $promotion_custom_title = get_post_meta($promoted_product,'promotion_custom_title',true)?:get_the_title($promoted_product);
            echo '<div style="background-color:'.$promoted_background_color.'" id="full-width-div"><h3 class="promoted_heading_field" style="color:'.$promoted_text_color.'">'.$promoted_heading_field.'</h3><a style="color:'.$promoted_text_color.'" href="'.get_permalink($promoted_product).'" class="promotion_custom_title">'.$promotion_custom_title.'</a></div>';
        }
    }
}