<?php

/**
* file which registers our post type for the ratings
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

function wp_rating_add_post_type() {

	$labels = array(
		'name'                  => _x('Ratings', 'Post Type General Name', 'wp-rating'),
		'singular_name'         => _x('Rating', 'Post Type Singular Name', 'wp-rating'),
		'menu_name'             => __('Ratings', 'wp-rating'),
		'name_admin_bar'        => __('Ratings', 'wp-rating'),
		'parent_item_colon'     => __('Parent Item:', 'wp-rating'),
		'all_items'             => __('All Items', 'wp-rating'),
		'add_new_item'          => __('Add New Item', 'wp-rating'),
		'add_new'               => __('Add New', 'wp-rating'),
		'new_item'              => __('New Item', 'wp-rating'),
		'edit_item'             => __('Edit Item', 'wp-rating'),
		'update_item'           => __('Update Item', 'wp-rating'),
		'view_item'             => __('View Item', 'wp-rating'),
		'search_items'          => __('Search Item', 'wp-rating'),
		'not_found'             => __('Not found', 'wp-rating'),
		'not_found_in_trash'    => __('Not found in Trash', 'wp-rating'),
		'items_list'            => __('Items list', 'wp-rating'),
		'items_list_navigation' => __('Items list navigation', 'wp-rating'),
		'filter_items_list'     => __('Filter items list', 'wp-rating'),
	);
	$args = array(
		'label'                 => __('Rating', 'wp-rating'),
		'labels'                => $labels,
		'supports'              => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type('wp_rating', $args);

}
add_action('init', 'wp_rating_add_post_type', 0);
