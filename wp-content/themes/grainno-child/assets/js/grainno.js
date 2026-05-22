(function ($) {
    'use strict';

    /* ============================================================
       WHATSAPP URL BUILDER
       ============================================================ */
    function buildWhatsAppURL(cartItems, total, waNumber) {
        var message = "Hello Grainno Foods! I'd like to place an order:\n\n🛒 ORDER DETAILS\n";
        cartItems.forEach(function (item) {
            var line = item.name;
            if (item.variation) line += ' – ' + item.variation;
            line += ' × ' + item.qty + ' = ₦' + item.subtotal;
            message += line + '\n';
        });
        message += '\n💰 TOTAL: ₦' + total;
        message += '\n\n📍 Please send me your account details or payment link.';
        return 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent(message);
    }

    /* ============================================================
       FLOATING CART TOGGLE
       ============================================================ */
    $(document).on('click', '#gf-cart-toggle', function (e) {
        e.stopPropagation();
        var panel = $('#gf-cart-panel');
        panel.toggleClass('open');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#gf-floating-cart').length) {
            $('#gf-cart-panel').removeClass('open');
        }
    });

    /* ============================================================
       UPDATE WHATSAPP BUTTON URL DYNAMICALLY
       ============================================================ */
    function updateWAButton() {
        if (typeof grainnoCart === 'undefined') return;
        var data = grainnoCart;
        if (!data.items || data.items.length === 0) return;
        var url = buildWhatsAppURL(data.items, data.total, data.waNumber);
        $('#gf-wa-btn').attr('href', url);
    }

    /* ============================================================
       AFTER ADD TO CART (AJAX)
       ============================================================ */
    $(document.body).on('added_to_cart', function (e, fragments, hash, button) {
        // Show floating cart panel
        setTimeout(function () {
            $('#gf-cart-panel').addClass('open');
        }, 300);

        // Refresh cart data
        $.ajax({
            url: grainnoCart.ajaxUrl,
            type: 'POST',
            data: { action: 'grainno_get_cart_data', nonce: grainnoCart.nonce },
            success: function (res) {
                if (res.success) {
                    grainnoCart.items = res.data.items;
                    grainnoCart.total = res.data.total;
                    updateWAButton();
                }
            }
        });
    });

    /* ============================================================
       ACCORDION
       ============================================================ */
    $(document).on('click', '.gf-accordion__trigger', function () {
        var acc = $(this).closest('.gf-accordion');
        acc.toggleClass('open');
        $(this).attr('aria-expanded', acc.hasClass('open'));
    });

    /* ============================================================
       STICKY ATC BAR (MOBILE)
       ============================================================ */
    if ($('#gf-sticky-atc').length) {
        var mainBtn = $('.single_add_to_cart_button');
        if (mainBtn.length) {
            $(window).on('scroll', function () {
                var btnOffset = mainBtn.offset().top + mainBtn.outerHeight();
                var scrollTop = $(window).scrollTop() + $(window).height();
                var sticky    = $('#gf-sticky-atc');
                if ($(window).scrollTop() > btnOffset) {
                    sticky.addClass('visible');
                } else {
                    sticky.removeClass('visible');
                }
            });
        }
    }

    /* ============================================================
       VARIANT PILL SELECTOR (VISUAL ENHANCEMENT)
       Override WooCommerce select with pill buttons
       ============================================================ */
    function buildVariantPills() {
        $('.variations select').each(function () {
            var $select  = $(this);
            var $row     = $select.closest('tr');
            var label    = $row.find('label').text().trim();
            var existing = $row.find('.gf-variant-pills');

            if (existing.length) return;

            var $pills = $('<div class="gf-variant-pills"></div>');
            $select.find('option').each(function () {
                var val  = $(this).val();
                var text = $(this).text();
                if (!val) return;
                var $pill = $('<button type="button" class="gf-variant-pill" data-value="' + val + '">' + text + '</button>');
                $pill.on('click', function () {
                    $select.val(val).trigger('change');
                    $pills.find('.gf-variant-pill').removeClass('active');
                    $(this).addClass('active');
                });
                $pills.append($pill);
            });

            $select.hide();
            $select.after($pills);

            // Sync when WooCommerce resets
            $select.on('change', function () {
                var cur = $(this).val();
                $pills.find('.gf-variant-pill').removeClass('active');
                $pills.find('[data-value="' + cur + '"]').addClass('active');
            });
        });
    }

    /* ============================================================
       INIT
       ============================================================ */
    $(document).ready(function () {
        updateWAButton();
        buildVariantPills();
    });

    $(document.body).on('wc_variation_form', function () {
        buildVariantPills();
    });

}(jQuery));
