<?php
/**
 * @package Facebook Fan Page
 * @version 1.0
 * @ enqueue style and script
 */
    function fanpage_style_and_script(){
//        Add CSS
        wp_enqueue_style('main-css',plugins_url().'/modern-fb-fan-page/css/style.css');
//        Add Java Script
        wp_enqueue_script('main-js',plugins_url().'/modern-fb-fan-page/js/main.js');

    }
    add_action('wp_enqueue_scripts','fanpage_style_and_script');








?>