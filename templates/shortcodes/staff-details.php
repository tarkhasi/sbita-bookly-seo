<?php
/**
 * Staff details
 * @var array $attrs
 */

if (!$attrs || (!isset($attrs['staff_id']) && !isset($attrs['post_id']))) {
    _e('`staff_id` or `post_id` for show staff details required!', 'sbita-bookly-seo');
    return null;
}

// find item
if (isset($attrs['staff_id'])) $item = sbita_bs_get_staff($attrs['staff_id']);
else $item = sbita_bs_get_staff_by_post($attrs['post_id']);
if (!isset($item['full_name'])) return;


$attachment_id = $item['attachment_id'];
$url = apply_filters('sbu_staff_item_url', null, $item, $attrs);
$default_class =  sbita_get_option('bs_default_staff_item_class');
$title_style =  isset($attrs['title_style']) ? $attrs['title_style'] : '';

?>

<div title="<?php echo esc_attr($item['full_name']) ?? ''; ?>"
     class="sbu-staff-detail <?php echo esc_attr($attrs['item_class'] ?? $default_class) ?>">

    <div class="sbu-staff-detail-image">
        <?php if ($url) { ?>
            <a href="<?php echo esc_url($url) ?>">
                <?php require SBS_TMP_DIR . '/shortcodes/staff-details-img.php'; ?>
            </a>
        <?php } else { ?>
            <?php require SBS_TMP_DIR . '/shortcodes/staff-details-img.php'; ?>
        <?php } ?>
    </div>

    <div class="sbu-staff-detail-content">
        <div class="sbu-staff-detail-info">
            <div class="sbu-staff-detail-title" title="<?php echo esc_attr($item['full_name'] ?? ''); ?>" style="<?php echo esc_html($title_style) ?>">
                <?php echo esc_html($item['full_name']); ?>
            </div>
            <div class="sbu-staff-detail-email" title="<?php echo esc_html($item['email'] ?? ''); ?>">
                <a href="mailto:<?php echo esc_html($item['email']) ?? ''; ?>"><?php echo esc_html($item['email'] ?? ''); ?></a>
            </div>
            <?php do_action('sbu_staff_info', $item, $attrs); ?>
        </div>
        <div class="sbu-staff-detail-footer">
            <?php do_action('sbu_staff_button', $item, $attrs); ?>
        </div>
    </div>



</div>