<?php


if (!class_exists('BooklySeoStaffPost')) {

    class BooklySeoStaffPost
    {
        public static $post_type = 'bookly-seo-staff';

        public static $post_slug = 'staff-members';

        public static $menu_icon = '';

        /**
         * Main
         */
        public static function main()
        {

        }

        /**
         * Init method
         */
        public static function init()
        {
            if (!sbs_check_licence()) return;
            self::posts_register();
            sbita_flush('bookly-seo-' . self::get_post_slug());
        }

        /**
         * Register Posts
         */
        public static function posts_register()
        {
            $post_type = self::post_type();
            if (post_type_exists($post_type)) return;

            $labels = array(
                'name' => esc_html__('Staff Members', 'sbita-bookly-seo'),
                'all_items' => esc_html__('Staff Members', 'sbita-bookly-seo'),
                'singular_name' => esc_html__('Staff', 'sbita-bookly-seo'),
                'add_new' => esc_html__('Add New', 'sbita-bookly-seo'),
                'add_new_item' => esc_html__('Add New', 'sbita-bookly-seo'),
                'edit_item' => esc_html__('Edit', 'sbita-bookly-seo'),
                'new_item' => esc_html__('Add New', 'sbita-bookly-seo'),
                'view_item' => esc_html__('View Item', 'sbita-bookly-seo'),
                'search_items' => esc_html__('Search', 'sbita-bookly-seo'),
                'not_found' => esc_html__('No found product', 'sbita-bookly-seo'),
                'not_found_in_trash' => esc_html__('No found in trash', 'sbita-bookly-seo')
            );

            $args = array(
                'can_export' => true,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'capability_type' => 'post',
                'capabilities' => array(
                    'create_posts' => false,
                ),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'rewrite' => array('slug' => self::get_post_slug()),
                'menu_position' => 5,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_menu' => 'edit.php?post_type=bookly-seo-services',
                'has_archive' => true,
                'supports' => array(
                    'title',
                    'editor',
                    'comments',
                    'revisions',
                    'author',
                    'comments',
                    'excerpt',
                    'page-attributes',
                    'thumbnail',
                    'custom-fields',
                    'front-end-editor'
                ),
            );

            register_post_type($post_type, $args);
        }

        /**
         * Get post type
         */
        public static function post_type()
        {
            return self::$post_type;
        }

        /**
         * Get post slug
         *
         * @return string
         */
        public static function get_post_slug()
        {
            try {
                $slug = sbita_get_option('bs_staff_slug');
                if (!$slug) return self::$post_slug;
                return $slug;
            } catch (Exception $e) {
                return self::$post_slug;
            }
        }

    }
}
