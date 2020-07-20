<?php
//scripts loader

// Async load
function c80_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'c80_async_scripts', 11, 1 );

function c80t_scripts() {
	if(!is_admin()) {
		wp_deregister_script( 'jquery' );
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1', false);
		if(is_page_template('c80-timeline.php')):
			wp_enqueue_script( 'timelinejs', get_bloginfo('template_url') . '/assets/js/c80-timeline.js', array('zingtouch'), '3.6.6?mod=c80', false );
			wp_enqueue_script( 'zingtouch', 'https://cdnjs.cloudflare.com/ajax/libs/zingtouch/1.0.6/zingtouch.min.js#asyncload', array(), '1.0.6', false);
			//wp_enqueue_script('sanitize-title', get_bloginfo('template_url') . '/assets/js/sanitize-title.js ', array(), C80_THEME_VERSION, false);
		endif;
		if(WP_ENV == 'development') {
			$c80script = 'c80.js';	
		} else {
			$c80script = 'c80.min.js#asyncload';
		}

		wp_register_script('c80js', get_bloginfo('template_url') . '/assets/js/' . $c80script , array('jquery'), C80_THEME_VERSION, false);
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('c80js');
		wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/269614ad84.js#asyncload', array(), '4.7.0', true);
		wp_localize_script( 'c80js', 'c80', array(
												'timelineurl' => get_bloginfo('url') . '/wp-json/constitucion1980/v1/linea-de-tiempo',
												'timelinehitosfases' => c80_timelinehitosfases()
											) );		
	}
	
	
}


function c80_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_enqueue_scripts', 'c80_remove_wp_block_library_css' );

function c80t_styles() {
	//wp_enqueue_style( 'bootstrap', get_bloginfo('template_url') . '/assets/vendor/bootstrap/dist/css/bootstrap.css', array(), C80_THEME_VERSION, 'screen' );
	wp_enqueue_style( 'c80-theme', get_bloginfo('template_url') . '/assets/css/main.css', array(), C80_THEME_VERSION, 'screen' );
	
	// //tipografías
	wp_enqueue_style( 'c80-tipografias', 'https://fonts.googleapis.com/css?family=Merriweather:400,400i,700|Lato:400,400i,700&display=swap', array(), false, 'screen' );

	//iconos
	//wp_enqueue_style( 'c80-iconos', get_bloginfo('template_url') . '/assets/vendor/font-awesome/css/font-awesome.min.css', C80_THEME_VERSION, 'screen' );
	// if(is_page_template('c80-timeline.php')):
	// 	wp_enqueue_style( 'timelinecss', 'https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css', array( ), false, 'screen' );
	// endif;
}

//actions
add_action( 'wp_enqueue_scripts', 'c80t_scripts' );
add_action( 'wp_enqueue_scripts', 'c80t_styles' );
