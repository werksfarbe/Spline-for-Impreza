<?php
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
/* has_3d_object Class */
function check_for_3d_object($content) {
	// Überprüfen Sie, ob der spezifische URL-Anfang im Inhalt vorhanden ist
	if (strpos($content, 'https://prod.spline.design') !== false) {
		// Setzen Sie eine globale Variable, um später zu überprüfen
		global $has_3d_object;
		$has_3d_object = true;
	}
	return $content;
}
add_filter('the_content', 'check_for_3d_object', 20);  // Priority 20, um sicherzustellen, dass es nach anderen Filtern ausgeführt wird

function add_3d_object_class($classes) {
	global $has_3d_object;
	if ($has_3d_object) {
		$classes[] = 'has_3d_object';
	}
	return $classes;
}
add_filter('body_class', 'add_3d_object_class');
