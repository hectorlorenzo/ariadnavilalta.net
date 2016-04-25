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

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

    <header id="masthead" class="site-header [ band band--wide ]" role="banner">

    </header><!-- #masthead -->

    <div id="content" class="site-content  js-wrapper">
