<?php

class CustomPostTypes {

    function __construct()
    {
        $this->Bind();
    }

    function Bind()
    {
        add_action( 'init', array( $this, 'RegisterProjectCustomPostType' ) );
        add_action( 'init', array( $this, 'RegisterProjectTaxonomy' ) );
    }

    function RegisterProjectCustomPostType()
    {
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

    function RegisterProjectTaxonomy()
    {
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'Sectors', 'taxonomy general name' ),
            'singular_name'     => _x( 'Sector', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Sectors' ),
            'all_items'         => __( 'All Sectors' ),
            'parent_item'       => __( 'Parent Sector' ),
            'parent_item_colon' => __( 'Parent Sector:' ),
            'edit_item'         => __( 'Edit Sector' ),
            'update_item'       => __( 'Update Sector' ),
            'add_new_item'      => __( 'Add New Sector' ),
            'new_item_name'     => __( 'New Sector Name' ),
            'menu_name'         => __( 'Sectors' ),
            );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'project-sectors' ),
        );

        register_taxonomy( 'project-sector', array( 'project' ), $args );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'Locations', 'taxonomy general name' ),
            'singular_name'     => _x( 'Location', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Locations' ),
            'all_items'         => __( 'All Locations' ),
            'parent_item'       => __( 'Parent Location' ),
            'parent_item_colon' => __( 'Parent Location:' ),
            'edit_item'         => __( 'Edit Location' ),
            'update_item'       => __( 'Update Location' ),
            'add_new_item'      => __( 'Add New Location' ),
            'new_item_name'     => __( 'New Location Name' ),
            'menu_name'         => __( 'Locations' ),
            );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'project-locations' ),
        );

        register_taxonomy( 'project-location', array( 'project' ), $args );

    }

}


$customPostTypes = new CustomPostTypes();
