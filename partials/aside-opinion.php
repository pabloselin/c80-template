<section class="opinion">
			<h2 class="opsect">
				<?php if(!is_home()):?>
					Últimas columnas
				<?php else:?>
					Opinión
				<?php endif;?>
					</h2>
			<div class="pad">
			
				
				<?php 
					$columnas = c80t_run_columnas();
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