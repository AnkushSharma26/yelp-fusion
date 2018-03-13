<?php
/*
Plugin Name: Reviews Online
Description: This plugin is create to collect online reviews for a business and display in wordpress website.
Author URI: https://www.google.com
Author: Acutweb Team
Version: 1.0
*/


//ABSPATH
if(!defined("ABSPATH"))exit;

//Define Constant

if(!defined("ONLINE_REVIEWS_DIR_PATH")) {
	define("ONLINE_REVIEWS_DIR_PATH",plugin_dir_path(__FILE__));
}


/*
Function Name: install_script_for_online_reviews
Description: This Plugin is used to create and display the install script
Parameter: No
Created By: Acutweb Team
Created On: 26-02-2018
*/

if(!function_exists("install_script_for_online_reviews"))
{
	function install_script_for_online_reviews()
	{
		$user_role_permission = array("manage_options","edit_plugins","edit_posts","publish_posts","publish_pages","edit_pages","read");
		if(file_exists(ONLINE_REVIEWS_DIR_PATH."lib/install-script.php"))
		{
			include ONLINE_REVIEWS_DIR_PATH."lib/install-script.php";
		}
	}
}


/*
Function Name: sidebar_menus_for_online_reviews
Description: This Function is create to access the pages from sidebar.
Parameter: No
Created By: Acutweb Team
Created On: 26-02-2018
*/

if(!function_exists("sidebar_menus_for_online_reviews"))
{
	function sidebar_menus_for_online_reviews()
	{
		$user_role_permission = array("manage_options","edit_plugins","edit_posts","publish_posts","publish_pages","edit_pages","read");
		if(file_exists(ONLINE_REVIEWS_DIR_PATH."lib/sidebar-menu.php"))
		{
			include ONLINE_REVIEWS_DIR_PATH."lib/sidebar-menu.php";
		}
	}
}



/*
Function Name: myplugin_load_textdomain
Description: This function is create to load textdomain
Parameter: No
Created By: Acutweb Team
Created On: 26-02-2018
*/
if(!function_exists("myplugin_load_textdomain"))
{
	function myplugin_load_textdomain() 
	{
  		load_plugin_textdomain( 'wp-reviews-online', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
	}
}



/*
Function Name: backend_js_css_for_online_reviews
Description: This function is create to display a css and js into the admin area
Parameter: No
Created By: Acutweb Team
Created On: 26-02-2018
*/


if(!function_exists("backend_js_css_for_online_reviews"))
{
	function backend_js_css_for_online_reviews()
	{
		wp_enqueue_script("jquery");
		wp_enqueue_style("style.min.css", plugins_url("assets/css/style.min.css", __FILE__));
		 wp_enqueue_script('jquery.min',plugins_url("assets/js/jquery.min.js", __FILE__));
		 wp_enqueue_script('jquery.validate.min',plugins_url("assets/js/jquery.validate.min.js", __FILE__));
		 wp_enqueue_script('additional-methods.min',plugins_url("assets/js/additional-methods.min.js", __FILE__));
	}
}



/*
Function Name: add_my_js_files
Description: This function is create to display a css and js into the admin area
Parameter: No
Created By: Acutweb Team
Created On: 26-02-2018
*/


if(!function_exists("add_my_js_files"))
{
	function add_my_js_files()
	{
		wp_enqueue_script("jquery");
		 wp_enqueue_script('jquery.min',plugins_url("assets/js/jquery.min.js", __FILE__));
		 wp_enqueue_script('jquery.validate.min',plugins_url("assets/js/jquery.validate.min.js", __FILE__));
		 wp_enqueue_script('additional-methods.min',plugins_url("assets/js/additional-methods.min.js", __FILE__));
	}
}


/*
Function Name: parent_review_table
Description: This function is used to create a table in wordpress database.
Created By: Acutweb Team
Created On: 27-02-2018
*/

if(!function_exists("parent_review_table"))
{
	function parent_review_table()
	{
		global $wpdb;
		return $wpdb->prefix . "parent_reviews_for_gyhf";
	}
}



/*
Function Name: meta_review_table
Description: This function is used to create a table in wordpress database.
Created By: Acutweb Team
Created On: 27-02-2018
*/

if(!function_exists("meta_review_table"))
{
	function meta_review_table()
	{
		global $wpdb;
		return $wpdb->prefix . "meta_reviews_for_gyhf";
	}
}

function tatwerat_startSession() {
    if(!session_id()) {
        session_start();
    }
}

add_action('admin_init', 'tatwerat_startSession', 1);


/*
Function Name: uninstall_script_for_online_reviews
Description: This Plugin is used to create and display the uninstall script
Parameter: No
Created By: Acutweb Team
Created On: 26-02-2018
*/

if(!function_exists("uninstall_script_for_online_reviews"))
{
	function uninstall_script_for_online_reviews()
	{
		
	}
}



/*
Hook Name: install_script_for_online_reviews
Description: It is used to create a install_script_for_online_reviews
Created By: Acutweb Team
Created On: 26-02-2018
*/
register_activation_hook(__FILE__,"install_script_for_online_reviews");


/*
Hook Name: uninstall_script_for_online_reviews
Description: It is used to create a uninstall_script_for_online_reviews
Created By: Acutweb Team
Created On: 26-02-2018
*/
register_deactivation_hook(__FILE__,"uninstall_script_for_online_reviews");


/*
Hook Name: admin_init
Description: It is used to install the latest events.
Created By: Acutweb Team
Created On: 26-02-2018
*/
add_action("admin_init","install_script_for_online_reviews");


/*
Hook Name: admin_menu
Description: This hook is create to access the pages from sidebar.
Created By: Acutweb Team
Created On: 26-02-2018
*/
add_action("admin_menu","sidebar_menus_for_online_reviews");


/*
Hook Name: plugins_loaded
Description: This hook is create to load textdomain
Created By: Acutweb Team
Created On: 26-02-2018
*/
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );



/*
Hook Name: admin_enqueue_scripts
Description: It is used to create and apply all styles to the page
Created By: Acutweb Team
Created On: 26-02-2018
*/
add_action( "admin_enqueue_scripts", "backend_js_css_for_online_reviews" );



/*
Hook Name: wp_enqueue_scripts
Description: It is used to create and apply all styles to the page
Created By: Acutweb Team
Created On: 26-02-2018
*/
add_action('wp_enqueue_scripts', "add_my_js_files");
?>