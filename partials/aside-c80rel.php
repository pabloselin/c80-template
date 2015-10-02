<aside class="cargador-articulos disabled">
		<header>
			<h2><i class="fa fa-book"></i> Constitución 1980</h2>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#artrel" aria-controls="artrel" role="tab" data-toggle="tab">Artículos Relacionados <span class="badge"><i class="fa fa-file-text-o"></i> <?php echo c80t_countrels($post->ID);?></span></a></li>
				<li role="presentation"><a href="#c80full" aria-controls="c80full" role="tab" data-toggle="tab">Texto completo</a></li>
			</ul>
		</header>
		<div class="wrap tab-content">
			<div role="tabpanel" class="texto-c80-rel tab-pane fade in active" id="artrel">
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
			<div role="tabpanel" class="textos-c80-mini tab-pane fade" id="c80full">
				<?php 
					echo c80t_constquery();
				?>
			</div>
		</div>
</aside>