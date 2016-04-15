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

		//Ver de donde viene el párrafo
		var closest = $(this).closest('.article-info-holder');
		console.log(closest);
		var chapter = closest.data('chaptername');
		var article = closest.data('articlenumber');
		var parno = parseInt(order) + 1;

		$('#c80_paragraph_link').modal('show');
		$('p.urlplaceholder').empty().append(rlink);
		$('textarea.linkplaceholder').empty().text('<a href="' + rlink + '" title="C80">Constitución 1980: ' + chapter + ' > ' + article + ' > Párrafo Nº ' + parno + '</a>');
		$('h4#linkparrafomodal').empty().append('<strong>' + chapter + '</strong> &gt; ' + article + ' &gt; Párrafo Nº ' + parno );
		$('textarea.linkplaceholder').on('click', function() {
			$(this).select();
		})
	});

	//4. Mostrar link embed HTML
	// $('.loadembedhtml').on('click', function() {
	// 	$('#c80_article_link').modal('show');
	// 	$('#c80_embedcodetextarea').on('click', function() {
	// 		$(this).select();
	// 	})
	// });

	$('.loadembedhtml').on('click', function() {
		var target = $(this).attr('data-target');
		var id = $(this).attr('data-id');
		console.log('target');
		$(target).modal('show');
		$('#c80_embedcodetextarea-' + id).on('click', function() {
			$(this).select();
		})
	});

});