<?php
/*
	Theme Name:  Sahu4You Lite
	Description: Custom child theme for the <a href="http://sahu4you.com">Genesis Child Thmes</a>.
	Author:       Vikas Sahu
	Author URI:  https://www.sahu4you.com
	Version:     1.0.0
	License:     GPL-2.0+
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Template:    genesis
*/

/*
BEFORE MODIFYING THIS THEME:
Please read the instructions here (private repo): https://github.com/billerickson/EA-Starter/wiki
Devs, contact me if you need access
*/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
    $content_width = 768;

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function ea_global_enqueues() {

	// javascript
	if( ! ea_is_amp() ) {
		wp_enqueue_script( 'ea-global', get_stylesheet_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/global-min.js' ), true );

		// Move jQuery to footer
		if( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
			wp_enqueue_script( 'jquery' );
		}

	}

	// css
	wp_dequeue_style( 'child-theme' );
	wp_enqueue_style( 'ea-fonts', ea_theme_fonts_url() );
	wp_enqueue_style( 'ea-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
}
add_action( 'wp_enqueue_scripts', 'ea_global_enqueues' );

/**
 * Gutenberg scripts and styles
 *
 */
function ea_gutenberg_scripts() {
	wp_enqueue_style( 'ea-fonts', ea_theme_fonts_url() );
	wp_enqueue_script( 'ea-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'ea_gutenberg_scripts' );

/**
 * Theme Fonts URL
 *
 */
function ea_theme_fonts_url() {
	return false;
}

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function ea_child_theme_setup() {

	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );

	// General cleanup
	include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );

	// Theme
	include_once( get_stylesheet_directory() . '/inc/markup.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/layouts.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/loop.php' );
	include_once( get_stylesheet_directory() . '/inc/author-box.php' );
	include_once( get_stylesheet_directory() . '/inc/template-tags.php' );
	include_once( get_stylesheet_directory() . '/inc/site-footer.php' );

	// Editor
	include_once( get_stylesheet_directory() . '/inc/disable-editor.php' );
	include_once( get_stylesheet_directory() . '/inc/tinymce.php' );

	// Functionality
	include_once( get_stylesheet_directory() . '/inc/login-logo.php' );
	include_once( get_stylesheet_directory() . '/inc/block-area.php' );
	include_once( get_stylesheet_directory() . '/inc/social-links.php' );

	// Plugin Support
	include_once( get_stylesheet_directory() . '/inc/acf.php' );
	include_once( get_stylesheet_directory() . '/inc/amp.php' );
	include_once( get_stylesheet_directory() . '/inc/shared-counts.php' );
	include_once( get_stylesheet_directory() . '/inc/wpforms.php' );

	// Editor Styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Image Sizes
	// add_image_size( 'ea_featured', 400, 100, true );

	// Gutenberg

	// -- Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Disable custom font sizes
	add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'ea_genesis_child' ),
			'shortName' => __( 'S', 'ea_genesis_child' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Normal', 'ea_genesis_child' ),
			'shortName' => __( 'M', 'ea_genesis_child' ),
			'size'      => 20,
			'slug'      => 'normal'
		),
		array(
			'name'      => __( 'Large', 'ea_genesis_child' ),
			'shortName' => __( 'L', 'ea_genesis_child' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'ea_genesis_child' ),
			'slug'  => 'blue',
			'color'	=> '#05306F',
		),
		array(
			'name'  => __( 'Grey', 'ea_genesis_child' ),
			'slug'  => 'grey',
			'color' => '#FAFAFA',
		),
	) );

}
add_action( 'genesis_setup', 'ea_child_theme_setup', 15 );

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function ea_comment_text( $args ) {
	$args['title_reply']          = __( 'Leave A Reply', 'ea_genesis_child' );
	$args['label_submit']         = __( 'Post Comment',  'ea_genesis_child' );
	$args['comment_notes_before'] = '';
	$args['comment_notes_after']  = '';
	return $args;
}
add_filter( 'comment_form_defaults', 'ea_comment_text' );

/**
 * Template Hierarchy
 *
 */
function ea_template_hierarchy( $template ) {
	if( is_home() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'ea_template_hierarchy' );


// Add custom logo or Enable option in Customizer > Site Identity
add_theme_support( 'custom-logo', array(
    'width'       => 244,
    'height'      => 315,
    'flex-width' => true,
    'flex-height' => true,
    'header-text' => array( '.site-title', '.site-description' ),
) );

// Display custom logo
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

function be_remove_metaboxes( $_genesis_admin_settings ) {
    
    remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
}

// Remove title/logo metabox from Genesis theme options page
add_action( 'genesis_theme_settings_metaboxes', 'be_remove_metaboxes' );

function es_theme_customize_register( $wp_customize ) {
 
    $wp_customize->remove_control('blog_title');
 
}

//Remove title/logo metabox from Genesis customizer
add_action( 'customize_register', 'es_theme_customize_register', 99 );

//Changing the Credits

// Remove site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
// Customize site footer
add_action( 'genesis_footer', 'leaguewp_custom_footer' );
function leaguewp_custom_footer() { ?>

	<div class="site-footer"><div class="wrap"><p>Designed with by <a href="https://www.sahu4you.com/sahu4you-genesis-theme/">Sahu4You</a>.</p>
</div></div>

<?php
}