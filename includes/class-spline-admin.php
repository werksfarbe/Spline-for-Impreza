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

	if (isset($_POST['post_types'])) {
		update_option('custom_3d_hero_post_types', $_POST['post_types']);
	}

	$script_url = get_option('spline_3d_script_url', 'https://unpkg.com/@splinetool/viewer/build/spline-viewer.js');
	$selected_post_types = get_option('custom_3d_hero_post_types', []);
	$all_post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
	?>
	<div class="wrap" style="max-width: 600px;">
		<h2>Spline 3D</h2>
		<img src="<?php echo SPLINE_3D_URL . 'images/backend-header.png'; ?>" alt="Backend Header" style="width: 100%; max-width: 600px; display: block;">
		<div class="form-wrapper" style="background: #ffffff; padding: 1rem;">
			<form method="post" action="">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">spline-viewer.js URL</th>
						<td><input type="text" name="spline_3d_script_url" value="<?php echo esc_url($script_url); ?>" style="width:100%" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Select Post Types for 3D Hero</th>
						<td>
							<?php foreach ($all_post_types as $post_type): ?>
								<label>
									<input type="checkbox" name="post_types[]" value="<?php echo $post_type->name; ?>" <?php echo in_array($post_type->name, $selected_post_types) ? 'checked' : ''; ?>>
									<?php echo $post_type->label; ?>
								</label><br>
							<?php endforeach; ?>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
	</div>
	<?php
}
