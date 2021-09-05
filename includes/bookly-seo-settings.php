<?php


if (!class_exists('BooklySeoSettings')) {
    class BooklySeoSettings
    {
        public static $group_name = 'Bookly Seo';

        public static function main()
        {


        }


        public static function admin_init()
        {
            self::add_settings();
        }

        private static function add_settings()
        {

            // >> Title
            $whc_option = new SbitaCoreOptionModel(null);
            $whc_option->setInputType('split');
            $whc_option->setLabel(__('Sync', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Auto sync
            $whc_option = new SbitaCoreOptionModel('bs_auto_sync');
            $whc_option->setDefaultValue('1');
            $whc_option->setInputType('checkbox');
            $whc_option->setLabel(__('Auto sync services and staff members by their posts if you open bookly services or bookly staff members page.', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Line
            $whc_option = new SbitaCoreOptionModel(null);
            $whc_option->setInputHtml('<hr/>');
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();


            if (!is_plugin_active('sbita-bookly-ui/main.php')) {
                // >> Title
                $whc_option = new SbitaCoreOptionModel(null);
                $whc_option->setInputType('split');
                $whc_option->setLabel(__('Bookly', 'sbita-bookly-seo'));
                $whc_option->setGroup(self::$group_name);
                $whc_option->add();

                // Bookly Page
                $whc_option = new SbitaCoreOptionModel('bs_bookly_page');
                $whc_option->setDefaultValue(BooklySeoServicesPost::$post_slug);
                $whc_option->setInputType('wp_dropdown_pages');
                $whc_option->setDescription(__('This page must contain of `[bookly-form]` shortcode.', 'sbita-bookly-ui'));
                $whc_option->setLabel(__('Bookly Page', 'sbita-bookly-seo'));
                $whc_option->setGroup(self::$group_name);
                $whc_option->add();

                // Line
                $whc_option = new SbitaCoreOptionModel(null);
                $whc_option->setInputHtml('<hr/>');
                $whc_option->setGroup(self::$group_name);
                $whc_option->add();
            }

            // >> Title
            $whc_option = new SbitaCoreOptionModel(null);
            $whc_option->setInputType('split');
            $whc_option->setLabel(__('Services', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            if (!is_plugin_active('sbita-bookly-ui/main.php')) {

                // Next button label
                $whc_option = new SbitaCoreOptionModel('bs_service_next_button_title');
                $whc_option->setDefaultValue('Book Now');
                $whc_option->setInputType('text');
                $whc_option->setLabel(__('Service Next Button Title', 'sbita-bookly-ui'));
                $whc_option->setGroup(self::$group_name);
                $whc_option->add();

            }


            // Services Slug
            $whc_option = new SbitaCoreOptionModel('bs_services_slug');
            $whc_option->setDefaultValue(BooklySeoServicesPost::$post_slug);
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Services Slug', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Service Details Class
            $whc_option = new SbitaCoreOptionModel('bs_service_details_class');
            $whc_option->setDefaultValue('sbu-service-item sbu-box-shadow sbu-rounded sbu-border');
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Service Details Class', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Show service detail in post
            $whc_option = new SbitaCoreOptionModel('bs_show_service_detail_in_post');
            $whc_option->setDefaultValue('1');
            $whc_option->setInputType('checkbox');
            $whc_option->setLabel(__('Show service details in post content', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();


            // Line
            $whc_option = new SbitaCoreOptionModel(null);
            $whc_option->setInputHtml('<hr/>');
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();


            // >> Title
            $whc_option = new SbitaCoreOptionModel(null);
            $whc_option->setInputType('split');
            $whc_option->setLabel(__('Staff Members', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Staff Slug
            $whc_option = new SbitaCoreOptionModel('bs_staff_slug');
            $whc_option->setDefaultValue(BooklySeoServicesPost::$post_slug);
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Staff Members Slug', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Staff Details Class
            $whc_option = new SbitaCoreOptionModel('bs_default_staff_item_class');
            $whc_option->setDefaultValue('sbu-staff-detail sbu-box-shadow sbu-rounded sbu-border');
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Staff Details Class', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            if (!is_plugin_active('sbita-bookly-ui/main.php')) {
                // Next button label
                $whc_option = new SbitaCoreOptionModel('bs_staff_next_button_title');
                $whc_option->setDefaultValue('Book Now');
                $whc_option->setInputType('text');
                $whc_option->setLabel(__('Staff Next Button Title', 'sbita-bookly-ui'));
                $whc_option->setGroup(self::$group_name);
                $whc_option->add();
            }


            // Show staff detail in post
            $whc_option = new SbitaCoreOptionModel('bs_show_staff_detail_in_post');
            $whc_option->setDefaultValue('1');
            $whc_option->setInputType('checkbox');
            $whc_option->setLabel(__('Show staff details in post content', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

        }


    }
}