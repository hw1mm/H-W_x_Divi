<?php
function hw_adminBar_HWwebsiteURL($wp_admin_bar)
{
    $args = array(
        'id' => 'hw_adminBar_HWwebsiteURL',
        'title' => 'Zu //H&W',
        // 'html' => '<img src="' . get_stylesheet_directory_uri() . '/loginScreen/assets/img/logo_hw_white.webp" alt="Mein Bild" width="20" height="20">',
        'href' => 'https://hw-brand.com', // URL, zu der das Element führt
        'meta' => array(
            'class' => 'custom-admin-item-class', // Benutzerdefinierte CSS-Klasse
            'target' => '_blank', // Öffnet den Link in einem neuen Tab
        ),
    );

    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'hw_adminBar_HWwebsiteURL', 0);
