<?php

class ThemeSetup {

    function __construct() {
        $this->Bind();
    }

    function Bind() {
        add_action( 'after_setup_theme', array( $this, 'BasicSetup' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'EnqueueStyles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'EnqueueScripts' ) );
    }

    function BasicSetup() {
        add_theme_support( 'post-thumbnails' );
    }

    function EnqueueStyles() {
        
    }

    function EnqueueScripts() {
        wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/build/js/main.js', array(), '20151215', true );
    }

}


$themeSetup = new ThemeSetup();
