<?php


add_filter('woocommerce_related_products', 'add_related_products');
function add_related_products($related_product_ids)
{
    global $post;
    
    // get the cats this product is in
    $terms = get_the_terms($post->ID, 'product_cat');
    
    // get Especies Category
    $product_cat = get_term_by( 'name', 'Especie', 'product_cat' );

    // if there is only one category jump out.
    if (count($terms) === 1) {
        return $args;
    }
    
    $cats = array();
    
    foreach ( $terms as $key => $term ){
        if($term->parent===$product_cat->term_id){
            $cats[] = $term->term_id;
        }
    }
    
    $post_ids = get_posts(array(
        'post_type' => 'product',
        'numberposts' => -1, // get all posts.
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $cats,
            )
        ),
            'fields' => 'ids', // Only get post IDs
        )
    );
    
    return array_diff ($post_ids, [$post->ID]); // return posts exclude current post
}
