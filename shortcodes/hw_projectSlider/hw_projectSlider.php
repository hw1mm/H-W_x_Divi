<?php

function hw_projectSlider($atts, $content = null)
{

    var_dump(123);
    wp_enqueue_style('hw-standorte-style', plugins_url('/assets/css/standorte.min.css', __FILE__));
    wp_enqueue_script('hw-standorte-script', plugins_url('/assets/js/standorte.js', __FILE__));

    wp_enqueue_script('hw-feather-script', 'https://unpkg.com/feather-icons');

    $htmlString = '
    <div class="hw-standorte-wrapper">
        <span class="hw-standorte-title">Standorte: </span>
    </div>';
    return $htmlString;
}
add_shortcode('hw_projectSlider', 'hw_projectSlider');

