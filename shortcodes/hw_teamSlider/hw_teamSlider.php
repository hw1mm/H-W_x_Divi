<?php

function hw_teamSlider($atts = null, $content = null)
{
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    wp_enqueue_style('hw-teamSlider', str_replace($document_root, '', __DIR__) .  '/assets/css/hw_teamslider.min.css');
    wp_enqueue_script('hw-teamSlider', str_replace($document_root, '', __DIR__)  . '/assets/js/hw_teamSlider.js');

    wp_enqueue_script('hw-swiperJS', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_style('hw-swiperJS', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');



    $personen = get_posts(array(
        'numberposts'      => -1,
        'order'            => 'asc',
        'post_type'        => 'person',
    ));

    $htmlString = '
    <div class="hw-teamSlider-wrapper">
      <div class="swiper hw-teamSlider-swiper">
        <div class="swiper-wrapper">';

    if (!empty($personen)) {
        foreach ($personen as $key => $person) {
            $htmlString .= '
      <div class="swiper-slide">
        <div class="hw-teamSlider-swiper-content-wrapper">
        ' . getTeamSliderSlideContent($person) . '
        </div>
      </div>';
        }
    }

    $htmlString .= '
    </div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>';
    return $htmlString;
}
add_shortcode('hw_teamSlider', 'hw_teamSlider');

function getTeamSliderSlideContent($person)
{
    $htmlString = '';

    $htmlString .='
    <a  href="'.get_permalink($person).'" class="hw-teamSlider-swiper-content">
        '.get_the_post_thumbnail($person).'
        <div class="hw-teamSlider-swiper-content-text">
            <span class="hw-teamSlider-swiper-content-name">'.get_the_title($person).'</span>
            <span class="hw-teamSlider-swiper-content-job">'.get_field('job',$person).'</span>
        </div>
    </a>
    ';

    return $htmlString;
}
