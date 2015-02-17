<?php
/**
 * Scripts
 *
 * @package     MASHSB\PluginName\Scripts
 * @subpackage  @todo
 * @copyright   @todo
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Load Scripts
 *
 * Enqueues the required scripts on your websites frontend.
 *
 * @since 1.0.0
 * @global $mashsb_options  This is the global options row where all your custom data is stored
 * @global $post
 * @return void
 */
function plugin_name_load_scripts($hook) {
    /* Load this scripts only when Mashshare is running on the same page 
     * Delete this when you want your scripts be loaded everywhere
     */
    if(function_exists('mashsbGetActiveStatus')){
        if ( ! apply_filters( 'plugin_name_load_scripts', mashsbGetActiveStatus(), $hook ) ) {
            return;
	}
    }
    
	global $mashsb_options, $post;
        
        /* @todo
         * Example of how to access data from the mashshare options row
         */
        //isset($mashsb_options['plugin_name_field_name']) ? $value1 = $mashsb_options['plugin_name_field_name'] : $value1 === null;
            
	$js_dir = MASHSB_PLUGIN_NAME_URL . 'assets/js/';
        $js_title = 'plugin_name';

	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        // Check if js should be loaded in footer
        isset($mashsb_options['load_scripts_footer']) ? $in_footer = true : $in_footer = false;
	wp_enqueue_script( 'plugin-name', $js_dir . $js_title . $suffix . '.js', array( 'jquery' ), MASHSB_PLUGIN_NAME_VERSION, $in_footer ); 
        
        /* Use this when you need CDATA Strings in your HTML code 
         * to access them via JS
         */
        //wp_localize_script( 'plugin_name', 'plugin_name', array (
          //  'VAR1' => $value1,
          //  'VAR2' => $value2
        //));
       
}
add_action( 'wp_enqueue_scripts', 'mashpv_load_scripts' );

/**
 * Register Styles
 *
 * Checks the styles option and hooks the required filter.
 *
 * @since 1.0.0
 * @global $mashsb_options
 * @return void
 */
function plugin_name_register_styles() {
	//needed when you want to access the mashshare options row
        global $mashsb_options; 
        
        $css_dir = MASHSB_PLUGIN_NAME_URL . 'assets/css/';
        $css_title = 'plugin-name';

	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'plugin-name', $css_dir . $css_title . $suffix . '.css', array(), MASHSB_PLUGIN_NAME_VERSION );
        
}
add_action( 'wp_enqueue_scripts', 'plugin_name_register_styles' );

/**
 * Load Admin Scripts
 *
 * Enqueues the required admin scripts.
 *
 * @since 1.0.0
 * @global $post
 * @param string $hook Page hook
 * @return void
 */

function plugin_name_load_admin_scripts( $hook ) {
    /* Load this scripts only on Mashshare settings in the backend 
     * Delete this when you want your scripts should be loaded on every admin page (not recommend)
     */
    if(function_exists('mashsbGetActiveStatus')){
	if ( ! apply_filters( 'mashpv_load_admin_scripts', mashsb_is_admin_page(), $hook ) ) {
		return;
	}
    }

	$js_dir  = MASHSB_PLUGIN_NAME_URL . 'assets/js/';
	$css_dir = MASHSB_PLUGIN_NAME_URL . 'assets/css/';

	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        // Check if js should be loaded in footer
        isset($mashsb_options['load_scripts_footer']) ? $in_footer = true : $in_footer = false;
	wp_enqueue_script( 'plugin-name-admin', $js_dir . 'plugin-name' . $suffix . '.js', array( 'jquery' ), MASHSB_PLUGIN_NAME_VERSION, $in_footer );
}
add_action( 'admin_enqueue_scripts', 'plugin_name_load_admin_scripts', 100 );

