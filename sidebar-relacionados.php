
		<?php 
		$c80public = new c80_Public('c80', '1.0.0');
		$relacionados = $c80public->c80_relart($post->ID);
			if($relacionados) {
				echo '<aside class="navegador-relacionados">';
				echo '<h4><i class="fa fa-code-fork"></i> Relacionados</h4>';
				echo '<ul>';
				foreach( $relacionados as $relacionado ) {
					$ptype = get_post_type_object( get_post_type($relacionado) );
					echo '<li>';
					echo '<span>' . $ptype->labels->name . '</span>';
					echo '<h5><a href="' . get_permalink($relacionado) . '">' . get_the_title($relacionado) . '</a></h5>';
					echo '</li>';
				}
				echo '</ul>';
				echo '</aside>';
			};
			?>
