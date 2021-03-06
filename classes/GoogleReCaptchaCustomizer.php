<?php

if (!class_exists('GoogleReCaptchaCustomizer')) {
    /**
     * Class GoogleReCaptchaCustomizer
     *
     * @author Kudinov Fedor <admin@joompress.biz>
     */
    class GoogleReCaptchaCustomizer
    {
        /**
         * @var array
         */
        public $languages = [
            'ar' => 'Arabic',
            'af' => 'Afrikaans',
            'am' => 'Amharic',
            'hy' => 'Armenian',
            'az' => 'Azerbaijani',
            'eu' => 'Basque',
            'bn' => 'Bengali',
            'bg' => 'Bulgarian',
            'ca' => 'Catalan',
            'zh-HK' => 'Chinese (Hong Kong)',
            'zh-CN' => 'Chinese (Simplified)',
            'zh-TW' => 'Chinese (Traditional)',
            'hr' => 'Croatian',
            'cs' => 'Czech',
            'da' => 'Danish',
            'nl' => 'Dutch',
            'en-GB' => 'English (UK)',
            'en' => 'English (US)',
            'et' => 'Estonian',
            'fil' => 'Filipino',
            'fi' => 'Finnish',
            'fr' => 'French',
            'fr-CA' => 'French (Canadian)',
            'gl' => 'Galician',
            'ka' => 'Georgian',
            'de' => 'German',
            'de-AT' => 'German (Austria)',
            'de-CH' => 'German (Switzerland)',
            'el' => 'Greek',
            'gu' => 'Gujarati',
            'iw' => 'Hebrew',
            'hi' => 'Hindi',
            'hu' => 'Hungarain',
            'is' => 'Icelandic',
            'id' => 'Indonesian',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'kn' => 'Kannada',
            'ko' => 'Korean',
            'lo' => 'Laothian',
            'lv' => 'Latvian',
            'lt' => 'Lithuanian',
            'ms' => 'Malay',
            'ml' => 'Malayalam',
            'mr' => 'Marathi',
            'mn' => 'Mongolian',
            'no' => 'Norwegian',
            'fa' => 'Persian',
            'pl' => 'Polish',
            'pt' => 'Portuguese',
            'pt-BR' => 'Portuguese (Brazil)',
            'pt-PT' => 'Portuguese (Portugal)',
            'ro' => 'Romanian',
            'ru' => 'Russian',
            'sr' => 'Serbian',
            'si' => 'Sinhalese',
            'sk' => 'Slovak',
            'sl' => 'Slovenian',
            'es' => 'Spanish',
            'es-419' => 'Spanish (Latin America)',
            'sw' => 'Swahili',
            'sv' => 'Swedish',
            'ta' => 'Tamil',
            'te' => 'Telugu',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'uk' => 'Ukrainian',
            'ur' => 'Urdu',
            'vi' => 'Vietnamese',
            'zu' => 'Zulu',
        ];

        /**
         * GoogleReCaptchaCustomizer constructor.
         */
        public function __construct()
        {
            add_action('customize_register', [$this, 'customizer']);
        }

        /**
         * Google reCAPTCHA Customizer
         *
         * @param $customize WP_Customize_Manager
         */
        public function customizer($customize)
        {
            // Section reCAPTCHA
            $customize->add_section('jp_recaptcha', [
                'title' => 'Google reCAPTCHA v2',
                'description' => 'Register your website with Google to get required API keys and enter them below. <a target="_blank" rel="nofollow noopener" href="https://www.google.com/recaptcha/admin#list">Get the API Keys</a>',
                'priority' => 203,
                //'panel' => 'jp_theme_options',
            ]);

            $customize->add_setting('jp_recaptcha_site_key', [
                'default' => '',
                'sanitize_callback' => '',
            ]);
            $customize->add_setting('jp_recaptcha_secret_key', [
                'default' => '',
                'sanitize_callback' => '',
            ]);
            $customize->add_setting('jp_recaptcha_login_form', [
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            ]);
            $customize->add_setting('jp_recaptcha_registration_form', [
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            ]);
            $customize->add_setting('jp_recaptcha_reset_password_form', [
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            ]);
            $customize->add_setting('jp_recaptcha_comments_form', [
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            ]);
            $customize->add_setting('jp_recaptcha_theme', [
                'default' => 'light',
                'sanitize_callback' => 'sanitize_select',
            ]);
            $customize->add_setting('jp_recaptcha_size', [
                'default' => 'normal',
                'sanitize_callback' => 'sanitize_select',
            ]);
            $customize->add_setting('jp_recaptcha_language', [
                'default' => 0,
                'sanitize_callback' => 'sanitize_select',
            ]);
            $customize->add_setting('jp_recaptcha_tabindex', [
                'default' => 0,
                'sanitize_callback' => '',
            ]);
            $customize->add_setting('jp_recaptcha_callback', [
                'sanitize_callback' => '',
            ]);
            $customize->add_setting('jp_recaptcha_expired_callback', [
                'sanitize_callback' => '',
            ]);
            $customize->add_setting('jp_recaptcha_error_callback', [
                'sanitize_callback' => '',
            ]);

            $customize->selective_refresh->add_partial('jp_recaptcha_site_key', [
                'selector' => '.jp-g-recaptcha',
            ]);

            $customize->add_control('jp_recaptcha_site_key', [
                'label' => 'Site Key',
                'description' => '<b>Required.</b> Your site key.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_site_key',
                'type' => 'text',
                'input_attrs' => [
                    'autocomplete' => 'off',
                ],
            ]);

            $customize->add_control('jp_recaptcha_secret_key', [
                'label' => 'Secret Key',
                'description' => '<b>Required.</b> The shared key between your site and reCAPTCHA. <b>Do not tell anyone.</b>',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_secret_key',
                'type' => 'password',
                'input_attrs' => [
                    'autocomplete' => 'off',
                ],
            ]);

            $customize->add_control('jp_recaptcha_login_form', [
                'label' => 'Login Form',
                'description' => 'Enable reCAPTCHA for Login Form',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_login_form',
                'type' => 'checkbox',
            ]);

            $customize->add_control('jp_recaptcha_registration_form', [
                'label' => 'Registration Form',
                'description' => 'Enable reCAPTCHA for Registration Form',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_registration_form',
                'type' => 'checkbox',
            ]);

            $customize->add_control('jp_recaptcha_reset_password_form', [
                'label' => 'Reset Password Form',
                'description' => 'Enable reCAPTCHA for Reset Password Form',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_reset_password_form',
                'type' => 'checkbox',
            ]);

            $customize->add_control('jp_recaptcha_comments_form', [
                'label' => 'Comments Form',
                'description' => 'Enable reCAPTCHA for Comments Form',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_comments_form',
                'type' => 'checkbox',
            ]);

            $customize->add_control('jp_recaptcha_theme', [
                'label' => 'Theme',
                'description' => 'Optional. The color theme of the widget.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_theme',
                'type' => 'select',
                'choices' => [
                    'dark' => 'Dark',
                    'light' => 'Light',
                ],
            ]);

            $customize->add_control('jp_recaptcha_size', [
                'label' => 'Size',
                'description' => 'Optional. The size of the widget.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_size',
                'type' => 'select',
                'choices' => [
                    'compact' => 'Compact',
                    'normal' => 'Normal',
                ],
            ]);

            $customize->add_control('jp_recaptcha_language', [
                'label' => 'Language',
                'description' => 'Optional. Forces the widget to render in a specific language. Auto-detects the user\'s language if unspecified.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_language',
                'type' => 'select',
                'choices' => array_merge([0 => 'Auto-detects'], $this->languages),
            ]);

            $customize->add_control('jp_recaptcha_tabindex', [
                'label' => 'Tab Index',
                'description' => 'Optional. The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_tabindex',
                'type' => 'number',
                'choices' => [
                    'min' => 0,
                    'step' => 1,
                ],
            ]);

            $customize->add_control('jp_recaptcha_callback', [
                'label' => 'Callback',
                'description' => 'Optional. The name of your callback function, executed when the user submits a successful response. The <b>g-recaptcha-response</b> token is passed to your callback.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_callback',
                'type' => 'text',
            ]);

            $customize->add_control('jp_recaptcha_expired_callback', [
                'label' => 'Expired Callback',
                'description' => 'Optional. The name of your callback function, executed when the reCAPTCHA response expires and the user needs to re-verify.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_expired_callback',
                'type' => 'text',
            ]);

            $customize->add_control('jp_recaptcha_error_callback', [
                'label' => 'Error Callback',
                'description' => 'Optional. The name of your callback function, executed when reCAPTCHA encounters an error (usually network connectivity) and cannot continue until connectivity is restored. If you specify a function here, you are responsible for informing the user that they should retry.',
                'section' => 'jp_recaptcha',
                'settings' => 'jp_recaptcha_error_callback',
                'type' => 'text',
            ]);
        }

    }

    new GoogleReCaptchaCustomizer;
}
