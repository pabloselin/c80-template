<?php

function c80t_avatar($size) {
	global $post;
	$authorid = get_the_author_meta( 'ID' );
	$avatar = get_avatar($authorid, $size);
	return $avatar;
}

function c80t_add_custom_user_profile_fields( $user ) {
	$output = '<h3>Información adicional</h3>';
	$output .= '<table class="form-table"><tr>';
	$output .= '<th><label for="author_bio">Biografía</label></th>';
	$output .= '<td><textarea rows="7" name="author_bio" id="author_bio" class="regular-text"/>' . esc_textarea( get_the_author_meta('author_bio', $user->ID )) . '</textarea> <br> </td>';
	$output .= '<span class="description">Escribe una biografía o reseña del autor / usuario más extendida.</span></td>';
	$output .= '</tr></table>';

	echo $output;
}

function c80t_save_custom_user_profile_fields( $user_id ) {
	if (!current_user_can('edit_user', $user_id ) )
			return FALSE;
	$info = $_POST['author_bio'];
	$cleanoutput = sanitize_text_field( $info );
	update_user_meta( $user_id, 'author_bio', $info );
}

add_action('show_user_profile', 'c80t_add_custom_user_profile_fields');
add_action('edit_user_profile', 'c80t_add_custom_user_profile_fields');
add_action('personal_options_update', 'c80t_save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'c80t_save_custom_user_profile_fields');