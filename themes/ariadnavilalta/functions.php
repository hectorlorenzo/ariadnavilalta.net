<?php
/**
 * ariadnavilalta functions and definitions
 *
 * @package ariadnavilalta
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'ariadnavilalta_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ariadnavilalta_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ariadnavilalta, use a find and replace
	 * to change 'ariadnavilalta' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ariadnavilalta', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// new image size for mobile
	add_image_size( 'project_thumb_regular', 99999, 900 );
	add_image_size( 'project_thumb_mobile', 99999, 450 );

	add_image_size( 'project_detail_mobile', 600, 450 );

	add_image_size( 'slideshow_mobile', 600, 250 );

}
endif; // ariadnavilalta_setup
add_action( 'after_setup_theme', 'ariadnavilalta_setup' );


// no admin bar
add_filter('show_admin_bar', '__return_false');


/**
 * Enqueue scripts and styles.
 */
function ariadnavilalta_scripts() {
	wp_enqueue_style( 'ariadnavilalta-style', get_stylesheet_uri(), array(), time() );

	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, true );
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/build/js/main.js', false, '0.0.1', true );

	wp_localize_script( 'main-script', 'ajaxVars', array( 'url' => admin_url( 'admin-ajax.php' ))); 
}
add_action( 'wp_enqueue_scripts', 'ariadnavilalta_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';




/**
 * CUSTOM POST TYPES
 */

add_action('init', 'ariadnavilalta_register_project_type' );

function ariadnavilalta_register_project_type() { 

	$labels = array(
		'name'               => _x( 'Projects', 'post type general name', 'ariadnavilalta' ),
		'singular_name'      => _x( 'Project', 'post type singular name', 'ariadnavilalta' ),
		'menu_name'          => _x( 'Projects', 'admin menu', 'ariadnavilalta' ),
		'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'ariadnavilalta' ),
		'add_new'            => _x( 'Add New', 'yay', 'ariadnavilalta' ),
		'add_new_item'       => __( 'Add New Project', 'ariadnavilalta' ),
		'new_item'           => __( 'New Project', 'ariadnavilalta' ),
		'edit_item'          => __( 'Edit Project', 'ariadnavilalta' ),
		'view_item'          => __( 'View Project', 'ariadnavilalta' ),
		'all_items'          => __( 'All Projects', 'ariadnavilalta' ),
		'search_items'       => __( 'Search Projects', 'ariadnavilalta' ),
		'parent_item_colon'  => __( 'Parent Projects:', 'ariadnavilalta' ),
		'not_found'          => __( 'No Projects found.', 'ariadnavilalta' ),
		'not_found_in_trash' => __( 'No Projects found in Trash.', 'ariadnavilalta' )
		);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'project' ),
	'menu_icon'          => 'dashicons-awards',
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

register_post_type( 'project', $args );

}


add_action( 'init', 'ariadnavilalta_register_project_taxonomy' );

function ariadnavilalta_register_project_taxonomy() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Project Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Project Categories' ),
		'all_items'         => __( 'All Project Categories' ),
		'parent_item'       => __( 'Parent Project Category' ),
		'parent_item_colon' => __( 'Parent Project Category:' ),
		'edit_item'         => __( 'Edit Project Category' ),
		'update_item'       => __( 'Update Project Category' ),
		'add_new_item'      => __( 'Add New Project Category' ),
		'new_item_name'     => __( 'New Project Category Name' ),
		'menu_name'         => __( 'Project Categories' ),
		);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-categories' ),
		);

	register_taxonomy( 'project-category', array( 'project' ), $args );
}




/**
 * PRROJECTS FUNCTIONS
 */


// add project_category as a query var
function add_query_vars($aVars) {
	$aVars[] = "project_category";
	$aVars[] = "page_number";
	return $aVars;
}
 
// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');


// let's add a url rewrite for work categories
function add_rewrite_rules( $aRules ) {
	$aNewRules3 = array('work/([^/]+)/([0-9])/?$' => 'index.php?pagename=work&project_category=$matches[1]&page_number=$matches[2]');
	$aNewRules2 = array('work/([0-9])/?$' => 'index.php?pagename=work&page_number=$matches[1]');
	$aNewRules1 = array('work/([^/]+)/?$' => 'index.php?pagename=work&project_category=$matches[1]');
	$aRules = $aNewRules3 + $aNewRules2 + $aNewRules1 + $aRules;
	return $aRules;
}

add_filter( 'rewrite_rules_array', 'add_rewrite_rules' );



function ariadnavilalta_get_featured_projects() {

	$args = array(
		'post_type'		=> 'project',
		'meta_key'		=> 'featured_project',
		'meta_value'	=> '1',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC' 
	);

	$query = new WP_Query( $args );

	$projects = $query->posts;

	wp_reset_postdata();

	return $projects;

}


function ariadnavilalta_get_recent_projects() {

	$args = array(
		'post_type'		=> 'project',
		'meta_key'		=> 'recent_project',
		'meta_value'	=> '1',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC' 
	);

	$query = new WP_Query( $args );

	$projects = $query->posts;

	wp_reset_postdata();

	return $projects;

}


function ariadnavilalta_get_projects( $slug_cat = 'all' ) {

	$args = array(
		'post_type' 	=> 'project',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC' 
	);

	if ( $slug_cat !== 'all' ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'project-category',
				'field'    => 'slug',
				'terms'    => $slug_cat
			)
		);
	}

	$query = new WP_Query( $args );

	$projects = $query->posts;

	wp_reset_postdata();

	return $projects;

}


add_action("wp_ajax_get_projects", "ariadnavilalta_ajax_get_projects");
add_action("wp_ajax_nopriv_get_projects", "ariadnavilalta_ajax_get_projects");

function ariadnavilalta_ajax_get_projects() {

	$project_cat = $_REQUEST['project_category'];

	$return = array();

	$projects = ariadnavilalta_get_projects( $project_cat );

	foreach ($projects as $index => $proj) {

		$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $proj->ID ), 'project_thumb_regular' );

		$return[$index] .= '<div id="project-'.$proj->ID.'" class="project-thumb [ one-whole portable--one-third ]">';
        $return[$index] .= '<div class="project-thumb__image">';
        $return[$index] .= '<a href="'.$proj->guid.'">';
        $return[$index] .= '<img src="'.$attachment[0].'" alt="'.$proj->post_title.'">';
        $return[$index] .= '</a>';
        $return[$index] .= '</div>';
        $return[$index] .= '<div class="project-thumb__footer">';
        $return[$index] .= '<h4 class="project-thumb__title"><a href="'.$proj->guid.'">'.$proj->post_title.'</a></h4>';
        $return[$index] .= '<h5 class="grey">Digital</h5>';
        $return[$index] .= '</div>';
        $return[$index] .= '</div>';
	}

	echo json_encode( $return );

	die();

}



function get_previous_project_url( $project_id = null) {

	global $wpdb;

	if ( is_null( $project_id ) ) return false;

	// let's get the menu order from this project
	$project_obj = get_post( $project_id );

	$next_project_id = $wpdb->get_var( $wpdb->prepare( 'SELECT ID FROM wp_posts WHERE post_type = "project" AND menu_order < %d ORDER BY menu_order DESC LIMIT 1', $project_obj->menu_order ) );

	$next_project_post = get_post( $next_project_id );

	if ( is_null($next_project_id) )
		return false;
	else
		return "<a href='" . get_permalink( $next_project_id ) . "'>&larr; " . $next_project_post->post_title . "</a>";

}


function get_next_project_url( $project_id = null) {

	global $wpdb;

	if ( is_null( $project_id ) ) return false;

	// let's get the menu order from this project
	$project_obj = get_post( $project_id );

	$next_project_id = $wpdb->get_var( $wpdb->prepare( 'SELECT ID FROM wp_posts WHERE post_type = "project" AND menu_order > %d ORDER BY menu_order ASC LIMIT 1', $project_obj->menu_order ) );

	$next_project_post = get_post( $next_project_id );

	if ( is_null($next_project_id) )
		return false;
	else
		return "<a href='" . get_permalink( $next_project_id ) . "'>" . $next_project_post->post_title . " &rarr;</a> ";

}







/**
 * ATTACHMENTS CONFIGURATION
 */

add_action( 'attachments_register', 'ariadnavilalta_custom_attachments' );

function ariadnavilalta_custom_attachments( $attachments )
{
	$fields = array(
		array(
			'name'      => 'title',                         // unique field name
			'type'      => 'text',                          // registered field type
			'label'     => __( 'Title', 'ariadnavilalta' ),    // label to display
			'default'   => 'title',                         // default value upon selection
		),
		array(
			'name'      => 'caption',                       // unique field name
			'type'      => 'textarea',                      // registered field type
			'label'     => __( 'Caption', 'ariadnavilalta' ),  // label to display
			'default'   => 'caption',                       // default value upon selection
	    ),
	);

	$args = array(
		'label'         => 'Project Images',
		'post_type'     => 'project',
		'position'      => 'normal',
		'priority'      => 'high',
	    'filetype'      => 'image',
	    'button_text'   => __( 'Add Image', 'ariadnavilalta' ),
	    'modal_text'    => __( 'Add', 'ariadnavilalta' ),
	    'router'        => 'upload',
		'fields'        => $fields,
    );

  $attachments->register( 'project_images', $args ); // unique instance name
}
