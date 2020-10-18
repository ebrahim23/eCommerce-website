<?php 
/**
 * Library of Theme options functions.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/

// Display Breadcrumb navigation
function songwriter_get_breadcrumb() { 
		if (get_theme_mod('songwriter_display_breadcrumb', songwriter_default_options('songwriter_display_breadcrumb')) != 'Hide') { ?>
<?php if(function_exists( 'bcn_display' ) && !is_front_page()){ _e('<p class="breadcrumb-navigation">', 'songwriter'); ?><?php bcn_display(); ?><?php _e('</p>', 'songwriter');} ?>
<?php } 
} 

// Display featured images on single posts
function songwriter_get_display_image_post() { 
		if (get_theme_mod('songwriter_display_image_post', songwriter_default_options('songwriter_display_image_post')) == '' || get_theme_mod('songwriter_display_image_post', songwriter_default_options('songwriter_display_image_post')) == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
}

// Display featured images on pages
function songwriter_get_display_image_page() { 
		if (get_theme_mod('songwriter_display_image_page', songwriter_default_options('songwriter_display_image_page')) == '' || get_theme_mod('songwriter_display_image_page', songwriter_default_options('songwriter_display_image_page')) == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
} ?>