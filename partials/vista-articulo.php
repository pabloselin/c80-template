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
			<?php 
							/**
							 * Toma subcapítulos
							 */
							$args = array(
								'post_type' => 'c80_cpt',
								'numberposts' => 100,
								'post_parent' => $post->ID,
								'order_by' => 'menu_order',
								'order' => 'ASC'
								);
							$subcap = new WP_Query($args);
							if($subcap->have_posts()):
								while($subcap->have_posts()):
									$subcap->the_post();?>
									
									<div class="sub-article">
										<header>
											<h2 class="subtitle"><?php the_title();?></h2>
										</header>
										<div class="sub-content">
											<?php the_content();?>
										</div>
									</div>

								<?php endwhile;
								wp_reset_postdata();
							endif;
						?>
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