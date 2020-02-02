<?php

/**
* file which handles all meta-box relevant things
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

// add meta box
function wp_rating_add_custom_meta_box() {
  add_meta_box(
    'wp_rating_editor', // id
    __('Rating', 'wp-rating'), // title
    'wp_rating_editor', // callback function
    'wp_rating', // post type where to register
    'advanced', // context
    'high' // priority
  );
}
add_action( 'add_meta_boxes', 'wp_rating_add_custom_meta_box');

// content and optical representation of our meta box
function wp_rating_editor($post) {
  // validate that the contents of the form came from the location on the current site and not somewhere else
  wp_nonce_field( 'wp_rating_save_meta_box_data', 'wp_rating_meta_box_nonce');

  $postID = $post->ID;

  $output = '
    <table class="form-table">
      <tbody>

        <tr>
          <th scope="row"><label for="wp_rating_shortcode">' . __('Shortcode', 'wp-rating') . '</label></th>
          <td><input type="text" name="wp_rating_shortcode" value="[wp_rating id=\'' . $postID . '\']" readonly /></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_title">' . __('Title', 'wp-rating') . '</label></th>
          <td><input type="text" name="wp_rating_title" value="' . esc_html(get_post_meta($postID, 'wp_rating_title', true)) . '" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_image">' . __('Image', 'wp-rating') . '</label></th>
          <td><input type="text" name="wp_rating_image" id="rating_image" value="' . esc_html(get_post_meta($postID, 'wp_rating_image', true)) . '" />
          <input type="button" id="wp_rating_upload_button" value="' . __('Upload', 'wp-rating') . '" />
        </td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_pro">' . __('Pro', 'wp-rating') . '</label></th>
          <td><textarea name="wp_rating_pro" rows="5">' . esc_html(get_post_meta($postID, 'wp_rating_pro', true)) . '</textarea></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_contra">' . __('Contra', 'wp-rating') . '</label></th>
          <td><textarea name="wp_rating_contra" rows="5">' . esc_html(get_post_meta($postID, 'wp_rating_contra', true)) . '</textarea></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_stars_check">' . __('Enable Star Rating', 'wp-rating') . '</label></th>
  ';

  $check = null;

  if (esc_html(get_post_meta($postID, 'wp_rating_stars_check', true)) === 'wp_rating_stars_check') {
    $check = 'checked';
  }

  $output	.= '
          <td><input type="checkbox" name="wp_rating_stars_check" value="wp_rating_stars_check" ' . $check . ' /></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_percent">' . __('Rating in %', 'wp-rating') . '</label></th>
          <td><input type="text" name="wp_rating_percent" value="' . esc_html(get_post_meta($postID, 'wp_rating_percent', true)) . '" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_button_background_color">' . __('Button Background Color', 'wp-rating') . '</label></th>
          <td><input type="text" class="button-background-color" name="wp_rating_button_background_color" value="' . esc_html(get_post_meta($postID, 'wp_rating_button_background_color', true)) . '" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_button_text">' . __('Button Text', 'wp-rating') . '</label></th>
          <td><input type="text" name="wp_rating_button_text" value="' . esc_html(get_post_meta($postID, 'wp_rating_button_text', true)) . '" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_rating_button_link">' . __('Button Link', 'wp-rating') . '</label></th>
          <td><input type="text" name="wp_rating_button_link" value="' . esc_html(get_post_meta($postID, 'wp_rating_button_link', true)) . '" /></td>
        </tr>

      </tbody>
    </table>';

  echo $output;
}

// save meta box form
function wp_rating_save($post_id) {

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!isset($_POST['wp_rating_meta_box_nonce'])) {
    return;
  }

  if (!wp_verify_nonce($_POST['wp_rating_meta_box_nonce'], 'wp_rating_save_meta_box_data')) {
    return;
  }

  if ('wp_rating' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id ) || !current_user_can('edit_post', $post_id)) {
      return;
    }
  }

  if (isset($_POST['wp_rating_title'])) {
    update_post_meta($post_id, 'wp_rating_title', $_POST['wp_rating_title'] );
  }

  if (isset($_POST['wp_rating_image'])) {
    update_post_meta($post_id, 'wp_rating_image', $_POST['wp_rating_image'] );
  }

  if (isset($_POST['wp_rating_pro'])) {
    update_post_meta($post_id, 'wp_rating_pro', $_POST['wp_rating_pro'] );
  }

  if (isset($_POST['wp_rating_contra'])) {
    update_post_meta($post_id, 'wp_rating_contra', $_POST['wp_rating_contra'] );
  }

  if (isset($_POST['wp_rating_percent'])) {
    update_post_meta($post_id, 'wp_rating_percent', $_POST['wp_rating_percent'] );
  }

  if (isset($_POST['wp_rating_button_background_color'])) {
    update_post_meta($post_id, 'wp_rating_button_background_color', $_POST['wp_rating_button_background_color'] );
  }

  if (isset($_POST['wp_rating_button_text'])) {
    update_post_meta($post_id, 'wp_rating_button_text', $_POST['wp_rating_button_text'] );
  }

  if (isset($_POST['wp_rating_button_link'])) {
    update_post_meta($post_id, 'wp_rating_button_link', $_POST['wp_rating_button_link'] );
  }
  if (isset($_POST['wp_rating_stars_check'])) {
    update_post_meta($post_id, 'wp_rating_stars_check', $_POST['wp_rating_stars_check'] );
  } else {
    update_post_meta($post_id, 'wp_rating_stars_check', null);
  }
}
add_action( 'save_post', 'wp_rating_save');
