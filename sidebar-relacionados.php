<aside class="navegador-relacionados">
		<?php 
		$c80public = new c80_Public('c80', '1.0.0');
		$relacionados = $c80public->c80_relart($post->ID);
			if($relacionados) {
				echo '<h4>Contenidos relacionados</h4>';
				echo '<ul>';
				foreach( $relacionados as $relacionado ) {
					echo '<li><a href="' . get_permalink($relacionado) . '">' . get_the_title($relacionado) . '</a></li>';
				}
				echo '</ul>';
			};
			?>
</aside>