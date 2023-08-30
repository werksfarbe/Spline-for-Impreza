<?
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	
	// Abfrage der ausgewählten Post-Typen
	$selected_post_types = get_option('custom_3d_hero_post_types', []);
	$locations_grid = [];
	
	foreach ($selected_post_types as $post_type) {
		$locations_grid[] = [
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => $post_type,
			]
		];
	}
	
	acf_add_local_field_group( array(
		'key' => 'group_64ef23201623e',
		'title' => '3D Teaser',
		'fields' => array(
			array(
				'key' => 'field_64ef2320fce51',
				'label' => 'Activate Spline 3D Grid Shortcode',
				'name' => 'activate_spline_3d_grid_shortcode',
				'aria-label' => '',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'grid_shortcode_active' => 'Yes',
					'grid_shortcode_passive' => 'No',
				),
				'default_value' => 'grid_shortcode_passive',
				'return_format' => 'value',
				'allow_null' => 0,
				'other_choice' => 0,
				'layout' => 'vertical',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_64ef2400fce52',
				'label' => 'Spline 3D Object URL',
				'name' => 'spline_3d_object_url_grid_shortcode',
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_64ef2320fce51',
							'operator' => '==',
							'value' => 'grid_shortcode_active',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => $locations_grid, // Hier verwenden wir die aktualisierte location
		'menu_order' => 5,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	) );
} );

function custom_3d_object_for_grids_shortcode() {
	$url = get_field('spline_3d_object_url_grid_shortcode');

	// Wenn das Feld leer ist, geben wir nichts zurück
	if( !$url ) return '';

	return '<div class="custom-3d-object custom-3d-object-for-grid"><spline-viewer loading-anim url="' . esc_url($url) . '"></spline-viewer></div>';
}
add_shortcode( 'add_custom_3d_object_for_grids', 'custom_3d_object_for_grids_shortcode' );
// [add_custom_3d_object_for_grids]
