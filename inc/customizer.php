<?php

/**
 * Customize
 *
 * @param $wp_customize WP_Customize_Manager
 */
function jp_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    $wp_customize->get_setting('background_color')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector'        => '.blog-name',
        'render_callback' => function () {
            return get_bloginfo('name', 'display');
        },
    ));

    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector'        => '.blog-description',
        'render_callback' => function () {
            return get_bloginfo('description', 'display');
        },
    ));

    $wp_customize->selective_refresh->add_partial('custom_logo', array(
        'selector'        => '.logo',
        'render_callback' => function () {
            return get_custom_logo();
        },
    ));

    // Panel Theme Options
    $wp_customize->add_panel('jp_theme_options', array(
        'title'       => 'Theme Options',
        'description' => 'Theme Options Customizer',
        'priority'    => 201,
    ));

    // Section Scroll Top
    $wp_customize->add_section('jp_scroll_top', array(
        'title'       => 'Scroll Top',
        'description' => 'Customizer Custom Scroll Top',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_scroll_top_enable', array(
        'default'           => true,
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_width', array(
        'default'           => '55',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_height', array(
        'default'           => '55',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_shape', array(
        'default'           => 'circle',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_position', array(
        'default'           => 'right',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_offset_left_right', array(
        'default'           => '20',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_offset_bottom', array(
        'default'           => '20',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_border_width', array(
        'default'           => '1',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_border_color', array(
        'default'           => '#000000',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_background_color', array(
        'default'           => '#000000',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_background_color_hover', array(
        'default'           => '#000000',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_setting('jp_scroll_top_arrow_color', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_control('jp_scroll_top_enable', array(
        'label'       => 'Enable/Disable',
        'description' => 'Display Scroll Top',
        'section'     => 'jp_scroll_top',
        'settings'    => 'jp_scroll_top_enable',
        'type'        => 'checkbox',
    ));

    $wp_customize->selective_refresh->add_partial('jp_scroll_top_enable', array(
        'selector' => '.js-scroll-top',
    ));

    $wp_customize->add_control('jp_scroll_top_width', array(
        'label'    => 'Width',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_width',
        'type'     => 'number',
    ));

    $wp_customize->add_control('jp_scroll_top_height', array(
        'label'    => 'Height',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_height',
        'type'     => 'number',
    ));

    $wp_customize->add_control('jp_scroll_top_shape', array(
        'label'    => 'Shape',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_shape',
        'type'     => 'select',
        'choices'  => array(
            'circle'  => 'Circle',
            'rounded' => 'Rounded',
            'square'  => 'Square',
        ),
    ));

    $wp_customize->add_control('jp_scroll_top_position', array(
        'label'    => 'Position',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_position',
        'type'     => 'select',
        'choices'  => array(
            'right' => 'Right',
            'left'  => 'Left',
        ),
    ));

    $wp_customize->add_control('jp_scroll_top_offset_left_right', array(
        'label'    => 'Offset Left/Right',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_offset_left_right',
        'type'     => 'number',
    ));

    $wp_customize->add_control('jp_scroll_top_offset_bottom', array(
        'label'    => 'Offset bottom',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_offset_bottom',
        'type'     => 'number',
    ));

    $wp_customize->add_control('jp_scroll_top_border_width', array(
        'label'    => 'Border width',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_border_width',
        'type'     => 'number',
    ));

    $wp_customize->add_control('jp_scroll_top_border_color', array(
        'label'    => 'Border color',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_border_color',
        'type'     => 'color',
    ));

    $wp_customize->add_control('jp_scroll_top_background_color', array(
        'label'    => 'Background color',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_background_color',
        'type'     => 'color',
    ));

    $wp_customize->add_control('jp_scroll_top_background_color_hover', array(
        'label'    => 'Background color hover',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_background_color_hover',
        'type'     => 'color',
    ));

    $wp_customize->add_control('jp_scroll_top_arrow_color', array(
        'label'    => 'Arrow color',
        'section'  => 'jp_scroll_top',
        'settings' => 'jp_scroll_top_arrow_color',
        'type'     => 'color',
    ));

    // Section Analytics Tracking Code
    $wp_customize->add_section('jp_analytics', array(
        'title'       => 'Analytics',
        'description' => 'Analytics Tracking Code',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_analytics_google_placed', array('default' => 'body', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_analytics_yandex_placed', array('default' => 'body', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_analytics_custom_placed', array('default' => 'body', 'sanitize_callback' => '',));

    $wp_customize->add_setting('jp_analytics_google', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_analytics_yandex', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_analytics_custom', array('sanitize_callback' => '',));

    $wp_customize->add_control('jp_analytics_google_placed', array(
        'label'       => 'Google Analytics',
        'description' => 'Placed (head/body)',
        'section'     => 'jp_analytics',
        'settings'    => 'jp_analytics_google_placed',
        'type'        => 'select',
        'choices'     => array(
            'head' => 'Head',
            'body' => 'Body',
        ),
    ));

    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'jp_analytics_google', array(
        'description' => 'Paste tracking code here &dArr;',
        'section'     => 'jp_analytics',
        'settings'    => 'jp_analytics_google',
        'code_type'   => 'text/javascript',
        'input_attrs' => array(
            'placeholder' => '',
        ),
    )));

    $wp_customize->add_control('jp_analytics_yandex_placed', array(
        'label'       => 'Yandex Metrika',
        'description' => 'Placed (head/body)',
        'section'     => 'jp_analytics',
        'settings'    => 'jp_analytics_yandex_placed',
        'type'        => 'select',
        'choices'     => array(
            'head' => 'Head',
            'body' => 'Body',
        ),
    ));

    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'jp_analytics_yandex', array(
        'description' => 'Paste tracking code here &dArr;',
        'section'     => 'jp_analytics',
        'settings'    => 'jp_analytics_yandex',
        'code_type'   => 'text/javascript',
        'input_attrs' => array(
            'placeholder' => '',
        ),
    )));

    $wp_customize->add_control('jp_analytics_custom_placed', array(
        'label'       => 'Custom Analytics',
        'description' => 'Placed (head/body)',
        'section'     => 'jp_analytics',
        'settings'    => 'jp_analytics_custom_placed',
        'type'        => 'select',
        'choices'     => array(
            'head' => 'Head',
            'body' => 'Body',
        ),
    ));

    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'jp_analytics_custom', array(
        'description' => 'Paste tracking code here &dArr;',
        'section'     => 'jp_analytics',
        'settings'    => 'jp_analytics_custom',
        'code_type'   => 'text/javascript',
        'input_attrs' => array(
            'placeholder' => '',
        ),
    )));

    // Section Login
    $wp_customize->add_section('jp_login', array(
        'title'       => 'Login',
        'description' => 'Customizer Custom Login logo',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_login_logo', array(
        'default'           => JP_IMG . '/login-logo.png',
        'sanitize_callback' => '',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jp_login_logo', array(
        'label'       => 'Logo',
        'description' => 'Image size 80x80 px',
        'section'     => 'jp_login',
        'settings'    => 'jp_login_logo',
    )));

    // Section Messenger
    $wp_customize->add_section('jp_messenger', array(
        'title'       => 'Messenger',
        'description' => 'Customizer Custom Messenger links',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_messenger_viber', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_messenger_whatsapp', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_messenger_telegram', array('default' => '', 'sanitize_callback' => '',));

    $wp_customize->selective_refresh->add_partial('jp_messenger_viber', array(
        'selector' => '.messenger',
    ));

    $wp_customize->add_control('jp_messenger_viber', array(
        'label'    => 'Viber',
        'section'  => 'jp_messenger',
        'settings' => 'jp_messenger_viber',
        'type'     => 'tel',
    ));

    $wp_customize->add_control('jp_messenger_whatsapp', array(
        'label'    => 'WhatsApp',
        'section'  => 'jp_messenger',
        'settings' => 'jp_messenger_whatsapp',
        'type'     => 'tel',
    ));

    $wp_customize->add_control('jp_messenger_telegram', array(
        'label'    => 'Telegram',
        'section'  => 'jp_messenger',
        'settings' => 'jp_messenger_telegram',
        'type'     => 'tel',
    ));

    // Section Social
    $wp_customize->add_section('jp_social', array(
        'title'       => 'Social',
        'description' => 'Customizer Custom Social links',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_social_vk', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_twitter', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_facebook', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_linkedin', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_instagram', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_odnoklassniki', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_google_plus', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_youtube', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_pinterest', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_tumblr', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_flickr', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_reddit', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_social_rss', array('default' => '', 'sanitize_callback' => '',));

    $wp_customize->selective_refresh->add_partial('jp_social_vk', array(
        'selector' => '.social',
    ));

    $wp_customize->add_control('jp_social_vk', array(
        'label'    => 'Vk',
        'section'  => 'jp_social',
        'settings' => 'jp_social_vk',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_twitter', array(
        'label'    => 'Twitter',
        'section'  => 'jp_social',
        'settings' => 'jp_social_twitter',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_facebook', array(
        'label'    => 'Facebook',
        'section'  => 'jp_social',
        'settings' => 'jp_social_facebook',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_linkedin', array(
        'label'    => 'Linkedin',
        'section'  => 'jp_social',
        'settings' => 'jp_social_linkedin',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_instagram', array(
        'label'    => 'Instagram',
        'section'  => 'jp_social',
        'settings' => 'jp_social_instagram',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_odnoklassniki', array(
        'label'    => 'Odnoklassniki',
        'section'  => 'jp_social',
        'settings' => 'jp_social_odnoklassniki',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_google_plus', array(
        'label'    => 'Google Plus',
        'section'  => 'jp_social',
        'settings' => 'jp_social_google_plus',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_youtube', array(
        'label'    => 'YouTube',
        'section'  => 'jp_social',
        'settings' => 'jp_social_youtube',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_pinterest', array(
        'label'    => 'Pinterest',
        'section'  => 'jp_social',
        'settings' => 'jp_social_pinterest',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_tumblr', array(
        'label'    => 'Tumblr',
        'section'  => 'jp_social',
        'settings' => 'jp_social_tumblr',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_flickr', array(
        'label'    => 'Flickr',
        'section'  => 'jp_social',
        'settings' => 'jp_social_flickr',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_reddit', array(
        'label'    => 'Reddit',
        'section'  => 'jp_social',
        'settings' => 'jp_social_reddit',
        'type'     => 'url',
    ));

    $wp_customize->add_control('jp_social_rss', array(
        'label'    => 'RSS',
        'section'  => 'jp_social',
        'settings' => 'jp_social_rss',
        'type'     => 'url',
    ));

    // Section Phones
    $wp_customize->add_section('jp_phones', array(
        'title'       => 'Phones',
        'description' => 'Customizer Custom Phone numbers',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_phone_one', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_phone_two', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_phone_three', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_phone_four', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_phone_five', array('sanitize_callback' => '',));

    $wp_customize->selective_refresh->add_partial('jp_phone_one', array(
        'selector' => '.phone',
    ));

    $wp_customize->add_control('jp_phone_one', array(
        'label'    => 'Phone 1',
        'section'  => 'jp_phones',
        'settings' => 'jp_phone_one',
        'type'     => 'tel',
    ));

    $wp_customize->add_control('jp_phone_two', array(
        'label'    => 'Phone 2',
        'section'  => 'jp_phones',
        'settings' => 'jp_phone_two',
        'type'     => 'tel',
    ));

    $wp_customize->add_control('jp_phone_three', array(
        'label'    => 'Phone 3',
        'section'  => 'jp_phones',
        'settings' => 'jp_phone_three',
        'type'     => 'tel',
    ));

    $wp_customize->add_control('jp_phone_four', array(
        'label'    => 'Phone 4',
        'section'  => 'jp_phones',
        'settings' => 'jp_phone_four',
        'type'     => 'tel',
    ));

    $wp_customize->add_control('jp_phone_five', array(
        'label'    => 'Phone 5',
        'section'  => 'jp_phones',
        'settings' => 'jp_phone_five',
        'type'     => 'tel',
    ));

    // Section reCAPTCHA
    $wp_customize->add_section('jp_recaptcha', array(
        'title'       => 'reCAPTCHA',
        'description' => 'Register your website with Google to get required API keys and enter them below. <a target="_blank" rel="nofollow noopener" href="https://www.google.com/recaptcha/admin#list">Get the API Keys</a>',
        'panel'       => 'jp_theme_options',
    ));

    $wp_customize->add_setting('jp_recaptcha_site_key', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_secret_key', array('default' => '', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_login_form', array('default' => false, 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_registration_form', array('default' => false, 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_reset_password_form',
        array('default' => false, 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_comments_form', array('default' => false, 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_theme', array('default' => 'light', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_size', array('default' => 'normal', 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_language', array('default' => 0, 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_tabindex', array('default' => 0, 'sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_callback', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_expired_callback', array('sanitize_callback' => '',));
    $wp_customize->add_setting('jp_recaptcha_error_callback', array('sanitize_callback' => '',));

    $wp_customize->selective_refresh->add_partial('jp_recaptcha_site_key', array(
        'selector' => '.jp-g-recaptcha',
    ));

    $wp_customize->add_control('jp_recaptcha_site_key', array(
        'label'       => 'Site Key',
        'description' => '<b>Required.</b> Your site key.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_site_key',
        'type'        => 'text',
        'input_attrs' => array(
            'autocomplete' => 'off',
        ),
    ));

    $wp_customize->add_control('jp_recaptcha_secret_key', array(
        'label'       => 'Secret Key',
        'description' => '<b>Required.</b> The shared key between your site and reCAPTCHA. <b>Do not tell anyone.</b>',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_secret_key',
        'type'        => 'password',
        'input_attrs' => array(
            'autocomplete' => 'off',
        ),
    ));

    $wp_customize->add_control('jp_recaptcha_login_form', array(
        'label'       => 'Login Form',
        'description' => 'Enable reCAPTCHA for Login Form',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_login_form',
        'type'        => 'checkbox',
    ));

    $wp_customize->add_control('jp_recaptcha_registration_form', array(
        'label'       => 'Registration Form',
        'description' => 'Enable reCAPTCHA for Registration Form',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_registration_form',
        'type'        => 'checkbox',
    ));

    $wp_customize->add_control('jp_recaptcha_reset_password_form', array(
        'label'       => 'Reset Password Form',
        'description' => 'Enable reCAPTCHA for Reset Password Form',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_reset_password_form',
        'type'        => 'checkbox',
    ));

    $wp_customize->add_control('jp_recaptcha_comments_form', array(
        'label'       => 'Comments Form',
        'description' => 'Enable reCAPTCHA for Comments Form',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_comments_form',
        'type'        => 'checkbox',
    ));

    $wp_customize->add_control('jp_recaptcha_theme', array(
        'label'       => 'Theme',
        'description' => 'Optional. The color theme of the widget.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_theme',
        'type'        => 'select',
        'choices'     => array(
            'dark'  => 'Dark',
            'light' => 'Light',
        ),
    ));

    $wp_customize->add_control('jp_recaptcha_size', array(
        'label'       => 'Size',
        'description' => 'Optional. The size of the widget.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_size',
        'type'        => 'select',
        'choices'     => array(
            'compact' => 'Compact',
            'normal'  => 'Normal',
        ),
    ));

    $wp_customize->add_control('jp_recaptcha_language', array(
        'label'       => 'Language',
        'description' => 'Optional. Forces the widget to render in a specific language. Auto-detects the user\'s language if unspecified.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_language',
        'type'        => 'select',
        'choices'     => array_merge(array(0 => 'Auto-detects'), get_recaptcha_languages())
    ));

    $wp_customize->add_control('jp_recaptcha_tabindex', array(
        'label'       => 'Tab Index',
        'description' => 'Optional. The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_tabindex',
        'type'        => 'number',
        'choices'     => array(
            'min'  => 0,
            'step' => 1,
        ),
    ));

    $wp_customize->add_control('jp_recaptcha_callback', array(
        'label'       => 'Callback',
        'description' => 'Optional. The name of your callback function, executed when the user submits a successful response. The <b>g-recaptcha-response</b> token is passed to your callback.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_callback',
        'type'        => 'text',
    ));

    $wp_customize->add_control('jp_recaptcha_expired_callback', array(
        'label'       => 'Expired Callback',
        'description' => 'Optional. The name of your callback function, executed when the reCAPTCHA response expires and the user needs to re-verify.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_expired_callback',
        'type'        => 'text',
    ));

    $wp_customize->add_control('jp_recaptcha_error_callback', array(
        'label'       => 'Error Callback',
        'description' => 'Optional. The name of your callback function, executed when reCAPTCHA encounters an error (usually network connectivity) and cannot continue until connectivity is restored. If you specify a function here, you are responsible for informing the user that they should retry.',
        'section'     => 'jp_recaptcha',
        'settings'    => 'jp_recaptcha_error_callback',
        'type'        => 'text',
    ));

    // Panel Google Maps Api
    $wp_customize->add_panel('google_map', array(
        'title'       => 'Google Maps Api',
        'description' => 'Customizer for Google Map',
        'priority'    => 202,
    ));

    // Section Project Setup
    $wp_customize->add_section('google_map_project_setup', array(
        'title' => 'Project setup',
        'panel' => 'google_map',
    ));

    $wp_customize->selective_refresh->add_partial('google_map_project_setup_api_key', array(
        'selector' => '.jp-google-map',
    ));

    $wp_customize->add_setting('google_map_js_display', array(
        'default'           => false,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_api_key', array(
        'default'           => '',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_version', array(
        'default'           => '',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_language', array(
        'default'           => 0,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_region', array(
        'default'           => '',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_map_callback', array(
        'default'           => 'initMap',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_map_selector', array(
        'default'           => 'google-map',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_height', array(
        'default'           => 400,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_width', array(
        'default'           => 600,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_latitude', array(
        'default'           => '',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_longitude', array(
        'default'           => '',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_project_setup_zoom_level', array(
        'default'           => 3,
        'sanitize_callback' => '',
    ));

    $wp_customize->add_control('google_map_js_display', array(
        'label'    => 'Enable/Disable',
        'section'  => 'google_map_project_setup',
        'settings' => 'google_map_js_display',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_control('google_map_project_setup_api_key', array(
        'label'       => 'Google Maps API Key',
        'description' => 'All Google Maps JavaScript API applications require authentication.',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_api_key',
        'type'        => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_version', array(
        'label'       => 'Google Maps API Version',
        'description' => 'You can indicate which version of the API to load within your application.',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_version',
        'type'        => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_language', array(
        'label'       => 'Language localization',
        'description' => 'Change the default language settings.',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_language',
        'type'        => 'select',
        'choices'     => array_merge(array(0 => 'Default'), get_google_map_languages()),
    ));

    $wp_customize->add_control('google_map_project_setup_region', array(
        'label'       => 'Region localization',
        'description' => 'Specify a region code, which alters the map\'s behavior based on a given country or territory.',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_region',
        'type'        => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_map_callback', array(
        'label'    => 'Map callback (for js)',
        'section'  => 'google_map_project_setup',
        'settings' => 'google_map_project_setup_map_callback',
        'type'     => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_map_selector', array(
        'label'    => 'Map selector (for css)',
        'section'  => 'google_map_project_setup',
        'settings' => 'google_map_project_setup_map_selector',
        'type'     => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_height', array(
        'label'       => 'Height',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_height',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'step' => 1,
        ),
    ));

    $wp_customize->add_control('google_map_project_setup_width', array(
        'label'       => 'Width',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_width',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'step' => 1,
        ),
    ));

    $wp_customize->add_control('google_map_project_setup_latitude', array(
        'label'    => 'Latitide',
        'section'  => 'google_map_project_setup',
        'settings' => 'google_map_project_setup_latitude',
        'type'     => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_longitude', array(
        'label'    => 'Longitude',
        'section'  => 'google_map_project_setup',
        'settings' => 'google_map_project_setup_longitude',
        'type'     => 'text',
    ));

    $wp_customize->add_control('google_map_project_setup_zoom_level', array(
        'label'       => 'Zoom level',
        'section'     => 'google_map_project_setup',
        'settings'    => 'google_map_project_setup_zoom_level',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 20,
            'step' => 1,
        ),
    ));

    // Section Controls
    $wp_customize->add_section('google_map_controls', array(
        'title' => 'Controls',
        'panel' => 'google_map',
    ));

    $wp_customize->add_setting('google_map_controls_map_type', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_zoom', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_gesture_handling', array(
        'default'           => 'auto',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_full_screen', array(
        'default'           => 0,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_street_view', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_scale', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_clickable_poi', array(
        'default'           => 0,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_draggable', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_double_click_to_zoom', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_controls_mouse_wheel_to_zoom', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));

    $wp_customize->add_control('google_map_controls_map_type', array(
        'label'    => 'Map type',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_map_type',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Hide',
            1 => 'Horizontal Bar',
            2 => 'Dropdown Menu',
        ),
    ));

    $wp_customize->add_control('google_map_controls_zoom', array(
        'label'    => 'Zoom',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_zoom',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Hide',
            1 => 'Show',
        ),
    ));

    $wp_customize->add_control('google_map_controls_gesture_handling', array(
        'label'    => 'Gesture handling',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_gesture_handling',
        'type'     => 'select',
        'choices'  => array(
            'none'        => 'None',
            'auto'        => 'Auto',
            'greedy'      => 'Greedy',
            'cooperative' => 'Cooperative',
        ),
    ));

    $wp_customize->add_control('google_map_controls_full_screen', array(
        'label'    => 'Full screen',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_full_screen',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Hide',
            1 => 'Show',
        ),
    ));

    $wp_customize->add_control('google_map_controls_street_view', array(
        'label'    => 'Street view',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_street_view',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Hide',
            1 => 'Show',
        ),
    ));

    $wp_customize->add_control('google_map_controls_scale', array(
        'label'    => 'Scale',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_scale',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Hide',
            1 => 'Show',
        ),
    ));

    $wp_customize->add_control('google_map_controls_clickable_poi', array(
        'label'    => 'Clickable POI',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_clickable_poi',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Disable',
            1 => 'Enable',
        ),
    ));

    $wp_customize->add_control('google_map_controls_draggable', array(
        'label'    => 'Draggable',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_draggable',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Disable',
            1 => 'Enable',
        ),
    ));

    $wp_customize->add_control('google_map_controls_double_click_to_zoom', array(
        'label'    => 'Double click to zoom',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_double_click_to_zoom',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Enable',
            1 => 'Disable',
        ),
    ));

    $wp_customize->add_control('google_map_controls_mouse_wheel_to_zoom', array(
        'label'    => 'Mouse wheel to zoom',
        'section'  => 'google_map_controls',
        'settings' => 'google_map_controls_mouse_wheel_to_zoom',
        'type'     => 'select',
        'choices'  => array(
            0 => 'Disable',
            1 => 'Enable',
        ),
    ));

    // Section Positions
    $wp_customize->add_section('google_map_positions', array(
        'title' => 'Positions',
        'panel' => 'google_map',
    ));

    $wp_customize->add_setting('google_map_positions_map_type', array(
        'default'           => 1,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_positions_zoom', array(
        'default'           => 9,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_positions_street_view', array(
        'default'           => 9,
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_positions_full_screen', array(
        'default'           => 3,
        'sanitize_callback' => '',
    ));

    $wp_customize->add_control('google_map_positions_map_type', array(
        'label'    => 'Map type',
        'section'  => 'google_map_positions',
        'settings' => 'google_map_positions_map_type',
        'type'     => 'select',
        'choices'  => array(
            1  => 'Top Left',
            2  => 'Top Center',
            3  => 'Top Right',
            4  => 'Left Center',
            5  => 'Left Top',
            6  => 'Left Bottom',
            7  => 'Right Top',
            8  => 'Right Center',
            9  => 'Right Bottom',
            10 => 'Bottom Left',
            11 => 'Bottom Center',
            12 => 'Bottom Right',
        ),
    ));

    $wp_customize->add_control('google_map_positions_zoom', array(
        'label'    => 'Zoom',
        'section'  => 'google_map_positions',
        'settings' => 'google_map_positions_zoom',
        'type'     => 'select',
        'choices'  => array(
            1  => 'Top Left',
            2  => 'Top Center',
            3  => 'Top Right',
            4  => 'Left Center',
            5  => 'Left Top',
            6  => 'Left Bottom',
            7  => 'Right Top',
            8  => 'Right Center',
            9  => 'Right Bottom',
            10 => 'Bottom Left',
            11 => 'Bottom Center',
            12 => 'Bottom Right',
        ),
    ));

    $wp_customize->add_control('google_map_positions_street_view', array(
        'label'    => 'Street view',
        'section'  => 'google_map_positions',
        'settings' => 'google_map_positions_street_view',
        'type'     => 'select',
        'choices'  => array(
            1  => 'Top Left',
            2  => 'Top Center',
            3  => 'Top Right',
            4  => 'Left Center',
            5  => 'Left Top',
            6  => 'Left Bottom',
            7  => 'Right Top',
            8  => 'Right Center',
            9  => 'Right Bottom',
            10 => 'Bottom Left',
            11 => 'Bottom Center',
            12 => 'Bottom Right',
        ),
    ));

    $wp_customize->add_control('google_map_positions_full_screen', array(
        'label'    => 'Full screen',
        'section'  => 'google_map_positions',
        'settings' => 'google_map_positions_full_screen',
        'type'     => 'select',
        'choices'  => array(
            1  => 'Top Left',
            2  => 'Top Center',
            3  => 'Top Right',
            4  => 'Left Center',
            5  => 'Left Top',
            6  => 'Left Bottom',
            7  => 'Right Top',
            8  => 'Right Center',
            9  => 'Right Bottom',
            10 => 'Bottom Left',
            11 => 'Bottom Center',
            12 => 'Bottom Right',
        ),
    ));

    // Section Themes
    $wp_customize->add_section('google_map_themes', array(
        'title' => 'Themes',
        'panel' => 'google_map',
    ));

    $wp_customize->add_setting('google_map_themes_type', array(
        'default'           => 'roadmap',
        'sanitize_callback' => '',
    ));
    $wp_customize->add_setting('google_map_themes_styles', array(
        'default'           => 0,
        'sanitize_callback' => '',
    ));

    $wp_customize->add_control('google_map_themes_type', array(
        'label'    => 'Google maps theme',
        'section'  => 'google_map_themes',
        'settings' => 'google_map_themes_type',
        'type'     => 'select',
        'choices'  => array(
            'roadmap'   => 'Road Map',
            'satellite' => 'Satellite',
            'hybrid'    => 'Hybrid',
            'terrain'   => 'Terrain',
        ),
    ));

    $wp_customize->add_control('google_map_themes_styles', array(
        'label'    => 'Shazzy maps theme',
        'section'  => 'google_map_themes',
        'settings' => 'google_map_themes_styles',
        'type'     => 'select',
        'choices'  => array_merge(array(0 => 'None'), get_snazzymaps_styles()),
    ));

}

add_action('customize_register', 'jp_customize_register');

/**
 * Customizer CSS
 *
 * @return void
 */
function jp_customizer_css()
{ ?>
    <style>
        .scroll-top {
            width: <?php theme_mod('jp_scroll_top_width', 55); ?>px;
            height: <?php theme_mod('jp_scroll_top_height', 55); ?>px;
            background-color: <?php theme_mod('jp_scroll_top_background_color', '#000000'); ?>;
            border-width: <?php theme_mod('jp_scroll_top_border_width', 1); ?>px;
            border-color: <?php theme_mod('jp_scroll_top_border_color', '#000000'); ?>;
            bottom: <?php theme_mod('jp_scroll_top_offset_bottom', 20); ?>px;
        <?php jp_scroll_top_position_offset(); ?>
        }

        .scroll-top:hover {
            background-color: <?php theme_mod('jp_scroll_top_background_color_hover', '#000000'); ?>;
        }

        .scroll-top--arrow {
            border-bottom-color: <?php theme_mod('jp_scroll_top_arrow_color', '#ffffff'); ?>;
        }
    </style>
    <?php
}

add_action('wp_head', 'jp_customizer_css');

/**
 * Scroll Top Position Offset
 *
 * @return void
 */
function jp_scroll_top_position_offset()
{
    $position = get_theme_mod('jp_scroll_top_position', 'right');
    $offset   = get_theme_mod('jp_scroll_top_offset_left_right', 20);

    $output = sprintf('%s: %spx;', $position, $offset);

    echo $output;
}
