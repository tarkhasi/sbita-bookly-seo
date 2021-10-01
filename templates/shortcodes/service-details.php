<?php
/**
 * Service details
 * @var array $attrs
 */

if (!$attrs || (!isset($attrs['service_id']) && !isset($attrs['post_id']))) {
    _e('`service_id` or `post_id` for show service details required!', 'sbita-bookly-seo');
    return null;
}

// find item
if (isset($attrs['service_id'])) $item = sbita_bs_get_service($attrs['service_id']);
else $item = sbita_bs_get_service_by_post($attrs['post_id']);
if (!isset($item['title'])) return;


$attachment_id = $item['attachment_id'];
$url = apply_filters('sbu_service_url', null, $item, $attrs);
$default_class = sbita_get_option('bs_service_details_class');
$title_style = isset($attrs['title_style']) ? $attrs['title_style'] : '';

?>

<div class="sbu-service-main <?php echo esc_attr($attrs['item_class'] ?? $default_class) ?>"
     title="<?php echo esc_attr($item['title']); ?>"
>

    <div class="sbu-service-detail-image">
        <?php if ($url) { ?>
            <a href="<?php echo esc_url($url) ?>">
                <?php require SBS_TMP_DIR . '/shortcodes/service-details-img.php'; ?>
            </a>
        <?php } else { ?>
            <?php require SBS_TMP_DIR . '/shortcodes/service-details-img.php'; ?>
        <?php } ?>
    </div>

    <div class="sbu-service-detail-content">
        <div class="sbu-service-detail-info">
            <div class="sbu-service-detail-title" style="<?php echo esc_attr($title_style) ?>">
                <?php echo esc_html($item['title']); ?>
            </div>
            <div class="sbu-service-detail-category" title="<?php _e('Category', 'sbita-bookly-ui'); ?>">
                <?php echo esc_html($item['category_name']); ?>
            </div>
            <div class="sub-flex">
                <div class="sbu-service-detail-duration" title="<?php _e('Duration', 'sbita-bookly-ui'); ?>">
                    <?php echo esc_html(sbs_duration($item['duration'])); ?>
                </div>
                <div class="sbu-service-detail-price" title="<?php _e('Price', 'sbita-bookly-ui'); ?>">
                    <?php echo esc_html(apply_filters('sbu_service_price', sbs_price($item['price']), $item)); ?>
                </div>
            </div>
        </div>

        <div class="sbu-service-detail-footer">
            <?php do_action('sbu_service_button', $item, $attrs); ?>
        </div>
    </div>

</div>