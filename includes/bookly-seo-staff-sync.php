<?php


if (!class_exists('BooklySeoStaffSync')) {

    class BooklySeoStaffSync
    {


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
            add_action('sbs_sync_staff_members', array(__CLASS__, 'sync_items'));
        }

        /**
         * Sync items
         */
        public static function sync_items()
        {
            do_action('bookly_seo_sync_staff');

            $items = \Bookly\Lib\Entities\Staff::query('s')
                ->where('s.visibility', 'public')
                ->fetchArray();
            if (!$items) return;

            // create or update items
            $result = array();
            foreach ($items as $item) {
                $result[] = self::create_item($item);
            }


            // control deleted items
            $posts_ids = array_column($result, 'ID');
            BooklySeoSync::deleted_items($posts_ids, BooklySeoStaffPost::post_type());
        }

        /**
         * Create item
         */
        public static function create_item($item)
        {
            try {

                $array = array(
                    'post_type' => BooklySeoStaffPost::post_type(),
                    'post_title' => $item['full_name'] ?? 'Default Name',
                    'post_content' => $item['info'] ?? 'No description',
                    'post_status' => 'publish',
                    'page_template' => sbita_get_option('bs_services_template') ?? 'default',
                    'tax_input' => [],
                    'meta_input' => array(
                        '_thumbnail_id' => $item['attachment_id'] ?? '',
                        '_wp_page_template' => sbita_get_option('bs_staff_template') ?? 'default',
                        '_sbita_bs_item' => json_encode($item),
                        BooklySeoSync::$post_item_id => $item['id'],
                    ),
                );

                $args = array(
                    'posts_per_page' => -1,
                    'post_type' => BooklySeoStaffPost::post_type(),
                    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
                    'meta_key' => BooklySeoSync::$post_item_id,
                    'meta_value' => $item['id']
                );
                $posts = get_posts($args);

                // update post
                if ($posts) {
                    $post = $posts[0];
                    $array['ID'] = $post->ID;
                    $array['post_content'] = $post->post_content ?? $item['info'];
                    $array['sync_type'] = 'update';

                    $array = apply_filters('sbs_sync_staff_update_params', $array, $item, $post);
                    wp_update_post($array);
                    return $array;
                }

                $array['sync_type'] = 'insert';

                $array = apply_filters('sbs_sync_staff_insert_params', $array, $item);
                $array['ID'] = wp_insert_post($array);

                return $array;
            } catch (Exception $e) {
                return null;
            }
        }

    }
}
