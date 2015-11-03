<?php
//content stuff

function c80t_articulos() {
	//Devuelve un listado de los artículos del tipo de post de constitución
	
	//Primer nivel
	$args = array(
		'post_type' => 'c80_cpt',
		'numberposts' => 100,
		'post_parent' => 0,
		'orderby' => 'menu_order',
		'order' => 'ASC'
		);

	$capitulos = get_posts($args);
	
	$items = '';
	

	foreach($capitulos as $capitulo) {
		$capitems = '';		
		$capitems .= '<a class="capitulo-lista" href="'.get_permalink($capitulo->ID).'">' . get_the_title($capitulo->ID) . ': ' .  c80t_captitle($capitulo->ID) .'</a>';

		//Segundo nivel
		$args = array(
			'post_type' => 'c80_cpt',
			'numberposts' => 100,
			'post_parent' => $capitulo->ID,
			'orderby' => 'menu_order',
			'order' => 'ASC'
			);
		
		$articulos = get_posts($args);
		
		$artitems = '';
		
		foreach($articulos as $articulo) {
			//Tercer nivel, si es que hay tercer nivel se desactiva el link en el segundo nivel.
			$args = array(
				'post_type' => 'c80_cpt',
				'numberposts' => 100,
				'post_parent' => $articulo->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC'
				);
			$children = get_posts($args);
			if($children) {
				$artitems .= '<li class="art-section">' . $articulo->post_title;

				$artitems .= '<ul class="articulos">';
				foreach($children as $child):
					$artitems .= '<li class="subart"><a href="' . get_permalink($child->ID) . '" class="articulo-lista">' . $child->post_title . '</a></li>';
				endforeach;
				$artitems .= '</ul></li>';

			} else {
				$artitems .= '<li><a href="' . get_permalink($articulo->ID) . '" class="articulo-lista">' . $articulo->post_title . '</a></li>';	
			}
			

		}

		$items .= '<li>' . $capitems .  '<ul class="articulos">' . $artitems . '</ul></li>';
	
	}

	$output = '<ul class="items-constitucion">' . $items . '</ul>';

	return $output;
}

function c80t_capitulos() {

}

function c80t_parentname($postid, $en_capitulo = false) {
	$ancestors = get_post_ancestors( $postid );
	if($ancestors && !$en_capitulo) {
		$name = get_the_title($ancestors[0]);
		$subname = c80t_captitle($postid);

		$fullname = $name . ': '. $subname;
		return $fullname;
	}	
}

function c80t_captitle($postid) {
	/**
	 * Devuelve el nombre del capítulo desde un capítulo o desde un artículo
	 */
	$ancestors = get_post_ancestors( $postid );
	if($ancestors) {
		$subt = get_post_meta($ancestors[0], 'c80_subtartcap', true);
	} else {
		//es de nivel superior o sea está en un capítulo...
		$subt = get_post_meta($postid, 'c80_subtartcap', true);
	}

	return $subt;
}

function c80t_template_loader($template, $data) {
	/**
	 * Cargador de plantillas incluyendo variables
	 */

	ob_start();
	
	extract($data);
	
	include( locate_template( sprintf('%s.php', $template) ) );

	return ob_get_clean();

}

function c80t_run_frontpage() {
	/**
	 * Crea un loop para los menús
	 */
	$items = c80t_getmenus('portada');
	//si tengo items creo un arreglo con los ids
	if($items) {
		foreach($items as $item) {
			$ids[] = $item->object_id;
		}
	
	$args = array(
		'post__in' => $ids,
		'orderby' => 'post__in'
		);
	$query = new WP_Query($args);
	return $query;
	}
}

function c80t_get_columnas($numberposts = 3) {
	/**
	 * Devuelve las últimas columnas
	 */
	$args = array(
		'post_type' => 'columnas',
		'posts_per_page' => $numberposts
		);
	$query = new WP_Query($args);
	return $query;
}

function c80t_run_columnas() {
	/**
	 * Crea un loop para las columnas
	 */
	$items = c80t_getmenus('columnas');
	//si tengo items creo un arreglo con los ids
	if($items) {
		foreach($items as $item) {
			$ids[] = $item->object_id;
		}
	
	$args = array(
		'post_type' => 'columnas',
		'post__in' => $ids,
		'orderby' => 'post__in'
		);
	$query = new WP_Query($args);
	return $query;
	}
}

function c80t_getmenus($menu) {
	/**
	 * Obtiene items de un objeto de menú
	 */
		$menuobject = c80t_getmenuobject($menu);
		if($menuobject) {
		//Si tengo un objeto menú me devuelve el objeto y empiezo a recolectar items
			$items = wp_get_nav_menu_items( $menuobject->term_id );
			return $items;
		} else {
			//Si no hay hago un llamado independiente por sección
			return false;
		}
}

function c80t_getmenuobject($location) {
	/**
	 * Obtiene el menú desde una ubicación escogida
	 */
	if( ( $locations = get_nav_menu_locations() ) && isset($locations[$location]) ){
		$menu = wp_get_nav_menu_object( $locations[$location] );
		return $menu;
	} else {
		return false;
	}
}



function c80t_comments_fields( $fields ) {
	$fields['url'] = '';
	return $fields;
}

add_filter('comment_form_default_fields', 'c80t_comments_fields');


function c80t_default_post_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr) {
	/**
	 * Añade imagen por defecto en caso de que no haya
	 */

	$id = get_post_thumbnail_id(); // gets the id of the current post_thumbnail (in the loop)
    $src = wp_get_attachment_image_src($id, $size); // gets the image url specific to the passed in size (aka. custom image size)
    $alt = get_the_title($id); // gets the post thumbnail title
    if(is_array($attr) && isset($attr['class'])) {
    	$class = $attr['class']; // gets classes passed to the post thumbnail, defined here 	
    } else {
    	$class = 'post-image';
    }
    
    $defaultsrc = get_bloginfo('template_url') . '/assets/img/placeholder-' . $size . '.png';

    if(has_post_thumbnail( $post_id )) {
    	$html = '<img src="' . $src[0] . '" alt="' . $alt . '" class="' . $class . '" />';
    } else {
    	$html = '<img src="' . $defaultsrc . '" alt="' . get_the_title($post_id) . '" class="placeholder">';
    }

    return $html;
}

add_filter('post_thumbnail_html', 'c80t_default_post_thumbnail', 99, 5);

function c80t_temas() {
	$args = array(
		'hide_empty' => 1,
		'exclude' => 1
		);
	$temas = get_categories( $args );
	$output = '';
	foreach($temas as $tema) {
		$output .= '<li><a class="cats" href="' . get_category_link($tema->term_id) .'">' . $tema->name . '</a></li>';
	}

	$html = '<div class="temas-header">
		<div class="container"><div class="row"><div class="col-md-12"><ul>' . $output . '</ul></div></div></div>
	</div>';

	return $html;
}

function c80t_twitter() {
	$baseurl = 'https://twitter.com/' . C80_TWITTER;
	return $baseurl;
}

function c80t_analytics() {
	echo "<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-68598243-1', 'auto');
	  ga('send', 'pageview');

	</script>";
}

add_action('wp_head', 'c80t_analytics');