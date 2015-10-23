<?php 
/**
 * Breadcrumb
 */
function c80t_breadcrumb() {
	global $post;
	/**
	 * Devuelve el breadcrumb
	 */
	$html = '<div class="breadcrumb">';
	$html .= '<div class="container">';
	$html .= '<div class="c80-breadcrumb">';
    $html .= '<a href="' . get_bloginfo('url') . '">' . '<i class="fa fa-home"></i> Inicio' . '</a>';

    if(is_post_type_archive( )):
        $ptype = get_post_type_object( get_post_type( $post->ID ) );
        $html .= ' <i class="fa fa-angle-right"></i> ' . $ptype->labels->name;
    endif;
    
    if(is_single() ):
    	$ptype = get_post_type_object( get_post_type( $post->ID ) );
    	$ptypelink = get_post_type_archive_link( $ptype->name );
    	$parents = get_post_ancestors( $post->ID );

    	$html .= ' <i class="fa fa-angle-right"></i> <a href="' . $ptypelink . '"> ' . $ptype->labels->name . ' </a>';
    	
    	if($parents) {
    		$parents = array_reverse($parents);
    		foreach($parents as $parent) {
    			$parentlink = get_permalink($parent);
    			$html .= ' <i class="fa fa-angle-right"></i> <a href="' . $parentlink . '"> ' . get_the_title($parent) . ' </a>';
    		}
    	};

    	$html .= '<i class="fa fa-angle-right"></i> ' . $post->post_title;

    endif;

    $html .= '</div>';
	$html .= '</div>';
    $html .= '</div>';

    return $html;
}