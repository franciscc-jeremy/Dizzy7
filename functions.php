<?php
/* By taking advantage of hooks, filters, and the Custom Loop API, you can make anything!
---:[ place your custom code below this line ]:---*/

include( 'include/tha-theme-hooks.php' );
include_once( dirname( __FILE__ ) . '/include/kirki/kirki.php' );

//Enque Scripts and styles etc
function dseven_enqueue_style() {
	wp_enqueue_style( 'dizzyseven', get_stylesheet_uri() ); 
	wp_enqueue_style( 'dizzyseven-guttenberg', get_template_directory_uri() . '/dizzy-gutenberg.css' );
}

add_action( 'wp_enqueue_scripts', 'dseven_enqueue_style' );

function d7_gutenberg_styles() {
	 wp_enqueue_style( 'dizzyseven-guttenberg', get_template_directory_uri() . '/dizzy-gutenberg.css', false, '@@pkg.version', 'all' );
	 wp_enqueue_style( 'dizzyseven', get_stylesheet_uri() ); 
}

add_action( 'enqueue_block_editor_assets', 'd7_gutenberg_styles' );

function dseven_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
   wp_enqueue_script('jquery');
}

add_action("wp_enqueue_scripts", "dseven_jquery_enqueue", 11);

function dseven_editor_styles() {
    wp_enqueue_style( 'dizzy-seven-editor-style', get_template_directory_uri() . '/editor.css' );
}

add_action( 'enqueue_block_editor_assets', 'dseven_editor_styles' );

function dseven_sweetalert_scripts() {
	wp_register_script('dseven_sweetalert_script', 'https://unpkg.com/sweetalert2@7.2.0/dist/sweetalert2.all.js', 
	array('jquery'),'', true);
	wp_enqueue_script('dseven_sweetalert_script');
}
  
add_action( 'wp_enqueue_scripts', 'dseven_sweetalert_scripts' );

function dseven_parallaxjs() {
	wp_register_script('dseven_parallaxjs', get_template_directory_uri() . '/include/parallax/parallax.min.js', 
	array('jquery'),'', true);
	wp_enqueue_script('dseven_parallaxjs');
}
  
add_action( 'wp_enqueue_scripts', 'dseven_parallaxjs' );


//Remove query strings from CSS and JS inclusions

function _remove_script_version($src) {
   $parts = explode('?ver', $src);
   return $parts[0];
}

add_filter('style_loader_src', '_remove_script_version', 15, 1);
add_filter('script_loader_src', '_remove_script_version', 15, 1);

//Theme support
add_theme_support("aesop-component-styles", array("parallax", "image", "quote", "gallery", "content", "video", "audio", "collection", "chapter", "document", "character", "map", "timeline" ) );

if( ! isset( $content_width ) ) $content_width = 720;

function d7_setup_theme() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 425, 99999999 );
    add_image_size( 'teaser-image', 250, 250, true);
}
add_action( 'after_setup_theme', 'd7_setup_theme' );

//Featured Image as OG Image
function dizzy_featured_ogimg () { 
	    $thumb = get_the_post_thumbnail($post->ID);
		$pattern= "/(?<=src=['|\"])[^'|\"]*?(?=['|\"])/i";
		preg_match($pattern, $thumb, $thePath);
		$theSrc = $thePath[0];
}
add_filter('wp_head','dizzy_featured_ogimg');

// Number of posts on home page (So you can have a different number of posts on home and on archive
function one_home($query) {
	if ( $query->is_front_page()) {
		$query-> set('showposts','10');
		}
		return $query;
	}
add_filter('pre_get_posts','one_home');

// Nav Menus

register_nav_menu('primary', 'Primary');
register_nav_menu('footer', 'Footer - You will need to manually add the menu');
register_nav_menu('extra1', 'Extra Menu 1- You will need to manually add the menu');
register_nav_menu('extra2', 'Extra Menu 2- You will need to manually add the menu');
register_nav_menu('extra3', 'Extra Menu 3- You will need to manually add the menu');
register_nav_menu('extra4', 'Extra Menu 4- You will need to manually add the menu');
register_nav_menu('extra5', 'Extra Menu 5- You will need to manually add the menu');

// Post and Page Id's

add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}

function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}

function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	if(is_page()&&($post->post_parent==$pid||is_page($pid))) 
               return true;   // we're at the page or at a sub page
	else 
               return false;  // we're elsewhere
};

//Custom Fields

if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_post-customizations',
		'title' => 'Post Customizations',
		'fields' => array (
			array (
				'key' => 'field_54f7426bfb725',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54f74275fb726',
				'label' => 'Cover Image',
				'name' => 'big-pic',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
            array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'wpfc_sermon',
					'order_no' => 0,
					'group_no' => 1,
				),
			),

		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 2,
	));
}

function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings

function my_mce_before_init_insert_formats( $init_array ) {  

	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Aside',  
			'block' => 'div',  
			'classes' => 'pullout',
			'wrapper' => true,
		),  
		array(  
			'title' => 'Callout',  
			'block' => 'div',  
			'classes' => 'callout',
			'wrapper' => true,
		), 
		array(  
			'title' => 'Button Link',  
			'block' => 'a',  
			'classes' => 'button',
			'wrapper' => true,
		), 
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	return $init_array;  
} 
// Attach callback to 'tiny_mce_before_init' 

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  

function my_theme_add_editor_styles() {
    add_editor_style( '/style.css' );
}

add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

//*Aesop Interaction*//

add_theme_support("aesop-component-styles", array("parallax", "image", "quote", "gallery", "content", "video", "audio", "collection", "chapter", "document", "character", "map", "timeline" ) );

// Add the open close button to hide the toolbar
function add_open_close_toolbar () {
	global $comment;
	?>
<?php if (is_user_logged_in()) { ?>
	<style type="text/css">
		.open-close {
			position: fixed;
			bottom: 0px;
			left: 8px;
			background: url('https://senda.s3.amazonaws.com/wp-content/uploads/2012/06/open-close.png') center top;
			height: 32px;
			width: 32px;
			display: block;
			border: none!important;
			z-index: 100000000;
		}
		.open-close:hover {
			background: url('https://senda.s3.amazonaws.com/wp-content/uploads/2012/06/open-close.png') center bottom;
		}
	</style>

<a href="javascript:ReverseDisplay('wpadminbar')" class="open-close" title="Open/Close WP-Toolbar"></a>

<?php } ?>
<?php
}

add_action('wp_footer', 'add_open_close_toolbar');
add_filter('widget_text', 'do_shortcode');

// Move Admin bar to bottom

function fb_move_admin_bar() { ?>
	<style type="text/css">
		body {
			margin-top: -28px;
			background-position-y:-28px!important;
		}
		body.admin-bar #wphead {
			padding-top: 0;
		}
		body.admin-bar #footer {
			padding-bottom: 28px;
		}
		#wpadminbar {
			top: auto !important;
			bottom: 0;
		}
		#wpadminbar .quicklinks .menupop ul {
			bottom: 0px;
		}
		.ab-sub-wrapper {
			bottom:27px!important;
			-moz-box-shadow: 0 -4px 4px rgba(0,0,0,0.2)!important;
			-webkit-box-shadow: 0 -4px 4px rgba(0,0,0,0.2)!important;
			box-shadow: 0 -4px 4px rgba(0,0,0,0.2)!important;
		}
	</style>
<?php }

// On frontend area

if ( is_admin_bar_showing() )

add_action( 'wp_head', 'fb_move_admin_bar' );
add_filter('get_theme_mod', 'do_shortcode');
add_filter('set_theme_mod', 'do_shortcode');

//Add the OpenHooks Link To toolbar

function thesis_openhooks_menu() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
			'id' => 'openhook',
			'title' => __('OpenHook'),
			'href' => '/wp-admin/options-general.php?page=openhook&tab=tha'
	));
}

add_action('wp_before_admin_bar_render', 'thesis_openhooks_menu');

// Widgets

function dizzy_widgets_init() {
	register_sidebar( array(
		'name' => 'Main Sidebar',
		'id' => 'main-sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Right Sidebar',
		'id' => 'right-sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Left Sidebar',
		'id' => 'left-sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}

add_action( 'widgets_init', 'dizzy_widgets_init' );

// First Time cookies

function is_first_time() {
    if (isset($_COOKIE['_wp_first_time']) || is_user_logged_in()) {
        return false;
    } else {
        // expires in 30 days.
        setcookie('_wp_first_time', 1, time() + (WEEK_IN_SECONDS * 4), COOKIEPATH, COOKIE_DOMAIN, false);

        return true;
    }
}
add_action( 'init', 'is_first_time');

//--------------------************--------------------//
// Customizer

add_action('customize_register', 'themedemo_customize');

function themedemo_customize($wp_customize) {
    $wp_customize->add_section( 'themedemo_demo_settings_schema_biz', array(
        'title'          => 'Schema.org Business',
        'priority'       => 35,
    ) );
    $wp_customize->add_section( 'themedemo_demo_settings', array(
        'title'          => 'Theme Customization',
        'priority'       => 35,
    ) );
	$wp_customize->add_section( 'themedemo_demo_settings_design', array(
        'title'          => 'Design Customization',
        'priority'       => 35,
    ) );
	$wp_customize->add_section( 'themedemo_demo_settings_social_media', array(
        'title'          => 'Social Network Links',
        'priority'       => 35,
    ) );

 	//Business Name//

    $wp_customize->add_setting( 'ds_busname_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_busname_setting', array(
        'label'   => 'Business Name',
        'section' => 'title_tagline',
        'settings'   => 'ds_busname_setting',
    ) ) );

    //Nav Logo//

     $wp_customize->add_setting( 'diz-nav-logo', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'diz-nav-logo', array(
        'label'   => 'Navigation Logo',
        'section' => 'themedemo_demo_settings',
        'settings'   => 'diz-nav-logo',
    ) ) );

	//Home Page BG//

	$wp_customize->add_setting( 'diz-bgimg', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'diz-bgimg', array(
        'label'   => 'Home Page Background',
		'section' => 'themedemo_demo_settings',
        'settings'   => 'diz-bgimg',
    ) ) );

	//Header Content//

    $wp_customize->add_setting( 'diz-header-content', array(
        'default'        => '<div class="container"><h1>Dizzy 7 Theme<span>A Theme Framework for Coders and beginners</span></h1> <a class="button" href="#">Learn More</a></div>',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'diz-header-content', array(
        'label'   => 'Header Content',
        'section' => 'themedemo_demo_settings',
        'settings'   => 'diz-header-content',
		'type'    => 'textarea',
    ) ) );

	//Home Page Before Content Content//

     $wp_customize->add_setting( 'diz-before-content', array(
        'default'        => 'Place your Content here. It will appear above the posts grid.',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'diz-before-content', array(
        'label'   => 'Home Page Before Content',
        'section' => 'themedemo_demo_settings',
        'settings'   => 'diz-before-content',
		'type'    => 'textarea',
    ) ) );

	//Footer Content//

     $wp_customize->add_setting( 'diz-footer-content', array(
        'default'        => 'Place your Footer content here',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'diz-footer-content', array(
        'label'   => 'Footer Content',
        'section' => 'themedemo_demo_settings',
        'settings'   => 'diz-footer-content',
		'type'    => 'textarea',
    ) ) );

	//Custom CSS//

	Kirki::add_field( 'kirki_demo', array(
		'type'        => 'code',
		'settings'    => 'diz-custom-css',
		'label'       => __( 'Custom CSS', 'kirki' ),
		'help'        => __( 'This is a tooltip', 'kirki-demo' ),
		'description' => __( 'Place Your custom CSS Here', 'kirki-demo' ),
		'section'     => 'themedemo_demo_settings_design',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
		'language' => 'css',
        'theme'    => 'monokai',
        'height'   => 500,
    	),
	) );
	
	//Root Colors//

	Kirki::add_field( '', array(
		'type'        => 'color',
		'settings'    => 'diz-theme-main-color',
		'label'       => __( 'Main Color', 'kirki' ),
		'help'        => __( 'This is your main color', 'kirki-demo' ),
		'description' => __( 'Select your main color. This is usually your logo primary color. It will be the button, menu hover background and link color and can be used elsewhere as a css variable --main-color', 'kirki-demo' ),
		'section'     => 'themedemo_demo_settings_design',
		'default'     => '#cccccc',
		'priority'    => 6,
		'choices'     => array(
		'alpha' => true,
			),
	) );
	
	Kirki::add_field( '', array(
		'type'        => 'color',
		'settings'    => 'diz-theme-second-color',
		'label'       => __( 'Second Color', 'kirki' ),
		'help'        => __( 'This is your second color', 'kirki-demo' ),
		'description' => __( 'Select your secondary color. This is usually a color complementary to your primary color. It will be the button, sub-menu and link hover color and can be used elsewhere as a css variable --second-color', 'kirki-demo' ),
		'section'     => 'themedemo_demo_settings_design',
		'default'     => '#eeeeff',
		'priority'    => 7,
		'choices'     => array(
		'alpha' => true,
			),
	) );

	Kirki::add_field( '', array(
		'type'        => 'color',
		'settings'    => 'diz-theme-third-color',
		'label'       => __( 'Highlight Color', 'kirki' ),
		'help'        => __( 'This is your highlight color', 'kirki-demo' ),
		'description' => __( 'Select your highlight color. This is usually a distinct color from to your primary color. It will be the H2 and blockquote color and can be used elsewhere as a css variable --highlight-color', 'kirki-demo' ),
		'section'     => 'themedemo_demo_settings_design',
		'default'     => '#00aaff',
		'priority'    => 8,
		'choices'     => array(
		'alpha' => true,
			),
	) );
	
	Kirki::add_field( '', array(
		'type'        => 'color',
		'settings'    => 'diz-theme-fourth-color',
		'label'       => __( 'Special Color', 'kirki' ),
		'help'        => __( 'This is your special color', 'kirki-demo' ),
		'description' => __( 'Select your special color. This is just an extra color variable if you want to add it and can be used anywhere as a css variable --special-color', 'kirki-demo' ),
		'section'     => 'themedemo_demo_settings_design',
		'default'     => '#333333',
		'priority'    => 8,
		'choices'     => array(
		'alpha' => true,
			),
	) );

	//*Social Networking Links*//

    	//*Facebook*//

	$wp_customize->add_setting( 'fb_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fb_social_setting', array(
        'label'   => 'Facebook URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'fb_social_setting',
    ) ) );
		
		//*Twitter*//

    $wp_customize->add_setting( 'tw_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tw_social_setting', array(
        'label'   => 'Twitter Profile URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'tw_social_setting',
    ) ) );

		//*Google +*//

	$wp_customize->add_setting( 'gp_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gp_social_setting', array(
        'label'   => 'Google Plus URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'gp_social_setting',
    ) ) );
    
        //*YouTube*//

	$wp_customize->add_setting( 'yt_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'yt_social_setting', array(
        'label'   => 'YouTube URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'yt_social_setting',
    ) ) );

		//*LinkedIn*//

	$wp_customize->add_setting( 'li_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'li_social_setting', array(
        'label'   => 'LinkedIn URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'li_social_setting',
    ) ) );

		//*Yelp*//

    $wp_customize->add_setting( 'yl_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'yl_social_setting', array(
        'label'   => 'Yelp Page URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'yl_social_setting',
    ) ) );

		//*AVVO*//

    $wp_customize->add_setting( 'av_social_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'av_social_setting', array(
        'label'   => 'AVVO Page URL',
        'section' => 'themedemo_demo_settings_social_media',
        'settings'   => 'av_social_setting',
    ) ) );
    
    //*Schema.org Business settings*//

    //*Business Address*//

	$wp_customize->add_setting( 'ds_busadd_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_busadd_setting', array(
        'label'   => 'Business Address',
        'section' => 'themedemo_demo_settings_schema_biz',
        'settings'   => 'ds_busadd_setting',
    ) ) );

    //*Business Google Maps Link*//

	$wp_customize->add_setting( 'ds_busadd_map_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_busadd_map_setting', array(
        'label'   => 'Business Address Google Map Link',
        'section' => 'themedemo_demo_settings_schema_biz',
        'settings'   => 'ds_busadd_map_setting',
    ) ) );

    //*Business Hours*//

	$wp_customize->add_setting( 'ds_bushours_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_bushours_setting', array(
        'label'   => 'Business Hours',
        'section' => 'themedemo_demo_settings_schema_biz',
        'settings'   => 'ds_bushours_setting',
    ) ) );

    //*Business Phone*//

	$wp_customize->add_setting( 'ds_busphone_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_busphone_setting', array(
        'label'   => 'Business Phone Number',
        'section' => 'themedemo_demo_settings_schema_biz',
        'settings'   => 'ds_busphone_setting',
    ) ) );

    //*Business Fax*//

	$wp_customize->add_setting( 'ds_busfax_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_busfax_setting', array(
        'label'   => 'Business Fax Number',
        'section' => 'themedemo_demo_settings_schema_biz',
        'settings'   => 'ds_busfax_setting',
    ) ) );

    //*Business Email*//

	$wp_customize->add_setting( 'ds_busemail_setting', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ds_busemail_setting', array(
        'label'   => 'Business Email Address',
        'section' => 'themedemo_demo_settings_schema_biz',
        'settings'   => 'ds_busemail_setting',
    ) ) );
}
	// Typogrophy removed for trouble shooting

//---------------**********************-------------------//
//End Customizer

//Social Links Short Code

function dizzy_social_shortcode( ) {
	 ob_start();
	echo '<div class="social">';
//Facebook	
if (get_theme_mod('fb_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'fb_social_setting', '' ); 
	echo '" title="Like Us On Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>';
}
//Twitter
if (get_theme_mod('tw_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'tw_social_setting', '' ); 
	echo '" title="Follow Us On Twitter" target="_blank"><i class="fab fa-twitter"></i></a>';
}
//Google Plus
if (get_theme_mod('gp_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'gp_social_setting', '' ); 
	echo '" rel="publisher author" title="Connect With Us On Google +" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
}
//YouTube
if (get_theme_mod('yt_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'yt_social_setting', '' ); 
	echo '" rel="publisher author" title="Watch Us On YouTube" target="_blank"><i class="fab fa-youtube"></i></a>';
}
//Linked In
if (get_theme_mod('li_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'li_social_setting', '' ); 
	echo '" title="Connect on LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a>';
}
//Yelp
if (get_theme_mod('yl_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'yl_social_setting', '' ); 
	echo '" title="Check Us Out On Yelp!" target="_blank"><i class="fab fa-yelp"></i></a>';
}
//Avvo
if (get_theme_mod('av_social_setting')) {
	echo '<a href="';
	echo get_theme_mod( 'av_social_setting', '' ); 
	echo '" title="View My Profile On Avvo" target="_blank"><img src="https://d17vkztfo54i4d.cloudfront.net/wp-content/uploads/sites/22/2015/04/avvo-logo-bug-150x150.png"/></a>';
}
echo '</div><!--Social Icons-->';
	$myvariable = ob_get_clean();
        return $myvariable;
}		

add_shortcode('dizzy-social', 'dizzy_social_shortcode');

//Social links widget
	// Creating the widget 
class ds_social_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'ds_social_widget', 
			// Widget name will appear in UI
			__('Dizzy Six Social Share Sidebar', 'ds_social_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Adds the Dizzy Seven Social Share buttons to the sidebar', 'ds_social_widget_domain' ), ) 
		);
	}

// Creating widget front-end
	// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
	// This is where you run the code and display the output
		echo '<div class="social-share"> <a data-fb-link="';
		echo the_permalink();
		echo '" href="https://www.facebook.com/sharer/sharer.php?u=';
		echo the_permalink();
		echo '" title="Share on Facebook" name="fb_share" onclick="window.open(this.href,\'targetWindow\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=660,height=380,left=100,top=100\');return false;" class="facebook"><span><i class="fab fa-facebook-f"></i></span> Facebook</a>';
		echo '<a href="https://twitter.com/intent/tweet?text=';
		echo the_title(); 
		echo '&url=';
		echo the_permalink();
		echo '" class="share-icon share-button share-icon-twitter twitter" title="Share on Twitter"  onclick="window.open(this.href,\'targetWindow\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=660,height=380,left=100,top=100\');return false;"><span><i class="fab fa-twitter"></i></span> Twitter</a>';      
		echo '<a href="https://plus.google.com/share?url=';
		echo the_permalink();
		echo '" class="share-icon share-button share-icon-google-plus google" title="Share on Google+" onclick="window.open(this.href,\'targetWindow\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=480,height=400,left=100,top=100\');return false;"><span><i class="fab fa-google-plus-g"></i></span> Google +</a>';        
		echo '<a class="social-email" href="mailto:?subject=I wanted to share this story with you: || ';
		echo the_title();
		echo '&body=I found this story on ';   
		echo bloginfo('url');
		echo 'and I thought you would like it:';
		echo the_permalink();
		echo ' Here is an excerpt:';
		echo strip_tags( get_the_excerpt() );
		echo '"><span><i class="fa fa-share-square"></i></span>Email a Friend</a></div>';
		echo $args['after_widget'];
}

// Widget Backend 
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
} else {
		$title = __( 'Share On Your Social Networks', 'ds_social_widget_domain' );
}

// Widget admin form
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
}

	// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
} // Class ds_social_widget ends here

// Register and load the widget
function ds_social_load_widget() {
	register_widget( 'ds_social_widget' );
}

add_action( 'widgets_init', 'ds_social_load_widget' );

//Social Media Links Widget

// Creating the widget 

class ds_social_links_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
	// Base ID of your widget
			'ds_social_links_widget', 
	// Widget name will appear in UI
			__('Dizzy Seven Social Links Sidebar', 'ds_social_links_widget_domain'), 
	// Widget description
			array( 'description' => __( 'Adds the Dizzy Seve Social Media Links to the sidebar', 'ds_social_links_widget_domain' ), ) 
		);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
		echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
	// This is where you run the code and display the output
				echo '<div class="social">';
	//Facebook	
					if (get_theme_mod('fb_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'fb_social_setting', '' ); 
						echo '" title="Like Us On Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>';
					}
	//Twitter
					if (get_theme_mod('tw_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'tw_social_setting', '' ); 
						echo '" title="Follow Us On Twitter" target="_blank"><i class="fab fa-twitter"></i></a>';
					}
	//Google Plus
					if (get_theme_mod('gp_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'gp_social_setting', '' ); 
						echo '" rel="publisher author" title="Connect With Us On Google +" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
					}
	//YouTube
					if (get_theme_mod('yt_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'yt_social_setting', '' ); 
						echo '" rel="publisher author" title="Watch Us On YouTube" target="_blank"><i class="fab fa-youtube"></i></a>';
					}
	//Linked In
					if (get_theme_mod('li_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'li_social_setting', '' ); 
						echo '" title="Connect on LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a>';
					}
	//Yelp
					if (get_theme_mod('yl_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'yl_social_setting', '' ); 
						echo '" title="Check Us Out On Yelp!" target="_blank"><i class="fab fa-yelp"></i></a>';
					}
	//Avvo
					if (get_theme_mod('av_social_setting')) {
						echo '<a href="';
						echo get_theme_mod( 'av_social_setting', '' ); 
						echo '" title="View My Profile On Avvo" target="_blank"><img src="https://d17vkztfo54i4d.cloudfront.net/wp-content/uploads/sites/22/2015/04/avvo-logo-bug-150x150.png"/></a>';
					}
	echo '</div><!--Social Icons-->';
	echo $args['after_widget'];
}

// Widget Backend 

public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	} else {
		$title = __( 'Connect With Us On Social Media', 'ds_social_links_widget_domain' );
	}

// Widget admin form
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
}

// Updating widget replacing old instances with new

public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
}
} // Class ds_social_links_widget ends here

// Register and load the widget
function ds_social_links_load_widget() {
	register_widget( 'ds_social_links_widget' );
}

add_action( 'widgets_init', 'ds_social_links_load_widget' );

//Business Schema shortcode

function dizzy_schema_biz_shortcode( ) {
	ob_start();
	echo '<div class="schemabiz" itemscope itemtype="https://schema.org/LocalBusiness">';
//Business image   
if (get_theme_mod('diz-nav-logo')) {
    echo '<figure itemprop="image" itemscope itemtype="http://schema.org/ImageObject"><img src="';
    echo get_theme_mod('diz-nav-logo');
    echo '" alt="';
    if (get_theme_mod( 'ds_busname_setting', '' )) {
        echo get_theme_mod( 'ds_busname_setting', '' );
    } else { 
        echo wp_title();
    }
    echo '" itemprop="url"/></figure>';
    }
//Business name
if (get_theme_mod('ds_busname_setting')) {
    echo '<h3  itemprop="name">';
    echo get_theme_mod( 'ds_busname_setting', '' );
    echo '</h3>';
} else {
    echo '<h3  itemprop="name">';
    echo wp_title();
    echo '</h3>';
}
    echo '<ul>';
//Business address
if (get_theme_mod('ds_busadd_setting')) {
    echo '<li itemprop="address"><i class="fas fa-map-marker-alt prelo"></i> <address>';
    if (get_theme_mod('ds_busadd_map_setting')) {
        echo '<a href="';
        echo get_theme_mod( 'ds_busadd_map_setting', '' );
        echo '">';
        echo get_theme_mod( 'ds_busadd_setting', '' );
        echo '</a>';
    } else {
        echo get_theme_mod( 'ds_busadd_setting', '' );
    }
    echo '</address></li>';
}
//Hours
if (get_theme_mod('ds_bushours_setting')) {
    echo '<li itemprop="openingHours" datetime="';
    echo get_theme_mod( 'ds_bushours_setting', '' );
    echo '"><i class="fas fa-clock prelo"></i> ';
    echo get_theme_mod( 'ds_bushours_setting', '' );
    echo '</li>';
}
//Phone
if (get_theme_mod('ds_busphone_setting')) {
    echo '<li itemprop="telephone"><i class="fas fa-mobile-alt prelo"></i> <a href="tel:';
    echo get_theme_mod( 'ds_busphone_setting', '' );
    echo '">';
    echo get_theme_mod( 'ds_busphone_setting', '' );
    echo '</a></li>';
}
//FAX
if (get_theme_mod('ds_busfax_setting')) {
    echo '<li itemprop="faxNumber"><i class="fas fa-fax prelo"></i> ';
    echo get_theme_mod( 'ds_busfax_setting', '' );
    echo '</li>';
}
//Email
if (get_theme_mod('ds_busemail_setting')) {
    echo '<li itemprop="email"><i class="far fa-envelope-open prelo"></i> <a href="mailto:';
    echo get_theme_mod( 'ds_busemail_setting', '' );
    echo '">Email ';
    if (get_theme_mod('ds_busname_setting')) {
        echo get_theme_mod( 'ds_busname_setting', '' );
    } else {
        echo wp_title();
    }
    echo '</a></li>';
}
//Social networks
    echo '<li><h3>Connect On Social Media</h3><br/>';
    echo do_shortcode("[dizzy-social]");
    echo '</li></ul></div>';

    $myvariable = ob_get_clean();
        return $myvariable;
}		

add_shortcode('dizzy-schemabiz', 'dizzy_schema_biz_shortcode');

//Schema.org Widget

// Creating the widget 

class d7_schema_info_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
	// Base ID of your widget
			'd7_schema_info_widget', 
	// Widget name will appear in UI
			__('Dizzy Seven Schema Info Widget', 'd7_schema_info_widget_domain'), 
	// Widget description
			array( 'description' => __( 'Adds the Dizzy Seven Schema Info Widget to the sidebar', 'd7_schema_info_widget_domain' ), ) 
		);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
		echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
	// This is where you run the code and display the output
				echo '<div class="schemabiz" itemscope itemtype="https://schema.org/LocalBusiness">';
//Business image   
if (get_theme_mod('diz-nav-logo')) {
    echo '<figure itemprop="image" itemscope itemtype="http://schema.org/ImageObject"><img src="';
    echo get_theme_mod('diz-nav-logo');
    echo '" alt="';
    if (get_theme_mod( 'ds_busname_setting', '' )) {
        echo get_theme_mod( 'ds_busname_setting', '' );
    } else { 
        echo wp_title();
    }
    echo '" itemprop="url"/></figure>';
    }
//Business name
if (get_theme_mod('ds_busname_setting')) {
    echo '<h3  itemprop="name">';
    echo get_theme_mod( 'ds_busname_setting', '' );
    echo '</h3>';
} else {
    echo '<h3  itemprop="name">';
    echo wp_title();
    echo '</h3>';
}
    echo '<ul>';
//Business address
if (get_theme_mod('ds_busadd_setting')) {
    echo '<li itemprop="address"><i class="fas fa-map-marker-alt prelo"></i> <address>';
    if (get_theme_mod('ds_busadd_map_setting')) {
        echo '<a href="';
        echo get_theme_mod( 'ds_busadd_map_setting', '' );
        echo '">';
        echo get_theme_mod( 'ds_busadd_setting', '' );
        echo '</a>';
    } else {
        echo get_theme_mod( 'ds_busadd_setting', '' );
    }
    echo '</address></li>';
}
//Hours
if (get_theme_mod('ds_bushours_setting')) {
    echo '<li itemprop="openingHours" datetime="';
    echo get_theme_mod( 'ds_bushours_setting', '' );
    echo '"><i class="fas fa-clock prelo"></i>';
    echo get_theme_mod( 'ds_bushours_setting', '' );
    echo '</li>';
}
//Phone
if (get_theme_mod('ds_busphone_setting')) {
    echo '<li itemprop="telephone"><i class="fas fa-mobile-alt prelo"></i> <a href="tel:';
    echo get_theme_mod( 'ds_busphone_setting', '' );
    echo '">';
    echo get_theme_mod( 'ds_busphone_setting', '' );
    echo '</a></li>';
}
//FAX
if (get_theme_mod('ds_busfax_setting')) {
    echo '<li itemprop="faxNumber"><i class="fas fa-fax prelo"></i> ';
    echo get_theme_mod( 'ds_busfax_setting', '' );
    echo '</li>';
}
//Email
if (get_theme_mod('ds_busemail_setting')) {
    echo '<li itemprop="email"><i class="far fa-envelope-open prelo"></i> <a href="mailto:';
    echo get_theme_mod( 'ds_busemail_setting', '' );
    echo '">Email ';
    if (get_theme_mod('ds_busname_setting')) {
        echo get_theme_mod( 'ds_busname_setting', '' );
    } else {
        echo wp_title();
    }
    echo '</a></li>';
}
//Social networks
    echo '<li><h3>Connect On Social Media</h3><br/>';
    echo do_shortcode("[dizzy-social]");
    echo '</li></ul></div>';
	echo $args['after_widget'];
}

// Widget Backend 

public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	} else {
		$title = __( 'Contact Us', 'd7_schema_info_widget_domain' );
	}

// Widget admin form
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
}

// Updating widget replacing old instances with new

public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
}
} // Class ds_social_links_widget ends here

// Register and load the widget
function d7_schema_info_widget_load_widget() {
	register_widget( 'd7_schema_info_widget' );
}

add_action( 'widgets_init', 'd7_schema_info_widget_load_widget' );

function kirki_demo_configuration_sample_styling( $config ) {
    $config['width']        = '40%';
    return $config;
}

add_filter( 'kirki/config', 'kirki_demo_configuration_sample_styling' );


//****Experimental Features *****//

add_action('init', 'my_custom_init');

function my_custom_init() {
    add_post_type_support( 'wpfc_sermon', 'publicize' );
}

/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/
function dizzy7_gutenberg_features() {
		

// Theme supports wide images, galleries and videos.
    add_theme_support( 'align-wide' );
    add_theme_support( 'align-full' );
    add_theme_support( 'wide-images' );
    
    add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Main Color', '@@textdomain' ),
				'slug' => 'main-color',
				'color' => get_theme_mod( 'diz-theme-main-color'),
			),
			array(
				'name'  => esc_html__( 'Second Color', '@@textdomain' ),
				'slug' => 'second-color',
				'color' => get_theme_mod( 'diz-theme-second-color'),
			),
			array(
				'name'  => esc_html__( 'Highlight Color', '@@textdomain' ),
				'slug' => 'highlight-color',
				'color' => get_theme_mod( 'diz-theme-third-color'),
			),
			array(
				'name'  => esc_html__( 'Special Color', '@@textdomain' ),
				'slug' => 'special-color',
				'color' => get_theme_mod( 'diz-theme-fourth-color'),
			)
		)
	);
}

add_action( 'after_setup_theme', 'dizzy7_gutenberg_features' );
