<?php
/*
Plugin Name: Artist Form
Description: Artist form to collect artist information.
Version: 1.0.0
Author: STS
License: GPLv2 or later
*/

if (is_admin()) {
    // we are in admin mode
    require_once __DIR__ . '/includes/awal-settings.php';
}

if (!defined('AWALAPI_BASE_NAME')) {
    define('AWALAPI_BASE_NAME', plugin_basename(__FILE__));
}

require_once __DIR__ . '/includes/awal-country.php';
require_once __DIR__ . '/includes/awal-shortcodes.php';
wp_enqueue_style('bootstrap-css', get_site_url() . '/wp-content/plugins/awalform/includes/css/bootstrap.min.css');
wp_enqueue_style('select2-css',  get_site_url() . '/wp-content/plugins/awalform/includes/css/select2.min.css');
wp_enqueue_style('magnific-popup-css',  get_site_url() . '/wp-content/plugins/awalform/includes/css/magnific-popup.css');
