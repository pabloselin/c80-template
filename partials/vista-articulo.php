<?php 

//Necesario por el modo de inclusión
global $post;
$checkmod = c80_Public::c80_checkmod($post->ID);
$checknew = c80_Public::c80_checknew($post->ID);
?>
<div class="grupo-articulo">
	<article id="articulo-<?php echo $post->ID;?>" class="articulo-constitucion <?php if($checkmod): echo 'modarticle mod-' . $checkmod; endif;?> <?php if($checknew): echo 'newarticle'; endif;?>">
			
				<div>
					<header>
						
						<h1 class="article-title"><i class="fa fa-file-text-o"></i> <span class="chaptername"><?php echo c80t_parentname($post->ID, $en_capitulo);?></span> <span class="articlenumber"><?php the_title();?></span></h1>

						<?php if($checknew):
								echo '<span class="badge badge-primary">Artículo añadido el ' . get_the_time( 'd/m/Y', $post->ID ). '</span>';
							endif;?>

						<?php if($checkmod):
								echo '<span class="badge badge-primary">Artículo modificado el ' . get_the_time( 'd/m/Y', $checkmod) .'</span>';
							endif;?>
						
							<p class="temas">
								<?php c80_tags();?>
							</p>
							
							<?php get_template_part('partials/modal-c80embed');?>
						
					</header>
								
					<div class="main-content article-info-holder" data-chaptername="<?php echo c80t_parentname($post->ID, false);?>" data-articlenumber="<?php the_title();?>">
								
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
								//ancestro para el nombre del capítulo
								$ancestor = get_post_ancestors( $subcap->ID );
								$ancestor_title = get_the_title($ancestor[0]) . ': ' . c80t_captitle($ancestor[0]);

								while($subcap->have_posts()):
									$subcap->the_post();
									$checkmod = c80_Public::c80_checkmod($post->ID);
									$checknew = c80_Public::c80_checknew($post->ID);
									?>
									
									<div class="sub-article article-info-holder <?php if($checkmod): echo 'modarticle mod-' . $checkmod; endif;?>" data-chaptername="<?php echo $ancestor_title . ' &gt; ' . c80t_parentname($post->ID, false);?>" data-articlenumber="<?php echo get_the_title($post->ID);?>">
										<header>
											<h2 class="subtitle"><?php the_title();?></h2>
											
											<?php if($checknew):
													echo '<p><span class="badge badge-primary">Artículo añadido el ' . get_the_time( 'd/m/Y', $post->ID ). '</span></p>';
												endif;?>

											<?php if($checkmod):
													echo '<p><span class="badge badge-primary">Artículo modificado el ' . get_the_time( 'd/m/Y', $checkmod) .'</span></p>';
												endif;?>

											<?php include(locate_template('partials/modal-c80embed.php'));?>
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