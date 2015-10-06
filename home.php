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
							<?php if($key > 1) { ?>
									<div class="top-meta">
										<p class="categoria">
											<?php the_category( ', ' );?>
										</p>
									
										<p class="fecha">
											<?php the_time( get_option( 'date_format' ) );?>
										</p>
										
										<p class="related">
											<a href="#">
												<i class="fa fa-file-text-o"></i>
											</a>
										</p>
									</div>
								<?php }?>
							<div class="img">
								<?php if(has_post_thumbnail( )):?>
									<a href="<?php the_permalink();?>">
										<?php the_post_thumbnail( $size );?>
									</a>
								<?php endif;?>
								<?php echo $hs;?>
									<a href="<?php the_permalink();?>"><?php the_title();?></a>
								<?php echo $he;?>	
							</div>
							
							<?php if($key > 1) {?>
								
								<div class="excerpt">
									<?php the_excerpt();?>
								</div>

							<?php }?>
							
							<?php if($key == 1) {?>
								<div class="top-meta">
										<p class="categoria">
											<?php the_category( ', ' );?>
										</p>
									
										<p class="fecha">
											<?php the_time( get_option( 'date_format' ) );?>
										</p>
										
										<p class="related">
											<a href="#">
												<i class="fa fa-file-text-o"></i>
											</a>
										</p>
									</div>
							<?php }?>
							
							<div class="bottom-meta">
								
								<p class="autor">
									Por: <?php the_author( );?>
								</p>
							
								<p class="temas">
									<?php the_tags( '<i class="fa fa-tags"></i> ', ' ' );?>
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
			
			<div class="pad">
			<header>
					<h2>Columnas</h2>
					<p class="date">
						<?php echo date_i18n( 'F, Y' );?>
					</p>
			</header>
				
				<?php 
					$columnas = c80t_get_columnas(3);
					while($columnas->have_posts() ): $columnas->the_post();?>
				
					<article class="columna">
						
						<div class="avatar">
							<?php echo c80t_avatar(70);?>
						</div>

						<div class="top-meta">
							<p class="cats"><?php the_category( ', ' );?></p>
							<p class="autor"><?php the_author( );?></p>
						</div>
				
						<h3>
							<a href="<?php the_permalink();?>"><?php the_title();?></a>
						</h3>
						<div class="bottom-meta">
							
							<p class="citas">
								<i class="fa fa-file-text-o"></i> Artículos citados
							</p>

							<p class="comentarios">
								<i class="fa fa-comments"></i> Comentarios
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