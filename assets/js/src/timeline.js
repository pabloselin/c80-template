jQuery(document).ready(function($) {
	var timeline;
        var timelineObj;
        var curFase;
        var fases = ['fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5'];

        $('.toggle-timeline').on('click', function(e) {
              e.preventDefault();
              var fase = $(this).attr('data-fase');  
              jQuery('body').addClass('timeline-on');
              $('#timeline-js-container').empty().append('<div class="loadingZone"><i class="fa fa-spin fa-circle-o-notch"></i></div>');
              var timeline = window.setTimeout(function(){ timelineObj = startTimeline(fase); }, 1000);
              curFase = fase;

                //console.log(timeoutID);     
                console.log(curFase);
                // timeline.on('change', function(data) {
                //         console.log
                //         console.log(data);
                // });
        });

        $('#timeline-active .fase-arrow a').on('click', function(e) {
                $('body').removeClass('timeline-on');
        });

        $('body').on('click', 'a.btn-nextphase', function(e) {
                $('body').removeClass('timeline-on');
        });
});

function startTimeline(fase) {
        jQuery.getJSON(c80.timelineurl, function(data) {
                timeline = new TL.Timeline('timeline-js-container', data[fase], {
                        language: 'es',
                        hash_bookmark: false
                });       

                return timeline;
        });



        
}