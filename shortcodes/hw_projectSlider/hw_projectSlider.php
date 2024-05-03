<?php

function hw_projectSlider($atts = null, $content = null)
{
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  // wp_enqueue_style('hw-standorte-style', plugins_url('/assets/css/standorte.min.css', __FILE__));
  wp_enqueue_style('hw-projectSlider', str_replace($document_root, '', __DIR__) .  '/assets/css/hw_projectSlider.min.css');
  wp_enqueue_script('hw-projectSlider', str_replace($document_root, '', __DIR__)  . '/assets/js/hw_projectSlider.js');

  wp_enqueue_script('hw-swiperJS', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
  wp_enqueue_style('hw-swiperJS', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

  wp_enqueue_script('hw-feather-script', 'https://unpkg.com/feather-icons');

  $projects = get_option('hw-generalSider');
  $htmlString = '';
  if (empty($projects)) {
    $projects = get_posts(array(
      'numberposts'      => -1,
      'order'            => 'asc',
      'post_type'        => 'project',
    ));
  }else{
    $projects = explode(',',$projects);
  }


  $htmlString .= '
    <div class="hw-projectSlider-wrapper">
        <div class="swiper hw-projectSlider-swiper">
    <div class="swiper-wrapper">';

  if (!empty($projects)) {
    foreach ($projects as $key => $project) {
      $imgURL = getSliderImage($project);
      $htmlString .= '
      <div class="swiper-slide">
        <div class="hw-projectSlider-swiper-content-wrapper" style="background-image:url(' . $imgURL . ')">
          <div class="hw-projectSlider-headline">
            <h2>Unsere <br>Projekte</h2>
          </div>
          <div class="hw-projectSlider-swiper-content">
            <div class="hw-projectSlider-swiper-content-inside">';

      if (!empty(get_the_terms($project, 'kunde'))) {
        $htmlString .=  '<a href="' . get_permalink($project) . '" class="hw-projectSlider-text-content-company">
                <span class="hw-projectSlider-text-content-company-name">
                  ' . get_the_terms($project, 'kunde')[0]->name . '
                </span>
                <span class="hw-projectSlider-text-content-company-icon">
                  <i data-feather="external-link"></i>
                </span>
              </a>';
      }

      $htmlString .= '<div class="hw-projectSlider-text-content-text">
              <h3>'.get_field('textauszug',$project)['uberschrift'].'</h3>
              <p>'.get_field('textauszug',$project)['textauszug'].'</p>
            </div>
            <div class="hw-projectSlider-text-content-btn">
            <a href="' . get_post_type_archive_link('project') . '" class="hw-projectSlider-text-content-btn-showAll hw-btn-white">Alle Projekte</a>
            </div>
            </div>
            <div class="swiper-button-next-wrapper">
              <div class="swiper-button-next"></div>
            </div>
        </div>
        </div>
      </div>';
    }
  }

  $htmlString .= '
    </div>
  </div>
</div>';
  return $htmlString;
}
add_shortcode('hw_projectSlider', 'hw_projectSlider');


function getSliderImage($projectID)
{
  $imgURL = get_field('slider_bild', $projectID);
  return $imgURL;
}
