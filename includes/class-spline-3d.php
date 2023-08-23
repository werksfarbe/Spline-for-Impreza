<?php
/* Extend Row Dialoge */
add_action( 'vc_after_init', 'add_custom_3d_object_field' );

function add_custom_3d_object_field() {
	// Custom object
	$attributes_textfield = array(
		'type' => 'textfield',
		'heading' => '3D-Object',
		'param_name' => 'custom_3d_object',
		'description' => 'Pash to spline viewer file.',
	);
	vc_add_param( 'vc_row', $attributes_textfield );
	// Custom Option Sticky
	$attributes_checkbox = array(
		'type' => 'checkbox',
		'heading' => 'Object is sticky',
		'param_name' => 'custom_3d_object_sticky',
		'value' => array('Ja' => 'true'),
		'description' => 'Aktivieren Sie diese Option, um das 3D-Objekt als sticky zu markieren.',
	);
	vc_add_param( 'vc_row', $attributes_checkbox );
	// Custom Height
	$attributes_height = array(
		'type' => 'textfield',
		'heading' => 'Object Height',
		'param_name' => 'custom_3d_height',
		'description' => 'Set height of the object.',
		'value' => '100vh' // This sets the default value to 100vh
	);
	vc_add_param( 'vc_row', $attributes_height );
	// Custom ID
	$attributes_id = array(
		'type' => 'textfield',
		'heading' => 'Object ID',
		'param_name' => 'custom_3d_id',
		'description' => 'Set ID if you want to manipulate the view via css.',
	);
	vc_add_param( 'vc_row', $attributes_id );
}

add_filter( 'vc_shortcode_output', 'prepend_custom_3d_object_inside_row', 10, 3 );


/* Add spline Viewer in Frontend Row */

function prepend_custom_3d_object_inside_row( $output, $shortcode, $atts ) {
	if ( $shortcode->settings('base') === 'vc_row' && isset( $atts['custom_3d_object'] ) && ! empty( $atts['custom_3d_object'] ) ) {
		
		// If the checkbox is true, add the class "object_is_sticky" to the div
		$classes = 'custom-3d-object';
		if (isset($atts['custom_3d_object_sticky']) && $atts['custom_3d_object_sticky'] === 'true') {
			$classes .= ' object_is_sticky';
		}

		// Add the ID attribute if custom_3d_id is set
		$id_attribute = '';
		if (isset($atts['custom_3d_id']) && !empty($atts['custom_3d_id'])) {
			$id_attribute = ' id="' . esc_attr($atts['custom_3d_id']) . '"';
		}

		// Add height style if custom_3d_height is set
		$height_style = '';
		if (isset($atts['custom_3d_height']) && !empty($atts['custom_3d_height'])) {
			$height_style = ' style="height: ' . esc_attr($atts['custom_3d_height']) . ';"'; // Assuming the value includes units like 'px' or '%'
		}

		$custom_output = '<div class="' . $classes . '"' . $id_attribute . $height_style . '>';
		$custom_output .= '<spline-viewer loading-anim url="' . esc_url( $atts['custom_3d_object'] ) . '"></spline-viewer>';
		$custom_output .= '</div>';

		// Find the opening section tag and insert the custom output right after it
		$output = preg_replace('/(<section[^>]*>)/', '$1' . $custom_output, $output, 1);
	}
	return $output;
}
