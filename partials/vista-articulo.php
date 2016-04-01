<?php 

//Necesario por el modo de inclusión
global $post;

?>
<div class="grupo-articulo">
	<article id="articulo-<?php echo $post->ID;?>" class="articulo-constitucion">
			
				<div>
					<header>
						
						<h1><i class="fa fa-file-text-o"></i> <?php echo c80t_parentname($post->ID, $en_capitulo);?> <?php the_title();?></h1>
						
							<p class="temas">
								<?php the_tags('<span class="nrel"><i class="fa fa-tags"></i></span>', ' ');?>
							</p>
							
							<?php get_template_part('partials/modal-c80embed');?>
						
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
								'orderby' => 'menu_order',
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
	
	
			<?php include( TEMPLATEPATH . '/sidebar-relacionados.php');?>
			
	</aside>
</div>