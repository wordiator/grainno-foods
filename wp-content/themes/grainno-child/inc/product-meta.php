<?php
defined('ABSPATH') || exit;

/* ============================================================
   ADD CUSTOM FIELDS TO PRODUCT ADMIN
   ============================================================ */
function grainno_add_product_fields() {
    echo '<div class="options_group">';

    woocommerce_wp_text_input([
        'id'          => '_grainno_tagline',
        'label'       => __('Product Tagline', 'grainno-child'),
        'placeholder' => 'e.g. For guys building muscle & girls toning up',
        'desc_tip'    => true,
        'description' => __('Short tagline shown on product page and cards.', 'grainno-child'),
    ]);

    woocommerce_wp_text_input([
        'id'          => '_grainno_protein',
        'label'       => __('Protein (per 100g)', 'grainno-child'),
        'placeholder' => 'e.g. 22g',
        'desc_tip'    => true,
        'description' => __('Protein content displayed in macro pills.', 'grainno-child'),
    ]);

    woocommerce_wp_text_input([
        'id'          => '_grainno_calories',
        'label'       => __('Calories (per 100g)', 'grainno-child'),
        'placeholder' => 'e.g. 424 kcal',
        'desc_tip'    => true,
        'description' => __('Calorie content displayed in macro pills.', 'grainno-child'),
    ]);

    woocommerce_wp_text_input([
        'id'          => '_grainno_carbs',
        'label'       => __('Carbs (per 100g)', 'grainno-child'),
        'placeholder' => 'e.g. 42g',
        'desc_tip'    => true,
        'description' => __('Carbs content displayed in macro pills.', 'grainno-child'),
    ]);

    woocommerce_wp_text_input([
        'id'          => '_grainno_fat',
        'label'       => __('Fat (per 100g)', 'grainno-child'),
        'placeholder' => 'e.g. 20g',
        'desc_tip'    => true,
        'description' => __('Fat content displayed in macro pills.', 'grainno-child'),
    ]);

    woocommerce_wp_textarea_input([
        'id'          => '_grainno_ingredients',
        'label'       => __('Ingredients List', 'grainno-child'),
        'placeholder' => 'Soyabeans (38%), Oats (18.1%), ...',
        'desc_tip'    => true,
        'description' => __('Comma-separated list of ingredients.', 'grainno-child'),
    ]);

    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'grainno_add_product_fields');

/* ============================================================
   SAVE CUSTOM FIELDS
   ============================================================ */
function grainno_save_product_fields($post_id) {
    $fields = ['_grainno_tagline', '_grainno_protein', '_grainno_calories', '_grainno_carbs', '_grainno_fat', '_grainno_ingredients'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('woocommerce_process_product_meta', 'grainno_save_product_fields');
