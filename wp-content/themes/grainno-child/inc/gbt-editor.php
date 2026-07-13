<?php
/**
 * GBT front-end inline editor.
 *
 * Templates mark editable elements with gbt_attr('key') and echo copy via
 * gbt_text('key', 'default'). Logged-in editors get a toolbar (gbt-editor/editor.js)
 * that toggles contenteditable, lets placeholders be hidden/restored, and saves
 * overrides to the page's `_gbt_content` post meta via AJAX. Visitors just get
 * the rendered copy — no editor assets are enqueued for them.
 */
defined('ABSPATH') || exit;

const GBT_HIDDEN_SENTINEL = '__hidden__';

function gbt_editor_templates() {
    return ['template-gbt-sales.php', 'template-gbt-landing.php'];
}

function gbt_content_overrides() {
    static $cache = null;
    if ($cache === null) {
        $meta  = get_post_meta(get_queried_object_id(), '_gbt_content', true);
        $cache = is_array($meta) ? $meta : [];
    }
    return $cache;
}

/** Echo the stored override for $key, or $default. Content is sanitized on save. */
function gbt_text($key, $default) {
    $overrides = gbt_content_overrides();
    if (isset($overrides[$key]) && $overrides[$key] !== GBT_HIDDEN_SENTINEL) {
        echo $overrides[$key];
        return;
    }
    echo $default;
}

/** Echo the data attribute that makes an element editable. */
function gbt_attr($key, $hideable = false) {
    echo 'data-gbt-key="' . esc_attr($key) . '"';
    if ($hideable) {
        echo ' data-gbt-hideable="1"';
    }
    if (gbt_is_hidden($key)) {
        echo ' data-gbt-hidden="1" style="display:none"';
    }
}

function gbt_is_hidden($key) {
    $overrides = gbt_content_overrides();
    return isset($overrides[$key]) && $overrides[$key] === GBT_HIDDEN_SENTINEL;
}

function gbt_editor_can_edit() {
    return is_page() && current_user_can('edit_page', get_queried_object_id());
}

/* Enqueue editor assets for users who can edit these templates */
add_action('wp_enqueue_scripts', function () {
    $is_gbt = false;
    foreach (gbt_editor_templates() as $tpl) {
        if (is_page_template($tpl)) { $is_gbt = true; break; }
    }
    if (!$is_gbt || !gbt_editor_can_edit()) {
        return;
    }
    wp_enqueue_style(
        'gbt-editor',
        get_stylesheet_directory_uri() . '/gbt-editor/editor.css',
        [],
        filemtime(get_stylesheet_directory() . '/gbt-editor/editor.css')
    );
    wp_enqueue_script(
        'gbt-editor',
        get_stylesheet_directory_uri() . '/gbt-editor/editor.js',
        [],
        filemtime(get_stylesheet_directory() . '/gbt-editor/editor.js'),
        true
    );
    wp_localize_script('gbt-editor', 'gbtEditor', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('gbt_editor'),
        'postId'  => get_queried_object_id(),
    ]);
}, 20);

/* Save handler */
add_action('wp_ajax_gbt_save_content', function () {
    check_ajax_referer('gbt_editor', 'nonce');

    $post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
    if (!$post_id || !current_user_can('edit_page', $post_id)) {
        wp_send_json_error('Not allowed.', 403);
    }

    $changes = isset($_POST['changes']) ? json_decode(wp_unslash($_POST['changes']), true) : null;
    if (!is_array($changes)) {
        wp_send_json_error('Bad payload.', 400);
    }

    $meta = get_post_meta($post_id, '_gbt_content', true);
    if (!is_array($meta)) {
        $meta = [];
    }

    foreach ($changes as $key => $value) {
        $key = sanitize_text_field($key);
        if ($value === null || $value === '') {
            unset($meta[$key]);
        } elseif ($value === GBT_HIDDEN_SENTINEL) {
            $meta[$key] = GBT_HIDDEN_SENTINEL;
        } else {
            $meta[$key] = wp_kses_post($value);
        }
    }

    if (empty($meta)) {
        delete_post_meta($post_id, '_gbt_content');
    } else {
        update_post_meta($post_id, '_gbt_content', $meta);
    }
    wp_send_json_success(['saved' => count($changes)]);
});

/* Reset handler — clears every override for the page */
add_action('wp_ajax_gbt_reset_content', function () {
    check_ajax_referer('gbt_editor', 'nonce');
    $post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
    if (!$post_id || !current_user_can('edit_page', $post_id)) {
        wp_send_json_error('Not allowed.', 403);
    }
    delete_post_meta($post_id, '_gbt_content');
    wp_send_json_success();
});

/* Expose _gbt_content via the REST API so overrides can be migrated between sites. */
add_action('init', function () {
    register_post_meta('page', '_gbt_content', [
        'type'          => 'object',
        'single'        => true,
        'show_in_rest'  => [
            'schema' => ['type' => 'object', 'additionalProperties' => true],
        ],
        'auth_callback' => function ($allowed, $meta_key, $post_id) {
            return current_user_can('edit_page', $post_id);
        },
    ]);
});
