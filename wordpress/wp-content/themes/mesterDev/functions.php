<?php 

    require_once('wp-bootstrap-navwalker.php');

    add_theme_support('post-thumbnails');

    // Exerpt Controls
    function exerpt_length($length){
        return 15;
    }
    function exerpt_dots($more){
        return ' (...)';
    }
    add_filter('excerpt_length', 'exerpt_length');
    add_filter('excerpt_more', 'exerpt_dots');

    // Add styles function [wp_enqueue_style()];
    function meStyle(){
        wp_enqueue_style('bs_css', get_template_directory_uri() . '/css/bootstrap.css');
        wp_enqueue_style('fa_css', get_template_directory_uri() . '/css/fontello-embedded.css');
        wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
    };

    // Add scripts function [wp_enqueue_script()];
    function meScript(){
        // Deregester old jquery
        wp_deregister_script('jquery');
        // regester new jquery
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, '', true);
        // Add new jquery
        wp_enqueue_script('jquery');
        wp_enqueue_script('bs_js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), false, true);
        wp_enqueue_script('mn_js', get_template_directory_uri() . '/js/main.js', array(), false, true);
        wp_enqueue_script('htmlshiv', get_template_directory_uri() . '/js/html5shiv.js');
        wp_script_add_data('htmlshiv', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.js');
        wp_script_add_data('respond', 'conditional', 'lt IE 9');
    };

    // Add custom support
    function customMenu(){
        register_nav_menus(array(
            'bootstrap-menu' => 'Navigation Bar',
            'footer-menu' => 'Footer Menu'
        ));
    };

    // Menu function
    function mesterMenu(){
        wp_nav_menu(array(
            'theme_location'    => 'bootstrap-menu',
            'menu_class'        => 'navbar-nav ml-auto',
            'container'         => false,
            'depth'             => 2,
            'walker'            => new wp_bootstrap_navwalker()
            
        ));
    };

    // Add action function [add_action()];
    add_action('wp_enqueue_scripts', 'meStyle');
    add_action('wp_enqueue_scripts', 'meScript');
    add_action('init', 'customMenu');