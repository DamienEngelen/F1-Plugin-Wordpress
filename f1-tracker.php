<?php
/**
 * Plugin Name: F1 Tracker
 * Description: A WordPress plugin to track F1 races and standings.
 * Version: 1.0.0
 * Author: Damien Engelen
 * Text Domain: f1-tracker
 */

if (!defined('ABSPATH')) {
    exit;
}

define('F1_TRACKER_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('F1_TRACKER_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once F1_TRACKER_PLUGIN_PATH . 'includes/class-f1-api.php';
require_once F1_TRACKER_PLUGIN_PATH . 'includes/class-f1-helpers.php';
require_once F1_TRACKER_PLUGIN_PATH . 'admin/class-f1-admin.php';

function f1_tracker_init() {
    new F1_Tracker_Admin();
}

add_action('plugins_loaded', 'f1_tracker_init');
