<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue child scripts
 */
add_action( 'wp_enqueue_scripts', 'enqueue_child_styles', 15 );

if ( ! function_exists( 'enqueue_child_styles' ) ) {
    function enqueue_child_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
    }
}

add_action( 'init', 'remove_from_header' );

function remove_from_header() {
    remove_action( 'storefront_header', 'storefront_header_container', 0 );
    remove_action( 'storefront_header', 'storefront_skip_links', 5 );
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
    remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    remove_action( 'storefront_homepage', 'storefront_homepage_header', 10 );
}

if ( ! function_exists( 'storefront_primary_navigation' ) ) {
    /**
     * Display Primary Navigation
     *
     * @since  1.0.0
     * @return void
     */
    function storefront_primary_navigation() {
        ?>
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'storefront' ); ?>">
            <button id="site-navigation-menu-toggle" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span>&nbsp;</span></button>
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container_class' => 'primary-navigation',
                )
            );

            wp_nav_menu(
                array(
                    'theme_location'  => 'handheld',
                    'container_class' => 'handheld-navigation',
                )
            );
            ?>
        </nav><!-- #site-navigation -->
        <?php
    }
}

add_action( 'wp_enqueue_scripts', 'slider_scripts', 10 );

function slider_scripts() {
    if (is_page_template('template-homepage.php')) {
        wp_enqueue_style( 'swiper-slyle', get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '9.0.5', 'all' );
        wp_enqueue_script( 'swiper-script', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '9.0.5', true );
        wp_enqueue_script( 'swiper-init', get_stylesheet_directory_uri() . '/assets/js/swiper-init.js', array('swiper-script'), '1.0.0', true );
    }
}

add_action( 'wp_enqueue_scripts', 'read_more', 12 );

function read_more() {
        wp_enqueue_script( 'read-more-script', get_stylesheet_directory_uri() . '/assets/js/read-more.js', array(), '1.0.0', true );
}

add_action( 'init', 'remove_from_homepage' );

function remove_from_homepage() {
    remove_action( 'storefront_homepage', 'storefront_homepage_header', 10 );
    remove_action( 'homepage', 'storefront_product_categories', 20 );
    remove_action( 'homepage', 'storefront_recent_products', 30 );
    remove_action( 'homepage', 'storefront_featured_products', 40 );
    remove_action( 'homepage', 'storefront_popular_products', 50 );
    remove_action( 'homepage', 'storefront_on_sale_products', 60 );
    remove_action( 'homepage', 'storefront_best_selling_products', 70 );
}

add_action( 'init', 'remove_from_footer' );

function remove_from_footer() {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
}

add_action( 'init', 'init_product' );

function init_product() {
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    add_action( 'woocommerce_after_shop_loop_item_title', 'template_loop_in_stock', 12 );
}

function template_loop_in_stock() {
    wc_get_template( 'loop/in-stock.php' );
}

if ( ! function_exists( 'template_loop_in_stock' ) ) {

    function template_loop_in_stock() {
        wc_get_template( 'loop/in-stock.php' );
    }
}