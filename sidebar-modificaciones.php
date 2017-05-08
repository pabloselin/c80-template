
		<?php 
		$c80public = new c80_Public('c80', '1.0.0');
		$modificaciones = $c80public->c80_checkmod($post->ID);
			if($modificaciones) {
				echo '<aside class="navegador-modificaciones" data-id="' . $post->ID . '">';
				echo '<h4><i class="fa fa-code-fork"></i> Modificaciones</h4>';
				echo '<ul class="lista-articulos-modificados" data-id="' . $post->ID . '">';

				foreach($modificaciones as $modificacion) {

					echo '<li class="rel-mod-item" data-id="' . $modificacion . '">';

					echo '<div class="text">';
                        if(get_post_meta($modificacion, 'c80_modurlexternal', true)):
						    echo '<a target="_blank" href="' . get_post_meta($modificacion, 'c80_modurlexternal', true) . '"><strong>' . get_post_meta($modificacion, 'c80_modnorma', true) . '</strong>' . get_post_meta($modificacion, 'c80_modtxtdesc', true) . '</a>';
						echo '<span class="modtime">' . get_the_time( 'd/m/Y', $modificacion) .'</span>';

                        endif;
					echo '</div>';
					echo '</li>';

				}
					

				echo '</ul>';
				echo '</aside>';
			};
			?>
