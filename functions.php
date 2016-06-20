<?php
//functions.php

define( 'C80_THEME_VERSION', '0.1.0');
define( 'C80_TWITTER', 'proyectoC80');
define( 'C80_FACEBOOK', 'https://www.facebook.com/proyectoC80/');

//theme support
function c80t_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5' );
}

add_action( 'after_setup_theme', 'c80t_theme_setup' );

function c80t_menus() {
	register_nav_menu( 'principal', 'Menú principal' );
	register_nav_menu( 'portada', 'Control contenidos portada' );
	register_nav_menu( 'columnas', 'Control Columnas' );
}

add_action( 'after_setup_theme', 'c80t_menus' );

//content width
if ( ! isset( $content_width ) ) {
	$content_width = 754;
}

//includes
include( TEMPLATEPATH . '/includes/scripts.php' );
include( TEMPLATEPATH . '/includes/metatags.php' );
include( TEMPLATEPATH . '/includes/content.php' );
include( TEMPLATEPATH . '/includes/content-archive.php' );
include( TEMPLATEPATH . '/includes/breadcrumb.php' );
include( TEMPLATEPATH . '/includes/ajax.php' );
include( TEMPLATEPATH . '/includes/post-types.php' );
include( TEMPLATEPATH . '/includes/bootstrap-menu.php' );
include( TEMPLATEPATH . '/includes/author.php' );
include( TEMPLATEPATH . '/includes/content-embeds.php' );
include( TEMPLATEPATH . '/includes/json-microdata.php' );

//actions
add_action( 'wp_enqueue_scripts', 'c80t_scripts' );
add_action( 'wp_enqueue_scripts', 'c80t_styles' );


//Image sizes
function c80t_imgsizes() {
	add_image_size( 'main', 754, 0, false );
	add_image_size( 'secondary', 369, 237, true );
	add_image_size( 'featured', 369, 369, true );
}

add_action( 'after_setup_theme', 'c80t_imgsizes' );