<?php
/**
 * Headerdata of Theme options.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/  

// Additional CSS
if(	!is_admin()){
function songwriter_fonts_include () {
// Google Fonts
$bodyfont = get_theme_mod('songwriter_body_google_fonts', songwriter_default_options('songwriter_body_google_fonts'));
$headingfont = get_theme_mod('songwriter_headings_google_fonts', songwriter_default_options('songwriter_headings_google_fonts'));
$descriptionfont = get_theme_mod('songwriter_description_google_fonts', songwriter_default_options('songwriter_description_google_fonts'));
$headlinefont = get_theme_mod('songwriter_headline_google_fonts', songwriter_default_options('songwriter_headline_google_fonts'));
$postentryfont = get_theme_mod('songwriter_postentry_google_fonts', songwriter_default_options('songwriter_postentry_google_fonts'));
$sidebarfont = get_theme_mod('songwriter_sidebar_google_fonts', songwriter_default_options('songwriter_sidebar_google_fonts'));
$menufont = get_theme_mod('songwriter_menu_google_fonts', songwriter_default_options('songwriter_menu_google_fonts'));

$fonturl = "//fonts.googleapis.com/css?family=";
$character_set = "&amp;subset=" . get_theme_mod('songwriter_character_set', 'latin');

$bodyfonturl = $fonturl.$bodyfont.$character_set;
$headingfonturl = $fonturl.$headingfont.$character_set;
$descriptionfonturl = $fonturl.$descriptionfont.$character_set;
$headlinefonturl = $fonturl.$headlinefont.$character_set;
$postentryfonturl = $fonturl.$postentryfont.$character_set;
$sidebarfonturl = $fonturl.$sidebarfont.$character_set;
$menufonturl = $fonturl.$menufont.$character_set;
	// Google Fonts
     if ($bodyfont != 'default' && $bodyfont != ''){
      wp_enqueue_style('songwriter-google-font1', $bodyfonturl); 
		 }
     if ($headingfont != 'default' && $headingfont != ''){
      wp_enqueue_style('songwriter-google-font2', $headingfonturl);
		 }
     if ($descriptionfont != 'default' && $descriptionfont != ''){
      wp_enqueue_style('songwriter-google-font3', $descriptionfonturl);
		 }
     if ($headlinefont != 'default' && $headlinefont != ''){
      wp_enqueue_style('songwriter-google-font4', $headlinefonturl); 
		 }
     if ($postentryfont != 'default' && $postentryfont != ''){
      wp_enqueue_style('songwriter-google-font5', $postentryfonturl); 
		 }
     if ($sidebarfont != 'default' && $sidebarfont != ''){
      wp_enqueue_style('songwriter-google-font6', $sidebarfonturl);
		 }
     if ($menufont != 'default' && $menufont != ''){
      wp_enqueue_style('songwriter-google-font8', $menufonturl);
		 }
}
add_action( 'wp_enqueue_scripts', 'songwriter_fonts_include' );
}

// Additional CSS
function songwriter_css_include () {    
    if (get_theme_mod('songwriter_css', songwriter_default_options('songwriter_css')) == 'Green' ){
			wp_enqueue_style('songwriter-style-green', get_template_directory_uri().'/css/colors/green.css');
		}    
		if (get_theme_mod('songwriter_css', songwriter_default_options('songwriter_css')) == 'Red' ){
			wp_enqueue_style('songwriter-style-red', get_template_directory_uri().'/css/colors/red.css');
		}
}
add_action( 'wp_enqueue_scripts', 'songwriter_css_include' );

// Display sidebar
function songwriter_display_sidebar() {
    $display_sidebar = get_theme_mod('songwriter_display_sidebar', songwriter_default_options('songwriter_display_sidebar')); 
		if ($display_sidebar == 'Hide') { ?>
		<?php _e('#wrapper #container #main-content #content { width: 100%; }', 'songwriter'); ?>
<?php } 
}

// Display header Search Form - header content width
function songwriter_display_search_form() {
    $display_search_form = get_theme_mod('songwriter_display_search_form', songwriter_default_options('songwriter_display_search_form')); 
		if ($display_search_form == 'Hide') { ?>
		<?php _e('#wrapper #header .header-content .site-title, #wrapper #header .header-content .site-description, #wrapper #header .header-content .header-logo { max-width: 100%; }', 'songwriter'); ?>
<?php } 
}

// Display Meta Box on post entries - styling
function songwriter_display_meta_post_entry() {
    $display_meta_post_entry = get_theme_mod('songwriter_display_meta_post_entry', songwriter_default_options('songwriter_display_meta_post_entry')); 
		if ($display_meta_post_entry == 'Hide') { ?>
		<?php _e('#wrapper #main-content .post-entry .attachment-post-thumbnail { margin-bottom: 20px; }', 'songwriter'); ?>
<?php } 
}

// Featured Images Size
function songwriter_featured_image_size() {
    $featured_image_size = get_theme_mod('songwriter_featured_image_size', songwriter_default_options('songwriter_featured_image_size')); 
		if ($featured_image_size == 'Large') { ?>
		<?php _e('.post-entry .attachment-post-thumbnail { margin-bottom: 15px !important; margin-left: 0 !important; margin-right: 0 !important; max-width: 100%; clear: both; float: none; }', 'songwriter'); ?>
<?php } 
}

// FONTS
// Body font
function songwriter_get_body_font() {
    $bodyfont = get_theme_mod('songwriter_body_google_fonts', songwriter_default_options('songwriter_body_google_fonts')); 
    if ($bodyfont != 'default' && $bodyfont != '') { ?>
    <?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper button, #wrapper textarea, #wrapper select, #wrapper #content .breadcrumb-navigation, #wrapper #main-content .post-meta { font-family: "', 'songwriter'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// Site title font
function songwriter_get_headings_google_fonts() {
    $headingfont = get_theme_mod('songwriter_headings_google_fonts', songwriter_default_options('songwriter_headings_google_fonts')); 
		if ($headingfont != 'default' && $headingfont != '') { ?>
		<?php _e('#wrapper #header .site-title { font-family: "', 'songwriter'); ?><?php echo $headingfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// Site description font
function songwriter_get_description_font() {
    $descriptionfont = get_theme_mod('songwriter_description_google_fonts', songwriter_default_options('songwriter_description_google_fonts'));
    if ($descriptionfont != 'default' && $descriptionfont != '') { ?>
    <?php _e('#wrapper #header .site-description {font-family: "', 'songwriter'); ?><?php echo $descriptionfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// Page/post headlines font
function songwriter_get_headlines_font() {
    $headlinefont = get_theme_mod('songwriter_headline_google_fonts', songwriter_default_options('songwriter_headline_google_fonts'));
    if ($headlinefont != 'default' && $headlinefont != '') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading, #wrapper #comments .entry-headline { font-family: "', 'songwriter'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// Post entry font
function songwriter_get_postentry_font() {
    $postentryfont = get_theme_mod('songwriter_postentry_google_fonts', songwriter_default_options('songwriter_postentry_google_fonts')); 
		if ($postentryfont != 'default' && $postentryfont != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline, #wrapper #main-content .slides li a, #wrapper #main-content .home-list-posts ul li a { font-family: "', 'songwriter'); ?><?php echo $postentryfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// Sidebar and Footer widget headlines font
function songwriter_get_sidebar_widget_font() {
    $sidebarfont = get_theme_mod('songwriter_sidebar_google_fonts', songwriter_default_options('songwriter_sidebar_google_fonts'));
    if ($sidebarfont != 'default' && $sidebarfont != '') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline, #wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-family: "', 'songwriter'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// Main Header menu font
function songwriter_get_menu_font() {
    $menufont = get_theme_mod('songwriter_menu_google_fonts', songwriter_default_options('songwriter_menu_google_fonts')); 
		if ($menufont != 'default' && $menufont != '') { ?>
		<?php _e('#wrapper #header .menu-box ul li a { font-family: "', 'songwriter'); ?><?php echo $menufont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'songwriter'); ?>
<?php } 
}

// User defined CSS.
function songwriter_get_own_css() {
    $own_css = get_theme_mod('songwriter_own_css'); 
    $own_css_def = songwriter_default_options('songwriter_own_css');
		if ($own_css != '') { ?>
		<?php echo esc_attr($own_css); ?>
<?php } elseif ($own_css == '' && $own_css_def != '') { echo esc_attr($own_css_def); } 
}

// Display custom CSS.
function songwriter_custom_styles() { ?>
<?php echo ("<style type='text/css'>"); ?>
<?php songwriter_get_own_css(); ?>
<?php songwriter_display_sidebar(); ?>
<?php songwriter_display_search_form(); ?>
<?php songwriter_display_meta_post_entry(); ?>
<?php songwriter_featured_image_size(); ?>
<?php songwriter_get_body_font(); ?>
<?php songwriter_get_headings_google_fonts(); ?>
<?php songwriter_get_description_font(); ?>
<?php songwriter_get_headlines_font(); ?>
<?php songwriter_get_postentry_font(); ?>
<?php songwriter_get_sidebar_widget_font(); ?>
<?php songwriter_get_menu_font(); ?>
<?php echo ("</style>"); ?>
<?php
} 
add_action('wp_enqueue_scripts', 'songwriter_custom_styles');	?>