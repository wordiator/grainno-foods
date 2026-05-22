<?php
/**
 * Template Name: Grainno Homepage
 */
defined('ABSPATH') || exit;

get_header();

$hero_image_id  = get_theme_mod('grainno_hero_image');
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'large') : get_stylesheet_directory_uri() . '/assets/img/hero-placeholder.jpg';
$hero_headline  = get_theme_mod('grainno_hero_headline', 'Eat Real Food. Build the Body You Want.');
$hero_sub       = get_theme_mod('grainno_hero_sub', "You eat well but nothing sticks. You work out but nothing tones. Your body needs the right Nigerian food — not lab chemicals.");

// Fetch the two products
$muscle_fuel  = get_page_by_path('muscle-fuel-meal', OBJECT, 'product');
$tom_brown    = get_page_by_path('complete-tom-brown', OBJECT, 'product');
?>

<!-- ====================================================
     HERO
     ==================================================== -->
<section class="gf-hero-wrap" style="background:var(--gf-black);overflow:hidden;">
    <div class="gf-hero">
        <div class="gf-hero__text">
            <div class="gf-hero__badge">🇳🇬 Made for Nigerian Bodies</div>
            <h1 class="gf-hero__headline">
                <?php
                $parts = explode('.', $hero_headline, 2);
                echo esc_html($parts[0]) . '.';
                if (!empty($parts[1])) {
                    echo '<br><span>' . esc_html(ltrim($parts[1])) . '</span>';
                }
                ?>
            </h1>
            <p class="gf-hero__sub"><?php echo esc_html($hero_sub); ?></p>
            <div class="gf-hero__ctas">
                <a href="#gf-products" class="btn-primary">
                    Shop Now
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#gf-how" class="btn-secondary">How It Works</a>
            </div>
        </div>
        <div class="gf-hero__image">
            <?php if ($hero_image_url) : ?>
                <img src="<?php echo esc_url($hero_image_url); ?>" alt="Grainno Foods" loading="eager">
            <?php else : ?>
                <div style="aspect-ratio:4/3;background:var(--gf-dark-card);border-radius:20px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.2);font-size:0.9rem;">Add hero image in Customizer</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ====================================================
     PRODUCTS
     ==================================================== -->
<section class="gf-products-section" id="gf-products">
    <div class="container">
        <div class="gf-section-header">
            <span class="gf-section-label">Our Products</span>
            <h2 class="gf-section-title">Two Blends. One Goal: Your Best Body.</h2>
        </div>

        <div class="gf-products-grid">
            <?php
            $products = [$muscle_fuel, $tom_brown];
            foreach ($products as $p) :
                if (!$p) continue;
                $wc_product = wc_get_product($p->ID);
                if (!$wc_product) continue;
                $tagline    = get_post_meta($p->ID, '_grainno_tagline', true);
                $img        = get_the_post_thumbnail_url($p->ID, 'medium_large');
                $price      = $wc_product->get_price_html();
                $link       = get_permalink($p->ID);
                $cats       = wp_get_post_terms($p->ID, 'product_cat');
                $cat_name   = !empty($cats) ? $cats[0]->name : '';
            ?>
            <article class="gf-product-card">
                <a href="<?php echo esc_url($link); ?>" class="gf-product-card__image">
                    <?php if ($img) : ?>
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($p->post_title); ?>" loading="lazy">
                    <?php else : ?>
                        <div style="aspect-ratio:4/3;background:#111;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.2);font-size:0.85rem;">No image yet</div>
                    <?php endif; ?>
                </a>
                <div class="gf-product-card__body">
                    <?php if ($cat_name) : ?>
                        <div class="gf-product-card__category"><?php echo esc_html($cat_name); ?></div>
                    <?php endif; ?>
                    <h3 class="gf-product-card__name">
                        <a href="<?php echo esc_url($link); ?>" style="color:inherit;"><?php echo esc_html($p->post_title); ?></a>
                    </h3>
                    <?php if ($tagline) : ?>
                        <p class="gf-product-card__tagline"><?php echo esc_html($tagline); ?></p>
                    <?php endif; ?>
                    <div class="gf-benefit-pills">
                        <span class="gf-pill">High Protein</span>
                        <span class="gf-pill">Nigerian Ingredients</span>
                        <span class="gf-pill">No Chemicals</span>
                    </div>
                    <div class="gf-product-card__price">
                        <span class="from">from </span><?php echo $price; ?>
                    </div>
                    <a href="<?php echo esc_url($link); ?>" class="btn-primary" style="width:100%;justify-content:center;">
                        Choose Size
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====================================================
     HOW IT WORKS
     ==================================================== -->
<section class="gf-how-section" id="gf-how">
    <div class="container">
        <div class="gf-section-header">
            <span class="gf-section-label">Why It Works</span>
            <h2 class="gf-section-title">Real Food. Real Results.</h2>
        </div>
        <div class="gf-steps-grid">
            <div class="gf-step">
                <div class="gf-step__icon">🌾</div>
                <h3 class="gf-step__title">Nigerian Ingredients Your Body Recognises</h3>
                <p class="gf-step__desc">No foreign chemicals. Just soya, tigernut, dates, peanuts — food your body has known for generations.</p>
            </div>
            <div class="gf-step">
                <div class="gf-step__icon">💪</div>
                <h3 class="gf-step__title">Balanced Macros — Not Empty Calories</h3>
                <p class="gf-step__desc">High protein for muscle and curves. Healthy carbs for energy. Good fats for hormones. The full package.</p>
            </div>
            <div class="gf-step">
                <div class="gf-step__icon">🚫</div>
                <h3 class="gf-step__title">No Chemicals. No Hormones. No Fake Stuff.</h3>
                <p class="gf-step__desc">We refuse to put anything in our blends that we wouldn't feed our own families. Full stop.</p>
            </div>
            <div class="gf-step">
                <div class="gf-step__icon">🥣</div>
                <h3 class="gf-step__title">Just Mix, Drink, and Eat Normally</h3>
                <p class="gf-step__desc">No complicated routine. Add to your regular meals. Works alongside your normal Nigerian diet.</p>
            </div>
        </div>
    </div>
</section>

<!-- ====================================================
     TESTIMONIALS / TRUST
     ==================================================== -->
<section class="gf-trust-section" id="gf-trust">
    <div class="container">
        <div class="gf-section-header">
            <span class="gf-section-label">Real Nigerians. Real Results.</span>
            <h2 class="gf-section-title">They Said What We Couldn't</h2>
        </div>

        <div class="gf-testimonials-grid">
            <div class="gf-testimonial">
                <p class="gf-testimonial__quote">I don't have hips — I'm just straight, no shape. After two months on Muscle Fuel, my clothes started fitting different. My aunty asked me what I was eating.</p>
                <div class="gf-testimonial__author">Amara O.</div>
                <div class="gf-testimonial__location">Port Harcourt</div>
            </div>
            <div class="gf-testimonial">
                <p class="gf-testimonial__quote">I eat and nothing sticks — my body just burns everything. I tried Complete Tom Brown for six weeks. I actually started filling out. My face changed first.</p>
                <div class="gf-testimonial__author">Chinedu M.</div>
                <div class="gf-testimonial__location">Lagos</div>
            </div>
            <div class="gf-testimonial">
                <p class="gf-testimonial__quote">I just want something natural — no chemicals, no side effects. I've tried everything and nothing was working until this. I feel healthy, not just heavy.</p>
                <div class="gf-testimonial__author">Fatima A.</div>
                <div class="gf-testimonial__location">Abuja</div>
            </div>
        </div>

        <div class="gf-trust-badges">
            <div class="gf-badge"><span>🇳🇬</span> 100% Nigerian Ingredients</div>
            <div class="gf-badge"><span>🚫</span> No Hormones or Chemicals</div>
            <div class="gf-badge"><span>✅</span> NAFDAC Registered</div>
            <div class="gf-badge"><span>📍</span> Made in Port Harcourt</div>
            <div class="gf-badge"><span>⭐</span> Real Food. Real Results.</div>
        </div>
    </div>
</section>

<!-- ====================================================
     GUARANTEE
     ==================================================== -->
<section class="gf-guarantee-section">
    <div class="gf-guarantee-inner">
        <div class="gf-guarantee-icon">🛡️</div>
        <h2 class="gf-guarantee-title">Our Promise to You</h2>
        <p class="gf-guarantee-text">If you experience any negative reaction after using our products, we'll refund you in full — no long questions asked. We stand behind everything we put in our blends.</p>
        <div style="margin-top:32px;">
            <a href="#gf-products" class="btn-primary">Order Now via WhatsApp</a>
        </div>
    </div>
</section>

<!-- ====================================================
     FOOTER
     ==================================================== -->
<footer class="gf-footer">
    <div class="gf-footer__inner">
        <div>
            <div class="gf-footer__brand-name">Grainno Foods</div>
            <p class="gf-footer__tagline">High-protein grain-based meal blends made for Nigerian bodies. Real food. Real results. Port Harcourt, Nigeria.</p>
        </div>
        <div>
            <div class="gf-footer__col-title">Shop</div>
            <ul class="gf-footer__links">
                <li><a href="<?php echo esc_url(get_permalink($muscle_fuel)); ?>">Muscle Fuel Meal</a></li>
                <li><a href="<?php echo esc_url(get_permalink($tom_brown)); ?>">Complete Tom Brown</a></li>
                <li><a href="<?php echo esc_url(wc_get_cart_url()); ?>">Cart</a></li>
            </ul>
        </div>
        <div>
            <div class="gf-footer__col-title">Contact</div>
            <ul class="gf-footer__links">
                <li><a href="https://wa.me/<?php echo GRAINNO_WHATSAPP; ?>" target="_blank" rel="noopener">💬 Chat on WhatsApp</a></li>
                <li><a href="https://wa.me/<?php echo GRAINNO_WHATSAPP; ?>" target="_blank" rel="noopener">Place an Order</a></li>
            </ul>
        </div>
    </div>
    <div class="gf-footer__bottom">
        <span>© <?php echo date('Y'); ?> Grainno Foods. Made with 🧡 for Nigerian bodies.</span>
        <span>Port Harcourt, Nigeria</span>
    </div>
</footer>

<?php get_footer(); ?>
