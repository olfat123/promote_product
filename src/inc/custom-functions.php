<?php
 function get_promoted_product(){
    $today = date('Y-m-d'); // Current date in 'YYYY-MM-DD' format

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
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $latest_promoted_post_id = get_the_ID();
        }
        wp_reset_postdata();
    } else {
        // No posts found
        $latest_promoted_post_id = 0;
    }
    
    // Output the post ID
    return $latest_promoted_post_id;   		
}