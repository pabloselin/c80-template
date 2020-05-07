jQuery(document).ready(function($) {
	console.log('init timeline functions');
	$('a.toggle-timeline').on('click', function(e) {
		e.preventDefault();
		var fase = $(this).attr('data-fase');
		$('.contenedor-timeline').addClass('active');
		$('.presentacion-fase').addClass('hidden');

        $.getJSON(c80.timelineurl, function(data) {
        	
        	timeline = new TL.Timeline('timeline-' + fase, data[fase], {
        		language: 'es',
        		hash_bookmark: true
        		});
        	
        	
        	});
	})

})