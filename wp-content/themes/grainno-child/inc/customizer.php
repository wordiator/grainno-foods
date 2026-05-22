<?php
defined('ABSPATH') || exit;

function grainno_customizer_settings($wp_customize) {

    $wp_customize->add_panel('grainno_panel', [
        'title'    => __('Grainno Foods', 'grainno-child'),
        'priority' => 30,
    ]);

    /* --- Homepage Section --- */
    $wp_customize->add_section('grainno_homepage', [
        'title' => __('Homepage', 'grainno-child'),
        'panel' => 'grainno_panel',
    ]);

    $wp_customize->add_setting('grainno_hero_image', ['sanitize_callback' => 'absint']);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'grainno_hero_image', [
        'label'     => __('Hero Image', 'grainno-child'),
        'section'   => 'grainno_homepage',
        'mime_type' => 'image',
    ]));

    $wp_customize->add_setting('grainno_hero_headline', [
        'default'           => 'Eat Real Food. Build the Body You Want.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('grainno_hero_headline', [
        'label'   => __('Hero Headline', 'grainno-child'),
        'section' => 'grainno_homepage',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('grainno_hero_sub', [
        'default'           => "You eat well but nothing sticks. You work out but nothing tones. Your body needs the right Nigerian food — not lab chemicals.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('grainno_hero_sub', [
        'label'   => __('Hero Sub-copy', 'grainno-child'),
        'section' => 'grainno_homepage',
        'type'    => 'textarea',
    ]);

    /* --- Store Settings --- */
    $wp_customize->add_section('grainno_store', [
        'title' => __('Store Settings', 'grainno-child'),
        'panel' => 'grainno_panel',
    ]);

    $wp_customize->add_setting('grainno_whatsapp_number', [
        'default'           => GRAINNO_WHATSAPP,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('grainno_whatsapp_number', [
        'label'       => __('WhatsApp Number', 'grainno-child'),
        'description' => __('Include country code, no + or spaces. e.g. 2348163874554', 'grainno-child'),
        'section'     => 'grainno_store',
        'type'        => 'text',
    ]);
}
add_action('customize_register', 'grainno_customizer_settings');
