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


// add our meta-box
function add_custom_meta_box_wp_ratings() {
  add_meta_box(
    'editor_wp_ratings', // id
    __('Rating', 'wp-ratings'), // title
    'editor_wp_ratings', // callback function
    'wp_ratings', // screen like post-type where to register
    'advanced', // context
    'high' // priority
  );
}
add_action('add_meta_boxes', 'add_custom_meta_box_wp_ratings');


// content and optical representation of our meta box
function editor_wp_ratings($post) {
  // validate that the contents of the form came from the location on the current site and not somewhere else
  wp_nonce_field( 'wp_ratings_save_meta_box_data', 'wp_ratings_meta_box_nonce' );

  $postID = $post -> ID;

  // table in our backend
  $output = '
    <table class="form-table">
      <tbody>

        <tr>
          <th scope="row">
            <label for="wp_ratings_shortcode">' . __('Shortcode', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" name="wp_ratings_shortcode" value="[wp_ratings id=\'' . $postID . '\']" readonly />
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_title">' . __('Title', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" name="wp_ratings_title" value="' . esc_html(get_post_meta($postID, 'wp_ratings_title', true)) . '" />
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_image">' . __('Image', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" name="wp_ratings_image" id="rating_image" value="' . esc_html(get_post_meta($postID, 'wp_ratings_image', true)) . '" />
            <input type="button" id="wp_ratings_upload_button" value="' . __('Upload', 'wp-ratings') . '" />
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="wp_ratings_pro">' . __('Pro', 'wp-ratings') . '</label></th>
          <td><textarea name="wp_ratings_pro" rows="5">' . esc_html( get_post_meta( $postID, 'wp_ratings_pro', true ) ) . '</textarea></td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_contra">' . __('Contra', 'wp-ratings') . '</label>
          </th>
          <td>
            <textarea name="wp_ratings_contra" rows="5">' . esc_html(get_post_meta($postID, 'wp_ratings_contra', true )) . '</textarea>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_stars_check">' . __('Enable Star Rating', 'wp-ratings') . '</label>
          </th>
  ';
  $check = null;

  if (esc_html(get_post_meta($postID, 'wp_ratings_stars_check', true)) === 'wp_ratings_stars_check') {
    $check = 'checked';
  }

  $output	.= '
          <td>
            <input type="checkbox" name="wp_ratings_stars_check" value="wp_ratings_stars_check" ' . $check . ' />
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_percent">' . __('Rating in %', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" name="wp_ratings_percent" value="' . esc_html(get_post_meta($postID, 'wp_ratings_percent', true)) . '" />
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_button_background_color">' . __('Button Background Color', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" class="button-background-color" name="wp_ratings_button_background_color" value="' . esc_html(get_post_meta($postID, 'wp_ratings_button_background_color', true)) . '" />
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_button_text">' . __('Button Text', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" name="wp_ratings_button_text" value="' . esc_html(get_post_meta($postID, 'wp_ratings_button_text', true)) . '" />
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="wp_ratings_button_link">' . __('Button Link', 'wp-ratings') . '</label>
          </th>
          <td>
            <input type="text" name="wp_ratings_button_link" value="' . esc_html(get_post_meta($postID, 'wp_ratings_button_link', true)) . '" />
          </td>
        </tr>

      </tbody>
    </table>
  ';

  // output/print our meta box
  echo $output;
}


// save our form
function save_wp_ratings($post_id) {

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (! isset( $_POST['wp_ratings_meta_box_nonce'])) {
    return;
  }

  if (!wp_verify_nonce($_POST['wp_ratings_meta_box_nonce'], 'wp_ratings_save_meta_box_data')) {
    return;
  }

  if ('wp_rating' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id) || !current_user_can('edit_post', $post_id)) {
      return;
    }
  }

  if (isset($_POST['wp_ratings_title'])) {
    update_post_meta($post_id, 'wp_ratings_title', $_POST['wp_ratings_title']);
  }

  if (isset($_POST['wp_ratings_image'])) {
    update_post_meta($post_id, 'wp_ratings_image', $_POST['wp_ratings_image']);
  }

  if (isset($_POST['wp_ratings_pro'])) {
    update_post_meta($post_id, 'wp_ratings_pro', $_POST['wp_ratings_pro']);
  }

  if (isset($_POST['wp_ratings_contra'])) {
    update_post_meta($post_id, 'wp_ratings_contra', $_POST['wp_ratings_contra']);
  }

  if (isset($_POST['wp_ratings_percent'])) {
    update_post_meta($post_id, 'wp_ratings_percent', $_POST['wp_ratings_percent']);
  }

  if (isset($_POST['wp_ratings_button_background_color'])) {
    update_post_meta($post_id, 'wp_ratings_button_background_color', $_POST['wp_ratings_button_background_color']);
  }

  if (isset($_POST['wp_ratings_button_text'])) {
    update_post_meta($post_id, 'wp_ratings_button_text', $_POST['wp_ratings_button_text']);
  }

  if (isset($_POST['wp_ratings_button_link'])) {
    update_post_meta($post_id, 'wp_ratings_button_link', $_POST['wp_ratings_button_link']);
  }

  // Speichern der Checkbox, nur angehakte Checkboxen werden gesetzt (isset)
  if (isset($_POST['wp_ratings_stars_check'])) {
    update_post_meta($post_id, 'wp_ratings_stars_check', $_POST['wp_ratings_stars_check']);
  } else {
    update_post_meta($post_id, 'wp_ratings_stars_check', null);
  }

}
add_action('save_post', 'save_wp_ratings');
