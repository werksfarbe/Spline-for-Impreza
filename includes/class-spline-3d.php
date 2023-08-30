<?php
/* Extend Row Dialoge */
add_action( 'vc_after_init', 'add_custom_3d_object_field' );

function add_custom_3d_object_field() {
	// Tabname
	$tab_name = '3D';
	// Custom object
	$attributes_textfield = array(
		'type' => 'textfield',
		'heading' => '3D-Object',
		'param_name' => 'custom_3d_object',
		'description' => 'Path to spline viewer file.',
		'group' => $tab_name
	);
	vc_add_param( 'vc_row', $attributes_textfield );
	// Custom Option for Object Positioning
	$attributes_dropdown = array(
		'type' => 'dropdown',
		'heading' => 'Object Position',
		'param_name' => 'custom_3d_object_position',
		'value' => array(
			'Absolute' => 'absolute',
			'Fixed' => 'fixed',
			'Sticky' => 'sticky'
		),
		'std' => 'absolute',  // Set the default value
		'description' => 'Wählen Sie die Positionseigenschaft für das 3D-Objekt.',
		'group' => $tab_name
	);
	
	vc_add_param('vc_row', $attributes_dropdown);
	// Custom Height
	$attributes_height = array(
		'type' => 'textfield',
		'heading' => 'Object Height',
		'param_name' => 'custom_3d_height',
		'description' => 'Set height of the object.',
		'group' => $tab_name ,
		'value' => '100vh' // This sets the default value to 100vh
	);
	vc_add_param( 'vc_row', $attributes_height );
	// Custom ID
	$attributes_id = array(
		'type' => 'textfield',
		'heading' => 'Object ID',
		'param_name' => 'custom_3d_id',
		'description' => 'Set ID if you want to manipulate the view via css.',
		'group' => $tab_name
	);
	vc_add_param( 'vc_row', $attributes_id );
	// Custom ID
	$attributes_class = array(
		'type' => 'textfield',
		'heading' => 'Object Class',
		'param_name' => 'custom_3d_class',
		'description' => 'Set Class if you want to manipulate the view via css.',
		'group' => $tab_name
	);
	vc_add_param( 'vc_row', $attributes_class );
}

add_filter( 'vc_shortcode_output', 'prepend_custom_3d_object_inside_row', 10, 3 );


/* Add spline Viewer in Frontend Row */
function prepend_custom_3d_object_inside_row($output, $shortcode, $atts) {
	if ($shortcode->settings('base') === 'vc_row' && isset($atts['custom_3d_object']) && !empty($atts['custom_3d_object'])) {

		// Default values
		$position_style = 'position: absolute;';
		$height_style = 'height: 100vh;';

		// Checking for custom_3d_object_position and setting the style accordingly
		if (isset($atts['custom_3d_object_position'])) {
			$position_value = esc_attr($atts['custom_3d_object_position']); 
			$position_style = 'position: ' . $position_value . ';';
		}

		if (isset($atts['custom_3d_height']) && !empty($atts['custom_3d_height'])) {
			$height_style = 'height: ' . esc_attr($atts['custom_3d_height']) . ';'; // Assuming the value includes units like 'px' or '%'
		}

		// Combine the styles
		$combined_style = trim($position_style . ' ' . $height_style);

		
		$id_attribute = '';
		if (isset($atts['custom_3d_id']) && !empty($atts['custom_3d_id'])) {
			$id_attribute = ' id="' . esc_attr($atts['custom_3d_id']) . '"';
		}
		$class_attribute = '';
		if (isset($atts['custom_3d_class']) && !empty($atts['custom_3d_class'])) {
			$class_attribute = ' class="' . esc_attr($atts['custom_3d_class']) . '"';
		}
		// Standardklasse
		$classes = 'custom-3d-object';
		
		// Fügen Sie die benutzerdefinierte Klasse hinzu, wenn sie gesetzt ist
		if (isset($atts['custom_3d_class']) && !empty($atts['custom_3d_class'])) {
			$classes .= ' ' . esc_attr($atts['custom_3d_class']);
		}
		
		
		$custom_output = '<div class="' . esc_attr($classes) . '"' . $id_attribute . ' style="' . $combined_style . '">';
		$custom_output .= '<spline-viewer loading-anim url="' . esc_url($atts['custom_3d_object']) . '"></spline-viewer>';
		$custom_output .= '</div>';

		// Find the opening section tag and insert the custom output right after it
		$output = preg_replace('/(<section[^>]*>)/', '$1' . $custom_output, $output, 1);
	}
	return $output;
}
