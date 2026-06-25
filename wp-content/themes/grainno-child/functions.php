<?php
defined('ABSPATH') || exit;

define('GRAINNO_WHATSAPP', '2348163874554');

/* Kill horizontal scroll — inline so it loads after all plugin/theme CSS */
add_action('wp_head', function () {
    echo '<style>html,body{overflow-x:hidden!important;max-width:100vw!important;}</style>';
}, 9999);


/* ============================================================
   INCLUDES
   ============================================================ */
require_once get_stylesheet_directory() . '/inc/customizer.php';
require_once get_stylesheet_directory() . '/inc/whatsapp-cart.php';
require_once get_stylesheet_directory() . '/inc/product-meta.php';

/* ============================================================
   ENQUEUE FONTS & SCRIPTS
   ============================================================ */
function grainno_enqueue_assets() {
    wp_enqueue_style(
        'grainno-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,700;1,9..144,400&family=DM+Sans:wght@400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'grainno-child-style',
        get_stylesheet_uri(),
        ['grainno-fonts'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'grainno-main',
        get_stylesheet_directory_uri() . '/assets/js/grainno.js',
        ['jquery'],
        wp_get_theme()->get('Version'),
        true
    );

    $cart_items = [];
    $cart_total = 0;

    if (function_exists('WC') && WC()->cart) {
        foreach (WC()->cart->get_cart() as $item) {
            $product   = $item['data'];
            $variation = '';
            if (!empty($item['variation'])) {
                $attrs = [];
                foreach ($item['variation'] as $k => $v) {
                    $attrs[] = $v;
                }
                $variation = implode(', ', $attrs);
            }
            $cart_items[] = [
                'name'      => $product->get_name(),
                'variation' => $variation,
                'qty'       => $item['quantity'],
                'subtotal'  => number_format($item['line_total'], 0, '.', ','),
            ];
        }
        $cart_total = number_format(WC()->cart->get_total('edit'), 0, '.', ',');
    }

    wp_localize_script('grainno-main', 'grainnoCart', [
        'items'     => $cart_items,
        'total'     => $cart_total,
        'waNumber'  => GRAINNO_WHATSAPP,
        'cartUrl'   => wc_get_cart_url(),
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('grainno_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'grainno_enqueue_assets');

/* ============================================================
   THEME SETUP
   ============================================================ */
function grainno_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'grainno_setup');

/* ============================================================
   WHATSAPP CHECKOUT REDIRECT
   ============================================================ */
function grainno_whatsapp_checkout_redirect() {
    if (!is_checkout() || is_order_received_page()) return;
    if (!function_exists('WC') || !WC()->cart || WC()->cart->is_empty()) return;

    $items   = [];
    $total   = WC()->cart->get_total('edit');

    foreach (WC()->cart->get_cart() as $item) {
        $product   = $item['data'];
        $variation = '';
        if (!empty($item['variation'])) {
            $vals = array_values($item['variation']);
            $variation = implode(', ', $vals);
        }
        $line = $product->get_name();
        if ($variation) $line .= ' – ' . $variation;
        $line .= ' × ' . $item['quantity'] . ' = ₦' . number_format($item['line_total'], 0, '.', ',');
        $items[] = $line;
    }

    $message  = "Hello Grainno Foods! I'd like to place an order:\n\n";
    $message .= "🛒 ORDER DETAILS\n";
    $message .= implode("\n", $items);
    $message .= "\n\n💰 TOTAL: ₦" . number_format($total, 0, '.', ',');
    $message .= "\n\n📍 Please send me your account details or payment link.";

    $wa_number = get_option('grainno_whatsapp_number', GRAINNO_WHATSAPP);
    $url       = 'https://wa.me/' . $wa_number . '?text=' . rawurlencode($message);

    wp_redirect($url);
    exit;
}
add_action('template_redirect', 'grainno_whatsapp_checkout_redirect');

/* ============================================================
   DISABLE UNNECESSARY WOOCOMMERCE FEATURES
   ============================================================ */
add_filter('woocommerce_related_products', '__return_empty_array');
add_filter('woocommerce_product_tabs', 'grainno_product_tabs', 98);

function grainno_product_tabs($tabs) {
    unset($tabs['reviews']);
    unset($tabs['additional_information']);
    unset($tabs['description']);
    return $tabs;
}

add_filter('woocommerce_enable_coupon_form', '__return_false');

/* ============================================================
   AJAX: RETURN CART DATA FOR JS
   ============================================================ */
function grainno_ajax_get_cart_data() {
    check_ajax_referer('grainno_nonce', 'nonce');

    $items = [];
    $total = 0;

    if (function_exists('WC') && WC()->cart) {
        foreach (WC()->cart->get_cart() as $item) {
            $product   = $item['data'];
            $variation = !empty($item['variation']) ? implode(', ', array_values($item['variation'])) : '';
            $items[] = [
                'name'      => $product->get_name(),
                'variation' => $variation,
                'qty'       => $item['quantity'],
                'subtotal'  => number_format($item['line_total'], 0, '.', ','),
            ];
        }
        $total = number_format(WC()->cart->get_total('edit'), 0, '.', ',');
    }

    wp_send_json_success(['items' => $items, 'total' => $total]);
}
add_action('wp_ajax_grainno_get_cart_data', 'grainno_ajax_get_cart_data');
add_action('wp_ajax_nopriv_grainno_get_cart_data', 'grainno_ajax_get_cart_data');

/* ============================================================
   OVERRIDE WORDPRESS ADMIN BAR MARGIN (runs after WP injects it)
   ============================================================ */
function grainno_kill_admin_bar_margin() {
    echo '<style>html{margin-top:0!important;}body,body.admin-bar{margin-top:0!important;padding-top:0!important;}</style>';
}
add_action('wp_head', 'grainno_kill_admin_bar_margin', 99);

/* ============================================================
   BODY CLASSES
   ============================================================ */
function grainno_body_classes($classes) {
    $classes[] = 'grainno-theme';
    return $classes;
}
add_filter('body_class', 'grainno_body_classes');
