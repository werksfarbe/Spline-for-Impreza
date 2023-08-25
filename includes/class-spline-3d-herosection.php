<?
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	// Get the selected post types from the option
	$selected_post_types = get_option('custom_3d_hero_post_types', []);
	$locations = [];

	foreach ($selected_post_types as $post_type) {
		$locations[] = [
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => $post_type,
			]
		];
	}


	acf_add_local_field_group( array(
	'key' => 'group_64e861f9e5471',
	'title' => 'Spline 3D Hero',
	'fields' => array(
		array(
			'key' => 'field_64e861facf422',
			'label' => 'Spline 3D Object URL',
			'name' => 'hero_spline_3d_object_url',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
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
		array(
			'key' => 'field_64e86225cf423',
			'label' => 'Height Desktop',
			'name' => 'hero_spline_3d_height_desktop',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
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
		array(
			'key' => 'field_64e8624ecf424',
			'label' => 'Height Mobile',
			'name' => 'hero_spline_3d_height_mobile',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
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
		array(
			'key' => 'field_64e86260cf425',
			'label' => 'Show hint',
			'name' => 'hero_spline_3d_show_hint',
			'aria-label' => '',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'hint' => 'Yes, show 3D hint',
			),
			'default_value' => array(
			),
			'return_format' => 'value',
			'allow_custom' => 0,
			'layout' => 'vertical',
			'toggle' => 0,
			'save_custom' => 0,
			'custom_choice_button_text' => 'Add new choice',
		),
		array(
			'key' => 'field_64e8626ccf426',
			'label' => 'Show preloader',
			'name' => 'hero_spline_3d_show_preloader',
			'aria-label' => '',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'loading-anim' => 'Yes, show preloader',
			),
			'default_value' => array(
			),
			'return_format' => 'value',
			'allow_custom' => 0,
			'layout' => 'vertical',
			'toggle' => 0,
			'save_custom' => 0,
			'custom_choice_button_text' => 'Add new choice',
		),
	),
	'location' => $locations,
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

