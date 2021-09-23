<?php


if (!class_exists('BooklySeoSyncPoints')) {

    class BooklySeoSyncPoints
    {
        /**
         * Main method
         */
        public static function main()
        {
            add_action('sbs_sync', array(__CLASS__, 'sync'));
            add_action('admin_head-edit.php', array(__CLASS__, 'sync_buttons'));

        }

        /**
         * Main method
         */
        public static function init()
        {
            self::auto_sync();
        }

        /**
         * Admin init method
         */
        public static function admin_init()
        {
        }

        /**
         * Sync any thing
         */
        public static function sync()
        {
            self::sync_services();
            self::sync_staff_members();

        }

        /**
         * Sync services
         */
        public static function sync_services()
        {

            do_action('sbs_sync_services');

        }

        /**
         * Sync staff members
         */
        public static function sync_staff_members()
        {
            do_action('sbs_sync_staff_members');

        }

        public static function auto_sync()
        {
            if (!sbs_check_licence()) return;
            $result = sbita_get_option('bs_auto_sync');
            if (!$result) return;
            add_action('wp_ajax_bookly_get_services', array(__CLASS__, 'sync_services'), 1);
            add_action('wp_ajax_bookly_get_staff_list', array(__CLASS__, 'sync_staff_members'), 1);
        }

        public static function sync_buttons()
        {
            global $wp;
            if (!isset($_GET['post_type'])) return;
            if ($_GET['post_type'] != 'bookly-seo-staff' && $_GET['post_type'] != 'bookly-seo-services') return;

            $query_vars = $wp->query_vars;
            $query_vars['sync_request'] = 'true';
            $url = add_query_arg($query_vars, home_url($wp->request));

            if (isset($_GET['sync_request'])) {
                do_action('sbs_sync');
                sbita_show_admin_message(__('Sync successfully!', 'sbita-bookly-seo'), true, null);
            }

            ?>
            <script>
                jQuery(function () {
                    jQuery("body .wrap h1").append('<a href="<?php echo esc_url($url) ?>" class="page-title-action" style="margin:0 15px"><?php _e('Sync with bookly', 'sbita-bookly-seo') ?></a>');
                });
            </script>
            <?php
        }
    }
}
