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
       SCROLL REVEAL (INTERSECTION OBSERVER)
       ============================================================ */
    function initReveal() {
        var selectors = '.gf-reveal, .fade-up';
        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll(selectors).forEach(function (el) {
                el.classList.add('visible');
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll(selectors).forEach(function (el) {
            observer.observe(el);
        });
    }

    /* ============================================================
       FLOATING CART TOGGLE
       ============================================================ */
    $(document).on('click', '#gf-cart-toggle', function (e) {
        e.stopPropagation();
        $('#gf-cart-panel').toggleClass('open');
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
    $(document.body).on('added_to_cart', function () {
        setTimeout(function () {
            $('#gf-cart-panel').addClass('open');
        }, 300);

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
    $(document).on('click', '.gf-accordion__btn', function () {
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
                $('#gf-sticky-atc').toggleClass('visible', $(window).scrollTop() > btnOffset);
            });
        }
    }

    /* ============================================================
       VARIANT PILL SELECTOR
       Replace WooCommerce dropdowns with visual pill buttons
       ============================================================ */
    function buildVariantPills() {
        $('.variations select').each(function () {
            var $select = $(this);
            var $row    = $select.closest('tr');

            if ($row.find('.gf-variant-pills').length) return;

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

            $select.hide().after($pills);

            $select.on('change', function () {
                var cur = $(this).val();
                $pills.find('.gf-variant-pill').removeClass('active');
                $pills.find('[data-value="' + cur + '"]').addClass('active');
            });
        });
    }

    /* ============================================================
       FLIP CARDS
       ============================================================ */
    $(document).on('click', '.gf-flip__hint', function (e) {
        e.stopPropagation();
        var flipId = $(this).data('flip-id');
        if (flipId) { $('#' + flipId).addClass('flipped'); }
    });

    $(document).on('click', '.gf-flip__back-close', function (e) {
        e.stopPropagation();
        $(this).closest('.gf-flip').removeClass('flipped');
    });

    $(document).on('click', '.gf-flip__back-actions .gf-btn', function (e) {
        e.stopPropagation(); // let link navigate, don't flip back
    });

    /* Size pill active state + price update */
    $(document).on('click', '.gf-flip__size', function () {
        $(this).siblings('.gf-flip__size').removeClass('active');
        $(this).addClass('active');
        var price = $(this).data('price');
        if (price) {
            $(this).closest('.gf-flip__body').find('.gf-flip__price').text('₦' + price);
        }
    });

    /* ============================================================
       TOAST
       ============================================================ */
    function showToast(msg, duration) {
        var $toast = $('#gf-toast');
        $toast.text(msg).addClass('show');
        setTimeout(function () { $toast.removeClass('show'); }, duration || 2800);
    }
    window.grainnoToast = showToast;

    /* Show toast on add to cart */
    $(document.body).on('added_to_cart', function () {
        showToast('Added to cart!');
    });

    /* ============================================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================================ */
    $(document).on('click', 'a[href^="#"]', function (e) {
        var target = $($(this).attr('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: target.offset().top - 80 }, 600);
        }
    });

    /* ============================================================
       INIT
       ============================================================ */
    $(document).ready(function () {
        initReveal();
        updateWAButton();
        buildVariantPills();
    });

    /* Reset any horizontal scroll the compositor allows despite overflow-x:hidden */
    window.addEventListener('scroll', function () {
        if (window.scrollX !== 0) {
            window.scrollTo(0, window.scrollY);
        }
    });

    $(document.body).on('wc_variation_form', function () {
        buildVariantPills();
    });

}(jQuery));
