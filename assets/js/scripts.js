//Main scripts
jQuery(document).ready(function($) {
	//Inicializar

	//1. Tooltip
	$('a[data-toggle="tooltip"]').tooltip();
	
	var c80Rel = $('a.showC80Rel');
	var c80Loader = $('aside.cargador-articulos');
	var stdarticle = $('section.contenedor-estandar')


	c80Rel.on('click', function() {
		if($(this).hasClass('active')) {
			c80Loader.removeClass('enabled').addClass('disabled');
			stdarticle.removeClass('con-c80-rel');
			$(this).removeClass('active');
		} else {
			c80Loader.removeClass('disabled').addClass('enabled');
			stdarticle.addClass('con-c80-rel');
			$(this).addClass('active');
		}
	});
});