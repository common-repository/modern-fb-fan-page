<?php
/**
 * @package Facebook Fan Page
 * @version 1.0
 */
/*
Plugin Name: Modern fan page plugin
Plugin URI:http://sumon-it.com/blog   
Description: This is simple Facebook fan page plugin, But very useful.
Author: Sumon Sarker
Version: 1.0
Author URI: http://sumon-it.com/
*/

//Make Sure the plugins Runs Only WordPress
if(!function_exists('add_action')){
    echo "Hi there! please run only wordpress.........";
    exit;
}

//IF SomeOne Directly access plugin file
if(!defined('ABSPATH')){
    exit;
}

//Require Your ALl of necessary File
//Include class file
require_once (plugin_dir_path(__FILE__).'inc/fan_page_class.php');
//Include Script File
require_once (plugin_dir_path(__FILE__).'inc/fan_page_script.php');

//Register Widget
add_action(
    'widgets_init',function (){
    register_widget('Fb_Fan_Page'); // Fb_Fan_Page =>class name
});

