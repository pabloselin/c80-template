<?php 

//Necesario por el modo de inclusión
global $post;

?>
<div class="grupo-articulo">
	<article id="articulo-<?php echo $post->ID;?>" class="articulo-constitucion">
			
				<header>
					
					<h1><?php echo c80t_parentname($post->ID, $en_capitulo);?> <?php the_title();?></h1>
			
				</header>
			
				<div class="main-content">
			
					<?php the_content();?>
			
				</div>
			
	</article>
	
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
</div>