<?php

    // Require The Nav Walker
    require_once('wp-bootstrap-navwalker.php');

    // Add Stylesheets Files
    function styles(){
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
        wp_enqueue_style('styles-css', get_template_directory_uri() . '/css/style.css');
    }

    // Add Scripts Files
    function scripts(){
        wp_deregister_script('jquery');
        wp_register_script('jquery', includes_url('js/jquery/jquery.js'), false, '', true);
        wp_enqueue_script('popper-js', get_template_directory_uri() . '/js/popper.min.js', array(), false, true);
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), false, true);
    }

    // Create Costum Menu Function
    function setup_theme(){
        add_theme_support('post-thumbnails');

        register_nav_menus(array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu')
        ));

        // Add Support For Post Format
        add_theme_support('post-formats', array('aside', 'gallery'));
    }

    // Create The Sidebar Widgets
    function wpb_sidebar($id){
        register_sidebar(array(
            'name'          => 'sidebar',
            'id'            => 'sidebar',
            'before_widget' => '<div class="card my-4"> <div class="card-body side">',
            'after_widget'  => '</div> </div>',
            'before_title'  => '<h5 class="card-header">',
            'after_title'   => '</h5>'
        ));
    }

    // Excerpt Length
    function editExerpt(){
        return 30;
    }
    add_filter('excerpt_length', 'editExerpt');

    // Create The Hooks
    add_action('wp_enqueue_scripts', 'styles');
    add_action('wp_enqueue_scripts', 'scripts');
    add_action('after_setup_theme', 'setup_theme');
    add_action('widgets_init', 'wpb_sidebar');
    