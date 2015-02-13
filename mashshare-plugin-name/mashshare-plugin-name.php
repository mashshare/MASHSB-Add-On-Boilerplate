<?php
/**
 * Plugin Name: Mashshare - @todo
 * Plugin URI: @todo
 * Description: @todo
 * Author: @todo
 * Author URI: @todo
 * Version: 1.0.0
 * Text Domain: plugin-name
 * Domain Path: languages
 * 
 *
 * @package MASHSB\Plugin_Name
 * @category Add-On
 * 
 * IMPORTANT! Ensure that you make the following adjustments
 * before releasing your extension:
 *
 * - Replace all instances of plugin-name with the name of your plugin.
 *   By WordPress coding standards, the folder name, plugin file name,
 *   and text domain should all match. For the purposes of standardization,
 *   the folder name, plugin file name, and text domain are all the
 *   lowercase form of the actual plugin name, replacing spaces with
 *   hyphens.
 *
 * - Replace all instances of Plugin_Name with the name of your plugin.
 *   For the purposes of standardization, the camel case form of the plugin
 *   name, replacing spaces with underscores, is used to define classes
 *   in your extension.
 *
 * - Replace all instances of PLUGINNAME with the name of your plugin.
 *   For the purposes of standardization, the uppercase form of the plugin
 *   name, removing spaces, is used to define plugin constants.
 *
 * - Replace all instances of Plugin Name with the actual name of your
 *   plugin. This really doesn't need to be anywhere other than in the
 *   Mashshare Licensing call in the hooks method.
 *
 * - Find all instances of @todo in the plugin and update the relevant
 *   areas as necessary.
 *
 * - All functions that are not class methods MUST be prefixed with the
 *   plugin name, replacing spaces with underscores. NOT PREFIXING YOUR
 *   FUNCTIONS CAN CAUSE PLUGIN CONFLICTS!
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'MASHSB_Plugin_Name' ) ) :
 
    
/* Define this Plugin version 
 * 
 * Having this on top of the plugin allows you to make version changes much quicker
 */
if (!defined('MASHSB_PLUGIN_NAME_VERSION')) {
    define('MASHSB_PLUGIN_NAME_VERSION', '1.0.0');
}

/**
 * Main MASHSB_Plugin_Name Class
 *
 * @since 1.0.0
 */
class MASHSB_Plugin_Name {
	/** Singleton *************************************************************/

	/**
	 * @var MASHSB_Plugin_Name $instance The one and only MASHSB_Plugin_Name
	 * @since 1.0.0
	 */
	private static $instance;

	
	/**
	 * Main Instance
	 *
	 * Insures that only one instance of this Add-On exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0.0
	 * @static
	 * @staticvar array $instance
	 * @return object self::$instance The one true MASHSB_Plugin_Name
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof MASHSB_Plugin_Name ) ) {
			self::$instance = new MASHSB_Plugin_Name();
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->load_textdomain();
                        self::$instance->hooks();
		}
		return self::$instance;
        }

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'plugin-name' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'plugin-name' ), '1.0.0' );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function setup_constants() {
		global $wpdb, $mashpv_options; 

		// Plugin Folder Path
		if ( ! defined( 'MASHSB_PLUGIN_NAME_DIR' ) ) {
			define( 'MASHSB_PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'MASHSB_PLUGIN_NAME_URL' ) ) {
			define( 'MASHSB_PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'MASHSB_PLUGIN_NAME_FILE' ) ) {
			define( 'MASHSB_PLUGIN_NAME_FILE', __FILE__ );
		}
                
	}

	/**
	 * Include required files
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function includes() {
            // Required files whoch are available in frontend and backend
            require_once MASHSB_PLUGIN_NAME_DIR . 'includes/scripts.php';
            require_once MASHSB_PLUGIN_NAME_DIR . 'includes/template-functions.php';
            
            /**
             * @todo        The following files are not included in the boilerplate, but
             *              the referenced locations are listed for the purpose of ensuring
             *              path standardization in Mashshare Add-Ons. Uncomment any that are
             *              relevant to your extension, and remove the rest.
             */
            // require_once MASHSB_PLUGIN_NAME_DIR . 'includes/shortcodes.php';
            // require_once MASHSB_PLUGIN_NAME_DIR . 'includes/widgets.php';
                
                // Required files only available in backend
		if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
                        require_once MASHSB_PLUGIN_NAME_DIR . 'includes/admin/settings.php';
                        require_once MASHSB_PLUGIN_NAME_DIR . 'includes/admin/plugins.php';
                        require_once MASHSB_PLUGIN_NAME_DIR . 'includes/admin/welcome.php';
                        /**
                        * @todo        The following files are not included in the boilerplate. Read above description why.
                        */
                        // require_once MASHSB_PLUGIN_NAME_DIR . 'includes/shortcodes.php';
                        // require_once MASHSB_PLUGIN_NAME_DIR . 'includes/widgets.php';
                        
		}
	}
        
        /**
         * Run action and filter hooks
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         *
         * @todo        The hooks listed in this section are a guideline, and
         *              may or may not be relevant to your particular Add-On.
         *              Please remove any unnecessary lines, and refer to the
         *              WordPress codex and Mashshare documentation for additional
         *              information on the included hooks.
         *
         *              This method should be used to add any filters or actions
         *              that are necessary to the core of your extension only.
         *              Hooks that are relevant to meta boxes, widgets and
         *              the like can be placed in their respective files.
         *
         *              IMPORTANT! If you are releasing your Add-On as a
         *              commercial extension in the Mashshare store, DO NOT remove
         *              the license check!
         */
        private function hooks() {

             /* Instantiate class MASHSB_licence 
             * Create 
             * @since 1.0.0
             * @return apply_filter mashsb_settings_licenses and create licence key input field in Mashshare core plugin
             * 
             */
            if (class_exists('MASHSB_License')) {
                $mashsb_sl_license = new MASHSB_License(__FILE__, 'Plugin Name', MASHSB_PLUGIN_NAME_VERSION, 'Rene Hermenau', 'edd_sl_license_key'); 
            }
        }

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'plugin-name', false, dirname( plugin_basename( MASHSB_PLUGIN_NAME_FILE ) ) . '/languages/' );
	}
        
        /**
	 * Activation function fires when the plugin is activated.
	 * This function is fired when the activation hook is called by WordPress.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @return void
	 */
	public static function activation() {
        /*Activation functions here*/    
        }   
}




/**
 * The main function responsible for returning the one true Add-On
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $MASHPV = MASHPV(); ?>
 *
 * @since 1.0.0
 * @return object The one true MASHSB_Plugin_Name Instance
 *
 * @todo        Inclusion of the activation code below isn't mandatory, but
 *              can prevent any number of errors, including fatal errors, in
 *              situations where this extension is activated but MASHSB is not
 *              present.
 */

function MASHSB_Plugin_Name_load() {
	if( ! class_exists( 'Mashshare' ) ) {
        if( ! class_exists( 'MASHSB_Extension_Activation' ) ) {
            require_once 'includes/class.extension-activation.php';
        }
        $activation = new MASHSB_Extension_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
        $activation = $activation->run();
        return MASHSB_Plugin_Name::instance();
    } else {
        return MASHSB_Plugin_Name::instance();
    }
}

/** 
 * The activation hook is called outside of the singleton because WordPress doesn't
 * register the call from within the class hence, needs to be called outside and the
 * function also needs to be static.
 */

register_activation_hook( __FILE__, array( 'MASHSB_Plugin_Name', 'activation' ) );



// Get MASHSB_Plugin_Name running after other plugins loaded
add_action( 'plugins_loaded', 'MASHSB_Plugin_Name_load' );

endif; // End if class_exists check