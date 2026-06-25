<?php
/**
 * Template Name: Grainno Homepage
 */
defined('ABSPATH') || exit;

get_header();

$hero_image_id  = get_theme_mod('grainno_hero_image');
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'large') : '';
$static_img_dir = get_stylesheet_directory_uri() . '/assets/images';
$hero_sub       = get_theme_mod('grainno_hero_sub', "Greek god shoulders, six packs, and figure-8 curves start in your kitchen, not on the gym floor.");

function grainno_find_product($slug, $title_fallback) {
    $p = get_page_by_path($slug, OBJECT, 'product');
    if (!$p) {
        $results = get_posts(['post_type' => 'product', 'posts_per_page' => 1,
            'post_status' => 'publish', 's' => $title_fallback]);
        $p = !empty($results) ? $results[0] : null;
    }
    return $p;
}

function grainno_get_product_data($p, $defaults) {
    if ($p) {
        $wc = wc_get_product($p->ID);
        if ($wc) {
            $ingredients = get_post_meta($p->ID, '_grainno_ingredients', true);
            return array_merge($defaults, [
                'id'          => $p->ID,
                'title'       => $p->post_title,
                'tagline'     => get_post_meta($p->ID, '_grainno_tagline', true) ?: $defaults['tagline'],
                'protein'     => get_post_meta($p->ID, '_grainno_protein', true),
                'calories'    => get_post_meta($p->ID, '_grainno_calories', true),
                'carbs'       => get_post_meta($p->ID, '_grainno_carbs', true),
                'fat'         => get_post_meta($p->ID, '_grainno_fat', true),
                'ingredients' => $ingredients ? array_map('trim', explode(',', $ingredients)) : $defaults['ingredients'],
                'description' => get_post_field('post_content', $p->ID),
                'img'         => get_the_post_thumbnail_url($p->ID, 'large'),
                'img_med'     => get_the_post_thumbnail_url($p->ID, 'medium_large'),
                'link'        => get_permalink($p->ID),
                'price'       => $wc->get_price_html(),
                'live'        => true,
            ]);
        }
    }
    return $defaults;
}

$mf_post  = grainno_find_product('muscle-fuel-meal', 'Muscle Fuel');
$tb_post  = grainno_find_product('complete-tom-brown', 'Tom Brown');
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop/';

$mf = grainno_get_product_data($mf_post, [
    'id'          => 0,
    'title'       => 'Muscle Fuel Meal',
    'tagline'     => 'High-protein grain blend for lean muscle, healthy weight gain, and growing curves in the right places.',
    'protein'     => '28g',
    'calories'    => '380kcal',
    'carbs'       => '42g',
    'fat'         => '8g',
    'ingredients' => ['Soyabeans', 'Oats', 'Dates', 'Peanut', 'Tigernut'],
    'description' => '',
    'img'         => '',
    'img_med'     => '',
    'link'        => $shop_url,
    'price'       => '',
    'live'        => false,
]);

$tb = grainno_get_product_data($tb_post, [
    'id'          => 0,
    'title'       => 'Complete Diet TomBrown',
    'tagline'     => 'All-in-one Nigerian meal blend for balanced nutrition, energy, and whole-family nourishment. 13 natural ingredients, zero chemicals.',
    'protein'     => '22g',
    'calories'    => '360kcal',
    'carbs'       => '48g',
    'fat'         => '9g',
    'ingredients' => ['Dates', 'Tigernut', 'Plantain', 'Millet', 'Maize'],
    'description' => '',
    'img'         => '',
    'img_med'     => '',
    'link'        => $shop_url,
    'price'       => '',
    'live'        => false,
]);

$mf_ings = [
    ['name' => 'Soyabeans',   'pct' => 32  ],
    ['name' => 'Oats',        'pct' => 26  ],
    ['name' => 'Dates',       'pct' => 12  ],
    ['name' => 'Peanut',      'pct' => 9.1 ],
    ['name' => 'Tigernut',    'pct' => 6   ],
    ['name' => 'Cashew',      'pct' => 4.5 ],
    ['name' => 'Almond',      'pct' => 4.5 ],
    ['name' => 'Potato',      'pct' => 3   ],
    ['name' => 'Maca',        'pct' => 1.5 ],
    ['name' => 'Chia',        'pct' => 0.8 ],
    ['name' => 'Fenugreek',   'pct' => 0.8 ],
    ['name' => 'Flax',        'pct' => 0.8 ],
    ['name' => 'Sesame',      'pct' => 0.8 ],
];

$tb_ings = [
    ['name' => 'Dates',       'pct' => 17.7],
    ['name' => 'Tigernut',    'pct' => 15  ],
    ['name' => 'Plantain',    'pct' => 9   ],
    ['name' => 'Millet',      'pct' => 8   ],
    ['name' => 'Maize',       'pct' => 8   ],
    ['name' => 'Oats',        'pct' => 8   ],
    ['name' => 'Peanut',      'pct' => 8   ],
    ['name' => 'Guinea Corn', 'pct' => 6   ],
    ['name' => 'Potato',      'pct' => 6   ],
    ['name' => 'Cashew',      'pct' => 6   ],
    ['name' => 'Soyabeans',   'pct' => 6   ],
    ['name' => 'Wheat',       'pct' => 4   ],
    ['name' => 'Ginger',      'pct' => 0.3 ],
];

$wa_number = get_option('grainno_whatsapp_number', GRAINNO_WHATSAPP);
$mf_wa_url = 'https://wa.me/' . $wa_number . '?text=' . rawurlencode("Hello Grainno Foods! I'd like to order the Muscle Fuel Meal. Please share available sizes and prices.");
$tb_wa_url = 'https://wa.me/' . $wa_number . '?text=' . rawurlencode("Hello Grainno Foods! I'd like to order the Complete TomBrown. Please share available sizes and prices.");
?>

<!-- ====================================================
     HERO (unchanged)
     ==================================================== -->
<section class="gf-hero" id="gf-hero">
    <div class="gf-hero__orb gf-hero__orb--1"></div>
    <div class="gf-hero__orb gf-hero__orb--2"></div>
    <div class="gf-hero__orb gf-hero__orb--3"></div>

    <div class="gf-hero__inner">
        <div>
            <div class="gf-hero__badge">🇳🇬 Your No. 1 Healthy Good Plug</div>
            <h1 class="gf-hero__headline">
                Eat Right.
                <span class="line-orange">Build the Body</span>
                <span class="line-green">You Want.</span>
            </h1>
            <div class="gf-hero__visual--mobile">
                <div class="gf-hero__img-wrap">
                    <div class="gf-hero__img-glow"></div>
                    <?php if ($hero_image_url) : ?>
                        <img src="<?php echo esc_url($hero_image_url); ?>" alt="Grainno Foods" loading="eager">
                    <?php else : ?>
                        <picture>
                            <source srcset="<?php echo esc_url($static_img_dir . '/hero.webp'); ?>" type="image/webp">
                            <img src="<?php echo esc_url($static_img_dir . '/hero.png'); ?>" alt="Grainno Foods" loading="eager">
                        </picture>
                    <?php endif; ?>
                </div>
            </div>
            <p class="gf-hero__sub"><?php echo esc_html($hero_sub); ?></p>
            <div class="gf-hero__ctas">
                <a href="#gf-products" class="gf-btn gf-btn-primary">
                    Shop Now
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#gf-why" class="gf-btn gf-btn-ghost">What Makes Us Different?</a>
            </div>
            <div class="gf-hero__stats">
                <div>
                    <span class="gf-hero__stat-val">98%</span>
                    <div class="gf-hero__stat-label">Research-Based Processing</div>
                </div>
                <div>
                    <span class="gf-hero__stat-val">0</span>
                    <div class="gf-hero__stat-label">Preservatives</div>
                </div>
                <div>
                    <span class="gf-hero__stat-val">100%</span>
                    <div class="gf-hero__stat-label">Natural ingredients</div>
                </div>
            </div>
        </div>

        <div class="gf-hero__visual gf-hero__visual--desktop">
            <div class="gf-hero__float-badge gf-hero__float-badge--1">
                <span class="dot"></span> Properly Processed
            </div>
            <div class="gf-hero__img-wrap">
                <div class="gf-hero__img-glow"></div>
                <?php if ($hero_image_url) : ?>
                    <img src="<?php echo esc_url($hero_image_url); ?>" alt="Grainno Foods — Real food for Nigerian bodies" loading="eager">
                <?php else : ?>
                    <picture>
                        <source srcset="<?php echo esc_url($static_img_dir . '/hero.webp'); ?>" type="image/webp">
                        <img src="<?php echo esc_url($static_img_dir . '/hero.png'); ?>" alt="Grainno Foods — Real food for Nigerian bodies" loading="eager">
                    </picture>
                <?php endif; ?>
            </div>
            <div class="gf-hero__float-badge gf-hero__float-badge--2">
                <span style="color:var(--gf-orange)">⭐</span> No Bloating After Consumption
            </div>
        </div>
    </div>
</section>

<!-- ====================================================
     TRUST BAR
     ==================================================== -->
<div class="gf-trustbar">
    <div class="gf-trustbar__track">
        <span class="gf-trustbar__item"><span class="icon">🌿</span> 100% Natural Ingredients</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🚫</span> No Hormones or Chemicals</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🌙</span> Maca Root for Curves</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">📍</span> Made in Port Harcourt</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">💪</span> High Protein Blends</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🛡️</span> Satisfaction Guaranteed</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🌿</span> 100% Natural Ingredients</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🚫</span> No Hormones or Chemicals</span>
        <span class="gf-trustbar__sep">✦</span>
        <span class="gf-trustbar__item"><span class="icon">🌙</span> Maca Root for Curves</span>
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
     WHY GRAINNO FOODS
     ==================================================== -->
<section class="gf-why" id="gf-why">
    <div class="container">

        <div class="gf-why__header gf-reveal">
            <div class="gf-section__label gf-section__label--brown">Not Your Regular Food Processing Vendor</div>
            <h2 class="gf-why__title">With Our Products You Get All Of The<br><em>Nutrients, None Of The Discomforts.</em></h2>
            <p class="gf-why__sub">Every step of our process is painstakingly designed to ensure proper digestion without food poisoning. Safe for babies above 6 months.</p>
        </div>

        <div class="gf-why__grid">
            <div class="gf-why__card gf-reveal gf-reveal-delay-1">
                <span class="gf-why__icon">🧫</span>
                <h3>Fermented &amp; Re-Dried</h3>
                <p>Our grains are soaked, fermented, and carefully re-dried. This process reduces anti-nutrients and makes the food easier for your body to absorb.</p>
                <span class="gf-why__badge">Science-backed</span>
            </div>
            <div class="gf-why__card gf-reveal gf-reveal-delay-2">
                <span class="gf-why__icon">⚡</span>
                <h3>Higher Bioavailability</h3>
                <p>Fermentation breaks down phytic acid, which normally blocks nutrient absorption. With our properly fermented products, you're getting optimal nutrition per spoon.</p>
                <span class="gf-why__badge">Clinically proven</span>
            </div>
            <div class="gf-why__card gf-reveal gf-reveal-delay-3">
                <span class="gf-why__icon">⚖️</span>
                <h3>Intentional Proportions</h3>
                <p>Every ingredient has a purpose and a precise ratio. Nothing is added for bulk. Everything is added in the right amount the body needs.</p>
                <span class="gf-why__badge">Precision formulated</span>
            </div>
            <div class="gf-why__card gf-reveal gf-reveal-delay-4">
                <span class="gf-why__icon">🇳🇬</span>
                <h3>Natural Ingredients</h3>
                <p>We use only natural ingredients sourced from trusted vendors. There's no preservative or chemicals added.</p>
                <span class="gf-why__badge">Locally sourced</span>
            </div>
        </div>

    </div>
</section>

<!-- ====================================================
     PRODUCTS — FLIP CARDS
     ==================================================== -->
<section class="gf-products" id="gf-products">
    <div class="container">

        <div class="gf-products__header gf-reveal">
            <div class="gf-section__label">Our Products</div>
            <h2 class="gf-section__title" style="text-align:center;">
                <span style="display:block;">For the guys who want to <span style="color:var(--gf-orange)">build real muscle.</span></span>
                <span style="display:block;">For the girls who want <span style="color:var(--gf-green)">curves without the belly fat.</span></span>
            </h2>
            <p class="gf-section__sub">Flip any card to see the ingredients in each product.</p>
        </div>

        <div class="gf-products__grid gf-flip-grid">

            <!-- ── MUSCLE FUEL ── -->
            <div class="gf-flip gf-reveal gf-reveal-delay-1" id="gf-flip-mf">
                <div class="gf-flip__inner">

                    <!-- Front -->
                    <div class="gf-flip__front">
                        <div class="gf-flip__img-area">
                            <?php if ($mf['img_med']) : ?>
                                <img src="<?php echo esc_url($mf['img_med']); ?>" alt="<?php echo esc_attr($mf['title']); ?>" loading="lazy">
                            <?php else : ?>
                                <picture>
                                    <source srcset="<?php echo esc_url($static_img_dir . '/muscle-fuel.webp'); ?>" type="image/webp">
                                    <img src="<?php echo esc_url($static_img_dir . '/muscle-fuel.png'); ?>" alt="<?php echo esc_attr($mf['title']); ?>" loading="lazy">
                                </picture>
                            <?php endif; ?>
                            <span class="gf-flip__tag gf-flip__tag--orange">High Protein</span>
                        </div>
                        <div class="gf-flip__body">
                            <h3 class="gf-flip__name"><?php echo esc_html($mf['title']); ?></h3>
                            <p class="gf-flip__tagline"><?php echo esc_html($mf['tagline']); ?></p>
                            <div class="gf-flip__macros-mini">
                                <span class="gf-flip__macro-chip"><?php echo esc_html($mf['protein']); ?> Protein</span>
                                <span class="gf-flip__macro-chip"><?php echo esc_html($mf['calories']); ?></span>
                                <span class="gf-flip__macro-chip">per 100g</span>
                            </div>
                            <div class="gf-flip__price">₦6,000</div>
                            <div class="gf-flip__size-row">
                                <button class="gf-flip__size active" data-price="6,000">500g</button>
                                <button class="gf-flip__size" data-price="10,000">1kg</button>
                            </div>
                            <div class="gf-flip__actions">
                                <a href="<?php echo esc_url($mf['link']); ?>" class="gf-btn gf-btn-primary gf-flip__cta">
                                    Get Yours
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                                <button class="gf-flip__hint" data-flip-id="gf-flip-mf">Ingredients ↻</button>
                            </div>
                        </div>
                    </div>

                    <!-- Back -->
                    <div class="gf-flip__back">
                        <div class="gf-flip__back-header">
                            <div class="gf-flip__back-title">Ingredient Breakdown</div>
                            <div class="gf-flip__back-sub">Muscle Fuel Meal · 13 ingredients</div>
                        </div>
                        <div class="gf-flip__ing-list">
                            <?php foreach ($mf_ings as $ing) : ?>
                                <div class="gf-flip__ing-item">
                                    <div class="gf-flip__ing-top">
                                        <span><?php echo esc_html($ing['name']); ?></span>
                                        <span><?php echo $ing['pct']; ?>%</span>
                                    </div>
                                    <div class="gf-flip__ing-bar">
                                        <div class="gf-flip__ing-fill" style="width:<?php echo $ing['pct']; ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gf-flip__back-actions">
                            <a href="<?php echo esc_url($mf_wa_url); ?>" class="gf-btn gf-btn-primary" style="width:100%;justify-content:center;" target="_blank" rel="noopener">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Order via WhatsApp
                            </a>
                            <button class="gf-flip__back-close" data-flip-close="gf-flip-mf">← Back to Product</button>
                        </div>
                    </div>

                </div>
            </div><!-- /gf-flip-mf -->

            <!-- ── COMPLETE TOM BROWN ── -->
            <div class="gf-flip gf-flip--tom gf-reveal gf-reveal-delay-2" id="gf-flip-tb">
                <div class="gf-flip__inner">

                    <!-- Front -->
                    <div class="gf-flip__front">
                        <div class="gf-flip__img-area">
                            <?php if ($tb['img_med']) : ?>
                                <img src="<?php echo esc_url($tb['img_med']); ?>" alt="<?php echo esc_attr($tb['title']); ?>" loading="lazy">
                            <?php else : ?>
                                <picture>
                                    <source srcset="<?php echo esc_url($static_img_dir . '/tombrown.webp'); ?>" type="image/webp">
                                    <img src="<?php echo esc_url($static_img_dir . '/tombrown.png'); ?>" alt="<?php echo esc_attr($tb['title']); ?>" loading="lazy">
                                </picture>
                            <?php endif; ?>
                            <span class="gf-flip__tag gf-flip__tag--green">Complete Nutrition</span>
                        </div>
                        <div class="gf-flip__body">
                            <h3 class="gf-flip__name"><?php echo esc_html($tb['title']); ?></h3>
                            <p class="gf-flip__tagline"><?php echo esc_html($tb['tagline']); ?></p>
                            <div class="gf-flip__macros-mini">
                                <span class="gf-flip__macro-chip"><?php echo esc_html($tb['protein']); ?> Protein</span>
                                <span class="gf-flip__macro-chip"><?php echo esc_html($tb['calories']); ?></span>
                                <span class="gf-flip__macro-chip">per 100g</span>
                            </div>
                            <div class="gf-flip__price">₦6,000</div>
                            <div class="gf-flip__size-row">
                                <button class="gf-flip__size active" data-price="6,000">500g</button>
                                <button class="gf-flip__size" data-price="10,000">1kg</button>
                            </div>
                            <div class="gf-flip__actions">
                                <a href="<?php echo esc_url($tb['link']); ?>" class="gf-btn gf-btn-green gf-flip__cta" style="padding:13px 24px;font-size:0.9rem;flex:1;">
                                    Get Yours
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                                <button class="gf-flip__hint" data-flip-id="gf-flip-tb">Ingredients ↻</button>
                            </div>
                        </div>
                    </div>

                    <!-- Back -->
                    <div class="gf-flip__back">
                        <div class="gf-flip__back-header">
                            <div class="gf-flip__back-title">Ingredient Breakdown</div>
                            <div class="gf-flip__back-sub">Complete Diet TomBrown · 13 ingredients</div>
                        </div>
                        <div class="gf-flip__ing-list">
                            <?php foreach ($tb_ings as $ing) : ?>
                                <div class="gf-flip__ing-item">
                                    <div class="gf-flip__ing-top">
                                        <span><?php echo esc_html($ing['name']); ?></span>
                                        <span><?php echo $ing['pct']; ?>%</span>
                                    </div>
                                    <div class="gf-flip__ing-bar">
                                        <div class="gf-flip__ing-fill" style="width:<?php echo ($ing['pct'] / 17.7 * 100); ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gf-flip__back-actions">
                            <a href="<?php echo esc_url($tb_wa_url); ?>" class="gf-btn gf-btn-green" style="width:100%;justify-content:center;" target="_blank" rel="noopener">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Order via WhatsApp
                            </a>
                            <button class="gf-flip__back-close" data-flip-close="gf-flip-tb">← Back to Product</button>
                        </div>
                    </div>

                </div>
            </div><!-- /gf-flip-tb -->

        </div>
    </div>
</section>

<!-- ====================================================
     PROCESS
     ==================================================== -->
<section class="gf-process" id="gf-process">
    <div class="container">

        <div class="gf-process__header gf-reveal">
            <div class="gf-section__label gf-section__label--muted">How We Make It</div>
            <h2 class="gf-process__title">Our Healthy<br>Grain-Processing Pipeline</h2>
        </div>

        <div class="gf-process__steps">
            <div class="gf-process__step gf-reveal gf-reveal-delay-1">
                <div class="gf-process__num">01</div>
                <div class="gf-process__step-title">Ingredient Sourcing</div>
                <p class="gf-process__step-desc">We source directly from trusted vendors to ensure no compromises on freshness or quality.</p>
            </div>
            <div class="gf-process__connector"></div>
            <div class="gf-process__step gf-reveal gf-reveal-delay-2">
                <div class="gf-process__num">02</div>
                <div class="gf-process__step-title">Soaking &amp; Fermentation</div>
                <p class="gf-process__step-desc">Each grain is soaked and fermented to break down anti-nutrients and unlock full nutritional potential.</p>
            </div>
            <div class="gf-process__connector"></div>
            <div class="gf-process__step gf-reveal gf-reveal-delay-3">
                <div class="gf-process__num">03</div>
                <div class="gf-process__step-title">Re-Drying</div>
                <p class="gf-process__step-desc">After fermentation, we carefully re-dry the grains at controlled temperatures in order to preserve nutrients and extend shelf life.</p>
            </div>
            <div class="gf-process__connector"></div>
            <div class="gf-process__step gf-reveal gf-reveal-delay-4">
                <div class="gf-process__num">04</div>
                <div class="gf-process__step-title">Precision Milling</div>
                <p class="gf-process__step-desc">Milled to the perfect consistency. Fine enough to mix easily, coarse enough to retain natural fibre.</p>
            </div>
            <div class="gf-process__connector"></div>
            <div class="gf-process__step gf-reveal" style="transition-delay:0.5s">
                <div class="gf-process__num">05</div>
                <div class="gf-process__step-title">Hygienic Packaging</div>
                <p class="gf-process__step-desc">Sealed in food-safe packaging so it comes to you clean and uncontaminated.</p>
            </div>
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
            <h2 class="gf-guarantee__title">Here's Our Assurance</h2>
            <p class="gf-guarantee__text">If you experience any negative reaction after using our products, we'll refund you in full. Yes, we believe in our products that much.</p>
            <a href="<?php echo esc_url($mf_wa_url); ?>" class="gf-btn gf-btn-guarantee" target="_blank" rel="noopener">
                Order Now via WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- ====================================================
     FOOTER
     ==================================================== -->
<footer class="gf-footer gf-footer--simple">
    <div class="container">
        <div class="gf-footer__bar">
            <div class="gf-footer__logo">Grainno<span>.</span></div>
            <span class="gf-footer__copy">&copy; <?php echo date('Y'); ?> Grainno Foods. All rights reserved.</span>
            <span class="gf-footer__made">🇳🇬 Made in Nigeria</span>
        </div>
    </div>
</footer>

<!-- Toast -->
<div class="gf-toast" id="gf-toast" aria-live="polite"></div>

<?php get_footer(); ?>
