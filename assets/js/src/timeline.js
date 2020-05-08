jQuery(document).ready(function($) {
	console.log('init timeline functions');
        if($('.presentacion-fase').attr('data-started') == 1) {
                var fase = $('.presentacion-fase').attr('data-fase');  
                console.log(fase);
                startTimeline(fase);
        };
	$('a.toggle-timeline').on('click', function(e) {
		e.preventDefault();
		var fase = $(this).attr('data-fase');  
                startTimeline(fase);     
        });

});

function startTimeline(fase) {
        jQuery('.contenedor-timeline').addClass('active');
        jQuery('.presentacion-fase').addClass('hidden');    
        jQuery.getJSON(c80.timelineurl, function(data) {
                
                timeline = new TL.Timeline('timeline-' + fase, data[fase], {
                        language: 'es',
                        hash_bookmark: true
                        });
                
                
                });

}