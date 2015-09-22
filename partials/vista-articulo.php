<?php 

//Necesario por el modo de inclusión
global $post;

?>
<div class="grupo-articulo">
	<article id="articulo-<?php echo $post->ID;?>" class="articulo-constitucion">
			
				<div>
					<header>
						
						<h1><i class="fa fa-file-text-o"></i> <?php echo c80t_parentname($post->ID, $en_capitulo);?> <?php the_title();?></h1>
						<div class="meta">
							<?php the_tags('<strong><i class="fa fa-tags"></i> Temas: </strong>');?>
						</div>		
					</header>
								
					<div class="main-content">
								
						<?php the_content();?>
								
					</div>
				</div>
			
	</article>
	
	
			<?php 
				$c80public = new c80_Public('c80', '1.0.0');
				$relacionados = $c80public->c80_relart($post->ID);
					if($relacionados) {
						echo '<aside class="navegador-relacionados">';
						echo '<div>';
						echo '<h4><i class="fa fa-code-fork"></i> Contenidos relacionados</h4>';
						echo '<ul>';
						foreach( $relacionados as $relacionado ) {
							echo '<li><a href="' . get_permalink($relacionado) . '">' . get_the_title($relacionado) . '</a></li>';
						}
						echo '</ul>';
						echo '</div>';
						};
					?>
			
	</aside>
</div>