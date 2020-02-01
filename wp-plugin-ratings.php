<?php
/**
 * rating plugin with custom post type and small frontend
 *
 * @package         WP Ratings
 * @author          Daniel Murth
 * @copyright       2020 Daniel Murth
 * @license         MIT
 *
 * @wordpress-plugin
 * Plugin Name:       WP Ratings
 * Description:       A small plugin which allows to create ratings with a small and simple frontend which can be used via shortcode [wp-ratings]
 * Version:           1.0
 * Author:            Daniel Murth
 * License:           MIT
 */

// no access if you call it directly
if (!defined('ABSPATH')) {
  exit;
}

// add scripts like css or js to our plugin
require plugin_dir_path( __FILE__ ) . 'includes/scripts.php';

// add custom post type and all relevant operations for these
require plugin_dir_path( __FILE__ ) . 'includes/post-type.php';

// add our ratings meta-box to handle all important information
require plugin_dir_path( __FILE__ ) . 'includes/meta-box.php';

// shortcode handling
require plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php';
