<?php


if (!class_exists('BooklySeoSync')) {

    class BooklySeoSync
    {
        /**
         * Move to trash deleted items
         *
         * @param array $posts_ids
         */
        public static function deleted_items($posts_ids, $post_type)
        {
            try {
                $result = array();

                $posts = get_posts([
                    'post__not_in' => $posts_ids,
                    'post_type' => $post_type,
                    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit'),
                    'posts_per_page' => -1,
                ]);

                if (!$posts) return [];

                foreach ($posts as $item) {
                    wp_update_post([
                        'ID' => $item->ID,
                        'post_status' => 'trash'
                    ]);
                    $result[] = [
                        'ID' => $item->ID,
                        'post_title' => $item->post_title,
                    ];
                }

                return $result;
            } catch (Exception $e) {
                return array('error' => $e->getMessage());
            }
        }

    }
}
