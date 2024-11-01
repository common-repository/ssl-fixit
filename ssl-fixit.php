<?php
/*
	Plugin Name
	@package     Wordpress SSL Fixit
	@author      Stefan Kitel
	@copyright   2018 Stefan Kittel
	@license     GPL-2.0+

	@wordpress-plugin
	Plugin Name:	SSL Fixit
	Description:	This plugin fixes the mixed insecure content. It replaces all http:// with https:// in any output. Nothing to configure
	Version:		1.01
	Plugin URI:		https://www.skittel.de/wp_sslfixit/
	Author:			Stefan Kittel
	Author URI:		https://skittel.de
	License:		GPL-2.0+
	License URI:	https://www.gnu.org/licenses/gpl-2.0.txt
*/


//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


//call back function the replace parts of the rendered output (header and body)
function skit_wp_sslfixit_callback($p_buffer)
{
	//get buffer as parameter
	$buffer = $p_buffer;

	//replace http:// with https://
	$buffer = str_ireplace("http://", "https://", $buffer);
	
	//return buffer for output
	return $buffer;
}


//start ob for output capture
function skit_wp_sslfixit_buffer_start()
{
	ob_start("skit_wp_sslfixit_callback");
}
add_action('plugins_loaded', 'skit_wp_sslfixit_buffer_start');


//end ob for output capture
function skit_wp_sslfixit_buffer_end()
{
	ob_end_flush();
}
add_action('shutdown', 'skit_wp_sslfixit_buffer_end');

?>