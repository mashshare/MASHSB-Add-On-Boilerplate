<?php
/**
 * Add some plugin meta settings links
 *
 * @package     Plugin_Name
 * @subpackage  Admin/Plugins
 * @copyright   Copyright (c) @Year, @author
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Plugins row action links
 *
 * @since 1.0
 * @param array $links already defined action links
 * @param string $file plugin file path and name being processed
 * @return array $links
 */
function plugin_name_plugin_action_links( $links, $file ) {
	$settings_link = '<a href="' . admin_url( 'admin.php?page=mashsb-settings&tab=extensions#mashsb_settingsplugin_name' ) . '">' . esc_html__( 'General Settings', 'plugin-name' ) . '</a>';
	if ( $file == 'mashshare-plugin-name/mashshare-plugin-name.php' )
		array_unshift( $links, $settings_link );

	return $links;
}
add_filter( 'plugin_action_links', 'plugin_name_plugin_action_links', 10, 2 );


/**
 * Plugin row meta links
 *
 * @since 1.0
 * @param array $input already defined meta links
 * @param string $file plugin file path and name being processed
 * @return array $input
 */
function plugin_name_row_meta( $input, $file ) {
	if ( $file != 'mashsharer/mashshare.php' )
		return $input;

	$links = array(
		'<a href="' . admin_url( 'options-general.php?page=mashsb-settings#mashsb_settingsplugin_name_pageviews_header' ) . '">' . esc_html__( 'Getting Started', 'plugin-name' ) . '</a>',
		'<a href="https://www.mashshare.net/downloads/">' . esc_html__( 'Add Ons', 'plugin-name' ) . '</a>',
	);

	$input = array_merge( $input, $links );

	return $input;
}
add_filter( 'plugin_row_meta', 'plugin_name_row_meta', 10, 2 );