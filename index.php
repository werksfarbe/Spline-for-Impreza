<?php
/*
Plugin Name: Spline 3D for Impreza
Description: Plugin for Imprezas WP-Backery to place 3D Objects in Background.
Version: 0.1
Author: Tom
*/


if (!defined('ABSPATH')) {
	exit;
}
define('SPLINE_3D_PATH', plugin_dir_path(__FILE__));
define('SPLINE_3D_URL', plugin_dir_url(__FILE__));

require_once SPLINE_3D_PATH . '/includes/class-spline-3d.php';
require_once SPLINE_3D_PATH . '/includes/class-spline-admin.php';

