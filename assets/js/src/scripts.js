function singleCounter() {
	//Toma contador Facebook y twitter
        var sharer = jQuery('.social-share');
        var durl = sharer.data('url');
        if(durl){
            var oldurl = durl.replace('https', 'http');
            getFbJson(durl, sharer);
        }
}

function getFbJson(url, sharer) {
    var fbshares = 0;
    var oldurl = url.replace('https', 'http');
    var nsh = 0,
        nsh_old = 0,
        sumsh = 0;
     
    jQuery.getJSON('https://graph.facebook.com/?id=' + url, function(json) {
            //fbshares += json.share.share_count;
            nsh = roundNumber(parseInt(json.share.share_count));        

            jQuery.getJSON('https://graph.facebook.com/?id=' + oldurl, function(json) {
                //fbshares += json.share.share_count;
                nsh_old = roundNumber(parseInt(json.share.share_count));
                sumsh = nsh + nsh_old;
                if(sumsh === 0) {
                    sumsh = '';
                }
                //console.log(nsh_old);
                jQuery('.sharer__facebook', sharer).append(' ').append(sumsh).addClass('with-shares');
            });

        });
}

function roundNumber(number) {
    var nicenumber;
    if(number > 999) {
        var ks = Math.floor(number/1000);
        var cs = Math.floor((number - ks*1000) / 100);
        nicenumber = ks + '.' + cs + 'K';
    } else  {
        nicenumber = number;
    }
    return nicenumber;
}

//Main scripts
jQuery(document).ready(function($) {
	//Inicializar

	var hash = window.location.hash;
	if(hash.length > 0) {
		$('a' + hash).addClass('highlight');	
	}

	//1. Tooltip
	$('a[data-toggle="tooltip"]').tooltip();
	
	var body = $('body');
	var c80Rel = $('a.showC80Rel');
	var c80Loader = $('aside.cargador-articulos');
	var stdarticle = $('section.contenedor-estandar')
	var moreaside = $('aside.standard');

	var c80p = $('a.c80_p');

	// c80p.on('click', function() {
	// 	event.preventDefault();
	// })

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
	
	
	//3. Mostrar link para compartir párrafos
	$('a.c80_p').on('click', function() {
		
		var rlink = $(this).attr('data-link');
		var parid = $(this).attr('data-pid');
		var order = $(this).attr('data-order');

		//Ver de donde viene el párrafo
		var closest = $(this).closest('.article-info-holder');
		
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
		$(target).modal('show');
		$('#c80_embedcodetextarea-' + id).on('click', function() {
			$(this).select();
		})
	});

	$('a.btn-showrel').on('click', function(event) {
		event.preventDefault();
		var dataid = $(this).attr('data-id');
		$('ul.lista-articulos-relacionados[data-id="' + dataid + '"]').fadeToggle();
		$(this).toggleClass('active');
	});

	$('a.toggletemas').on('click', function(event) {
		event.preventDefault();
		var temasheader = $('.temas-header');
		var dropdowntemas = $('.dropdown-temas');


		temasheader.toggleClass('expanded');
		dropdowntemas.toggleClass('visible');

		if($('i', this).hasClass('fa-plus')) {
			$('i', this).removeClass('fa-plus').addClass('fa-times');
		} else {
			$('i', this).removeClass('fa-times').addClass('fa-plus');
		}

	});

	singleCounter();

});