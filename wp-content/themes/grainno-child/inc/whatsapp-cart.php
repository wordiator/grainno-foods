<?php
defined('ABSPATH') || exit;

/* ============================================================
   FLOATING CART FRAGMENT
   ============================================================ */
function grainno_cart_fragment($fragments) {
    ob_start();
    grainno_floating_cart_html();
    $fragments['#gf-floating-cart'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'grainno_cart_fragment');

function grainno_floating_cart_html() {
    $count      = function_exists('WC') ? WC()->cart->get_cart_contents_count() : 0;
    $total      = function_exists('WC') ? WC()->cart->get_total('edit') : 0;
    $wa_number  = get_option('grainno_whatsapp_number', GRAINNO_WHATSAPP);
    $items      = [];

    if (function_exists('WC') && WC()->cart) {
        foreach (WC()->cart->get_cart() as $item) {
            $product   = $item['data'];
            $variation = '';
            if (!empty($item['variation'])) {
                $variation = implode(', ', array_values($item['variation']));
            }
            $items[] = [
                'name'      => esc_html($product->get_name()),
                'variation' => esc_html($variation),
                'qty'       => (int) $item['quantity'],
                'subtotal'  => number_format($item['line_total'], 0, '.', ','),
            ];
        }
    }

    // Build WhatsApp URL server-side as fallback
    $wa_url = '#';
    if ($count > 0) {
        $lines = [];
        foreach ($items as $i) {
            $line  = $i['name'];
            if ($i['variation']) $line .= ' – ' . $i['variation'];
            $line .= ' × ' . $i['qty'] . ' = ₦' . $i['subtotal'];
            $lines[] = $line;
        }
        $msg    = "Hello Grainno Foods! I'd like to place an order:\n\n🛒 ORDER DETAILS\n";
        $msg   .= implode("\n", $lines);
        $msg   .= "\n\n💰 TOTAL: ₦" . number_format($total, 0, '.', ',');
        $msg   .= "\n\n📍 Please send me your account details or payment link.";
        $wa_url = 'https://wa.me/' . $wa_number . '?text=' . rawurlencode($msg);
    }
    ?>
    <div id="gf-floating-cart" class="<?php echo $count > 0 ? 'has-items' : ''; ?>">
        <button class="gf-cart-toggle" id="gf-cart-toggle" aria-label="Open cart">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
            </svg>
            <span class="gf-cart-count" data-count="<?php echo $count; ?>"><?php echo $count > 0 ? $count : ''; ?></span>
        </button>

        <div class="gf-cart-panel" id="gf-cart-panel">
            <div class="gf-cart-panel__header">
                <span>Your Cart</span>
                <span><?php echo $count; ?> item<?php echo $count !== 1 ? 's' : ''; ?></span>
            </div>

            <div class="gf-cart-panel__items">
                <?php if (empty($items)) : ?>
                    <p class="gf-cart-panel__empty">Your cart is empty</p>
                <?php else : ?>
                    <?php foreach ($items as $item) : ?>
                        <div class="gf-cart-panel__item">
                            <div>
                                <div class="gf-cart-panel__item-name"><?php echo $item['name']; ?></div>
                                <div class="gf-cart-panel__item-meta">
                                    <?php if ($item['variation']) echo $item['variation'] . ' · '; ?>
                                    Qty: <?php echo $item['qty']; ?>
                                </div>
                            </div>
                            <div class="gf-cart-panel__item-price">₦<?php echo $item['subtotal']; ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if ($count > 0) : ?>
                <div class="gf-cart-panel__footer">
                    <div class="gf-cart-panel__total">
                        <span>Total</span>
                        <span class="amount">₦<?php echo number_format($total, 0, '.', ','); ?></span>
                    </div>
                    <a href="<?php echo esc_url($wa_url); ?>" class="btn-whatsapp" id="gf-wa-btn" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Pay via WhatsApp
                    </a>
                    <a href="<?php echo wc_get_cart_url(); ?>" style="display:block;text-align:center;margin-top:10px;font-size:0.85rem;color:rgba(253,250,245,0.5);">View full cart</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/* ============================================================
   OUTPUT FLOATING CART IN FOOTER
   ============================================================ */
function grainno_output_floating_cart() {
    grainno_floating_cart_html();
}
add_action('wp_footer', 'grainno_output_floating_cart');
