<aside class="c80-rels">
		<header>
			<h2><i class="fa fa-book"></i>  <?php echo c80t_countrels($post->ID);?> Artículos de la constitución relacionados</h2>
		</header>
	
			<div class="textos-c80-mini">
				<?php 
						$rels = rwmb_meta('c80_artrel', 'multiple=true', $post->ID);
						$relpar = rwmb_meta('c80_parraforel', 'multiple=true', $post->ID);
						
						$artids = array();
						$plids = array();
						$finnrel = array();
						foreach($relpar as $relp) {
							$ids = explode('-', $relp);
							$artids[] = array(
								'parrafo' => $ids[0], 
								'articulo' => $ids[1]
								);
							$plids[] = $ids[1];
						}

						//Cada uno de los $artids tiene un párrafo
						foreach($rels as $rel) {
							//Si $rel no está en $artids es por que está el artículo pelado
							if(in_array($rel, $plids)) {
								foreach($artids as $artid) {
									//Así evito iteraciones repetidas
									// TODO: hacer que los párrafos relacionados se agrupen en orden por capítulo y artículo
									if(!in_array($artid['parrafo'] . '-' . $artid['articulo'], $finnrel)):
										echo c80t_pquery($artid['parrafo'] . '-' . $artid['articulo']);
										$finnrel[] = $artid['parrafo'] . '-' . $artid['articulo'];
									endif;
								}
							} else {
								echo c80t_artquery($rel);
							}
						}

						
				?>
			</div>
</aside>