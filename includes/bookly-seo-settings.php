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
            $whc_option->setLabel(__('Services', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Services Slug
            $whc_option = new SbitaCoreOptionModel('bs_services_slug');
            $whc_option->setDefaultValue(BooklySeoServicesPost::$post_slug);
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Services Slug', 'sbita-bookly-seo'));
            $whc_option->setGroup(self::$group_name);
            $whc_option->add();

            // Services Template
            $whc_option = new SbitaCoreOptionModel('bs_services_template');
            $whc_option->setDefaultValue(BooklySeoServicesPost::$post_slug);
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Services Page Template', 'sbita-bookly-seo'));
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

            // Staff Template
            $whc_option = new SbitaCoreOptionModel('bs_staff_template');
            $whc_option->setDefaultValue(BooklySeoServicesPost::$post_slug);
            $whc_option->setInputType('text');
            $whc_option->setLabel(__('Staff Members Page Template', 'sbita-bookly-seo'));
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


        }


    }
}