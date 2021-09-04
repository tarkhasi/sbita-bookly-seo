<?php
if (!class_exists('BooklySeoShortcodes')) {
    class BooklySeoShortcodes
    {
        public static $service_details_shortcode = 'sbita-bookly-seo-service-details';
        public static $staff_details_shortcode = 'sbita-bookly-seo-staff-details';

        public static function main()
        {
            try {
                add_shortcode(self::$service_details_shortcode, array(__CLASS__, 'service_details'));
                add_shortcode(self::$staff_details_shortcode, array(__CLASS__, 'staff_details'));

            } catch (Exception $e) {
                sbita_show_admin_message($e->getMessage());
            }
        }

        /**
         * Show service details
         *
         * @param $attrs
         * @return false|string
         */
        public static function service_details($attrs)
        {
            wp_enqueue_style('bookly-seo', sbita_plugin_asset_url(__FILE__, 'css/bookly-seo-main.css') , false, '1.0', 'all');

            ob_start();
            include sbita_plugin_template(__FILE__, 'shortcodes/service-details.php');
            return ob_get_clean();
        }

        /**
         * Show staff details
         *
         * @param $attrs
         * @return false|string
         */
        public static function staff_details($attrs)
        {
            wp_enqueue_style('bookly-seo', sbita_plugin_asset_url(__FILE__, 'css/bookly-seo-main.css') , false, '1.0', 'all');

            ob_start();
            include sbita_plugin_template(__FILE__, 'shortcodes/staff-details.php');
            return ob_get_clean();
        }

    }
}