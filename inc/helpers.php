<?php

if (!function_exists('theme_mod')) {
    /**
     * Display theme modification value for the current theme.
     *
     * @param string $name Theme modification name.
     * @param bool|string $default
     *
     * @return void
     */
    function theme_mod($name, $default = false)
    {
        $theme_mod = get_theme_mod($name, $default);

        if (!empty($theme_mod)) {
            echo $theme_mod;
        }
    }
}

if (!function_exists('e_get_option')) {
    /**
     * Displays an option value based on an option name
     *
     * @see get_option()
     *
     * @param string $option Name of option to retrieve. Expected to not be SQL-escaped.
     * @param mixed $default Optional. Default value to return if the option does not exist.
     *
     * @return void
     */
    function e_get_option($option, $default = false)
    {
        echo get_option($option, $default);
    }
}

if (!function_exists('logo')) {
    /**
     * Displays a logo, linked to home.
     *
     * @param string $file_name
     *
     * @param array $attr
     *
     * @return void
     * @see get_logo()
     *
     */
    function logo($file_name = 'logo.png', $attr = [])
    {
        echo get_logo($file_name, $attr);
    }
}

if (!function_exists('get_logo_url')) {
    /**
     * Returns a logo url
     *
     * @return string
     */
    function get_logo_url()
    {
        $attachment_id = get_theme_mod('custom_logo');
        $logo_url = $attachment_id ? wp_get_attachment_image_url($attachment_id, 'full') : JP_IMG . '/logo.png';

        return esc_url($logo_url);
    }
}

if (!function_exists('get_logo')) {
    /**
     * Returns a logo, linked to home.
     *
     * @param string $file_name
     *
     * @param array $attr
     *
     * @return string Logo markup.
     */
    function get_logo($file_name = 'logo.png', $attr = [])
    {
        $src_dir = get_template_directory() . '/assets/img/' . $file_name;

        $html = '';

        if (file_exists($src_dir)) {

            $src = JP_IMG . '/' . $file_name;
            $mime = mime_content_type($src_dir);

            if ('image/svg' !== $mime) {

                list($width, $height) = getimagesize($src);

                $logo_img = sprintf(
                    '<img class="logo-img" src="%s" width="%s" height="%s" alt="%s">',
                    esc_url($src),
                    esc_attr($width),
                    esc_attr($height),
                    get_bloginfo('name')
                );

            } else {

                $fill = $attr['fill'] ?: '#000';
                $width = $attr['width'] ?: 100;
                $height = $attr['height'] ?: 50;

                $logo_img = sprintf(
                    '<svg class="logo-img" width="%s" height="%s" fill="%s" aria-label="%s"><use xlink:href="#%s"></use></svg>',
                    esc_attr($width),
                    esc_attr($height),
                    esc_attr($fill),
                    get_bloginfo('name'),
                    esc_attr(basename($file_name, '.svg'))
                );

            }

            $html = sprintf(
                '<a class="logo-link" href="%s">%s</a>',
                esc_url(home_url('/')),
                $logo_img
            );

        } else {
            trigger_error(
                sprintf('A file name %s is not found in %s/', $file_name, JP_IMG),
                E_USER_WARNING
            );
        }

        return $html;
    }
}

if (!function_exists('hamburger')) {
    /**
     * Hamburger HTML Markup
     *
     * @param string $class
     * @param bool $echo
     *
     * @return string|void
     */
    function hamburger($class = 'js-hamburger', $echo = true)
    {
        $box = '<span class="hamburger-box"><span class="hamburger-inner"></span></span>';

        $html = sprintf(
            '<button class="hamburger %s" type="button" tabindex="0" aria-label="%s">%s</button>',
            esc_attr($class),
            __('Trigger mobile menu.', 'joompress'),
            $box
        );

        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
}

if (!function_exists('btn_close_menu')) {
    function btn_close_menu($class = 'js-menu-close')
    {
        echo sprintf(
            '<button type="button" tabindex="0" class="menu-close %s" aria-label="%s"></button>',
            esc_attr($class),
            __('Close mobile menu.', 'joompress')
        );
    }
}

if (!function_exists('skip_to_content')) {
    /**
     * Skip To Content HTML Markup
     *
     * @param string $id
     * @param bool $echo
     *
     * @return string|void
     */
    function skip_to_content($id = 'content', $echo = true)
    {
        $html = sprintf(
            '<a class="skip-link screen-reader-text" href="#%s" tabindex="0">%s</a>',
            esc_attr($id),
            __('Skip to content', 'joompress')
        );

        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
}

if (!function_exists('the_phone_number')) {
    /**
     * Display phone number for html markup <a href="tel:phone_number"></a>
     *
     * @param $phone_number
     *
     * @see get_phone_number()
     * @return void
     */
    function the_phone_number($phone_number)
    {
        echo get_phone_number($phone_number);
    }
}

if (!function_exists('get_phone_number')) {
    /**
     * Clear phone number for tag <a href="tel:phone_number"></a>
     *
     * @param string $phone_number
     *
     * @return string
     */
    function get_phone_number($phone_number)
    {
        return str_replace(['-', '(', ')', ' '], '', $phone_number);
    }
}

if (!function_exists('get_phones')) {
    /**
     * Get Phone Numbers
     *
     * @see Phones::getPhones()
     *
     * @return array
     */
    function get_phones()
    {
        if (class_exists('Phones')) {
            return (new Phones())->getPhones();
        }

        return [];
    }
}

if (!function_exists('phones')) {
    /**
     * Phone Numbers
     *
     * @see Phones::getPhones()
     *
     * @return void
     */
    function phones()
    {
        if (class_exists('Phones')) {
            echo (new Phones())->getMarkup();
        }
    }
}

if (!function_exists('get_messengers')) {
    /**
     * Get Messengers
     *
     * @see Messengers::getMessengers()
     *
     * @return array
     */
    function get_messengers()
    {
        if (class_exists('Messengers')) {
            return (new Messengers())->getMessengers();
        }

        return [];

    }
}

if (!function_exists('messengers')) {
    /**
     * Messengers
     *
     * @see Messengers::getMarkup()
     *
     * @return void
     */
    function messengers()
    {
        if (class_exists('Messengers')) {
            echo (new Messengers())->getMarkup();
        }
    }
}

if (!function_exists('get_social')) {
    /**
     * Get Social Networks
     *
     * @see Social::getSocial()
     *
     * @param array $options
     *
     * @return array
     */
    function get_social($options = [])
    {
        if (class_exists('Social')) {
            return (new Social())->getSocial($options);
        }

        return [];

    }
}

if (!function_exists('social')) {
    /**
     * Social Networks
     *
     * @see Social::getMarkup()
     *
     * @param array $options
     *
     * @return void
     */
    function social($options = [])
    {
        if (class_exists('Social')) {
            echo (new Social())->getMarkup($options);
        }
    }
}

if (!function_exists('scroll_top')) {
    /**
     * HTML Markup Scroll Top
     *
     * @see ScrollTop::getMarkup()
     *
     * @return void
     */
    function scroll_top()
    {
        if (class_exists('ScrollTop')) {
            echo (new ScrollTop())->getMarkup();
        }
    }
}

if (!function_exists('get_svg_sprite')) {
    /**
     * Get SVG Sprite markup
     *
     * @return string
     */
    function get_svg_sprite()
    {
        $filename = get_template_directory() . '/assets/img/sprite.svg';

        ob_start();

        if (file_exists($filename) && filesize($filename)) {
            load_template($filename);
        }

        return ob_get_clean();
    }
}

if (!function_exists('svg_sprite')) {
    /**
     * SVG Sprite markup
     *
     * @see get_svg_sprite()
     *
     * @return void
     */
    function svg_sprite()
    {
        echo get_svg_sprite();
    }
}

if (!function_exists('analytics_tracking_code')) {
    /**
     * Display Analytics Tracking Code
     *
     * @param string $placed
     *
     * @see get_analytics_tracking_code()
     * @return void
     */
    function analytics_tracking_code($placed = 'body')
    {
        echo get_analytics_tracking_code($placed);
    }
}

if (!function_exists('get_analytics_tracking_code')) {
    /**
     * Return Analytics Tracking Code
     *
     * @param string $placed
     *
     * @return string
     */
    function get_analytics_tracking_code($placed = 'body')
    {
        $tracking_code = [];
        $tracking_code['google'] = get_theme_mod('jp_analytics_google');
        $tracking_code['yandex'] = get_theme_mod('jp_analytics_yandex');
        $tracking_code['custom'] = get_theme_mod('jp_analytics_custom');

        $tracking_placed = [];
        $tracking_placed['google'] = get_theme_mod('jp_analytics_google_placed', 'body');
        $tracking_placed['yandex'] = get_theme_mod('jp_analytics_yandex_placed', 'body');
        $tracking_placed['custom'] = get_theme_mod('jp_analytics_custom_placed', 'body');

        $output = '';

        foreach ($tracking_code as $key => $script) {
            if (!empty($tracking_placed[$key]) && !empty($script)) {
                if ($tracking_placed[$key] === $placed) {
                    $output .= $script . PHP_EOL;
                }
            }
        };

        if (!empty($output)) {
            return sprintf('<script>%s</script>', $output);
            //return $output;
        }

        return '';

    }
}

if (!function_exists('copyright')) {
    /**
     * Copyright Info
     *
     * @param bool $echo
     *
     * @return string|void
     */
    function copyright($echo = true)
    {
        $copyright = sprintf(
            __('&copy; %d %s. %s', 'joompress'),
            date('Y'),
            get_bloginfo('name'),
            __('All rights reserved', 'joompress')
        );

        if ($echo) {
            echo $copyright;
        } else {
            return $copyright;
        }
    }
}

if (!function_exists('delete_post_link')) {
    /**
     * Displays the delete post link for post.
     *
     * @since 1.0.0
     * @since 4.4.0 The `$class` argument was added.
     *
     * @param string $text Optional. Anchor text. If null, default is 'Delete This'. Default null.
     * @param string $before Optional. Display before edit link. Default empty.
     * @param string $after Optional. Display after edit link. Default empty.
     * @param int $id Optional. Post ID. Default is the ID of the global `$post`.
     * @param string $class Optional. Add custom class to link. Default 'post-delete-link'.
     */
    function delete_post_link($text = null, $before = '', $after = '', $id = 0, $class = 'post-delete-link')
    {
        if (!$post = get_post($id)) {
            return;
        }

        if (!$url = get_delete_post_link($post->ID)) {
            return;
        }

        if (null === $text) {
            $text = __('Delete This', 'joompress');
        }

        $link = '<a class="' . esc_attr($class) . '" href="' . esc_url($url) . '">' . $text . '</a>';

        /**
         * Filters the post delete link anchor tag.
         *
         * @since 2.3.0
         *
         * @param string $link Anchor tag for the edit link.
         * @param int $post_id Post ID.
         * @param string $text Anchor text.
         */
        echo $before . apply_filters('delete_post_link', $link, $post->ID, $text) . $after;
    }
}

if (!function_exists('dump')) {
    /**
     * Dumps information about a variable
     *
     * @param mixed ...$expression
     *
     * @return void
     */
    function dump(...$expression)
    {
        echo '<pre style="flex-shrink: 0;">';
        var_dump($expression);
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    /**
     * Dump and die
     *
     * @param mixed ...$expression
     *
     * @return void
     */
    function dd(...$expression)
    {
        dump($expression);
        die();
    }
}

if (!function_exists('jp_get_ip')) {
    /**
     * Get client IP.
     *
     * @return string|null
     */
    function jp_get_ip()
    {
        $fields = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($fields as $ip_field) {
            if (!empty($_SERVER[$ip_field])) {
                return $_SERVER[$ip_field];
            }
        }

        return null;
    }
}


if (!function_exists('jp_pagination')) {
    /**
     * Pagination
     *
     * @param array $args
     *
     * @return array|string
     */
    function jp_pagination($args = [])
    {
        /** @var WP_Rewrite $wp_rewrite */
        /** @var WP_Query $wp_query */
        global $wp_query, $wp_rewrite;

        // Setting up default values based on the current URL.
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $url_parts = explode('?', $pagenum_link);

        // Get max pages and current page out of the current query, if available.
        $total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
        $current = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

        // Append the format placeholder to the base URL.
        $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

        // URL base depends on permalink settings.
        $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%',
            'paged') : '?paged=%#%';

        $defaults = [
            'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
            'format' => $format, // ?page=%#% : %#% is replaced by the page number
            'total' => $total,
            'current' => $current,
            'aria_current' => 'page',
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'end_size' => 1,
            'mid_size' => 1,
            'type' => 'list',
            'add_args' => [], // array of query args to add
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => '',
        ];

        $args = wp_parse_args($args, $defaults);

        if (!is_array($args['add_args'])) {
            $args['add_args'] = [];
        }

        // Merge additional query vars found in the original URL into 'add_args' array.
        if (isset($url_parts[1])) {
            // Find the format argument.
            $format = explode('?', str_replace('%_%', $args['format'], $args['base']));
            $format_query = isset($format[1]) ? $format[1] : '';
            wp_parse_str($format_query, $format_args);

            // Find the query args of the requested URL.
            wp_parse_str($url_parts[1], $url_query_args);

            // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
            foreach ($format_args as $format_arg => $format_arg_value) {
                unset($url_query_args[$format_arg]);
            }

            $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
        }

        // Who knows what else people pass in $args
        $total = (int)$args['total'];
        if ($total < 2) {
            return;
        }
        $current = (int)$args['current'];
        $end_size = (int)$args['end_size']; // Out of bounds?  Make it the default.
        if ($end_size < 1) {
            $end_size = 1;
        }
        $mid_size = (int)$args['mid_size'];
        if ($mid_size < 0) {
            $mid_size = 2;
        }
        $add_args = $args['add_args'];
        $r = '';
        $page_links = [];
        $dots = false;

        if ($args['prev_next'] && $current && 1 < $current) :
            $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
            $link = str_replace('%#%', $current - 1, $link);
            if ($add_args) {
                $link = add_query_arg($add_args, $link);
            }
            $link .= $args['add_fragment'];

            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            $page_links[] = '<a class="pagination-link pagination-prev" href="' . esc_url(apply_filters('paginate_links',
                    $link)) . '">' . $args['prev_text'] . '</a>';
        endif;
        for ($n = 1; $n <= $total; $n++) :
            if ($n == $current) :
                $page_links[] = "<span aria-current='" . esc_attr($args['aria_current']) . "' class='pagination-link is-current'>" . $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number'] . "</span>";
                $dots = true;
            else :
                if ($args['show_all'] || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
                    $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                    $link = str_replace('%#%', $n, $link);
                    if ($add_args) {
                        $link = add_query_arg($add_args, $link);
                    }
                    $link .= $args['add_fragment'];

                    /** This filter is documented in wp-includes/general-template.php */
                    $page_links[] = "<a class='pagination-link' href='" . esc_url(apply_filters('paginate_links',
                            $link)) . "'>" . $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number'] . "</a>";
                    $dots = true;
                elseif ($dots && !$args['show_all']) :
                    $page_links[] = '<span class="pagination-link pagination-dots">' . __('&hellip;',
                            'joompress') . '</span>';
                    $dots = false;
                endif;
            endif;
        endfor;
        if ($args['prev_next'] && $current && $current < $total) :
            $link = str_replace('%_%', $args['format'], $args['base']);
            $link = str_replace('%#%', $current + 1, $link);
            if ($add_args) {
                $link = add_query_arg($add_args, $link);
            }
            $link .= $args['add_fragment'];

            /** This filter is documented in wp-includes/general-template.php */
            $page_links[] = '<a class="pagination-link pagination-next" href="' . esc_url(apply_filters('paginate_links',
                    $link)) . '">' . $args['next_text'] . '</a>';
        endif;
        switch ($args['type']) {
            case 'array' :
                return $page_links;

            case 'list' :
                $r .= "<ul class='pagination-list'>\n\t<li class='pagination-item'>";
                $r .= join("</li>\n\t<li class='pagination-item'>", $page_links);
                $r .= "</li>\n</ul>\n";
                break;

            default :
                $r = join("\n", $page_links);
                break;
        }

        echo $r;
    }
}

if (!function_exists('jp_comments_pagination')) {
    /**
     * @param array $args
     *
     * @return void
     */
    function jp_comments_pagination($args = [])
    {

        if (isset($args['type']) && 'array' == $args['type']) {
            $args['type'] = 'plain';
        }

        /** @var WP_Rewrite $wp_rewrite */
        global $wp_rewrite;

        if (!is_singular()) {
            return;
        }

        $page = get_query_var('cpage');
        if (!$page) {
            $page = 1;
        }
        $max_page = get_comment_pages_count();
        $defaults = [
            'base' => add_query_arg('cpage', '%#%'),
            'format' => '',
            'total' => $max_page,
            'current' => $page,
            'echo' => true,
            'add_fragment' => '#comments',
            'prev_text' => __('&laquo; Previous', 'joompress'),
            'next_text' => __('Next &raquo;', 'joompress'),
        ];
        if ($wp_rewrite->using_permalinks()) {
            $defaults['base'] = user_trailingslashit(trailingslashit(get_permalink()) . $wp_rewrite->comments_pagination_base . '-%#%',
                'commentpaged');
        }

        $args = wp_parse_args($args, $defaults);

        jp_pagination($args);
    }
}

if (!function_exists('sanitize_checkbox')) {
    /**
     * @param $input
     * @return bool
     */
    function sanitize_checkbox($input)
    {
        if (is_bool($input)) {
            return $input;
        }

        if (is_string($input) && 'false' === strtolower($input)) {
            return false;
        }

        return (bool)$input;
    }
}

if (!function_exists('sanitize_select')) {
    /**
     * @param $input
     * @param WP_Customize_Setting $setting
     * @return string
     */
    function sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);

        $choices = $setting->manager->get_control($setting->id)->choices;

        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
}

if (!function_exists('sanitize_radio')) {
    /**
     * @param $input
     * @param WP_Customize_Setting $setting
     * @return string
     */
    function sanitize_radio($input, $setting)
    {
        $input = sanitize_key($input);

        $choices = $setting->manager->get_control($setting->id)->choices;

        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
}

if (!function_exists('sanitize_background_setting')) {
    /**
     * @param $value
     * @param $setting
     * @return string|WP_Error
     */
    function sanitize_background_setting($value, $setting)
    {
        if ('jp_login_background_repeat' === $setting->id) {
            if (!in_array($value, ['repeat-x', 'repeat-y', 'repeat', 'no-repeat'])) {
                return new WP_Error('invalid_value', 'Invalid value for background repeat.');
            }
        } elseif ('jp_login_background_attachment' === $setting->id) {
            if (!in_array($value, ['fixed', 'scroll'])) {
                return new WP_Error('invalid_value', 'Invalid value for background attachment.');
            }
        } elseif ('jp_login_background_position' === $setting->id) {
            if (!in_array($value, [
                'left top',
                'center top',
                'right top',
                'left center',
                'center center',
                'right center',
                'left bottom',
                'center bottom',
                'right bottom'
            ], true)) {
                return new WP_Error('invalid_value', 'Invalid value for background position X.');
            }
        } elseif ('jp_login_background_size' === $setting->id) {
            if (!in_array($value, ['auto', 'contain', 'cover'], true)) {
                return new WP_Error('invalid_value', 'Invalid value for background size.');
            }
        } elseif ('jp_login_background_image' === $setting->id || 'jp_login_background_image_thumb' === $setting->id) {
            $value = empty($value) ? '' : esc_url_raw($value);
        } else {
            return new WP_Error('unrecognized_setting', 'Unrecognized background setting.');
        }
        return $value;
    }
}

if (!function_exists('sanitize_phone')) {
    /**
     * Sanitizes a phone number.
     *
     * @param string $phone Phone to sanitize.
     * @return string Sanitized string.
     */
    function sanitize_phone($phone)
    {
        $phone = preg_replace('/^[0-9+-]$/', '', $phone);

        return $phone;
    }
}

if (!function_exists('is_ie')) {
    /**
     * Test if the current browser MSIE or Trident
     *
     * @return bool
     */
    function is_ie()
    {
        $is_ie = false;
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (isset($user_agent)) {
            $msie = strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE');
            $trident = strpos($_SERVER['HTTP_USER_AGENT'], 'Trident');
            if ($msie !== false || $trident !== false) {
                $is_ie = true;
            }
        }

        return $is_ie;
    }
}

if (!function_exists('get_background_login_page')) {
    /**
     * Get Background style for Login Page
     *
     * @return string
     */
    function get_background_login_page()
    {
        $background = get_theme_mod('jp_login_background_image');
        $color = get_theme_mod('jp_login_background_color');

        $style = $color ? "background-color: #$color;" : '';

        if ($background) {
            $image = ' background-image: url("' . esc_url_raw($background) . '");';

            $position = get_theme_mod('jp_login_background_position');

            if (!in_array($position, [
                'left top',
                'center top',
                'right top',
                'left center',
                'center center',
                'right center',
                'left bottom',
                'center bottom',
                'right bottom'
            ], true)) {
                $position = 'left top';
            }

            $position = " background-position: $position;";

            $size = get_theme_mod('jp_login_background_size');

            if (!in_array($size, ['auto', 'contain', 'cover'], true)) {
                $size = 'auto';
            }

            $size = " background-size: $size;";

            $repeat = get_theme_mod('jp_login_background_repeat');

            if (!in_array($repeat, ['repeat-x', 'repeat-y', 'repeat', 'no-repeat'], true)) {
                $repeat = 'repeat';
            }

            $repeat = " background-repeat: $repeat;";

            $attachment = get_theme_mod('background_attachment');

            if ('fixed' !== $attachment) {
                $attachment = 'scroll';
            }

            $attachment = " background-attachment: $attachment;";

            $style .= $image . $position . $size . $repeat . $attachment;

        }

        return trim($style);
    }
}

if (!function_exists('pushPreloadFile')) {
    /**
     * Push Preload File
     *
     * @param string $path - Path to the resource to be preloaded in the href attribute
     * @param string $type - The type of resource you are preloading in the as attribute
     *
     * @return void
     */
    function pushPreloadFile($path, $type = 'style')
    {
	    /*if (headers_sent()) {
		    return;
	    }*/

        //header("Link: <{$path}>; rel=preload; as={$type}", false);
    }
}

if (!function_exists('the_custom_category')) {
    /**
     * Display category list for a post in either HTML list or custom format.
     *
     * @since 0.71
     *
     * @param string $separator Optional. Separator between the categories. By default, the links are placed
     *                          in an unordered list. An empty string will result in the default behavior.
     * @param string $parents Optional. How to display the parents.
     * @param string $taxonomy Optional.
     * @param bool $post_id Optional. Post ID to retrieve categories.
     */
    function the_custom_category($separator = '', $taxonomy = 'category', $parents = '', $post_id = false)
    {
        echo get_the_custom_category_list($separator, $taxonomy, $parents, $post_id);
    }
}

if (!function_exists('get_the_custom_category_list')) {
    /**
     * Retrieve category list for a post in either HTML list or custom format.
     *
     * @since 1.5.1
     *
     * @param string $separator Optional. Separator between the categories. By default, the links are placed
     *                          in an unordered list. An empty string will result in the default behavior.
     * @param string $parents Optional. How to display the parents.
     * @param string $taxonomy Optional.
     * @param bool $post_id Optional. Post ID to retrieve categories.
     * @return string
     * @global WP_Rewrite $wp_rewrite
     *
     */
    function get_the_custom_category_list($separator = '', $taxonomy = 'category', $parents = '', $post_id = false)
    {
        /** @var WP_Rewrite $wp_rewrite */
        global $wp_rewrite;
        if (!is_object_in_taxonomy(get_post_type($post_id), $taxonomy)) {
            /** This filter is documented in wp-includes/category-template.php */
            return apply_filters('the_custom_category', '', $separator, $parents);
        }

        /**
         * Filters the categories before building the category list.
         *
         * @since 4.4.0
         *
         * @param array $categories An array of the post's categories.
         * @param int|bool $post_id ID of the post we're retrieving categories for. When `false`, we assume the
         *                             current post in the loop.
         */
        $categories = apply_filters('the_custom_category_list', get_the_custom_category($post_id, $taxonomy), $post_id);

        if (empty($categories)) {
            /** This filter is documented in wp-includes/category-template.php */
            return apply_filters('the_custom_category', __('Uncategorized', 'joompress'), $separator, $parents);
        }

        $rel = (is_object($wp_rewrite) && $wp_rewrite->using_permalinks()) ? 'rel="category tag"' : 'rel="category"';

        $thelist = '';
        if ('' == $separator) {
            $thelist .= '<ul class="post-categories">';
            foreach ($categories as $category) {
                $thelist .= "\n\t<li>";
                switch (strtolower($parents)) {
                    case 'multiple':
                        if ($category->parent) {
                            $thelist .= get_custom_category_parents($category->parent, true, $separator, $taxonomy);
                        }
                        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" ' . $rel . '>' . $category->name . '</a></li>';
                        break;
                    case 'single':
                        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '"  ' . $rel . '>';
                        if ($category->parent) {
                            $thelist .= get_custom_category_parents($category->parent, false, $separator, $taxonomy);
                        }
                        $thelist .= $category->name . '</a></li>';
                        break;
                    case '':
                    default:
                        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" ' . $rel . '>' . $category->name . '</a></li>';
                }
            }
            $thelist .= '</ul>';
        } else {
            $i = 0;
            foreach ($categories as $category) {
                if (0 < $i) {
                    $thelist .= $separator;
                }
                switch (strtolower($parents)) {
                    case 'multiple':
                        if ($category->parent) {
                            $thelist .= get_custom_category_parents($category->parent, true, $separator, $taxonomy);
                        }
                        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" ' . $rel . '>' . $category->name . '</a>';
                        break;
                    case 'single':
                        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" ' . $rel . '>';
                        if ($category->parent) {
                            $thelist .= get_custom_category_parents($category->parent, false, $separator, $taxonomy);
                        }
                        $thelist .= "$category->name</a>";
                        break;
                    case '':
                    default:
                        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" ' . $rel . '>' . $category->name . '</a>';
                }
                ++$i;
            }
        }

        /**
         * Filters the category or list of categories.
         *
         * @since 1.2.0
         *
         * @param string $thelist List of categories for the current post.
         * @param string $separator Separator used between the categories.
         * @param string $parents How to display the category parents. Accepts 'multiple',
         *                          'single', or empty.
         */
        return apply_filters('the_custom_category', $thelist, $separator, $parents);
    }
}

if (!function_exists('get_the_custom_category')) {
    /**
     * Retrieve post categories.
     *
     * This tag may be used outside The Loop by passing a post id as the parameter.
     *
     * Note: This function only returns results from the default "category" taxonomy.
     * For custom taxonomies use get_the_terms().
     *
     * @since 0.71
     *
     * @param bool $id Optional, default to current post ID. The post ID.
     * @param string $taxonomy Optional
     * @return array Array of WP_Term objects, one for each category assigned to the post.
     */
    function get_the_custom_category($id = false, $taxonomy = 'category')
    {
        $categories = get_the_terms($id, $taxonomy);
        if (!$categories || is_wp_error($categories)) {
            $categories = [];
        }

        $categories = array_values($categories);

        foreach (array_keys($categories) as $key) {
            _make_cat_compat($categories[$key]);
        }

        /**
         * Filters the array of categories to return for a post.
         *
         * @since 3.1.0
         * @since 4.4.0 Added `$id` parameter.
         *
         * @param array $categories An array of categories to return for the post.
         * @param int $id ID of the post.
         */
        return apply_filters('get_the_custom_categories', $categories, $id);
    }
}

if (!function_exists('get_custom_category_parents')) {
    /**
     * Retrieve category parents with separator.
     *
     * @since 1.2.0
     * @since 4.8.0 The `$visited` parameter was deprecated and renamed to `$deprecated`.
     *
     * @param int $id Category ID.
     * @param bool $link Optional, default is false. Whether to format with link.
     * @param string $separator Optional, default is '/'. How to separate categories.
     * @param string $taxonomy Optional
     * @param bool $nicename Optional, default is false. Whether to use nice name for display.
     * @param array $deprecated Not used.
     * @return string|WP_Error A list of category parents on success, WP_Error on failure.
     */
    function get_custom_category_parents(
        $id,
        $link = false,
        $separator = '/',
        $taxonomy = 'category',
        $nicename = false,
        $deprecated = []
    ) {

        if (!empty($deprecated)) {
            _deprecated_argument(__FUNCTION__, '4.8.0');
        }

        $format = $nicename ? 'slug' : 'name';

        $args = [
            'separator' => $separator,
            'link' => $link,
            'format' => $format,
        ];

        return get_term_parents_list($id, $taxonomy, $args);
    }
}
