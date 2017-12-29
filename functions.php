<?php
//functions.php

define( 'C80_THEME_VERSION', '1.0.7');
define( 'C80_TWITTER', 'proyectoC80');
define( 'C80_FACEBOOK', 'https://www.facebook.com/proyectoC80/');
define( 'C80_INSTAGRAM', 'https://www.instagram.com/proyectoc80/');
define( 'C80_NOTFOUND', 1084);

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


//Image sizes
function c80t_imgsizes() {
	add_image_size( 'main', 668, 0, false );
	add_image_size( 'secondary', 360, 231, true );
	add_image_size( 'single', 730, 0, false );
	add_image_size( 'featured', 360, 360, true );
	add_image_size( 'mini-item', 200, 60, true );
	add_image_size( 'alt-thumbnail', 150, 200, true);
}

add_action( 'after_setup_theme', 'c80t_imgsizes' );

function c80_tags() {
	global $post;
	$tags = get_the_terms( $post->ID, 'post_tag' );
	$count = count($tags);

	if($tags) {
		foreach($tags as $key=>$tag) {
			$ckey = ($key+1 == $count)? 'last' : $key;
			$taglist[] = '<a class="tagp-' . $ckey .  ' tag-' . $key . '" href="' . get_term_link( $tag->term_id, 'post_tag' ) . '">' . $tag->name . '</a>';
		}

		return '<span class="nrel"><i class="fa fa-tags"></i> </span>' . implode(' ', $taglist);
	}
	
}

function c80_url($id) {
	if(get_bloginfo('url') != 'https://c80.cl') {
		$url = str_replace(get_bloginfo('url'), 'https://c80.cl', get_permalink($id));
		return $url;
	} else {
		return get_permalink($id);
	}
}

function c80_paginator($query = NULL) {
	if(!$query) {
		global $wp_query;
	} else {
		$wp_query = $query;
	}
	
	$big = 999999999; // need an unlikely integer
	echo '<nav>';
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 3,
		'type' => 'list'
	) );
	echo '</nav>';
}

function append_browsersync() {
	if(WP_ENV == 'development') {
		?>
			
			<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.13'><\/script>".replace("HOST", location.hostname));
//]]></script>

		<?php
	}
}

add_action('wp_footer', 'append_browsersync');
