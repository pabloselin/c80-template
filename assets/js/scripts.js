//Main scripts
jQuery(document).ready(function($) {
	//Inicializar

	//1. Tooltip
	$('a[data-toggle="tooltip"]').tooltip();
	
	var body = $('body');
	var c80Rel = $('a.showC80Rel');
	var c80Loader = $('aside.cargador-articulos');
	var stdarticle = $('section.contenedor-estandar')
	var moreaside = $('aside.standard');

	var c80p = $('a.c80_p');

	c80p.on('click', function() {
		event.preventDefault();
	})

	c80Rel.on('click', function() {
		if($(this).hasClass('active')) {
			c80Loader.removeClass('enabled').addClass('disabled');
			stdarticle.removeClass('con-c80-rel');
			$(this).removeClass('active');
			moreaside.removeClass('disp');

		} else {
			c80Loader.removeClass('disabled').addClass('enabled');
			stdarticle.addClass('con-c80-rel');
			$(this).addClass('active');
			moreaside.addClass('disp');
		}
	});

	
	singleCounter();

	
	
	//3. Mostrar link para compartir párrafos
	$('.c80_p').on('click', function() {
		var rlink = $(this).attr('data-link');
		var parid = $(this).attr('data-pid');
		var order = $(this).attr('data-order');

		$('#c80_paragraph_link').modal('show');
		$('p.linkplaceholder').empty().append(rlink);
		$('span.c80pno').empty().append(parseInt(order) + 1);
	})

});