<?php
/**
 * Service Image
 *
 * @var array $attrs
 * @var string|numeric $attachment_id
 */

if (!isset($attachment_id) || !$attachment_id) {
    $default_image = sbita_get_option('bu_default_service_image');
    $default_image = $default_image != null ? $default_image : sbita_plugin_asset_url(__FILE__, 'img/default-service.jpg');
    echo sprintf("<img src='%s' alt=''/>", esc_url($default_image));
    return;
}
$image = wp_get_attachment_image_src($attachment_id, 'thumbnail');
$height = $attrs['height'] ?? '250px';
?>

<div <?php echo !empty($image) ? 'style="width: 100%;max-width:100%;height: '.esc_html($height).';background-image: url(' . esc_url($image[0]) . '); background-size: cover;"' : ''  ?>>
</div>