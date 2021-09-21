<?php
if (!class_exists('BooklySeoUi')) {
    class BooklySeoUi
    {
        /**
         * Main method
         */
        public static function main()
        {
            add_filter('sbu_service_url', array(__CLASS__, 'service_url'), 10, 3);
            add_filter('sbu_staff_item_url', array(__CLASS__, 'staff_url'), 10, 3);
            add_filter('the_content', array(__CLASS__, 'add_details_to_service_content'));
            add_filter('the_content', array(__CLASS__, 'add_details_to_staff_content'));
        }

        /**
         * Init method
         */
        public static function init()
        {
            self::add_service_button();
        }

        /**
         * Add service detail
         *
         * @param $content
         * @return mixed|string
         */
        public static function add_details_to_service_content($content)
        {
            try {
                if (!is_single()) return $content;
                if (get_post_type() != BooklySeoServicesPost::post_type()) return $content;
                if (!sbita_get_option('bs_show_service_detail_in_post')) return $content;
                $post_id = get_post()->ID;
                $shortcode = BooklySeoShortcodes::$service_details_shortcode;
                return "[$shortcode post_id='$post_id']" . $content;
            } catch (Exception $e) {
                return $content;
            }
        }

        /**
         * Add staff detail to content
         *
         * @param $content
         * @return mixed|string
         */
        public static function add_details_to_staff_content($content)
        {
            try {
                if (!sbs_check_licence()) return $content;
                if (!is_single()) return $content;
                if (get_post_type() != BooklySeoStaffPost::post_type()) return $content;
                if (!sbita_get_option('bs_show_staff_detail_in_post')) return $content;
                $post_id = get_post()->ID;
                $shortcode = BooklySeoShortcodes::$staff_details_shortcode;
                return "[$shortcode post_id='$post_id']" . $content;
            } catch (Exception $e) {
                return $content;
            }
        }

        /**
         * Service page url
         *
         * @param $url
         * @param $item
         * @param $attrs
         * @return mixed|string
         */
        public static function service_url($url, $item, $attrs)
        {
            if (!$item || !isset($item['id'])) return $url;

            $args = array(
                'posts_per_page' => 1,
                'post_type' => BooklySeoServicesPost::post_type(),
                'post_status' => array('publish'),
                'meta_key' => BooklySeoSync::$post_item_id,
                'meta_value' => $item['id']
            );
            $posts = get_posts($args);
            if (!$posts || !is_array($posts)) return $url;
            return get_post_permalink($posts[0]->ID);
        }

        /**
         * Staff page url
         *
         * @param $url
         * @param $item
         * @param $attrs
         * @return mixed|string
         */
        public static function staff_url($url, $item, $attrs)
        {
            if (!sbs_check_licence()) return $url;
            if (!$item || !isset($item['id'])) return $url;

            $args = array(
                'posts_per_page' => 1,
                'post_type' => BooklySeoStaffPost::post_type(),
                'post_status' => array('publish'),
                'meta_key' => '_sbita_bs_item_id',
                'meta_value' => $item['id']
            );
            $posts = get_posts($args);
            if (!$posts || !is_array($posts)) return $url;
            return get_post_permalink($posts[0]->ID);
        }

        private static function add_service_button()
        {
            if (is_plugin_active('sbita-bookly-ui/main.php')) return;
            add_action('sbu_service_button', array(__CLASS__, 'item_buttons'), 1, 2);
            
            add_action('sbu_staff_button', array(__CLASS__, 'staff_item_buttons'), 1, 2);
        }


        /**
         * Service item button
         *
         * @param $item
         * @param $attrs
         */
        public static function item_buttons($item, $attrs)
        {
            $page_id = sbita_get_option('bs_bookly_page');
            if (!$page_id) return;

            $url = get_permalink($page_id);
            $url = $url . '?service_id=' . $item['id'];
            $title = sbita_get_option('bs_service_next_button_title') ?? 'Next';
            $button_class = 'sbu-bookly-color sbu-color-white-hover sbu-bookly-bg-hover';

            if (!empty($attrs['button_label'])) $title = $attrs['button_label'];
            if (!empty($attrs['button_class'])) $button_class = $attrs['button_class'];
            echo '<a href="' . $url . '" class="'.$button_class.'"  > ' . __($title, 'sbita-bookly-ui') . ' </a>';
        }



        /**
         * Staff item button
         *
         * @param $item
         * @param $attrs
         */
        public static function staff_item_buttons($item, $attrs)
        {
            $page_id = sbita_get_option('bs_bookly_page');
            if (!$page_id) return;

            $url = get_permalink($page_id);
            $url = $url . '?staff_id=' . $item['id'];
            $title = sbita_get_option('bs_staff_next_button_title') ?? 'Next';
            $button_class = 'sbu-bookly-color sbu-color-white-hover sbu-bookly-bg-hover';
            if (!empty($attrs['button_label'])) $title = $attrs['button_label'];
            if (!empty($attrs['button_class'])) $button_class = $attrs['button_class'];
            echo '<a href="' . $url . '" class="'.$button_class.'"  > ' . __($title, 'sbita-bookly-ui') . '</a>';
        }

    }
}