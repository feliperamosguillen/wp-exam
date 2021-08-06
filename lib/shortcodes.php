<?php

/* Add Show All Products to Woocommerce Shortcode filteref by category*/
function woocommerce_shortcode_display_all_products_filtered_by_cat($args)
{
    $filters = '';

    // normalize parameters
    $atts = array_change_key_case( (array) $args, CASE_LOWER );

    // if exists category filter
    if(isset($atts["category"])){
        $filters = 'category="'. $atts["category"] .'"';
    }

    return do_shortcode( "[products $filters]" );
}
add_shortcode('woo_exam_products_query', 'woocommerce_shortcode_display_all_products_filtered_by_cat');
