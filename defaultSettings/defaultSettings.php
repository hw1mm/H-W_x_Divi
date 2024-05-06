<?php
function hw_enqueue_defaultSettings()
{
    wp_enqueue_script('hw_bootstrap_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');
    // wp_enqueue_style('hw_bootstrap_style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
}
add_action('wp_enqueue_scripts', 'hw_enqueue_defaultSettings');




function hw_defaultSettings_allowFileTypes($mimes)
{
    $mimes['ttf'] = 'font/ttf';
    $mimes['webp'] = 'image/webp';
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'hw_defaultSettings_allowFileTypes');


function hw_enqueue_scripts_defaultSettings()
{
    wp_enqueue_style('hw_defaultSettings_style', get_stylesheet_directory_uri() . '/defaultSettings/assets/css/style.min.css');
}
add_action('wp_enqueue_scripts', 'hw_enqueue_scripts_defaultSettings',10,2);




function prefix_disable_gutenberg($current_status, $post_type)
{
    // Use your post type key instead of 'product'
    if ($post_type != 'post' && $post_type != 'page') return false;
    return $current_status;
}
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);


// Disable WordPress' automatic image scaling feature
add_filter( 'big_image_size_threshold', '__return_false' );