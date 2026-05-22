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

<div class="gf-single-product">

    <!-- Gallery -->
    <div class="gf-product-gallery">
        <?php if ($img) : ?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
        <?php else : ?>
            <div style="aspect-ratio:1/1;background:var(--gf-dark-card);border-radius:16px;border:1px solid var(--gf-border);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.2);">No image yet</div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="gf-product-info">
        <?php if ($cat_name) : ?>
            <div class="gf-product-info__category"><?php echo esc_html($cat_name); ?></div>
        <?php endif; ?>

        <h1 class="gf-product-info__title"><?php the_title(); ?></h1>

        <?php if ($tagline) : ?>
            <p class="gf-product-info__tagline"><?php echo esc_html($tagline); ?></p>
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
                <div class="gf-macro" style="min-width:100px;">
                    <span class="gf-macro__val" style="font-size:0.75rem;color:rgba(253,250,245,0.4);">per 100g</span>
                    <span class="gf-macro__label">serving</span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <div class="gf-product-price"><?php echo $product->get_price_html(); ?></div>

        <!-- WooCommerce add to cart form (variant selector styled) -->
        <div class="gf-atc-form">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <!-- Ingredients accordion -->
        <?php if ($ingredients) :
            $ing_list = array_map('trim', explode(',', $ingredients));
        ?>
            <div class="gf-accordion" id="gf-acc-ingredients">
                <button class="gf-accordion__trigger" aria-expanded="false">Ingredients</button>
                <div class="gf-accordion__body">
                    <ul class="gf-ingredient-list">
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
                <button class="gf-accordion__trigger" aria-expanded="false">Product Details</button>
                <div class="gf-accordion__body">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Trust pills -->
        <div class="gf-benefit-pills" style="margin-top:20px;">
            <span class="gf-pill">🇳🇬 Nigerian Ingredients</span>
            <span class="gf-pill">No Chemicals</span>
            <span class="gf-pill">No Side Effects</span>
            <span class="gf-pill">NAFDAC Registered</span>
        </div>
    </div>
</div>

<!-- Sticky ATC bar (mobile) -->
<div class="gf-sticky-atc" id="gf-sticky-atc">
    <span class="gf-sticky-atc__name"><?php the_title(); ?></span>
    <span style="font-weight:700;color:var(--gf-orange);"><?php echo $product->get_price_html(); ?></span>
    <button class="btn-primary" onclick="document.querySelector('.single_add_to_cart_button')?.click()" style="white-space:nowrap;padding:12px 20px;">Add to Cart</button>
</div>

<?php
endwhile;

get_footer('shop');
?>
