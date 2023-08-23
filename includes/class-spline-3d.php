<?php
// Enqueue styles and scripts
function spline_3d_enqueue_scripts() {
	wp_enqueue_style('spline-3d-for-impreza', plugin_dir_url(__FILE__) . 'css/spline-3d-for-impreza.css');
	wp_enqueue_script('spline-3d-for-impreza', plugin_dir_url(__FILE__) . 'js/spline-3d-for-impreza.js', array(), '1.0', true);

	$script_url = get_option('spline_3d_script_url', 'https://unpkg.com/@splinetool/viewer/build/spline-viewer.js');
	echo '<script type="module" src="' . esc_url($script_url) . '"></script>';
}
add_action('wp_enqueue_scripts', 'spline_3d_enqueue_scripts');


/* Extend Row Dialoge */
add_action( 'vc_after_init', 'add_custom_3d_object_field' );

function add_custom_3d_object_field() {
	$attributes_textfield = array(
		'type' => 'textfield',
		'heading' => '3D-Objekt',
		'param_name' => 'custom_3d_object',
		'description' => 'Geben Sie hier den Pfad zu Ihrem 3D-Objekt ein. NUR den Pfad aus dem spline-viewer. Keinen Code.',
	);
	vc_add_param( 'vc_row', $attributes_textfield );
	// Custom checkbox
	$attributes_checkbox = array(
		'type' => 'checkbox',
		'heading' => 'Objekt ist sticky',
		'param_name' => 'custom_3d_object_sticky',
		'value' => array('Ja' => 'true'),
		'description' => 'Aktivieren Sie diese Option, um das 3D-Objekt als sticky zu markieren.',
	);
	vc_add_param( 'vc_row', $attributes_checkbox );
}

add_filter( 'vc_shortcode_output', 'prepend_custom_3d_object_inside_row', 10, 3 );


/* Add spline Viewer in Row */

function prepend_custom_3d_object_inside_row( $output, $shortcode, $atts ) {
	if ( $shortcode->settings('base') === 'vc_row' && isset( $atts['custom_3d_object'] ) && ! empty( $atts['custom_3d_object'] ) ) {
		$custom_output = '<div class="custom-3d-object';

		// If the checkbox is true, add the class "object_is_sticky" to the div
		if (isset($atts['custom_3d_object_sticky']) && $atts['custom_3d_object_sticky'] === 'true') {
			$custom_output .= ' object_is_sticky';
		}

		$custom_output .= '">';
		$custom_output .= '<spline-viewer loading-anim url="' . esc_url( $atts['custom_3d_object'] ) . '"></spline-viewer>';
		$custom_output .= '</div>';

		// Find the opening section tag and insert the custom output right after it
		$output = preg_replace('/(<section[^>]*>)/', '$1' . $custom_output, $output, 1);
	}
	return $output;
}
/* Spline per Row  END */