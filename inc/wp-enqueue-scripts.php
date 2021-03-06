<?php

/**
 * Enqueue Style And Script
 */
function jp_enqueue_style_script()
{
    $suffix = SCRIPT_DEBUG ? '' : '.min';

    $styleCss = JP_TEMPLATE . "/style{$suffix}.css";
    $commonJS = JP_JS . "/common{$suffix}.js";

    $libs = [
        'validate' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate' . $suffix . '.js',
        'respond' => 'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js',
        'html5shiv' => 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js',
    ];

    wp_enqueue_style('jp-style', $styleCss, [], null);

    wp_register_script('jp-style-ie', JP_CSS . "/ie.css", ['jp-style'], null);

    wp_register_script('jp-html5shiv', $libs['html5shiv'], [], null, false);
    wp_register_script('jp-respond', $libs['respond'], [], null, false);

    wp_style_add_data('jp-style-ie', 'conditional', 'lt IE 9');
    wp_script_add_data('jp-html5shiv', 'conditional', 'lt IE 9');
    wp_script_add_data('jp-respond', 'conditional', 'lt IE 9');

    wp_enqueue_style('jp-style-ie');
    wp_enqueue_script('jp-html5shiv');
    wp_enqueue_script('jp-respond');

    wp_register_script('jp-validate', $libs['validate'], ['jquery'], null, true);

    wp_register_script('jp-common', $commonJS, ['jquery'], null, true);
    wp_register_script('jp-skip-link-focus-fix', JP_JS . '/skip-link-focus-fix.js', [], null, true);

    wp_enqueue_script('jp-common');

    if (is_ie()) {
        wp_enqueue_script('jp-skip-link-focus-fix');
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
        wp_enqueue_script('jp-validate');
    }

    pushPreloadFile($styleCss, 'style');
    pushPreloadFile($commonJS, 'script');
}

add_action('wp_enqueue_scripts', 'jp_enqueue_style_script', 11, 0);

/**
 * WP Default Styles
 *
 * @param WP_Styles $styles
 * @return void
 */
function jp_wp_default_styles($styles)
{
    $editor = get_option('classic-editor-replace');

    if ($editor === 'classic') {
        $styles->remove('wp-block-library-theme');
        $styles->remove('wp-block-library');
    }
}

add_action('wp_default_styles', 'jp_wp_default_styles', 11);

/**
 * Remove Jquery Migrate
 *
 * @param WP_Scripts $scripts WP_Scripts object.
 */
function jp_remove_jquery_migrate($scripts)
{
    if (is_admin()) {
        return;
    }

    $suffix = SCRIPT_DEBUG ? '' : '.min';
    $jquery_version = '3.3.1';

    $scripts->remove('jquery');
    $scripts->add('jquery', false, ['jquery-core'], $jquery_version);

    $scripts->remove('jquery-core');
    //$scripts->add('jquery-core', JP_JS . '/libs/jquery' . $suffix . '.js', [], null, 1);
    $scripts->add('jquery-core',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/' . $jquery_version . '/jquery' . $suffix . '.js', [],
        $jquery_version, ['in_footer' => true]);

    $scripts->add_data('jquery', 'group', 1);
    $scripts->add_data('jquery-core', 'group', 1);
    $scripts->add_data('jquery-migrate', 'group', 1);
}

add_action('wp_default_scripts', 'jp_remove_jquery_migrate', 11);

/**
 * Customizer Preview
 */
function jp_customizer_preview()
{
    wp_register_script('jp_customizer_preview', JP_JS . '/customizer-preview.js', [
        'jquery',
        'customize-preview'
    ], null, true);

    wp_enqueue_script('jp_customizer_preview');
}

add_action('customize_preview_init', 'jp_customizer_preview');

/**
 * Customizer Controls
 */
function jp_customize_controls_enqueue_scripts()
{
    wp_register_script('jp_customizer_control', JP_JS . '/customizer-control.js', [
        'jquery',
        'customize-controls'
    ], null, true);

    wp_enqueue_script('jp_customizer_control');
}

add_action('customize_controls_enqueue_scripts', 'jp_customize_controls_enqueue_scripts');

/**
 * wp_head Analytics Tracking Code
 *
 * @return void
 */
function jp_wp_head()
{
    analytics_tracking_code('head');
}

add_action('wp_head', 'jp_wp_head', 20);

/**
 * wp_footer Analytics Tracking Code
 *
 * @return void
 */
function jp_wp_footer()
{
    analytics_tracking_code('body');
}

add_action('wp_footer', 'jp_wp_footer', 20);

/**
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
function jp_add_async_attribute($tag, $handle)
{
    $scripts_to_async = ['jp-js-handle'];

    foreach ($scripts_to_async as $async_script) {

        if ($async_script === $handle) {

            return str_replace(' src', ' async src', $tag);

        }

    }

    return $tag;

}

add_filter('script_loader_tag', 'jp_add_async_attribute', 10, 2);

/**
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
function jp_add_defer_attribute($tag, $handle)
{
    $scripts_to_defer = ['jp-js-handle'];

    foreach ($scripts_to_defer as $defer_script) {

        if ($defer_script === $handle) {

            return str_replace(' src', ' defer src', $tag);

        }

    }

    return $tag;
}

add_filter('script_loader_tag', 'jp_add_defer_attribute', 10, 2);

/**
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
function jp_add_async_defer_attribute($tag, $handle)
{
    $scripts = ['jp-js-handle'];

    foreach ($scripts as $script) {

        if ($script === $handle) {

            return str_replace(' src', ' async defer src', $tag);

        }
    }

    return $tag;
}

add_filter('script_loader_tag', 'jp_add_async_defer_attribute', 10, 2);
