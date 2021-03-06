<?php

if (!function_exists('jp_polylang_shortcode')) {
    /**
     * Add Shortcode Polylang
     *
     * @param $atts
     *
     * @return array|null|string
     */
    function jp_polylang_shortcode($atts)
    {
        // Attributes
        $atts = shortcode_atts(
            [
                'dropdown' => 0, // display as list and not as dropdown
                'echo' => 0, // echoes the list
                'hide_if_empty' => 1, // hides languages with no posts ( or pages )
                'menu' => 0, // not for nav menu ( this argument is deprecated since v1.1.1 )
                'show_flags' => 0, // don't show flags
                'show_names' => 1, // show language names
                'display_names_as' => 'name', // valid options are slug and name
                'force_home' => 0, // tries to find a translation
                'hide_if_no_translation' => 0, // don't hide the link if there is no translation
                'hide_current' => 0, // don't hide current language
                'post_id' => null, // if not null, link to translations of post defined by post_id
                'raw' => 0, // set this to true to build your own custom language switcher
                'item_spacing' => 'preserve', // 'preserve' or 'discard' whitespace between list items
            ],
            $atts
        );

        if (function_exists('pll_the_languages')) {
            $flags = pll_the_languages($atts);

            if (0 === (int)$atts['dropdown']) {
                $flags = sprintf('<ul class="lang"></ul>', $flags);
            }

            return $flags;
        }

        return '';

    }

    add_shortcode('jp_polylang', 'jp_polylang_shortcode');
}

if (!function_exists('jp_sitemap_shortcode')) {
    /**
     * Add Shortcode HTML Sitemap
     *
     * @param $atts
     *
     * @return string
     */
    function jp_sitemap_shortcode($atts)
    {
        $output = '';
        $args = [
            'public' => 1,
        ];

        // If you would like to ignore some post types just add them to the array below
        $ignoreposttypes = [
            'attachment',
            'popup',
        ];

        $post_types = get_post_types($args, 'objects');

        foreach ($post_types as $post_type) {
            if (!in_array($post_type->name, $ignoreposttypes)) {
                $output .= '<h2 class="sitemap-headline">' . $post_type->labels->name . '</h2>';
                $args = [
                    'posts_per_page' => -1,
                    'post_type' => $post_type->name,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ];
                $posts_array = get_posts($args);
                $output .= '<ul class="sitemap-list">';
                foreach ($posts_array as $pst) {
                    $output .= '<li class="sitemap-item"><a class="sitemap-link" href="' . get_permalink($pst->ID) . '">' . $pst->post_title . '</a></li>';
                }
                $output .= '</ul>';
            }
        }

        return $output;
    }

    add_shortcode('jp_sitemap', 'jp_sitemap_shortcode');
}

if (!function_exists('jp_search_shortcode')) {
    /**
     * Add Shortcode Search
     *
     * @return string String when $echo is false.
     */
    function jp_search_shortcode()
    {
        return get_search_form(false);
    }

    add_shortcode('jp_search', 'jp_search_shortcode');
}

/**
 * Add Quicktags Buttons
 */
function jp_add_quicktags()
{
    if (wp_script_is('quicktags')) { ?>
        <script>
            QTags.addButton('jp_search', 'search', '[jp_search]', '', 's', 'Add shortcode Search');
            QTags.addButton('jp_social', 'social', '[jp_social]', '', 's', 'Add shortcode Social');
            QTags.addButton('jp_phones', 'phones', '[jp_phones]', '', 'p', 'Add shortcode Phones');
            QTags.addButton('jp_sitemap', 'sitemap', '[jp_sitemap]', '', 's', 'Add shortcode Sitemap');
            QTags.addButton('jp_polylang', 'polylang', '[jp_polylang]', '', 'p', 'Add shortcode Polylang');
            QTags.addButton('jp_messengers', 'messengers', '[jp_messengers]', '', 'm', 'Add shortcode Messengers');
        </script>
    <?php }
}

add_action('admin_print_footer_scripts', 'jp_add_quicktags');
