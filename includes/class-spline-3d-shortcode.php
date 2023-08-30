<?
// Shortcode
function add_custom_3d_object_shortcode($atts) {
	$atts = shortcode_atts(
		array(
			'custom_3d_object_url' => '',
			'custom_3d_object_class' => '',
			'show_3d_preloader' => 'false',
			'show_3d_hint' => 'false'
		), 
		$atts, 
		'add_custom_3d_object_shortcode'
	);

	// Combine default class with user-defined class (if provided)
	$div_class = 'shortcode-3d-object';
	if (!empty($atts['custom_3d_object_class'])) {
		$div_class .= ' ' . esc_attr($atts['custom_3d_object_class']);
	}
	
	// Begin building the output string using the combined classes
	$output = '<div class="' . $div_class . '">';
	

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

function load_pagebuilder_element() {
	if (function_exists('vc_map')) {
		vc_map(
			array(
				'name' => 'Custom 3D Object',
				'base' => 'add_custom_3d_object_shortcode',
				'html_template' => plugin_dir_path(__FILE__) . 'vc_templates/shortcode-3d-object.php',
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
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => 'Object Class',
						'param_name' => 'custom_3d_object_class',
						'value' => '',
						'description' => 'Set Class if you want to manipulate the view via css.'
					)

				)
			)
		);
	}
}

// Hängen Sie Ihre Funktion an den plugins_loaded Hook mit einer höheren Priorität:
add_action('plugins_loaded', 'load_pagebuilder_element', 20);

