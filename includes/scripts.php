<?php
//scripts loader

function c80t_scripts() {
	//bootstrap
	wp_enqueue_script( 'bootstrap', get_bloginfo('template_url') . '/assets/vendor/bootstrap/dist/js/bootstrap.js', array(), C80_THEME_VERSION, false );
	wp_enqueue_script( 'c80t-scripts', get_bloginfo('template_url') . '/assets/js/scripts.js', array('bootstrap'), C80_THEME_VERSION, false);
}

function c80t_styles() {
	//wp_enqueue_style( 'bootstrap', get_bloginfo('template_url') . '/assets/vendor/bootstrap/dist/css/bootstrap.css', array(), C80_THEME_VERSION, 'screen' );
	wp_enqueue_style( 'c80-theme', get_bloginfo('template_url') . '/assets/css/main.css', array(), C80_THEME_VERSION, 'screen' );
}
