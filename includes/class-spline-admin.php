<?php

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
