<?php 
//frontpage
	get_header();

?>


<div id="main" class="container">
	<div class="contenedor-home">

		<div class="featured-section">
			<?php 
				$featured = c80t_run_featured();
				while($featured->have_posts() ): $featured->the_post();
					//Imagen destacada
					$pthid = get_post_thumbnail_id( $featured->ID );
					$pthsrc = wp_get_attachment_image_src( $pthid, 'main' );
				?>

				<article class="featured">

					<div class="pad" style="background-image:url(<?php echo $pthsrc[0];?>);">
						<div class="overlay">
						<div class="top-info">
									<div class="over-title">
										<?php the_time( get_option( 'date_format' ) );?>
									</div>
									<h1>
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
									</h1>
									

						</div>

							<div class="excerpt">
									<?php the_excerpt();?>
							</div>

						</div>
					</div><!--pad-->
				
				</article>

				
				<div class="related-featured">
					<?php get_template_part('partials/aside', 'c80rel-front');?>
				</div>

				<?php
				wp_reset_postdata();
				endwhile;
				?>
		</div>
		
		<section class="noticias">

		<div class="rm">
		
		<?php
				$homeitems = c80t_run_frontpage();
				$key = 0;
				while( $homeitems->have_posts() ): $homeitems->the_post();
					$key++;
					
					$size = 'secondary';
					$hs = '<h2>';
					$he = '</h2>';
					
					
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
							
								<!-- <p class="temas">
									<?php the_tags( '<span class="nrel"><i class="fa fa-tags"></i> </span>', ' ' );?>
								</p> -->	
							
							</div>
						</div>
						
					</article>
				
			
						<?php
					wp_reset_postdata();
				endwhile;
				?>

			</div>


		</section>

		<?php get_template_part('partials/aside-opinion');?>

	</div>

	<div class="ancho-home">
		<section class="map">
			<?php get_template_part('partials/colabora');?>
		</section>
	</div>
</div>

<?php
	get_footer();
?>