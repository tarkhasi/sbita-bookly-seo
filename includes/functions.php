<?php
if (!function_exists('sbita_bs_get_service_by_post')) return;

/**
 * Get bookly service info
 *
 * @param $id
 * @return null
 */
function sbita_bs_get_service($id)
{
    try {
        return \Bookly\Lib\Entities\Service::query('s')
            ->select('c.name AS category_name, s.*')
            ->leftJoin('Category', 'c', 's.category_id = c.id')
            ->where('s.visibility', 'public')
            ->where('id', $id)
            ->fetchRow();
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Get bookly staff info
 *
 * @param $id
 * @return null
 */
function sbita_bs_get_staff($id)
{
    try {
        return \Bookly\Lib\Entities\Staff::query('s')
            ->where('s.visibility', 'public')
            ->where('id', $id)
            ->fetchRow();
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Get bookly service info by post
 *
 * @param $post_id
 * @return null
 */
function sbita_bs_get_service_by_post($post_id)
{
    try {
        $result = get_post_meta($post_id, BooklySeoSync::$post_item_id);
        if (!$result) return null;
        return sbita_bs_get_service($result[0]);
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Get bookly staff info by post
 *
 * @param $post_id
 * @return null
 */
function sbita_bs_get_staff_by_post($post_id)
{
    try {
        $result = get_post_meta($post_id, BooklySeoSync::$post_item_id);
        if (!$result) return null;
        return sbita_bs_get_staff($result[0]);
    } catch (Exception $e) {
        return null;
    }
}


/**
 * Bookly duration
 *
 * @param $duration
 * @return mixed|string
 */
function sbs_duration($duration)
{
    try {
        return Bookly\Lib\Utils\DateTime::secondsToInterval($duration);
    } catch (Exception $e) {
        return $duration;
    }
}

/**
 * Get price currency
 *
 * @param $price
 * @return mixed|string
 */
function sbs_price($price)
{
    try {
        $currencies = Bookly\Lib\Utils\Price::getCurrencies();
        return $currencies[get_option('bookly_pmt_currency')]['symbol'] . ' ' . $price;
    } catch (Exception $e) {
        return $price;
    }
}

/**
 * Get price currency
 */
function sbs_check_licence($from_server = false)
{
    try {
        $licence = sbita_get_option('bs_licence');
        $product_id = sbs_get_product_id();
        $local = sbita_get_option('bs_licence_activated');
        if ($local !== null && $from_server == false) return $local;

        $result = sbita_licence($licence, $product_id);
        sbita_update_option('bs_licence_activated', $result);
        return $result;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Get Product id
 */
function sbs_get_product_id()
{
    return '3569';
}