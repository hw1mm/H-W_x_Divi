<?php

function hw_teamOverview($atts = null, $content = null)
{
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    wp_enqueue_style('hw-teamOverview', str_replace($document_root, '', __DIR__) .  '/assets/css/hw_teamOverview.min.css');
    wp_enqueue_script('hw-teamOverview', str_replace($document_root, '', __DIR__)  . '/assets/js/hw_teamOverview.js');
    
    // wp_enqueue_style('hw-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');



    $personen = get_posts(array(
        'numberposts'      => -1,
        'order'            => 'asc',
        'post_type'        => 'person',
    ));

    $htmlString = '
    <div class="hw-teamOverview-wrapper row g-5">';

    if (!empty($personen)) {
        foreach ($personen as $key => $person) {
            $htmlString .= '
        <div class="hw-teamOverview-item-wrapper col-4">
        ' . getTeamOverviewItem($person) . '
      </div>';
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
