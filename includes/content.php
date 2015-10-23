<?php
//content stuff

function c80t_articulos() {
	//Devuelve un listado de los artículos del tipo de post de constitución
	
	//Primer nivel
	$args = array(
		'post_type' => 'c80_cpt',
		'numberposts' => 100,
		'post_parent' => 0,
		'order_by' => 'menu_order',
		'order' => 'ASC'
		);

	$capitulos = get_posts($args);
	
	$items = '';
	

	foreach($capitulos as $capitulo) {
		$capitems = '';		
		$capitems .= '<a class="capitulo-lista" href="'.get_permalink($capitulo->ID).'">'.$capitulo->post_title.'</a>';

		//Segundo nivel
		$args = array(
			'post_type' => 'c80_cpt',
			'numberposts' => 100,
			'post_parent' => $capitulo->ID,
			'order_by' => 'menu_order',
			'order' => 'ASC'
			);
		
		$articulos = get_posts($args);
		
		$artitems = '';
		
		foreach($articulos as $articulo) {
			$artitems .= '<li><a href="' . get_permalink($articulo->ID) . '" class="articulo-lista">' . $articulo->post_title . '</a></li>';
		}

		$items .= '<li>' . $capitems .  '<ul>' . $artitems . '</ul></li>';
	
	}

	$output = '<ul>' . $items . '</ul>';

	return $output;
}

function c80t_capitulos() {

}

function c80t_parentname($postid, $en_capitulo = false) {
	$ancestors = get_post_ancestors( $postid );
	if($ancestors && !$en_capitulo) {
		$name = get_the_title($ancestors[0]);
		return $name;	
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

function c80t_avatar($size) {
	global $post;
	$authorid = get_the_author_meta( 'ID' );
	$avatar = get_avatar($authorid, $size);
	return $avatar;
}

function c80t_comments_fields( $fields ) {
	$fields['url'] = '';
	return $fields;
}

add_filter('comment_form_default_fields', 'c80t_comments_fields');

function c80t_breadcrumb() {
	/**
	 * Devuelve el breadcrumb
	 */
	$html = '<div class="breadcrumb">';
	$html .= '<div class="container">';
	$html .= '<div class="c80-breadcrumb">';
    $html .= '<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a>';
    $html .= '</div>';
	$html .= '</div>';
    $html .= '</div>';

    return $html;
}

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