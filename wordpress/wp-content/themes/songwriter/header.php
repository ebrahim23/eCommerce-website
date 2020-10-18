<?php
/**
 * The header template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" /> 
  <meta name="viewport" content="width=device-width" />  
<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { ?><title><?php wp_title( '|', true, 'right' ); ?></title><?php } ?>  
  <!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>  
</head>
 
<body <?php body_class(); ?> id="wrapper">   
<div id="container">

  <header id="header">
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
<?php if ( get_theme_mod('songwriter_header_address', songwriter_default_options('songwriter_header_address')) != '' || get_theme_mod('songwriter_header_email', songwriter_default_options('songwriter_header_email')) != '' || get_theme_mod('songwriter_header_phone', songwriter_default_options('songwriter_header_phone')) != '' || get_theme_mod('songwriter_header_skype', songwriter_default_options('songwriter_header_skype')) != '' ) {  ?>
  <div class="top-navigation-wrapper">
    <div class="top-navigation">
      <p class="header-contact">
<?php if ( get_theme_mod('songwriter_header_address', songwriter_default_options('songwriter_header_address')) != '' ){ ?>
        <span class="header-contact-address"><i class="icon_house" aria-hidden="true"></i><?php echo esc_attr(get_theme_mod('songwriter_header_address', songwriter_default_options('songwriter_header_address'))); ?></span>
<?php } ?>
<?php if ( get_theme_mod('songwriter_header_email', songwriter_default_options('songwriter_header_email')) != '' ){ ?>
        <span class="header-contact-email"><i class="icon_mail" aria-hidden="true"></i><?php echo esc_attr(get_theme_mod('songwriter_header_email', songwriter_default_options('songwriter_header_email'))); ?></span>
<?php } ?>
<?php if ( get_theme_mod('songwriter_header_phone', songwriter_default_options('songwriter_header_phone')) != '' ){ ?>
        <span class="header-contact-phone"><i class="icon_phone" aria-hidden="true"></i><?php echo esc_attr(get_theme_mod('songwriter_header_phone', songwriter_default_options('songwriter_header_phone'))); ?></span>
<?php } ?>
<?php if ( get_theme_mod('songwriter_header_skype', songwriter_default_options('songwriter_header_skype')) != '' ){ ?>
        <span class="header-contact-skype"><i class="social_skype" aria-hidden="true"></i><?php echo esc_attr(get_theme_mod('songwriter_header_skype', songwriter_default_options('songwriter_header_skype'))); ?></span>
      </p>
<?php } ?> 
    </div>
  </div>
<?php }} ?>    
  <div class="header-content-wrapper">
    <div class="header-content">
<?php if ( get_theme_mod('songwriter_logo_url', songwriter_default_options('songwriter_logo_url')) == '' ) { ?>
      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
<?php } else { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="header-logo" src="<?php echo esc_url(get_theme_mod('songwriter_logo_url', songwriter_default_options('songwriter_logo_url'))); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
<?php } ?>
<?php if ( get_theme_mod('songwriter_display_site_description', songwriter_default_options('songwriter_display_site_description')) != 'Hide' ) { ?>
      <p class="site-description"><?php bloginfo( 'description' ); ?></p>
<?php } ?>
<?php if ( get_theme_mod('songwriter_display_search_form', songwriter_default_options('songwriter_display_search_form')) != 'Hide' && !is_page_template('template-landing-page.php') ) { ?>
<?php get_search_form(); ?>
<?php } ?>
    </div>
  </div>
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
  <div class="menu-box-wrapper">
    <div class="menu-box">
      <a class="link-home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="icon_house" aria-hidden="true"></i></a>
<?php wp_nav_menu( array( 'menu_id'=>'nav', 'theme_location'=>'main-navigation' ) ); ?>
    </div>
  </div>
<?php } ?>    
<?php if ( is_home() || is_front_page() ) { ?>
<?php if ( get_header_image() != '' ) { ?>    
    <div class="header-image"><img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" /></div>
<?php } ?>
<?php } else { ?>
<?php if ( get_header_image() != '' && get_theme_mod('songwriter_display_header_image', songwriter_default_options('songwriter_display_header_image')) != 'Only on Homepage' ) { ?>    
    <div class="header-image"><img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" /></div>
<?php } ?>
<?php } ?>
  </header> <!-- end of header -->

<div id="main-content-wrapper">
<div id="main-content">
<div id="content" class="hentry">