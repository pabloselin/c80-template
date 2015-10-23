<aside class="c80-rels">
		<header>
			<h2><i class="fa fa-book"></i>  <?php echo c80t_countrels($post->ID);?> Artículos relacionados</h2>
		</header>
	
			<div class="textos-c80-mini">
				<?php 
						$rel = rwmb_meta('c80_artrel', 'multiple=true', $post->ID);
						//$rel = get_post_meta($post->ID, 'c80_artrel', true);
					
						if($rel){
							foreach($rel as $r){
								echo c80t_artquery($r);	
							}
						}
				?>
			</div>
</aside>