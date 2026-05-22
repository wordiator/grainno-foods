<?php
defined('ABSPATH') || exit;

get_header('shop');

while (have_posts()) :
    the_post();
    global $product;

    $tagline     = get_post_meta(get_the_ID(), '_grainno_tagline', true);
    $protein     = get_post_meta(get_the_ID(), '_grainno_protein', true);
    $calories    = get_post_meta(get_the_ID(), '_grainno_calories', true);
    $carbs       = get_post_meta(get_the_ID(), '_grainno_carbs', true);
    $fat         = get_post_meta(get_the_ID(), '_grainno_fat', true);
    $ingredients = get_post_meta(get_the_ID(), '_grainno_ingredients', true);
    $cats        = wp_get_post_terms(get_the_ID(), 'product_cat');
    $cat_name    = !empty($cats) ? $cats[0]->name : '';
    $img         = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>

<div class="gf-single">

    <!-- Gallery -->
    <div class="gf-single__gallery">
        <?php if ($img) : ?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
        <?php else : ?>
            <div style="aspect-ratio:1/1;background:var(--gf-card);border-radius:20px;border:1px solid var(--gf-border);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.15);font-size:3rem;">🌾</div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="gf-single__info">
        <?php if ($cat_name) : ?>
            <div class="gf-single__badge"><?php echo esc_html($cat_name); ?></div>
        <?php endif; ?>

        <h1 class="gf-single__title"><?php the_title(); ?></h1>

        <?php if ($tagline) : ?>
            <p class="gf-single__tagline"><?php echo esc_html($tagline); ?></p>
        <?php endif; ?>

        <!-- Macro pills -->
        <?php if ($protein || $calories || $carbs || $fat) : ?>
            <div class="gf-macros">
                <?php if ($protein) : ?>
                    <div class="gf-macro">
                        <span class="gf-macro__val"><?php echo esc_html($protein); ?></span>
                        <span class="gf-macro__label">Protein</span>
                    </div>
                <?php endif; ?>
                <?php if ($calories) : ?>
                    <div class="gf-macro">
                        <span class="gf-macro__val"><?php echo esc_html($calories); ?></span>
                        <span class="gf-macro__label">Calories</span>
                    </div>
                <?php endif; ?>
                <?php if ($carbs) : ?>
                    <div class="gf-macro">
                        <span class="gf-macro__val"><?php echo esc_html($carbs); ?></span>
                        <span class="gf-macro__label">Carbs</span>
                    </div>
                <?php endif; ?>
                <?php if ($fat) : ?>
                    <div class="gf-macro">
                        <span class="gf-macro__val"><?php echo esc_html($fat); ?></span>
                        <span class="gf-macro__label">Fat</span>
                    </div>
                <?php endif; ?>
                <div class="gf-macro">
                    <span class="gf-macro__val" style="font-size:0.7rem;color:var(--gf-muted);">per 100g</span>
                    <span class="gf-macro__label">serving</span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <div class="gf-price"><?php echo $product->get_price_html(); ?></div>

        <!-- WooCommerce add to cart -->
        <div style="margin-bottom:24px;">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <!-- Trust pills -->
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:24px;">
            <span class="gf-pill gf-pill--orange">🇳🇬 Nigerian Ingredients</span>
            <span class="gf-pill gf-pill--white">No Chemicals</span>
            <span class="gf-pill gf-pill--white">No Side Effects</span>
            <span class="gf-pill gf-pill--green">NAFDAC Registered</span>
        </div>

        <!-- Ingredients accordion -->
        <?php if ($ingredients) :
            $ing_list = array_map('trim', explode(',', $ingredients));
        ?>
            <div class="gf-accordion" id="gf-acc-ingredients">
                <button class="gf-accordion__btn" aria-expanded="false">Ingredients</button>
                <div class="gf-accordion__body">
                    <ul class="gf-ing-list">
                        <?php foreach ($ing_list as $ing) : ?>
                            <li><?php echo esc_html($ing); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <!-- Description accordion -->
        <?php if (get_the_content()) : ?>
            <div class="gf-accordion" id="gf-acc-desc">
                <button class="gf-accordion__btn" aria-expanded="false">Product Details</button>
                <div class="gf-accordion__body">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Sticky ATC bar (mobile) -->
<div class="gf-sticky-atc" id="gf-sticky-atc">
    <span class="gf-sticky-atc__name"><?php the_title(); ?></span>
    <span class="gf-sticky-atc__price"><?php echo $product->get_price_html(); ?></span>
    <button class="gf-btn gf-btn-primary" onclick="document.querySelector('.single_add_to_cart_button')?.click()" style="white-space:nowrap;padding:12px 20px;font-size:0.9rem;">Add to Cart</button>
</div>

<?php
endwhile;

get_footer('shop');
?>
