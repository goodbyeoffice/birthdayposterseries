<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package birthday
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico"/>

<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="A project of goobye, office">
<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">

<meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() ); ?>/og-image.jpg">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title desktop"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Birthday</a></h1>
			<h1 class="site-title mobile"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Birthday Poster Series</a></h1>
			<h2 class="site-description">A project of <a href="http://www.goodbyeoffice.com" target="_blank" rel="home">goodbye, office</a></h2>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
