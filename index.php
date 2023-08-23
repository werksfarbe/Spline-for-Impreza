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

require_once SPLINE_3D_PATH . 'includes/class-spline-3d.php';

// Enqueue styles and scripts
function spline_3d_enqueue_scripts() {
	wp_enqueue_style('spline-3d-for-impreza', plugin_dir_url(__FILE__) . 'css/spline-3d-for-impreza.css');
	wp_enqueue_script('spline-3d-for-impreza', plugin_dir_url(__FILE__) . 'js/spline-3d-for-impreza.js', array(), '1.0', true);

	$script_url = get_option('spline_3d_script_url', 'https://unpkg.com/@splinetool/viewer/build/spline-viewer.js');
	echo '<script type="module" src="' . esc_url($script_url) . '"></script>';
}
add_action('wp_enqueue_scripts', 'spline_3d_enqueue_scripts');

// Add admin menu
function spline_3d_admin_menu() {
	add_menu_page('WerksTools', 'WerksTools', 'manage_options', 'werkstools', 'spline_3d_admin_page', 'dashicons-admin-generic', 3);
	add_submenu_page('werkstools', 'Spline 3D', 'Spline 3D', 'manage_options', 'spline-3d', 'spline_3d_admin_subpage');
}
add_action('admin_menu', 'spline_3d_admin_menu');

// Admin subpage
function spline_3d_admin_subpage() {
	if (isset($_POST['spline_3d_script_url'])) {
		update_option('spline_3d_script_url', $_POST['spline_3d_script_url']);
	}

	$script_url = get_option('spline_3d_script_url', 'https://unpkg.com/@splinetool/viewer/build/spline-viewer.js');
	?>
	<div class="wrap">
		<h2>Spline 3D</h2>
		<img src="<?php echo plugin_dir_url(__FILE__) . 'images/backend-header.png'; ?>" alt="Backend Header" style="width: 100%; max-width: 600px; display: block; margin-bottom: 20px;">
		<form method="post" action="">
			<table class="form-table">
				<tr valign="top">
				<th scope="row">JavaScript URL</th>
				<td><input type="text" name="spline_3d_script_url" value="<?php echo esc_url($script_url); ?>" /></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
