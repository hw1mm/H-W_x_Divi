<?php

function child_theme_styles()
{

    
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    wp_enqueue_style('custom-style-css', get_stylesheet_directory_uri() . '/assets/customStyle.min.css', array('child-theme-css'));
}
add_action('wp_enqueue_scripts', 'child_theme_styles');


// $hw_login_screen_template = get_stylesheet_directory()  . '/loginScreen/loginScreen.php';
// if (file_exists($hw_login_screen_template) && is_login()) {
//     include_once($hw_login_screen_template);
// }

$hw_adminBar_HWwebsiteURL = get_stylesheet_directory()  . '/adminBar_HWwebsiteURL/adminBar_HWwebsiteURL.php';
if (file_exists($hw_adminBar_HWwebsiteURL)) {
    include_once($hw_adminBar_HWwebsiteURL);
}

$hw_defaltSettings = get_stylesheet_directory()  . '/defaultSettings/defaultSettings.php';
if (file_exists($hw_defaltSettings)) {
    include_once($hw_defaltSettings);
}

// Shortcodes
$hw_projectSlider = get_stylesheet_directory()  . '/shortcodes/hw_projectSlider/hw_projectSlider.php';
if (file_exists($hw_projectSlider)) {
    include_once($hw_projectSlider);
}
$hw_teamSlider = get_stylesheet_directory()  . '/shortcodes/hw_teamSlider/hw_teamSlider.php';
if (file_exists($hw_teamSlider)) {
    include_once($hw_teamSlider);
}


// Option pages
$hw_projectSlider_optionPage = get_stylesheet_directory()  . '/shortcodes/hw_projectSlider/hw_projectSlider_optionPage.php';
if (file_exists($hw_projectSlider_optionPage)) {
    include_once($hw_projectSlider_optionPage);
}




add_action('init', 'my_remove_editor_from_post_type');
function my_remove_editor_from_post_type() {
    remove_post_type_support( 'project', 'editor' );
}