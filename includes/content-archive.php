<?php 
function c80t_archivetitle() {
	$prefix = 'Archivo de ';
	if(is_category()) {
		$title = single_cat_title( $prefix, 'false' );
	} elseif(is_tag()) {
		$title = single_tag_title( $prefix, 'false' );
	} elseif(is_post_type_archive( )) {
		$ptype = get_post_type( );
		$ptypeobj = get_post_type_object( $ptype );
		$title = $prefix . $ptypeobj->labels->name; 
	} elseif(is_tax()) {
		$title = single_term_title( $prefix, 'false' );
	}
	return $title;
}