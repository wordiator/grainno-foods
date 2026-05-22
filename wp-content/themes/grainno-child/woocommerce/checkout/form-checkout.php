<?php
/**
 * WhatsApp checkout redirect page — no form, just redirect.
 * The PHP-level redirect is handled by grainno_whatsapp_checkout_redirect()
 * in functions.php. This template is a fallback for non-JS environments.
 */
defined('ABSPATH') || exit;

get_header('shop');

$wa_number = get_option('grainno_whatsapp_number', GRAINNO_WHATSAPP);
$items     = [];
$total     = 0;

if (function_exists('WC') && WC()->cart) {
    foreach (WC()->cart->get_cart() as $item) {
        $product   = $item['data'];
        $variation = !empty($item['variation']) ? implode(', ', array_values($item['variation'])) : '';
        $line      = $product->get_name();
        if ($variation) $line .= ' – ' . $variation;
        $line     .= ' × ' . $item['quantity'] . ' = ₦' . number_format($item['line_total'], 0, '.', ',');
        $items[]   = $line;
    }
    $total = WC()->cart->get_total('edit');
}

$msg  = "Hello Grainno Foods! I'd like to place an order:\n\n🛒 ORDER DETAILS\n";
$msg .= implode("\n", $items);
$msg .= "\n\n💰 TOTAL: ₦" . number_format($total, 0, '.', ',');
$msg .= "\n\n📍 Please send me your account details or payment link.";
$wa_url = 'https://wa.me/' . $wa_number . '?text=' . rawurlencode($msg);
?>

<div style="max-width:600px;margin:100px auto;padding:0 20px;text-align:center;">
    <div style="font-size:3rem;margin-bottom:24px;">💬</div>
    <h1 style="font-family:var(--font-display);font-size:2rem;color:var(--gf-white);margin-bottom:16px;">You're almost done!</h1>
    <p style="color:rgba(253,250,245,0.7);font-size:1.05rem;margin-bottom:36px;line-height:1.7;">
        We don't use an online payment form. Instead, tap the button below to send your order to us on WhatsApp — we'll send you our bank details or a payment link right away.
    </p>
    <a href="<?php echo esc_url($wa_url); ?>" class="btn-whatsapp" style="display:inline-flex;max-width:400px;font-size:1.1rem;padding:18px 32px;" target="_blank" rel="noopener">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        Send Order on WhatsApp
    </a>
    <p style="margin-top:24px;font-size:0.85rem;color:rgba(253,250,245,0.35);">
        <a href="<?php echo wc_get_cart_url(); ?>" style="color:rgba(253,250,245,0.35);">← Back to cart</a>
    </p>
</div>

<?php get_footer('shop'); ?>
