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
require_once get_stylesheet_directory() . '/inc/gbt-editor.php';

/* ============================================================
   ENQUEUE FONTS & SCRIPTS
   ============================================================ */
function grainno_enqueue_assets() {
    if (is_page_template('template-gbt-sales.php')) {
        wp_enqueue_style(
            'gbt-landing-fonts',
            'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600..900;1,9..144,400..600&family=DM+Sans:wght@400..700&family=IBM+Plex+Mono:wght@400;500&display=swap',
            [],
            null
        );
        wp_enqueue_style(
            'gbt-sales-style',
            get_stylesheet_directory_uri() . '/gbt-sales/style.css',
            ['gbt-landing-fonts'],
            filemtime(get_stylesheet_directory() . '/gbt-sales/style.css')
        );
        wp_enqueue_script(
            'gbt-sales-script',
            get_stylesheet_directory_uri() . '/gbt-sales/script.js',
            [],
            filemtime(get_stylesheet_directory() . '/gbt-sales/script.js'),
            true
        );
        return;
    }

    if (is_page_template('template-gbt-landing.php')) {
        wp_enqueue_style(
            'gbt-landing-fonts',
            'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600..900;1,9..144,400..600&family=DM+Sans:wght@400..700&family=IBM+Plex+Mono:wght@400;500&display=swap',
            [],
            null
        );
        wp_enqueue_style(
            'gbt-landing-style',
            get_stylesheet_directory_uri() . '/gbt-landing/style.css',
            ['gbt-landing-fonts'],
            filemtime(get_stylesheet_directory() . '/gbt-landing/style.css')
        );
        wp_enqueue_script(
            'gbt-landing-script',
            get_stylesheet_directory_uri() . '/gbt-landing/script.js',
            [],
            filemtime(get_stylesheet_directory() . '/gbt-landing/script.js'),
            true
        );
        return;
    }

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

/* GBT templates are standalone pages: strip every stylesheet the parent theme
   and plugins force onto them (storefront, woocommerce, main site style.css),
   keeping only GBT assets and the logged-in admin bar. */
function grainno_gbt_style_isolation() {
    if (!is_page_template(['template-gbt-sales.php', 'template-gbt-landing.php'])) {
        return;
    }
    $keep = [
        'gbt-landing-fonts', 'gbt-landing-style', 'gbt-sales-style',
        'gbt-editor', 'admin-bar', 'dashicons', 'cookieadmin-style',
    ];
    foreach ((array) wp_styles()->queue as $handle) {
        if (!in_array($handle, $keep, true)) {
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        }
    }
}
add_action('wp_enqueue_scripts', 'grainno_gbt_style_isolation', 999);
add_action('wp_print_styles', 'grainno_gbt_style_isolation', 999);

/* Final gate: some plugins (WooCommerce blocks) re-enqueue styles through paths
   the queue sweep can't reach, so filter the printed tag itself. */
add_filter('style_loader_tag', function ($tag, $handle) {
    if (!is_page_template(['template-gbt-sales.php', 'template-gbt-landing.php'])) {
        return $tag;
    }
    $keep = [
        'gbt-landing-fonts', 'gbt-landing-style', 'gbt-sales-style',
        'gbt-editor', 'admin-bar', 'dashicons', 'cookieadmin-style',
    ];
    return in_array($handle, $keep, true) ? $tag : '';
}, 10, 2);

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
