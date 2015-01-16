<?php

/**
 * Registers the options in mashsb Extensions tab
 * *
 * @access      private
 * @since       1.0
 * @param 	$settings array the existing plugin settings
 * @return      array
 * @todo        This are several sample settings. You can check out mashsharer/includes/admin/settings.php for more option examples.
 * 
*/

function plugin_name_extension_settings( $settings ) {

	$ext_settings = array(
		array(
			'id' => 'plugin_name_header',
			'name' => '<strong>' . __( 'Plugin_Name', 'plugin-name' ) . '</strong>',
			'desc' => '',
			'type' => 'header',
			'size' => 'regular'
		),
		array(
			'id' => 'plugin_name_textfield',
			'name' => __( 'Text Field', 'plugin-name' ),
			'desc' => __( 'This is a text field', 'plugin-name' ),
			'type' => 'text',
                        'size' => 'large',
                        'std' => 'This is a large textfield'
		),
                array(
			'id' => 'plugin_name_number',
			'name' => __( 'Number field', 'plugin-name' ),
			'desc' => __( 'This is a number field', 'plugin-name' ),
			'type' => 'number',
                        'size' => 'normal'
		),  
                array(
			'id' => 'plugin_name_custom_field',
			'name' => __( 'Custom field', 'plugin-name' ),
			'desc' => __( 'This is a custom field created with the callback function mashsb_custom_field_callback', 'plugin-name' ),
			'type' => 'custom_field',
                        'size' => 'small',
                        'std' => 0.8
		), 
                array(
			'id' => 'plugin_name_options',
			'name' => __( 'Options field', 'plugin-name' ),
			'desc' => __( 'This is an options field', 'plugin-name' ),
			'type' => 'select',
                                        'options' => array(
						'value1' => __( 'Value 1', 'plugin-name' ),
						'value2' => __( 'Value 2', 'plugin-name' )
					)
		),
                array(
			'id' => 'plugin_name_checkbox',
			'name' => __( 'Checkbox', 'plugin-name' ),
			'desc' => __( 'You already guessed it: This is a Checkbox', 'plugin-name' ),
			'type' => 'checkbox'
		),
	);

	return array_merge( $settings, $ext_settings );

}
add_filter('mashsb_settings_extension', 'plugin_name_extension_settings');

/**
 * Custom Callback
 *
 * Renders a custom fields.
 * 
 * @todo This is an example to show how to create your own callback function for custom settings field
 *
 * @since 1.0
 * @param array $args Arguments passed by the setting
 * @global $mashsb_options Array of all the Mashshare Options
 * @return void
 */
function mashsb_custom_field_callback( $args ) {
	global $mashsb_options;

	if ( isset( $mashsb_options[ $args['id'] ] ) )
		$value = $mashsb_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$max  = isset( $args['max'] ) ? $args['max'] : 999999;
	$min  = isset( $args['min'] ) ? $args['min'] : 0;
	$step = isset( $args['step'] ) ? $args['step'] : 0.1;

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="number" step="' . esc_attr( $step ) . '" max="' . esc_attr( $max ) . '" min="' . esc_attr( $min ) . '" class="' . $size . '-text" id="mashsb_settings[' . $args['id'] . ']" name="mashsb_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
	$html .= '<label for="mashsb_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}



