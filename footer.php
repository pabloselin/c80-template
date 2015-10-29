
<footer id="footer-sitio">
	<div class="container">
		<div class="footer-content">
			
			<div class="footer-column info">
				<img src="<?php bloginfo('template_url');?>/assets/img/logo-c80-footer.png" alt="<?php bloginfo('name');?>">
				<p>Constitución: <br>Lo que dice, nos afecta</p>	
			</div>

			<div class="footer-column menu">
				<ul>
					<li><a href="<?php echo get_permalink(68);?>">sobre el proyecto</a></li>
					<li><a href="https://docs.google.com/document/d/1s2iJIYTWPd1A2vH_-zBdT0B5WD1BLFVoGml9z_4PK74/edit?usp=sharing" target="_blank">¿cómo colaborar?</a></li>
					<li><a href="<?php echo get_permalink(70);?>">contacto</a></li>
					<li><a href="<?php bloginfo('url');?>/noticias">noticias</li>
					<li><a href="<?php echo get_post_type_archive_link( 'columnas' );?>">opinión</a></li>
					<li><a href="<?php echo get_post_type_archive_link( 'c80_cpt' );?>">constitución</a></li>
				</ul>
			</div>

			<div class="footer-column auspicios">
				<p>Con el apoyo de:</p>
				<img src="<?php bloginfo('template_url');?>/assets/img/logo-finlandia.png" alt="Embajada de Finlandia - Santiago Chile">
			</div>

			<div class="footer-licencia">
				<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="<?php bloginfo('template_url');?>/assets/img/cc.png" /></a><br /><a xmlns:cc="http://creativecommons.org/ns#" href="http://www.c80.cl" property="cc:attributionName" rel="cc:attributionURL">C80</a> está bajo una <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licencia Creative Commons Atribución 4.0 Internacional</a>.
			</div>

		</div>
	</div>
</footer>

<?php wp_footer();?>
</body>
</html>