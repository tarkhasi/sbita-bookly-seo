<?php


if (!class_exists('BooklySeoAdmin')) {
    class BooklySeoAdmin
    {
        /**
         * Main method
         */
        public static function main()
        {
            add_action('admin_menu', array(__CLASS__, 'admin_menu'));
        }

        /**
         * Admin init
         */
        public static function admin_init()
        {
            add_filter('plugin_action_links_' . sbita_plugin_dir_name(__FILE__) . '/main.php', array(__CLASS__, 'action_links'));
        }

        /**
         * Add links to plugins page
         *
         * @return mixed|string
         */
        public static function action_links($links)
        {

            array_unshift($links, '<a href="' . sbita_settings_url(BooklySeoSettings::$group_name) . '">Settings</a>');

            return $links;
        }

        /**
         * Admin menu
         */
        public static function admin_menu()
        {
            add_submenu_page(
                'edit.php?post_type=' . BooklySeoServicesPost::post_type(),
                __('Settings', 'sbita-bookly-seo'),
                __('Settings', 'sbita-bookly-seo'),
                'manage_options',
                sbita_settings_url(BooklySeoSettings::$group_name)
            );
        }

    }
}