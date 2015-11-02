<?php

function c80t_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">';
}

add_action('wp_head', 'c80t_viewport');