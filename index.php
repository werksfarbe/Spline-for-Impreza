<?php
/*
Plugin Name: Spline 3D for Impreza
Description: Plugin for Imprezas WP-Backery to place 3D Objects in Background.
Version: 0.2
Author: Tom
*/


if (!defined('ABSPATH')) {
	exit;
}
define('SPLINE_3D_PATH', plugin_dir_path(__FILE__));
define('SPLINE_3D_URL', plugin_dir_url(__FILE__));


// Enqueue styles and scripts
function spline_3d_enqueue_scripts() {
	wp_enqueue_style('spline-3d-for-impreza', plugin_dir_url(__FILE__) . 'css/spline-3d-for-impreza.css');
	wp_enqueue_script('spline-3d-for-impreza', plugin_dir_url(__FILE__) . 'js/spline-3d-for-impreza.js', array(), '1.0', true);

	$script_url = get_option('spline_3d_script_url', 'https://unpkg.com/@splinetool/viewer/build/spline-viewer.js');
	echo '<script type="module" src="' . esc_url($script_url) . '"></script>';
}
add_action('wp_enqueue_scripts', 'spline_3d_enqueue_scripts');


require_once SPLINE_3D_PATH . '/includes/class-spline-3d.php';
require_once SPLINE_3D_PATH . '/includes/class-spline-admin.php';

