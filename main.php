<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly
/*
Plugin Name: SbiTa Bookly Seo (Add-on)
Description:
Version: 1.0.0
Author: WebKok
Author URI:
Domain Path: /languages
Text Domain: sbita-bookly-seo
*/

if (!class_exists('SbitaBooklySeo')) {

    define('SBS_TMP_DIR', path_join(plugin_dir_path(__FILE__), 'templates'));

    require_once ABSPATH . 'wp-admin/includes/plugin.php';


    include plugin_dir_path(__FILE__) . '/includes/functions.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-services-post.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-staff-post.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-sync.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-sync-points.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-services-sync.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-staff-sync.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-settings.php';
    include plugin_dir_path(__FILE__) . '/includes/bookly-seo-admin.php';


    class SbitaBooklySeo
    {
        /**
         * Main Method
         */
        public static function main()
        {
            $result = is_plugin_active('sbita/main.php') && is_plugin_active('bookly-addon-pro/main.php');
            if (!$result) return self::need_core_message();

            add_action('plugins_loaded', array(__CLASS__, 'textdomain'));
            add_action('init', array(__CLASS__, 'init'));
            add_action('admin_init', array(__CLASS__, 'admin_init'));

            BooklySeoAdmin::main();
            BooklySeoSettings::main();
            BooklySeoServicesPost::main();
            BooklySeoStaffPost::main();
            BooklySeoStaffSync::main();
            BooklySeoServicesSync::main();
            BooklySeoSyncPoints::main();


        }

        /**
         * Init plugin
         */
        public static function init()
        {
            BooklySeoServicesPost::init();
            BooklySeoStaffPost::init();
            BooklySeoStaffSync::init();
            BooklySeoServicesSync::init();
            BooklySeoSyncPoints::init();
        }

        /**
         * Admin init plugin
         */
        public static function admin_init()
        {
            BooklySeoAdmin::admin_init();
            BooklySeoSyncPoints::admin_init();
            BooklySeoSettings::admin_init();
        }


        /**
         * Load textdomain
         *
         * @return void
         */
        public static function textdomain()
        {
            load_plugin_textdomain('sbita-bookly-seo', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }

        /**
         * Core message
         *
         */
        public static function need_core_message()
        {
            add_action('admin_notices', function () {
                echo "
                <div class='notice notice-error is-dismissible'>
                        <p>SbiTa Bookly Seo: Need `SbiTa`  and 
                        <a href='https://wordpress.org/plugins/bookly-responsive-appointment-booking-tool/'>Bookly</a>
                        plugins!</p>
                </div>";
            });
            return null;
        }

    }

    SbitaBooklySeo::main();
}
