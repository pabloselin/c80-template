<?php
//scripts loader

function c80t_scripts() {
	//bootstrap
	wp_enqueue_script( 'bootstrap', get_bloginfo('template_url') . '/assets/vendor/bootstrap/dist/js/bootstrap.js', array(), C80_THEME_VERSION, false );
	wp_enqueue_script( 'c80t-scripts', get_bloginfo('template_url') . '/assets/js/scripts.js', array('bootstrap', 'jquery'), C80_THEME_VERSION, false);
}

function c80t_styles() {
	//wp_enqueue_style( 'bootstrap', get_bloginfo('template_url') . '/assets/vendor/bootstrap/dist/css/bootstrap.css', array(), C80_THEME_VERSION, 'screen' );
	wp_enqueue_style( 'c80-theme', get_bloginfo('template_url') . '/assets/css/main.css', array(), C80_THEME_VERSION, 'screen' );
	
	// //tipografías
	// wp_enqueue_style( 'c80-letras', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic|Oswald:400,300', C80_THEME_VERSION, 'screen' );

	//iconos
	wp_enqueue_style( 'c80-iconos', get_bloginfo('template_url') . '/assets/vendor/font-awesome/css/font-awesome.min.css', C80_THEME_VERSION, 'screen' );
}
