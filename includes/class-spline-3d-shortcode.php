<?
// Shortcode
function add_custom_3d_object_shortcode($atts) {
	$atts = shortcode_atts(
		array(
			'custom_3d_object_url' => '',
			'show_3d_preloader' => 'false',
			'show_3d_hint' => 'false'
		), 
		$atts, 
		'add_custom_3d_object_shortcode'
	);

	// Begin building the output string
	$output = '<div class="shortcode-3d-object">';

	$spline_attributes = 'url="' . esc_url($atts['custom_3d_object_url']) . '"';

	if ($atts['show_3d_preloader'] === 'true') {
		$spline_attributes .= ' loading-anim';
	}

	if ($atts['show_3d_hint'] === 'true') {
		$spline_attributes .= ' hint';
	}

	$output .= '<spline-viewer ' . $spline_attributes . '></spline-viewer>';
	$output .= '</div>';

	return $output;
}
add_shortcode('add_custom_3d_object_shortcode', 'add_custom_3d_object_shortcode');

// WP-Backey

// Statt einfach Ihren Code auszuführen, setzen Sie ihn in eine Funktion:
function load_my_plugin() {
	if (function_exists('vc_map')) {
		vc_map(
			array(
				'name' => 'Custom 3D Object',
				'base' => 'add_custom_3d_object_shortcode',
				'category' => 'Spline 3D',
				'params' => array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => '3D Object URL',
						'param_name' => 'custom_3d_object_url',
						'value' => '',
						'description' => 'Set the URL for the 3D object.'
					),
					array(
						'type' => 'checkbox',
						'holder' => 'div',
						'heading' => 'Show 3D Preloader',
						'param_name' => 'show_3d_preloader',
						'value' => array('Yes' => 'true'),
						'description' => 'Show a preloader for the 3D object.'
					),
					array(
						'type' => 'checkbox',
						'holder' => 'div',
						'heading' => 'Show 3D Hint',
						'param_name' => 'show_3d_hint',
						'value' => array('Yes' => 'true'),
						'description' => 'Show a hint for the 3D object.'
					)
				)
			)
		);
	}
}

// Hängen Sie Ihre Funktion an den plugins_loaded Hook mit einer höheren Priorität:
add_action('plugins_loaded', 'load_my_plugin', 20);

