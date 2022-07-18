<?php

/*
 * GC CUSTOM GALLERY
 * Plugin Name: GC CUSTOM GALLERY
 * Plugin URI: https://gokhancelebi.net/
 * Description: OPEN IMAGE IN NEW TAB
 * Version: 1.0.0
 *
 */

function gc_image_gallery($atts)
{
    extract(shortcode_atts(array(
        "images" => "",
    ), $atts));


    $images = explode(",", $atts["ids"]);
    # convert image paths to image urls
    foreach ($images as &$image) {
        $image_big = wp_get_attachment_image_src($image, 'full')[0];
        $image_preview = wp_get_attachment_image_src($image, 'thumbnail')[0];
        $image = "<a target='_blank' href='" . $image_big . "' data-lightbox='image-1'>" . "<img src='" . $image_preview . "' />" . "</a>";
    }

    return '<div class="gc-gallery-list">' . implode("", $images) . '</div>';

}

add_shortcode('gc-gallery', 'gc_image_gallery');


# add style.css to the plugin
function gc_custom_gallery_style()
{
    wp_enqueue_style('gc-image-integration-style', plugins_url('/assets/css/style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'gc_custom_gallery_style');

# add script.js to the plugin
function gc_custom_gallery_script()
{
    wp_enqueue_script('gc-image-integration-script', plugins_url('/assets/js/script.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'gc_custom_gallery_script');

# add lightbox script into queue and add jquery as dependency
function gc_custom_gallery_lightbox_script()
{
    wp_enqueue_script('gc-image-integration-lightbox-script', plugins_url('/assets/lightbox/js/lightbox.min.js', __FILE__), array('jquery'));
}

add_action('wp_enqueue_scripts', 'gc_custom_gallery_lightbox_script');

# add lightbox style into queue
function gc_custom_gallery_lightbox_style()
{
    wp_enqueue_style('gc-image-integration-lightbox-style', plugins_url('/assets/lightbox/css/lightbox.min.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'gc_custom_gallery_lightbox_style');