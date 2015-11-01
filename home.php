<?php 
//frontpage
	get_header();

?>


<div id="main" class="container">
	<div class="contenedor-home">
		
		<section class="noticias">
		
			<div class="rm">
		
		<?php
				$homeitems = c80t_run_frontpage();
				$key = 0;
				while( $homeitems->have_posts() ): $homeitems->the_post();
					$key++;
					if($key == 1) {
						$size = 'main';
						$hs = '<h1>';
						$he = '</h1>';
					} else {
						$size = 'secondary';
						$hs = '<h2>';
						$he = '</h2>';
					}
					
					?>
				
					<article <?php post_class('item-' . $key );?> >
						
						<div class="pad">
							<div class="img">
								
									<a href="<?php the_permalink();?>">
										<?php the_post_thumbnail( $size );?>
									</a>
								
								<div class="top-info">
									<div class="over-title">
										<?php the_category( ', ' );?> |	<?php the_time( get_option( 'date_format' ) );?>
									</div>
									<?php echo $hs;?>
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
									<?php echo $he;?>
									
									<p class="autor">
										<?php the_author( );?>
									</p>

								</div>
							</div>
							
							
								
								<div class="excerpt">
									<?php the_excerpt();?>
								</div>

							
							
							
							
							<div class="bottom-meta">
								
								<p class="related">
											<?php echo c80t_relink($post->ID);?>
								</p>
							
								<p class="temas">
									<?php the_tags( '<span class="nrel"><i class="fa fa-tags"></i> </span>', ' ' );?>
								</p>	
							
							</div>
						</div>
						
					</article>
				
			
						<?php
					wp_reset_postdata();
				endwhile;
				?>

			</div>


		</section>

		<section class="opinion">
			<h2 class="opsect">Opinión</h2>
			<div class="pad">
			
				
				<?php 
					$columnas = c80t_get_columnas(5);
					while($columnas->have_posts() ): $columnas->the_post();?>
				
					<article class="columna">
						
						<div class="avatar">
							<?php echo c80t_avatar(70);?>
						</div>

						<div class="top-meta">
							<p class="cats"><?php the_category( ', ' );?></p>
						</div>
				
						<h3>
							<a href="<?php the_permalink();?>"><?php the_title();?></a>
						</h3>
						<p class="autor"><?php the_author( );?>
							<?php if(get_the_author_meta('author_org')):?>
								- <?php the_author_meta('author_org');?></p>
							<?php endif;?>
						<div class="excerpt">
							<?php the_excerpt();?>
						</div>
						<div class="bottom-meta">
							
							<p class="citas">
								<?php echo c80t_relink($post->ID);?>
							</p>
						
						</div>
					</article>
					
				
					<?php 
					wp_reset_postdata();
					endwhile; 
				?></div>
		</section>

	</div>

	<div class="ancho-home">
		<section class="map">
			
		</section>
	</div>
</div>

<?php
	get_footer();
?>