<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.

global $product;

$post_thumbnail_id = $product->get_image_id();

// Use new, updated functions
$attachment_ids = $product->get_gallery_image_ids() ;
$gallery_thumbnail = wc_get_image_size('gallery_thumbnail');

$thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));

if ($attachment_ids && has_post_thumbnail()) {
    echo '<div class="wpgs-nav swiper-container fnt-product-image-thumbs-swiper">';
    echo '<div class="swiper-wrapper">';
    $image         = wp_get_attachment_image($post_thumbnail_id, 'shop_thumbnail', true);
    echo '<div class="swiper-slide"><div class="fnt-product-detail-thumbs d-flex align-items-center justify-content-center">'.$image.'</div></div>';

    foreach ($attachment_ids as $attachment_id) {
        $thumbnail_image     = wp_get_attachment_image($attachment_id, $thumbnail_size);
        echo '<div class="swiper-slide"><div class="fnt-product-detail-thumbs d-flex align-items-center justify-content-center">' . $thumbnail_image . '</div></div>';
    }
    echo "</div>";
    echo "</div>";
}
do_action('wpgs_after_image_gallery');
