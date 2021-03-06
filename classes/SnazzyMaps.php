<?php

if (!class_exists('SnazzyMaps')) {
    /**
     * Class SnazzyMaps
     *
     * @author Kudinov Fedor <admin@joompress.biz>
     */
    class SnazzyMaps
    {
        /**
         * @var wpdb
         */
        private $wpdb;

        /**
         * @var string
         */
        private $table = 'snazzymaps';

        /**
         * @var string
         */
        private $table_name;

        /**
         * @var string
         */
        private $charset_collate;

        /**
         * @var bool
         */
        private $table_exists = false;

        /**
         * @var bool
         */
        private $table_empty = true;

        /**
         * @var array
         */
        private $styles = [];

        /**
         * @var array
         */
        private $pagination = [];

        /**
         * @var int
         */
        private $page_size = 500;

        /**
         * @var int
         */
        private $total_items = 0;

        /**
         * @var int
         */
        private $total_pages = 0;

        /**
         * SnazzyMaps constructor.
         */
        public function __construct()
        {
            global $wpdb;
            $this->wpdb = $wpdb;

            if (!in_array($this->table, $this->wpdb->tables)) {
                $this->wpdb->tables[] = $this->table;
            }

            $this->table_name = $this->wpdb->prefix . $this->table;
            $this->charset_collate = $this->wpdb->get_charset_collate();

            $this->isTableExist();
            $this->isTableEmpty();

            //$this->createTable();
            //$this->fillTable();
        }

        /**
         * Checks if the table exists in the DB
         *
         * @return bool
         */
        public function isTableExist()
        {
            $this->table_exists = $this->table_name === $this->wpdb->get_var("SHOW TABLES LIKE '$this->table_name';");

            return $this->table_exists;
        }

        /**
         * Check if the table is empty
         *
         * @return bool
         */
        public function isTableEmpty()
        {
            if ($this->table_exists) {
                $this->total_items = $this->wpdb->get_var("SELECT COUNT(*) FROM `$this->table_name`;");
                $this->table_empty = false === (bool)$this->total_items;
            }

            return $this->table_empty;
        }

        /**
         * Create Table in DB
         *
         * @return void
         */
        public function createTable()
        {
            if (!$this->table_exists) {

                // ENGINE=MyISAM | InnoDB

                $sql = "CREATE TABLE $this->table_name (
                  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                  style_id INT NOT NULL,
                  name VARCHAR(255) NOT NULL,
                  url VARCHAR(255) NOT NULL,
                  image_url VARCHAR(255) NOT NULL,
                  json TEXT NOT NULL,
                  views INT NOT NULL,
                  favorites INT NOT NULL,
                  created_on INT NOT NULL,
                  tags VARCHAR(255) NOT NULL,
                  colors VARCHAR(255) NOT NULL,
                  PRIMARY KEY (id)
                ) ENGINE=MyISAM $this->charset_collate;";

                $this->wpdb->query($sql);

                $this->table_exists = true;
            }
        }

        /**
         * Drop Table in DB
         *
         * @return void
         */
        public function dropTable()
        {
            if ($this->table_exists) {

                $sql = "DROP TABLE IF EXISTS `$this->table_name`;";

                $this->wpdb->query($sql);

                $this->table_exists = false;

            }
        }

        /**
         * Fills the table with values
         *
         * @return void
         */
        public function fillTable()
        {
            if ($this->table_exists && $this->table_empty) {

                $url = $this->getRemoteUrl();

                $response = $this->getResponse($url);

                if (null !== $response) {
                    $this->pagination = $response['pagination'];
                    $this->total_pages = $this->pagination['totalPages'];
                }

                for ($i = 1; $i <= $this->total_pages; $i++) {
                    $url = $this->getRemoteUrl([
                        'pageSize' => $this->page_size,
                        'page' => $i,
                    ]);

                    $response = $this->getResponse($url);

                    if (null !== $response) {
                        $this->styles = $response['styles'];

                        $maps = [];

                        foreach ($this->styles as $key => $item) {
                            $timestamp = strtotime($item['createdOn']);
                            $tags = join('|', $item['tags']);
                            $colors = join('|', $item['colors']);

                            $maps[$key] = [
                                'style_id' => (int)$item['id'],
                                'name' => htmlspecialchars($this->validate_field($item['name'])),
                                //'description' => htmlspecialchars($this->validate_field($item['description'])),
                                'url' => htmlspecialchars($this->validate_field($item['url'])),
                                'image_url' => htmlspecialchars($this->validate_field($item['imageUrl'])),
                                'json' => $this->validate_field($item['json']),
                                'views' => (int)$item['views'],
                                'favorites' => (int)$item['favorites'],
                                'created_on' => (int)$timestamp,
                                'tags' => htmlspecialchars($this->validate_field($tags)),
                                'colors' => htmlspecialchars($this->validate_field($colors)),
                            ];

                            $this->wpdb->insert(
                                $this->table_name, $maps[$key],
                                ['%d', '%s', '%s', '%s', '%s', '%d', '%d', '%d', '%s', '%s']
                            );
                        }
                    }

                }

                $this->table_empty = false;

            }
        }

        /**
         * Get Remote Url Snazzy Maps
         * @param array $query_data
         * @return string
         */
        public function getRemoteUrl($query_data = [])
        {
            $query_defaults = [
                'key' => 'ecaccc3c-44fa-486c-9503-5d473587a493',
                'pageSize' => $this->page_size,
                'page' => 1,
                'sort' => 'popular',
            ];

            $query_data = array_merge($query_defaults, $query_data);

            $query = http_build_query($query_data);

            $url = sprintf('https://snazzymaps.com/explore.json?%s', $query);

            return $url;
        }

        /**
         * Get Response
         *
         * @param $url
         *
         * @return array|mixed|null|object|WP_Error
         */
        public function getResponse($url)
        {
            $response = wp_remote_get($url, [
                'timeout' => 30,
                'sslverify' => true,
            ]);

            if (is_object($response)) {
                return null;
            }

            if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                $body = wp_remote_retrieve_body($response);
                $response = json_decode($body, true);
            }

            return $response;

        }

        /**
         * Validate fields
         *
         * @param $field
         * @return string
         */
        public function validate_field($field)
        {
            $field = trim($field);
            $field = stripslashes($field);
            $field = strip_tags($field);

            return $field;
        }

        /**
         * Minify JSON String
         *
         * @param string $subject
         * @return string
         */
        public function minifyString($subject)
        {
            $subject = preg_replace("/[\r\n\t\s]+/i", '', $subject);

            return trim($subject);
        }

        /**
         * Get Snazzy Maps Items
         *
         * @param array $options
         * @return array|null|object
         */
        public function getItems($options = [])
        {
            $default = [
                'sort' => get_theme_mod('snazzy_maps_sort_by', ''),
                'tag' => get_theme_mod('snazzy_maps_filter_by_tag', ''),
                'color' => get_theme_mod('snazzy_maps_filter_by_color', ''),
                'limit' => get_theme_mod('snazzy_maps_limit', 100),
            ];

            $results = [];

            if ($this->table_exists && !$this->table_empty) {

                $options = array_merge($default, $options);

                $conditions = [];
                $condition = '';

                if (!empty($tag = $options['tag'])) {
                    $conditions[] = "`tags` LIKE '%{$tag}%'";
                }

                if (!empty($color = $options['color'])) {
                    $conditions[] = "`colors` LIKE '%{$color}%'";
                }

                if (!empty($conditions)) {
                    $condition = 'WHERE ' . join(' AND ', $conditions);
                }

                switch ($options['sort']) {
                    case 'name':
                        $order_by = 'ORDER BY `name` ASC';
                        break;
                    case 'recent':
                        $order_by = 'ORDER BY `created_on` DESC';
                        break;
                    case 'popular':
                    default:
                        $order_by = 'ORDER BY `views` DESC';
                        break;
                }

                $limit_val = $options['limit'] < 1000 ? (int)$options['limit'] : 1000;
                $limit = sprintf('LIMIT %d', $limit_val);

                $results = $this->wpdb->get_results(
                    "SELECT `style_id`, `name`, `image_url`, `json` FROM $this->table_name $condition $order_by $limit;",
                    ARRAY_A
                );

            }

            return $results;
        }

        /**
         * Get Snazzy Map Style item By ID
         *
         * @param int $id
         *
         * @param string $field
         * @return string
         */
        public function getItem($id, $field = 'json')
        {
            $id = (int)$id;

            $result = '';

            if ($this->table_exists && !$this->table_empty) {

                $result = $this->wpdb->get_row(
                    "SELECT `$field` FROM `$this->table_name` WHERE `style_id` = $id LIMIT 1;",
                    ARRAY_A
                );

                return $result[$field];

            }

            return $result;
        }

        /**
         * Get json Snazzy Map Style item By ID
         *
         * @param int $id
         *
         * @return string
         */
        public function getItemJson($id)
        {
            return $this->getItem($id, 'json');
        }

        /**
         * Get image Snazzy Map Style item By ID
         *
         * @param int $id
         *
         * @return string
         */
        public function getItemImageUrl($id)
        {
            return $this->getItem($id, 'image_url');
        }

        /**
         * Get Snazzy Maps Styles
         *
         * @param array $options
         * @return array
         */
        public function getMapStyles($options = [])
        {
            $items = $this->getItems($options);

            $styles = [];

            foreach ($items as $item) {
                $styles[$item['style_id']] = ucfirst($item['name']);
            }

            return $styles;
        }

        /**
         * Get the total number of items
         *
         * @return int
         */
        public function countItems()
        {
            return $this->total_items;
        }
    }
}
