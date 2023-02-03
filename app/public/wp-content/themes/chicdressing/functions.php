<?php 

add_action( 'wp_enqueue_scripts', 'chicdressing_enqueue_styles' );
function chicdressing_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
}

add_filter( 'big_image_size_threshold', '__return_false' );

/*
    Fonctions de Romain
*/

// h2 => h3 sur les titres de produits sur la page d'accueil
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'chicdressing_woo_shop_products_title', 10 );
function chicdressing_woo_shop_products_title() {
    echo '<h3 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

// h1 => h2 sur les titres de produits sur les pages produits
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'wc_template_single_title', 5 );
function wc_template_single_title() {
    echo '<h2 class="product_title entry-title">' . get_the_title() . '</h2>';
}

// h1 => h2 sur la page "Shop"
add_filter( 'woocommerce_show_page_title' , 'hide_page_title' );
function hide_page_title() {
    return false;
}
add_action( 'woocommerce_archive_description', 'wc_taxonomy_archive_description', 10);
function wc_taxonomy_archive_description() {
    echo '<h2 class="shop-page-title">' . woocommerce_page_title(false) . '</h2>';
}

// changement de l'URL de la boutique de "shop" en "boutique"
add_filter( 'woocommerce_get_shop_page_permalink', 'wc_change_shop_page_permalink' );
function wc_change_shop_page_permalink( $permalink ) {
    return home_url( '/boutique/' );
}