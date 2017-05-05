
		<?php 
		$c80public = new c80_Public('c80', '1.0.0');
		$modificacion = $c80public->c80_checkmod($post->ID);
			if($modificacion) {
				echo '<aside class="navegador-modificaciones" data-id="' . $post->ID . '">';
				echo '<h4><i class="fa fa-code-fork"></i> Modificaciones</h4>';
				echo '<ul class="lista-articulos-modificados" data-id="' . $post->ID . '">';

					echo '<li class="rel-mod-item" data-id="' . $modificacion . '">';

					echo '<div class="text">';
                        if(get_post_meta($modificacion, 'c80_modurlexternal', true)):
						    echo '<a href="' . get_post_meta($modificacion, 'c80_modurlexternal', true) . '">' . get_post_meta($modificacion, 'c80_modtxtdesc', true) . '</a>';
                        endif;
					echo '</div>';
					echo '</li>';

				echo '</ul>';
				echo '</aside>';
			};
			?>
