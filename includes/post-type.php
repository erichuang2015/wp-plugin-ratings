<?php

/**
* file which registers our post type
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

// register our custom post type called "wp-ratings"
// used https://generatewp.com/ to generate without a lot of typing work
function add_post_type_wp_ratings() {

  $labels = array(
    'name'                  => _x('Ratings', 'Post Type General Name', 'wp-ratings'),
    'singular_name'         => _x('Rating', 'Post Type Singular Name', 'wp-ratings'),
    'menu_name'             => __('Ratings', 'wp-ratings'),
    'name_admin_bar'        => __('Ratings', 'wp-ratings'),
    'parent_item_colon'     => __('Parent Rating:', 'wp-ratings'),
    'all_items'             => __('All Ratings', 'wp-ratings'),
    'add_new_item'          => __('Add New Rating', 'wp-ratings'),
    'add_new'               => __('Add New Rating', 'wp-ratings'),
    'new_item'              => __('New Rating', 'wp-ratings'),
    'edit_item'             => __('Edit Rating', 'wp-ratings'),
    'update_item'           => __('Update Rating', 'wp-ratings'),
    'view_item'             => __('View Rating', 'wp-ratings'),
    'search_items'          => __('Search Rating', 'wp-ratings'),
    'not_found'             => __('Not found', 'wp-ratings'),
    'not_found_in_trash'    => __('Not found in Trash', 'wp-ratings'),
    'items_list'            => __('Rating list', 'wp-ratings'),
    'items_list_navigation' => __('Rating list navigation', 'wp-ratings'),
    'filter_items_list'     => __('Filter rating list', 'wp-ratings'),
  );

  $args = array(
    'label'                 => __('Rating', 'wp-ratings'),
    'labels'                => $labels,
    'supports'              => array( ),
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

  register_post_type('wp_ratings', $args);
}
add_action('init', 'add_post_type_wp_ratings', 0);
