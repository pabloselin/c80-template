<?php
//content stuff

function c80t_articulos() {
	//Devuelve un listado de los artículos del tipo de post de constitución
	
	//Primer nivel
	$args = array(
		'post_type' => 'c80_cpt',
		'numberposts' => 100,
		'post_parent' => 0
		);

	$capitulos = get_posts($args);
	
	$items = '';
	$capitems = '';	

	foreach($capitulos as $capitulo) {

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

function c80t_capitulo() {

}

function c80t_parentname($postid, $en_capitulo = false) {
	$ancestors = get_post_ancestors( $postid );
	if($ancestors && !$en_capitulo) {
		$name = get_the_title($ancestors[0]);
		return $name;	
	}	
}

function c80t_template_loader($template, $data) {
	
	ob_start();
	
	extract($data);
	
	include( locate_template( sprintf('%s.php', $template) ) );

	return ob_get_clean();

}