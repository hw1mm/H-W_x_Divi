<?php

function hw_teamOverview($atts = null, $content = null)
{
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    wp_enqueue_style('hw-teamOverview', str_replace($document_root, '', __DIR__) .  '/assets/css/hw_teamOverview.min.css');
    wp_enqueue_script('hw-teamOverview', str_replace($document_root, '', __DIR__)  . '/assets/js/hw_teamOverview.js');
    wp_enqueue_style('hw-bootstrap', str_replace($document_root, '', get_stylesheet_directory()) . '/defaultSettings/assets/vendors/bootstrap/bootstrap.min.css');



    $personen = get_posts(array(
        'numberposts'      => -1,
        'order'            => 'asc',
        'post_type'        => 'person',
    ));

    $htmlString = '
    <div class="hw-teamOverview-wrapper row gx-hw1 gy-hw5 gx-t-hw2 gx-d-hw6 gy-d-hw10 ">';

    if (!empty($personen)) {
        $i = 0;
        foreach ($personen as $key => $person) {
            $htmlString .= '
                <div class="hw-teamOverview-item-wrapper col-6 col-d-4">
                    ' . getTeamOverviewItem($person) . '
                </div>';
            if ($i == 3) {
                $htmlString .= '
                    <div class="hw-teamOverview-break-small col-8 d-none d-d-block">
                        <div style="height: 100%;background-image:url(/wp-content/uploads/2024/05/HW-David-Wagner-Gespraech.webp)"></div>
                    </div>';
            }
            if ($i > 3 && $i % 6 == 0) {
                $htmlString .=  '
                    <div class="hw-teamOverview-break-big col-12">
                        <img src="/wp-content/uploads/2024/05/HW-David-Wagner-Gespraech.webp">
                    </div>';
            }
            $i++;
        }
    }

    $htmlString .= '

</div>';
    return $htmlString;
}
add_shortcode('hw_teamOverview', 'hw_teamOverview');

function getTeamOverviewItem($person)
{
    $htmlString = '';

    $htmlString .= '
    <a  href="' . get_permalink($person) . '" class="hw-teamOverview-item-content">
        ' . get_the_post_thumbnail($person) . '
        <div class="hw-teamOverview-item-content-text">
            <span class="hw-teamOverview-item-content-name">' . get_the_title($person) . '</span>
            <span class="hw-teamOverview-item-content-job">' . get_field('job', $person) . '</span>
        </div>
    </a>
    ';

    return $htmlString;
}
