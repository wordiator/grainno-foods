<?php
/**
 * Template Name: Grainno Homepage
 */
defined('ABSPATH') || exit;

get_header();

$hero_image_id  = get_theme_mod('grainno_hero_image');
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'large') : '';
$hero_sub       = get_theme_mod('grainno_hero_sub', "You eat well but nothing sticks. You work out but nothing tones. Your body needs the right Nigerian food — not lab chemicals.");

$muscle_fuel = get_page_by_path('muscle-fuel-meal', OBJECT, 'product');
$tom_brown   = get_page_by_path('complete-tom-brown', OBJECT, 'product');
?>

<!-- ====================================================
     HERO
     ==================================================== -->
<section class="gf-hero" id="gf-hero">
    <div class="gf-hero__orb gf-hero__orb--1"></div>
    <div class="gf-hero__orb gf-hero__orb--2"></div>
    <div class="gf-hero__orb gf-hero__orb--3"></div>

    <div class="gf-hero__inner">
        <!-- Text column -->
        <div>
            <div class="gf-hero__badge">🇳🇬 Made for Nigerian Bodies</div>

            <h1 class="gf-hero__headline">
                Eat Real Food.
                <span class="line-orange">Build the Body</span>
                <span class="line-green">You Want.</span>
            </h1>

            <p class="gf-hero__sub"><?php echo esc_html($hero_sub); ?></p>

            <div class="gf-hero__ctas">
                <a href="#gf-products" class="gf-btn gf-btn-primary">
                    Shop Now
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#gf-how" class="gf-btn gf-btn-ghost">How It Works</a>
            </div>

            <div class="gf-hero__stats">
                <div>
                    <span class="gf-hero__stat-val">500+</span>
                    <div class="gf-hero__stat-label">Happy customers</div>
                </div>
                <div>
                    <span class="gf-hero__stat-val">0</span>
                    <div class="gf-hero__stat-label">Chemicals used</div>
                </div>
                <div>
                    <span class="gf-hero__stat-val">100%</span>
                    <div class="gf-hero__stat-label">Nigerian ingredients</div>
                </div>
            </div>
        </div>

        <!-- Visual column -->
        <div class="gf-hero__visual">
            <div class="gf-hero__float-badge gf-hero__float-badge--1">
                <span class="dot"></span> NAFDAC Registered
            </div>

            <div class="gf-hero__img-wrap">
                <div class="gf-hero__img-glow"></div>
                <?php if ($hero_image_url) : ?>
                    <img src="<?php echo esc_url($hero_image_url); ?>" alt="Grainno Foods — Real food for Nigerian bodies" loading="eager">
                <?php else : ?>
                    <div class="gf-hero__img-placeholder">
                        <span style="font-size:3rem;">🌾</span>
                        <span>Add hero image in Customizer</span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="gf-hero__float-badge gf-hero__float-badge--2">
                <span style="color:var(--gf-orange)">⭐</span> Real food. Real results.
            </div>
        </div>
    </div>
</section>

<!-- ====================================================
     TRUST BAR
     ==================================================== -->
<div class="gf-trustbar">
    <div class="gf-trustbar__track">
        <span class="gf-trustbar__item"><span class="icon">🇳🇬</span> 100% Nigerian Ingredients</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🚫</span> No Hormones or Chemicals</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">✅</span> NAFDAC Registered</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">📍</span> Made in Port Harcourt</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">💪</span> High Protein Blends</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🛡️</span> Satisfaction Guaranteed</span>
        <span class="gf-trustbar__sep">✦</span>
        <!-- Duplicate for seamless loop -->
        <span class="gf-trustbar__item"><span class="icon">🇳🇬</span> 100% Nigerian Ingredients</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🚫</span> No Hormones or Chemicals</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">✅</span> NAFDAC Registered</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">📍</span> Made in Port Harcourt</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">💪</span> High Protein Blends</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🛡️</span> Satisfaction Guaranteed</span>
        <span class="gf-trustbar__sep">✦</span>
    </div>
</div>

<!-- ====================================================
     PRODUCTS
     ==================================================== -->
<section class="gf-products gf-section" id="gf-products">
    <div class="container">
        <div class="gf-products__header gf-reveal">
            <div class="gf-section__label">Our Products</div>
            <h2 class="gf-section__title">Two Blends. One Goal:<br>Your Best Body.</h2>
            <p class="gf-section__sub">Whether you want lean muscle, healthy weight, or just want to feel strong — we've built a blend for you.</p>
        </div>

        <div class="gf-products__grid">
            <?php
            $products = [
                ['post' => $muscle_fuel, 'modifier' => 'gf-pcard--muscle', 'tag' => 'Muscle Builder', 'pills' => [
                    ['High Protein', 'orange'], ['Lean Mass', 'orange'], ['Nigerian Grain', 'white']
                ]],
                ['post' => $tom_brown, 'modifier' => 'gf-pcard--tom', 'tag' => 'Complete Nutrition', 'pills' => [
                    ['All-In-One', 'green'], ['Natural Energy', 'green'], ['Family Blend', 'white']
                ]],
            ];

            foreach ($products as $pd) :
                $p = $pd['post'];
                if (!$p) continue;
                $wc_product = wc_get_product($p->ID);
                if (!$wc_product) continue;
                $tagline  = get_post_meta($p->ID, '_grainno_tagline', true);
                $img      = get_the_post_thumbnail_url($p->ID, 'medium_large');
                $price    = $wc_product->get_price_html();
                $link     = get_permalink($p->ID);
            ?>
            <article class="gf-pcard <?php echo esc_attr($pd['modifier']); ?> gf-reveal">
                <a href="<?php echo esc_url($link); ?>" class="gf-pcard__img">
                    <?php if ($img) : ?>
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($p->post_title); ?>" loading="lazy">
                    <?php else : ?>
                        <div class="gf-pcard__img-placeholder">
                            <span style="font-size:3rem;">🌾</span>
                            <span>Image coming soon</span>
                        </div>
                    <?php endif; ?>
                    <span class="gf-pcard__tag"><?php echo esc_html($pd['tag']); ?></span>
                </a>

                <div class="gf-pcard__body">
                    <h3 class="gf-pcard__name"><?php echo esc_html($p->post_title); ?></h3>
                    <?php if ($tagline) : ?>
                        <p class="gf-pcard__tagline"><?php echo esc_html($tagline); ?></p>
                    <?php endif; ?>

                    <div class="gf-pcard__pills">
                        <?php foreach ($pd['pills'] as $pill) : ?>
                            <span class="gf-pill gf-pill--<?php echo esc_attr($pill[1]); ?>"><?php echo esc_html($pill[0]); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="gf-pcard__footer">
                        <div class="gf-pcard__price">
                            <span class="gf-pcard__price-from">from</span>
                            <?php echo $price; ?>
                        </div>
                        <a href="<?php echo esc_url($link); ?>" class="gf-btn gf-btn-primary" style="padding:12px 24px;font-size:0.9rem;">
                            Choose Size
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====================================================
     HOW IT WORKS
     ==================================================== -->
<section class="gf-how" id="gf-how">
    <div class="container">
        <div class="gf-reveal">
            <div class="gf-section__label">Why It Works</div>
            <h2 class="gf-section__title">Real Food. Real Results.</h2>
            <p class="gf-section__sub">No shortcuts. No chemicals. Just the right Nigerian ingredients working the way nature intended.</p>
        </div>

        <div class="gf-how__grid">
            <div class="gf-how__card gf-reveal gf-reveal-delay-1">
                <div class="gf-how__num">01</div>
                <div class="gf-how__icon">🌾</div>
                <h3 class="gf-how__title">Nigerian Ingredients Your Body Recognises</h3>
                <p class="gf-how__desc">No foreign chemicals. Just soya, tigernut, dates, peanuts — food your body has known for generations.</p>
            </div>
            <div class="gf-how__card gf-reveal gf-reveal-delay-2">
                <div class="gf-how__num">02</div>
                <div class="gf-how__icon">💪</div>
                <h3 class="gf-how__title">Balanced Macros — Not Empty Calories</h3>
                <p class="gf-how__desc">High protein for muscle and curves. Healthy carbs for energy. Good fats for hormones. The full package.</p>
            </div>
            <div class="gf-how__card gf-reveal gf-reveal-delay-3">
                <div class="gf-how__num">03</div>
                <div class="gf-how__icon">🚫</div>
                <h3 class="gf-how__title">No Chemicals. No Hormones. No Fake Stuff.</h3>
                <p class="gf-how__desc">We refuse to put anything in our blends that we wouldn't feed our own families. Full stop.</p>
            </div>
            <div class="gf-how__card gf-reveal gf-reveal-delay-4">
                <div class="gf-how__num">04</div>
                <div class="gf-how__icon">🥣</div>
                <h3 class="gf-how__title">Just Mix, Drink, and Eat Normally</h3>
                <p class="gf-how__desc">No complicated routine. Add to your regular meals. Works alongside your normal Nigerian diet.</p>
            </div>
        </div>
    </div>
</section>

<!-- ====================================================
     TESTIMONIALS
     ==================================================== -->
<section class="gf-testimonials gf-section" id="gf-trust">
    <div class="container">
        <div class="gf-reveal" style="text-align:center;">
            <div class="gf-section__label">Real Nigerians. Real Results.</div>
            <h2 class="gf-section__title">They Said What We Couldn't</h2>
        </div>

        <div class="gf-testimonials__grid">
            <div class="gf-tcard gf-reveal gf-reveal-delay-1">
                <div class="gf-tcard__stars">⭐⭐⭐⭐⭐</div>
                <p class="gf-tcard__quote">I don't have hips — I'm just straight, no shape. After two months on Muscle Fuel, my clothes started fitting different. My aunty asked me what I was eating.</p>
                <div class="gf-tcard__author">
                    <div class="gf-tcard__avatar">AO</div>
                    <div>
                        <div class="gf-tcard__name">Amara O.</div>
                        <div class="gf-tcard__city">Port Harcourt</div>
                    </div>
                </div>
            </div>

            <div class="gf-tcard gf-reveal gf-reveal-delay-2">
                <div class="gf-tcard__stars">⭐⭐⭐⭐⭐</div>
                <p class="gf-tcard__quote">I eat and nothing sticks — my body just burns everything. I tried Complete Tom Brown for six weeks. I actually started filling out. My face changed first.</p>
                <div class="gf-tcard__author">
                    <div class="gf-tcard__avatar">CM</div>
                    <div>
                        <div class="gf-tcard__name">Chinedu M.</div>
                        <div class="gf-tcard__city">Lagos</div>
                    </div>
                </div>
            </div>

            <div class="gf-tcard gf-reveal gf-reveal-delay-3">
                <div class="gf-tcard__stars">⭐⭐⭐⭐⭐</div>
                <p class="gf-tcard__quote">I just want something natural — no chemicals, no side effects. I've tried everything and nothing was working until this. I feel healthy, not just heavy.</p>
                <div class="gf-tcard__author">
                    <div class="gf-tcard__avatar">FA</div>
                    <div>
                        <div class="gf-tcard__name">Fatima A.</div>
                        <div class="gf-tcard__city">Abuja</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gf-badges gf-reveal">
            <div class="gf-badge"><span class="icon">🇳🇬</span> 100% Nigerian Ingredients</div>
            <div class="gf-badge"><span class="icon">🚫</span> No Hormones or Chemicals</div>
            <div class="gf-badge"><span class="icon">✅</span> NAFDAC Registered</div>
            <div class="gf-badge"><span class="icon">📍</span> Made in Port Harcourt</div>
            <div class="gf-badge"><span class="icon">⭐</span> Real Food. Real Results.</div>
        </div>
    </div>
</section>

<!-- ====================================================
     GUARANTEE
     ==================================================== -->
<section class="gf-guarantee gf-reveal">
    <div class="container">
        <div class="gf-guarantee__inner">
            <div class="gf-guarantee__icon">🛡️</div>
            <h2 class="gf-guarantee__title">Our Promise to You</h2>
            <p class="gf-guarantee__text">If you experience any negative reaction after using our products, we'll refund you in full — no long questions asked. We stand behind everything we put in our blends.</p>
            <a href="#gf-products" class="gf-btn gf-btn-primary">Order Now via WhatsApp</a>
        </div>
    </div>
</section>

<!-- ====================================================
     FOOTER
     ==================================================== -->
<footer class="gf-footer">
    <div class="container">
        <div class="gf-footer__grid">
            <div>
                <div class="gf-footer__logo">Grainno<span>.</span></div>
                <p class="gf-footer__about">High-protein grain-based meal blends made for Nigerian bodies. Real food. Real results. No chemicals. Port Harcourt, Nigeria.</p>
                <div class="gf-footer__social">
                    <a href="https://wa.me/<?php echo GRAINNO_WHATSAPP; ?>" target="_blank" rel="noopener" aria-label="WhatsApp">💬</a>
                    <a href="#" aria-label="Instagram">📸</a>
                    <a href="#" aria-label="Facebook">👍</a>
                </div>
            </div>

            <div>
                <div class="gf-footer__col-label">Shop</div>
                <ul class="gf-footer__links">
                    <?php if ($muscle_fuel) : ?>
                        <li><a href="<?php echo esc_url(get_permalink($muscle_fuel)); ?>">Muscle Fuel Meal</a></li>
                    <?php endif; ?>
                    <?php if ($tom_brown) : ?>
                        <li><a href="<?php echo esc_url(get_permalink($tom_brown)); ?>">Complete Tom Brown</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo esc_url(wc_get_cart_url()); ?>">Cart</a></li>
                </ul>
            </div>

            <div>
                <div class="gf-footer__col-label">Contact</div>
                <ul class="gf-footer__links">
                    <li><a href="https://wa.me/<?php echo GRAINNO_WHATSAPP; ?>" target="_blank" rel="noopener">💬 Chat on WhatsApp</a></li>
                    <li><a href="https://wa.me/<?php echo GRAINNO_WHATSAPP; ?>" target="_blank" rel="noopener">Place an Order</a></li>
                    <li><a href="https://wa.me/<?php echo GRAINNO_WHATSAPP; ?>" target="_blank" rel="noopener">Customer Support</a></li>
                </ul>
            </div>
        </div>

        <div class="gf-footer__bottom">
            <span>© <?php echo date('Y'); ?> Grainno Foods. Made with 🧡 for Nigerian bodies.</span>
            <span>Port Harcourt, Nigeria</span>
        </div>
    </div>
</footer>

<?php get_footer(); ?>
