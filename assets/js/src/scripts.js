function singleCounter() {
	//Toma contador Facebook y twitter
        var sharer = jQuery('.social-share');
        var durl = sharer.data('url');
        if(durl){
            var oldurl = durl.replace('https', 'http');
            getFbJson(durl, sharer);
        }
}


// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

// We listen to the resize event
window.addEventListener('resize', () => {
  // We execute the same script as before
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
});


function isMobile() {
  var check = false;
  (function(a){
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) 
      check = true;
  })(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};

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