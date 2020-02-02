<?php

/**
* file which handles all style or frontend imports
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

// load backend styles and scripts
function load_admin_scripts() {
	wp_enqueue_media();
	wp_register_script('custom_admin_js', plugins_url('../admin/js/admin.js', __FILE__ ), array('jquery'));
	wp_enqueue_script('custom_admin_js');

	wp_enqueue_style('wp-color-picker');
	wp_register_script('color_picker_js', plugins_url('../admin/js/color-picker.js', __FILE__), array('jquery', 'wp-color-picker'));
	wp_enqueue_script('color_picker_js');
}
add_action('admin_enqueue_scripts', 'load_admin_scripts');

// load frontend styles and scripts
function load_frontend_scripts() {
	wp_enqueue_style('dashicons');
	wp_register_style('custom_front_css', plugins_url('../public/css/frontend.css', __FILE__));
	wp_enqueue_style('custom_front_css' );

	wp_register_script('custom_front_js', plugins_url('../public/js/frontend.js', __FILE__), array('jquery'));
	wp_enqueue_script('custom_front_js' );
}
add_action('wp_enqueue_scripts', 'load_frontend_scripts');
