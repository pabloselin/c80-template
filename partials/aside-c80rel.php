<aside class="c80-rels">
		<header>
			<h2><i class="fa fa-book"></i>  <?php echo c80t_countrels($post->ID);?> Artículos de la constitución relacionados</h2>
		</header>
	
			<div class="textos-c80-mini">
				<?php 
						$rel = rwmb_meta('c80_artrel', 'multiple=true', $post->ID);
						$relpar = rwmb_meta('c80_parraforel', 'multiple=true', $post->ID);

						if($rel && $relpar) {
							foreach($relpar as $relp) {
								echo c80t_pquery($relp);
							}
						}
						elseif($rel){
							foreach($rel as $r){
								echo c80t_artquery($r);	
							}
						}
				?>
			</div>
</aside>