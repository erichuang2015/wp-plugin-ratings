<?php

/**
* file which handles all shortcode relevant things and frontend output
*
* @package         WP Ratings
* @subpackage      WP Ratings/includes
* @author          Daniel Murth
* @copyright       2020 Daniel Murth
* @license         MIT
*
**/


// no access if you call it directly
if (!defined('ABSPATH')) {
  exit;
}


function wp_rating_display($atts, $content = null) {
  $postId = $atts['id'];

  // check if rating is published, otherwise return withour rendering someting
  if (get_post_status($postId) != 'publish') {
    return;
  }

  // image size calculation
  $imgSrc = esc_html(get_post_meta($postId, 'wp_rating_image', true));

  $imageInfos = getimagesize( $imgSrc );
  $imageWidth = $imageInfos[0];
  $imageHeight = $imageInfos[1];

  $factor = $imageHeight / $imageWidth;

  $imageHeight = round($factor * 150, 0);

  if ($imageWidth >= 150) {
    $imageWidth = 150;
    $imageHeight = $imageWidth * $factor;
  }

  $outputCss = '';
  $output = '';

  $outputCss = '
    <style>
      a#button-btn1-' . $postId . ' {
        background-color: ' . esc_html(get_post_meta($postId, 'wp_rating_button_background_color', true)) . ';
      }
      #rating-arguments-' . $postId . ' {
        width: 65%;
        margin: 0 0 20px 0px;
        min-height: ' . $imageHeight . 'px;
      }
      #rating-image-' . $postId . ' {
        width: ' . $imageWidth . 'px;
        height: ' . $imageHeight . 'px;
        box-shadow: 2px 2px 3px 0px rgba(122, 125, 127, 0.75);
        margin: 5px 0 10px 0;
      }
      @media only screen and (max-width: 500px) {
        #rating-arguments-' . $postId . ' {
          width: 100%;
        }
        #rating-image-' . $postId . ' {
          max-width: 150px;
        }
      }
    </style>';

  // rating title
  $output = $outputCss . '
    <div class="rating-container">
      <div class="top">
        <div class="rating-title-bg">
          <div class="rating-title">' . esc_html(get_post_meta($postId, 'wp_rating_title', true)) . '
        </div>
      </div>
    </div>
  ';
  // rating image with link
  $output .= '
    <div class="middle">
      <div class="rating-image">
        <a target="_blank" href="' . esc_html(get_post_meta($postId, 'wp_rating_button_link', true)) . '">
          <img id="rating-image-' . $postId . '" src="' . $imgSrc . '" />
        </a>
      </div>';
  // rating pro and contra lists
  $output .= '
      <div id="rating-arguments-' . $postId . '">
        <div class="rating-pro">
          <div class="pro-heading">' . __('Pro', 'wp-rating') . '</div>
          <ul>';

  $listItems = explode("\n", esc_html(get_post_meta($postId, 'wp_rating_pro', true)));
  foreach ($listItems as $listItem) {
    if (trim($listItem) == '') {
      continue;
    }
    $output .= '<li>' . $listItem . '</li>';
  }

  $output .= '
          </ul>
        </div>
        <div class="rating-contra">
          <div class="contra-heading">' . __('Contra', 'wp-rating') . '</div>
          <ul>';

  $listItems = explode( "\n", esc_html(get_post_meta($postId, 'wp_rating_contra', true)) );
  foreach ($listItems as $listItem) {
    if (trim($listItem) == '') {
      continue;
    }
    $output .= '<li>' . $listItem . '</li>';
  }

  $output .= '
          </ul>
        </div>
      </div>
    </div>';

  $percent = (float)get_post_meta($postId, 'wp_rating_percent', true);

  if (get_post_meta($postId, 'wp_rating_stars_check', true) === null) {
    // bar rating
    $output .= '
    <div class="bottom">
      <div class="rating-percent-number">' . $percent . '%</div>
      <div class="rating-percent">
        <div class="rating-bar-bg">
          <div class="rating-bar" style="width: ' . $percent . '%"></div>
        </div>
      </div>
    </div>';
  } else {
    // star rating

    // convert % to stars
    $stars = round( $percent / 10 / 2, 1 );

    $starsFull = floor ( $stars );
    $starsHalf = round( ($stars - $starsFull), 0 );
    $starsEmpty = 5 - $starsFull - $starsHalf;

    $output .= '
    <div class="bottom">
      <div class="rating-result">' . __('Result:', 'wp-rating') . '</div>
      <div class="star-rating" title="' . $stars . __(' of 5 stars', 'wp-rating') . '">';

    // full stars
    for ($i = 1; $i <= $starsFull; $i++) {
      $output .= '<div class="star star-full"></div>';
    }

    // half stars
    for ($i = 1; $i <= $starsHalf; $i++) {
      $output .= '<div class="star star-half"></div>';
    }

    // empty stars
    for ($i = 1; $i <= $starsEmpty; $i++ ) {
      $output .= '<div class="star star-empty"></div>';
    }

    // ende div sterne bewertung
    $output .= '
      </div>
    </div>';
  }

  $output .= '
    <div class="rating-button-text">
      <a target="_blank" href="' . get_post_meta($postId, 'wp_rating_button_link', true) . '" class="button-btn1" id="button-btn1-' . $postId . '">
        ' . get_post_meta($postId, 'wp_rating_button_text', true) . '
      </a>
    </div>
  </div>';

  return $output;
}
add_shortcode('wp_rating', 'wp_rating_display');
