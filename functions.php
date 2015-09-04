<?php
//functions.php

define( 'C80_THEME_VERSION', '0.1.0');

include( TEMPLATEPATH . '/includes/scripts.php');
include( TEMPLATEPATH . '/includes/content.php');

add_action('wp_enqueue_scripts', 'c80t_scripts');
add_action('wp_enqueue_scripts', 'c80t_styles');
