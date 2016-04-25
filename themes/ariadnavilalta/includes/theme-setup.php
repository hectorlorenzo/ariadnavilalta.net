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

    }

}


$themeSetup = new ThemeSetup();
