<?php 
//standard index para vista de artículos
	get_header();
?>

<div id="main" class="container">
	<section class="contenedor-estandar">
		
		
		
		<article class="articulo-constitucion">
        <?php 
            $notfoundpage = get_page(C80_NOTFOUND);
        ?>


			<header>
				
				<h1><?php echo $notfoundpage->post_title;?></h1>
		
			</header>
		
			<div class="main-content">

                <?php echo apply_filters('the_content', $notfoundpage->post_content);?>

            </div>
		
		</article>


	</section>
</div>

<?php
	get_footer();
?>