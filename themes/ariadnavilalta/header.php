<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ariadnavilalta
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<meta property="og:url" content="http://ariadnavilalta.net"/>
<meta property="og:title" content="Ariadna Vilalta portfolio"/>
<meta property="og:image" content="http://ariadnavilalta.net/ariadna_vilalta_portfolio.jpg"/>
<meta property="og:site_name" content="Ariadna Vilalta portfolio"/>
<meta property="og:description" content="A Designer who creates simple, helpful, and remarkable graphic design. From global brands to small businesses."/>


<script src="//use.typekit.net/atx8apd.js"></script>
<script>try{Typekit.load();}catch(e){}</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

    <header id="masthead" class="site-header [ band band--wide ]" role="banner">
        <div class="wrapper">
            <div class="site-branding">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Ariadna Vilalta</a></h1>
                
                <?php if ( !is_home() ): ?>
                <nav class="secondary-navigation">
                    <ul>
                        <li<?php echo is_page('work') ? ' class="active"' : '' ?>><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li><!--
                     --><li<?php echo is_page('about') ? ' class="active"' : '' ?>><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
                    </ul>
                </nav>
                <?php endif; ?>

            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
