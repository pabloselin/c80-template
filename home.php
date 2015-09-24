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
							
							
							<div class="bottom-meta">
								
								<p class="autor">
									Por: <?php the_author( );?>
								</p>
							
								<p class="temas">
									<?php the_tags( 'Etiquetas: ', ', ' );?>
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
			
			<header>
				<h2>Columnas</h2>
				<p class="date">
					<?php echo date_i18n( 'F, Y' );?>
				</p>
			</header>

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