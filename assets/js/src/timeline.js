jQuery(document).ready(function($) {
	var timeline;
    var timelineObj;
    var fases = ['fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5'];

    $('body').scrollspy({ target: '#timeline-nav'});

    $('.toggle-timeline').on('click', function(e) {
      e.preventDefault();
      var fase = $(this).attr('data-fase');  
      jQuery('body').addClass('timeline-on');
      $('#timeline-js-container').empty().append('<div class="loadingZone"><i class="fa fa-spin fa-circle-o-notch"></i></div>');
      var timeline = window.setTimeout(function(){ timelineObj = startTimeline(fase); }, 1000);
    
        $('#timeline-active ul.fases-main li#navfase-' + fase).addClass('running');    
    });

    $('#timeline-active .fase-arrow a').on('click', function(e) {
        $('body').removeClass('timeline-on');
        $('#timeline-active ul.fases-main li').removeClass('running');

    });

    $('body').on('click', 'a.btn-nextphase', function(e) {
        $('body').removeClass('timeline-on');
        $('#timeline-active ul.fases-main li').removeClass('running');
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

function closest(array, number) {
    var num = 0;
    for (var i = array.length - 1; i >= 0; i--) {
        if(Math.abs(number - array[i].position) < Math.abs(number - array[num].position)){
            num = i;
        }
    }
    return array[num].element;
}
