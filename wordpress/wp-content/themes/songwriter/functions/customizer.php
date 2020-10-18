<?php
/**
 * SongWriter Theme Customizer.
 * @package SongWriter
 * @since SongWriter 2.0.0
*/

/**
 * Default values - backwards compatibility for older SongWriter versions.
 *  
*/ 
function songwriter_default_options($key) {

$songwriter_theme_options = get_option('songwriter_options');

/* Define the array of defaults */ 
$songwriter_defaults = array(
			'songwriter_css' => 'Blue (default)',
      'songwriter_display_sidebar' => 'Display',
			'songwriter_display_breadcrumb' => 'Display',
			'songwriter_display_header_image' => 'Everywhere',
			'songwriter_logo_url' => '',
      'songwriter_display_site_description' => 'Display',
      'songwriter_display_search_form' => 'Display',
			'songwriter_header_address' => '',
			'songwriter_header_email' => '',
			'songwriter_header_phone' => '',
			'songwriter_header_skype' => '',
			'songwriter_display_image_post' => 'Display',
			'songwriter_display_meta_post' => 'Display',
			'songwriter_next_preview_post' => 'Display',
			'songwriter_display_image_page' => 'Display',
			'songwriter_display_meta_post_entry' => 'Display',
      'songwriter_featured_image_size' => 'Small',
			'songwriter_content_archives' => 'Excerpt',
      'songwriter_latest_posts_headline' => 'Latest Posts',
			'songwriter_body_google_fonts' => 'default',
			'songwriter_headings_google_fonts' => 'default',
      'songwriter_description_google_fonts' => 'default',
			'songwriter_headline_google_fonts' => 'default',
			'songwriter_postentry_google_fonts' => 'default',
			'songwriter_sidebar_google_fonts' => 'default',
			'songwriter_menu_google_fonts' => 'default',
			'songwriter_own_css' => '' );

$songwriter_theme_options = wp_parse_args( $songwriter_theme_options, $songwriter_defaults );

if ( isset($songwriter_theme_options[$key]) ) {
return $songwriter_theme_options[$key]; } else {
return false;
}}

/**
 * Register Customizer sections and options.
 *  
*/
function songwriter_customize_register($wp_customize){

$songwriter_fonts = array(
			'default' => 'default',	
			'Abel' => 'Abel',			
			'Aclonica' => 'Aclonica',
			'Actor' => 'Actor',
			'Adamina' => 'Adamina',
			'Aldrich' => 'Aldrich',
			'Alegreya Sans' => 'Alegreya Sans',
			'Alice' => 'Alice',
			'Alike' => 'Alike',
			'Allan' => 'Allan',
			'Allerta' => 'Allerta',
      'Amarante' => 'Amarante',
			'Amaranth' => 'Amaranth',
      'Andika' => 'Andika',
			'Antic' => 'Antic',
			'Anton' => 'Anton',
			'Arimo' => 'Arimo',	
			'Artifika' => 'Artifika',
			'Arvo' => 'Arvo',
			'Bitter' => 'Bitter',
			'Brawler' => 'Brawler',
			'Buda' => 'Buda',	
      'Butcherman' => 'Butcherman',	
      'Cabin' => 'Cabin',
			'Candal' => 'Candal',
			'Cantarell' => 'Cantarell',	
      'Cherry Swash' => 'Cherry Swash',				
			'Chivo' => 'Chivo',			
			'Coda' => 'Coda',	
      'Concert One' => 'Concert One',		
			'Copse' => 'Copse',
			'Corben' => 'Corben',
			'Cousine' => 'Cousine',			
			'Coustard' => 'Coustard',
			'Covered By Your Grace' => 'Covered By Your Grace',
			'Crafty Girls' => 'Crafty Girls',
			'Crimson Text' => 'Crimson Text',
			'Crushed' => 'Crushed',
			'Cuprum' => 'Cuprum',
			'Damion' => 'Damion',
			'Dancing Script' => 'Dancing Script',
			'Dawning of a New Day' => 'Dawning of a New Day',
			'Days One' => 'Days One',
			'Delius' => 'Delius',
			'Delius Swash Caps' => 'Delius Swash Caps',
			'Delius Unicase' => 'Delius Unicase',
			'Didact Gothic' => 'Didact Gothic',
			'Dorsa' => 'Dorsa',
			'Dosis' => 'Dosis',
			'Droid Sans' => 'Droid Sans',
			'Droid Sans Mono' => 'Droid Sans Mono',
      'Droid Serif' => 'Droid Serif',
			'EB Garamond' => 'EB Garamond',
			'Expletus Sans' => 'Expletus Sans',
			'Fanwood Text' => 'Fanwood Text',
			'Federo' => 'Federo',
			'Fontdiner Swanky' => 'Fontdiner Swanky',
			'Forum' => 'Forum',
			'Francois One' => 'Francois One',
			'Gentium Basic' => 'Gentium Basic',
			'Gentium Book Basic' => 'Gentium Book Basic',
			'Geo' => 'Geo',
			'Geostar' => 'Geostar',
			'Geostar Fill' => 'Geostar Fill',
      'Gilda Display' => 'Gilda Display',
			'Give You Glory' => 'Give You Glory',
			'Gloria Hallelujah' => 'Gloria Hallelujah',
			'Goblin One' => 'Goblin One',
			'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
			'Gravitas One' => 'Gravitas One',
			'Gruppo' => 'Gruppo',
			'Hammersmith One' => 'Hammersmith One',
			'Hind' => 'Hind',
			'Holtwood One SC' => 'Holtwood One SC',
			'Homemade Apple' => 'Homemade Apple',
			'Inconsolata' => 'Inconsolata',
			'Indie Flower' => 'Indie Flower',
      'IM Fell English' => 'IM Fell English',
			'Irish Grover' => 'Irish Grover',
			'Irish Growler' => 'Irish Growler',
			'Istok Web' => 'Istok Web',
			'Judson' => 'Judson',
			'Julee' => 'Julee',
			'Just Another Hand' => 'Just Another Hand',
			'Just Me Again Down Here' => 'Just Me Again Down Here',
			'Kameron' => 'Kameron',
			'Kelly Slab' => 'Kelly Slab',
			'Kenia' => 'Kenia',
			'Kranky' => 'Kranky',
			'Kreon' => 'Kreon',
			'Kristi' => 'Kristi',
			'La Belle Aurore' => 'La Belle Aurore',
      'Lato' => 'Lato',
			'League Script' => 'League Script',
			'Leckerli One' => 'Leckerli One',
			'Lekton' => 'Lekton',
      'Lily Script One' => 'Lily Script One',
			'Limelight' => 'Limelight',
			'Lobster' => 'Lobster',
			'Lobster Two' => 'Lobster Two',
			'Lora' => 'Lora',
			'Love Ya Like A Sister' => 'Love Ya Like A Sister',
			'Loved by the King' => 'Loved by the King',
      'Lovers Quarrel' => 'Lovers Quarrel',
			'Luckiest Guy' => 'Luckiest Guy',
			'Maiden Orange' => 'Maiden Orange',
			'Mako' => 'Mako',
			'Marvel' => 'Marvel',
			'Maven Pro' => 'Maven Pro',
			'Meddon' => 'Meddon',
			'MedievalSharp' => 'MedievalSharp',
      'Medula One' => 'Medula One',
			'Megrim' => 'Megrim',
			'Merienda One' => 'Merienda One',
			'Merriweather' => 'Merriweather',
			'Metrophobic' => 'Metrophobic',
			'Michroma' => 'Michroma',
			'Miltonian Tattoo' => 'Miltonian Tattoo',
			'Miltonian' => 'Miltonian',
			'Modern Antiqua' => 'Modern Antiqua',
			'Molengo' => 'Molengo',
      'Monofett' => 'Monofett',
			'Monoton' => 'Monoton',
      'Montaga' => 'Montaga',
			'Montez' => 'Montez',
      'Montserrat' => 'Montserrat',
			'Mountains of Christmas' => 'Mountains of Christmas',
			'Muli' => 'Muli',
			'Neucha' => 'Neucha',
			'Neuton' => 'Neuton',
			'News Cycle' => 'News Cycle',
			'Nixie One' => 'Nixie One',
			'Nobile' => 'Nobile',
			'Noto Sans' => 'Noto Sans',
			'Nova Cut' => 'Nova Cut',
			'Nova Flat' => 'Nova Flat',
			'Nova Mono' => 'Nova Mono',
			'Nova Oval' => 'Nova Oval',
			'Nova Round' => 'Nova Round',
			'Nova Script' => 'Nova Script',
			'Nova Slim' => 'Nova Slim',
			'Nova Square' => 'Nova Square',
			'Numans' => 'Numans',
			'Nunito' => 'Nunito',
      'Open Sans' => 'Open Sans',
			'Oswald' => 'Oswald',
			'Over the Rainbow' => 'Over the Rainbow',
			'Ovo' => 'Ovo',
			'Oxygen' => 'Oxygen',
			'Pacifico' => 'Pacifico',
			'Passero One' => 'Passero One',
			'Passion One' => 'Passion One',
			'Patrick Hand' => 'Patrick Hand',
			'Paytone One' => 'Paytone One',
			'Permanent Marker' => 'Permanent Marker',
			'Philosopher' => 'Philosopher',
			'Play' => 'Play',
			'Playfair Display' => 'Playfair Display',
			'Podkova' => 'Podkova',
			'Poller One' => 'Poller One',
			'Pompiere' => 'Pompiere',
			'Prata' => 'Prata',
			'Prociono' => 'Prociono',
			'PT Sans' => 'PT Sans',
			'PT Sans Caption' => 'PT Sans Caption',
			'PT Sans Narrow' => 'PT Sans Narrow',
			'PT Serif' => 'PT Serif',
			'PT Serif Caption' => 'PT Serif Caption',
			'Puritan' => 'Puritan',
			'Quattrocento' => 'Quattrocento',
			'Quattrocento Sans' => 'Quattrocento Sans',
			'Questrial' => 'Questrial',
			'Radley' => 'Radley',
			'Raleway' => 'Raleway', 
      'Rationale' => 'Rationale',
			'Redressed' => 'Redressed',
      'Reenie Beanie' => 'Reenie Beanie', 
      'Roboto' => 'Roboto',
      'Roboto Condensed' => 'Roboto Condensed',
			'Rock Salt' => 'Rock Salt',
			'Rochester' => 'Rochester',
			'Rokkitt' => 'Rokkitt',
			'Rosario' => 'Rosario',
			'Ruslan Display' => 'Ruslan Display',
      'Sancreek' => 'Sancreek',
			'Sansita One' => 'Sansita One',
			'Schoolbell' => 'Schoolbell',
			'Shadows Into Light' => 'Shadows Into Light',
			'Shanti' => 'Shanti',
			'Short Stack' => 'Short Stack',
			'Sigmar One' => 'Sigmar One',
			'Six Caps' => 'Six Caps',
			'Slackey' => 'Slackey',
			'Smokum' => 'Smokum',
			'Smythe' => 'Smythe',
			'Sniglet' => 'Sniglet',
			'Snippet' => 'Snippet',
			'Sorts Mill Goudy' => 'Sorts Mill Goudy',
			'Special Elite' => 'Special Elite',
			'Spinnaker' => 'Spinnaker',
			'Stardos Stencil' => 'Stardos Stencil',
			'Sue Ellen Francisco' => 'Sue Ellen Francisco',
			'Sunshiney' => 'Sunshiney',
			'Swanky and Moo Moo' => 'Swanky and Moo Moo',
			'Syncopate' => 'Syncopate',
			'Tangerine' => 'Tangerine',
			'Tenor Sans' => 'Tenor Sans',
			'Terminal Dosis Light' => 'Terminal Dosis Light',
			'Tinos' => 'Tinos',
			'Titillium Web' => 'Titillium Web',
			'Tulpen One' => 'Tulpen One',
			'Ubuntu' => 'Ubuntu',
			'Ultra' => 'Ultra',
      'UnifrakturCook' => 'UnifrakturCook',
			'UnifrakturMaguntia' => 'UnifrakturMaguntia',
      'Unkempt' => 'Unkempt',
			'Unna' => 'Unna',
			'Varela' => 'Varela',
			'Varela Round' => 'Varela Round',
			'Vibur' => 'Vibur',
			'Vidaloka' => 'Vidaloka',
			'Volkhov' => 'Volkhov',
			'Vollkorn' => 'Vollkorn',
			'Voltaire' => 'Voltaire',
			'VT323' => 'VT323',
			'Waiting for the Sunrise' => 'Waiting for the Sunrise',
			'Wallpoet' => 'Wallpoet',
			'Walter Turncoat' => 'Walter Turncoat',
			'Wire One' => 'Wire One',
			'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
			'Yellowtail' => 'Yellowtail',
			'Yeseva One' => 'Yeseva One',
			'Zeyada' => 'Zeyada');
      
/**
 * Textarea custom control.
 *  
*/ 
class songwriter_customize_textarea_control extends WP_Customize_Control {
    public $type = 'textarea'; 
    public function render_content() { ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
<?php }}

/**
 * Sections and Options.
 *  
*/     
    $wp_customize->add_section('songwriter_general_settings', array(
        'title'    => __('SongWriter General Settings', 'songwriter'),
        'description' => '',
        'priority' => 120,
    ));
    $wp_customize->add_section('songwriter_header_settings', array(
        'title'    => __('SongWriter Header Settings', 'songwriter'),
        'description' => '',
        'priority' => 130,
    ));
    $wp_customize->add_section('songwriter_posts_settings', array(
        'title'    => __('SongWriter Posts/Pages Settings', 'songwriter'),
        'description' => '',
        'priority' => 140,
    ));
    $wp_customize->add_section('songwriter_post_entries_settings', array(
        'title'    => __('SongWriter Post Entries Settings', 'songwriter'),
        'description' => '',
        'priority' => 150,
    ));
    $wp_customize->add_section('songwriter_font_settings', array(
        'title'    => __('SongWriter Font Settings', 'songwriter'),
        'description' => '',
        'priority' => 160,
    ));
 
    //  =============================
    //  = Color Scheme              =
    //  =============================
    $wp_customize->add_setting('songwriter_css', array(
        'default'        => songwriter_default_options('songwriter_css'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_css_control', array(
        'label'      => __('Color Scheme', 'songwriter'),
        'section'    => 'songwriter_general_settings',
        'settings'   => 'songwriter_css',
        'type'       => 'radio',
        'choices'    => array(
            'Blue (default)' => __( 'Blue (default)' , 'songwriter' ),
            'Green' => __( 'Green' , 'songwriter' ),
            'Red' => __( 'Red' , 'songwriter' ),
        ),
    ));
    
    //  ==================================
    //  = Display Sidebar                =
    //  ==================================
    $wp_customize->add_setting('songwriter_display_sidebar', array(
        'default'        => songwriter_default_options('songwriter_display_sidebar'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_sidebar_control', array(
        'label'      => __('Display Right Sidebar', 'songwriter'),
        'section'    => 'songwriter_general_settings',
        'settings'   => 'songwriter_display_sidebar',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  =================================
    //  = Display Breadcrumb Navigation =
    //  =================================
    $wp_customize->add_setting('songwriter_display_breadcrumb', array(
        'default'        => songwriter_default_options('songwriter_display_breadcrumb'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_breadcrumb_control', array(
        'label'      => __('Display Breadcrumb Navigation', 'songwriter'),
        'section'    => 'songwriter_general_settings',
        'settings'   => 'songwriter_display_breadcrumb',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  ==================================
    //  = Display Header Image           =
    //  ==================================
    $wp_customize->add_setting('songwriter_display_header_image', array(
        'default'        => songwriter_default_options('songwriter_display_header_image'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_header_image_control', array(
        'label'      => __('Display Header Image', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_display_header_image',
        'type'       => 'radio',
        'choices'    => array(
            'Everywhere' => __( 'Everywhere' , 'songwriter' ),
            'Only on Homepage' => __( 'Only on Homepage' , 'songwriter' ),
        ),
    ));
    
    //  =============================
    //  = Header Logo               =
    //  =============================
    $wp_customize->add_setting('songwriter_logo_url', array(
        'default'        => songwriter_default_options('songwriter_logo_url'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_uri',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'songwriter_logo_url_control', array(
        'label'    => __('Header Logo', 'songwriter'),
        'section'  => 'songwriter_header_settings',
        'settings' => 'songwriter_logo_url',
    )));
    
    //  ====================================
    //  = Display Site Description         =
    //  ====================================
    $wp_customize->add_setting('songwriter_display_site_description', array(
        'default'        => songwriter_default_options('songwriter_display_site_description'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_site_description_control', array(
        'label'      => __('Display Site Description', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_display_site_description',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  ====================================
    //  = Display Search Form              =
    //  ====================================
    $wp_customize->add_setting('songwriter_display_search_form', array(
        'default'        => songwriter_default_options('songwriter_display_search_form'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_search_form_control', array(
        'label'      => __('Display Search Form', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_display_search_form',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  =============================
    //  = Postal Address            =
    //  =============================
    $wp_customize->add_setting('songwriter_header_address', array(
        'default'        => songwriter_default_options('songwriter_header_address'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_header_address_control', array(
        'label'      => __('Postal Address', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_header_address',
    ));
    
    //  =============================
    //  = Email Address             =
    //  =============================
    $wp_customize->add_setting('songwriter_header_email', array(
        'default'        => songwriter_default_options('songwriter_header_email'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_header_email_control', array(
        'label'      => __('Email Address', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_header_email',
    ));
    
    //  =============================
    //  = Phone Number              =
    //  =============================
    $wp_customize->add_setting('songwriter_header_phone', array(
        'default'        => songwriter_default_options('songwriter_header_phone'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_header_phone_control', array(
        'label'      => __('Phone Number', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_header_phone',
    ));
    
    //  =============================
    //  = Skype Name                =
    //  =============================
    $wp_customize->add_setting('songwriter_header_skype', array(
        'default'        => songwriter_default_options('songwriter_header_skype'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_header_skype_control', array(
        'label'      => __('Skype Name', 'songwriter'),
        'section'    => 'songwriter_header_settings',
        'settings'   => 'songwriter_header_skype',
    ));
    
    //  ==========================================
    //  = Display Featured Image on single posts =
    //  ==========================================
    $wp_customize->add_setting('songwriter_display_image_post', array(
        'default'        => songwriter_default_options('songwriter_display_image_post'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_image_post_control', array(
        'label'      => __('Display Featured Image on single posts', 'songwriter'),
        'section'    => 'songwriter_posts_settings',
        'settings'   => 'songwriter_display_image_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  ====================================
    //  = Display Meta Box on single posts =
    //  ====================================
    $wp_customize->add_setting('songwriter_display_meta_post', array(
        'default'        => songwriter_default_options('songwriter_display_meta_post'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_meta_post_control', array(
        'label'      => __('Display Meta Box on single posts', 'songwriter'),
        'section'    => 'songwriter_posts_settings',
        'settings'   => 'songwriter_display_meta_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  =================================
    //  = Next/Previous Post Navigation =
    //  =================================
    $wp_customize->add_setting('songwriter_next_preview_post', array(
        'default'        => songwriter_default_options('songwriter_next_preview_post'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_next_preview_post_control', array(
        'label'      => __('Display Next/Previous Post Navigation on single posts', 'songwriter'),
        'section'    => 'songwriter_posts_settings',
        'settings'   => 'songwriter_next_preview_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  ==========================================
    //  = Display Featured Image on pages        =
    //  ==========================================
    $wp_customize->add_setting('songwriter_display_image_page', array(
        'default'        => songwriter_default_options('songwriter_display_image_page'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_image_page_control', array(
        'label'      => __('Display Featured Image on pages', 'songwriter'),
        'section'    => 'songwriter_posts_settings',
        'settings'   => 'songwriter_display_image_page',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  ====================================
    //  = Display Meta Box on Post Entries =
    //  ====================================
    $wp_customize->add_setting('songwriter_display_meta_post_entry', array(
        'default'        => songwriter_default_options('songwriter_display_meta_post_entry'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_display_meta_post_entry_control', array(
        'label'      => __('Display Meta Box on Post Entries', 'songwriter'),
        'section'    => 'songwriter_post_entries_settings',
        'settings'   => 'songwriter_display_meta_post_entry',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'songwriter' ),
            'Hide' => __( 'Hide' , 'songwriter' ),
        ),
    ));
    
    //  ====================================
    //  = Featured Images Size             =
    //  ====================================
    $wp_customize->add_setting('songwriter_featured_image_size', array(
        'default'        => songwriter_default_options('songwriter_featured_image_size'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_featured_image_size_control', array(
        'label'      => __('Featured Images Size', 'songwriter'),
        'section'    => 'songwriter_post_entries_settings',
        'settings'   => 'songwriter_featured_image_size',
        'type'       => 'radio',
        'choices'    => array(
            'Small' => __( 'Small' , 'songwriter' ),
            'Large' => __( 'Large' , 'songwriter' ),
        ),
    ));
    
    //  ===============================
    //  = Content/Excerpt Displaying  =
    //  ===============================
    $wp_customize->add_setting('songwriter_content_archives', array(
        'default'        => songwriter_default_options('songwriter_content_archives'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_content_archives_control', array(
        'label'      => __('Content/Excerpt Displaying', 'songwriter'),
        'section'    => 'songwriter_post_entries_settings',
        'settings'   => 'songwriter_content_archives',
        'type'       => 'radio',
        'choices'    => array(
            'Excerpt' => __( 'Excerpt' , 'songwriter' ),
            'Content' => __( 'Content' , 'songwriter' ),
        ),
    ));
    
    //  =============================
    //  = Excerpt Length            =
    //  =============================
    $wp_customize->add_setting('songwriter_excerpt_length', array(
        'default'        => '40',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_excerpt_length_control', array(
        'label'      => __('Excerpt Length (number of words)', 'songwriter'),
        'section'    => 'songwriter_post_entries_settings',
        'settings'   => 'songwriter_excerpt_length',
    ));
    
    //  =================================
    //  = Latest Posts section headline =
    //  =================================
    $wp_customize->add_setting('songwriter_latest_posts_headline', array(
        'default'        => songwriter_default_options('songwriter_latest_posts_headline'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_latest_posts_headline_control', array(
        'label'      => __('Latest Posts (Blog) page headline', 'songwriter'),
        'section'    => 'songwriter_post_entries_settings',
        'settings'   => 'songwriter_latest_posts_headline',
    ));
    
    //  ==============================
    //  = Character Set              =
    //  ==============================
    $wp_customize->add_setting('songwriter_character_set', array(
        'default'        => 'latin',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
    ));
 
    $wp_customize->add_control('songwriter_character_set_control', array(
        'label'      => __('Character Set', 'songwriter'),
        'section'    => 'songwriter_font_settings',
        'settings'   => 'songwriter_character_set',
        'type'       => 'radio',
        'choices'    => array(
            'latin' => __( 'Latin' , 'songwriter' ),
            'latin-ext' => __( 'Latin Extended' , 'songwriter' ),
            'cyrillic' => __( 'Cyrillic' , 'songwriter' ),
            'cyrillic-ext' => __( 'Cyrillic Extended' , 'songwriter' ),
            'greek' => __( 'Greek' , 'songwriter' ),
            'greek-ext' => __( 'Greek Extended' , 'songwriter' ),
            'vietnamese' => __( 'Vietnamese' , 'songwriter' ),
        ),
    ));
    
    //  =============================
    //  = Body font                 =
    //  =============================
     $wp_customize->add_setting('songwriter_body_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_body_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_body_google_fonts_control', array(
        'settings' => 'songwriter_body_google_fonts',
        'label'   => __('Body font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  =============================
    //  = Site Title font           =
    //  =============================
     $wp_customize->add_setting('songwriter_headings_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_headings_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_headings_google_fonts_control', array(
        'settings' => 'songwriter_headings_google_fonts',
        'label'   => __('Site Title font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  =============================
    //  = Site Description font     =
    //  =============================
     $wp_customize->add_setting('songwriter_description_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_description_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_description_google_fonts_control', array(
        'settings' => 'songwriter_description_google_fonts',
        'label'   => __('Site Description font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  =============================
    //  = Page/Post Headlines font  =
    //  =============================
     $wp_customize->add_setting('songwriter_headline_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_headline_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_headline_google_fonts_control', array(
        'settings' => 'songwriter_headline_google_fonts',
        'label'   => __('Page/Post Headlines (h1 - h6) font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  =============================
    //  = Post Entry Headline font  =
    //  =============================
     $wp_customize->add_setting('songwriter_postentry_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_postentry_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_postentry_google_fonts_control', array(
        'settings' => 'songwriter_postentry_google_fonts',
        'label'   => __('Post Entry Headline font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  ========================================
    //  = Sidebar/Footer Widget Headlines font =
    //  ========================================
     $wp_customize->add_setting('songwriter_sidebar_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_sidebar_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_sidebar_google_fonts_control', array(
        'settings' => 'songwriter_sidebar_google_fonts',
        'label'   => __('Sidebar/Footer Widget Headlines font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  =============================
    //  = Main Header Menu font     =
    //  =============================
     $wp_customize->add_setting('songwriter_menu_google_fonts', array(
        'default'        => songwriter_default_options('songwriter_menu_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'songwriter_sanitize_text',
 
    ));
    $wp_customize->add_control( 'songwriter_menu_google_fonts_control', array(
        'settings' => 'songwriter_menu_google_fonts',
        'label'   => __('Main Header Menu font', 'songwriter'),
        'section' => 'songwriter_font_settings',
        'type'    => 'select',
        'choices'    => $songwriter_fonts,
    ));
    
    //  =============================
    //  = Custom CSS                =
    //  =============================
    $wp_customize->add_setting('songwriter_own_css', array(
        'default'        => songwriter_default_options('songwriter_own_css'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));
 
    $wp_customize->add_control( new songwriter_customize_textarea_control($wp_customize, 'songwriter_own_css_control', array(
        'label'    => __('Custom CSS', 'songwriter'),
        'section'  => 'songwriter_general_settings',
        'settings' => 'songwriter_own_css',
    )));
}

add_action('customize_register', 'songwriter_customize_register');

/**
 * Sanitize URIs
*/
function songwriter_sanitize_uri($uri) {
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);
}

/**
 * Sanitize Texts
*/
function songwriter_sanitize_text($str) {
	if('' === $str){
		return '';
	}
	return sanitize_text_field( $str);
} ?>