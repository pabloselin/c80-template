var timeline;
var timelineObj;
var fases = ['fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5'];

jQuery(document).ready(function($) {
    

    $('body').scrollspy({ target: '#timeline-nav'});

    $('.toggle-timeline, .gotophase, .gotophase-mobile').on('click', function(e) {
      e.preventDefault();
      var fase = $(this).attr('data-fase');
      var nextfase = $(this).attr('data-nextfase');  
      jQuery('body').addClass('timeline-on');
      $('#timeline-js-container').empty().append('<div class="loadingZone"><i class="fa fa-spin fa-circle-o-notch"></i></div>');
      var timeline = window.setTimeout(function(){ startTimeline(fase, nextfase); }, 1000);
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

    $('.toggle-timeline-nav, a.faselink').on('click', function(e) {
        $('.fases-nav-home').toggleClass('active');
    })

});

function startTimeline(fase, nextfase) {
    var last;
    jQuery.getJSON(c80.timelineurl, function(data) {
        timelineObj = new TL.Timeline('timeline-js-container', data[fase], {
            language: 'es',
            hash_bookmark: false,
            group_order: ['Constitucional', 'Político social', 'Presidencial']
        });
        //console.log(data);
        var events = data[fase].events;
        var lastSlide = timelineObj.getSlide(events.length - 1);
        console.log(lastSlide.data);
        
        last = data[fase].lastevent;
        timelineObj.on("change", function(data) {
           
            if(data.unique_id == lastSlide.data.unique_id) {
                console.log(nextfase);
                var next = $('section.presentacion-fase[data-fase="' + nextfase + '"]').attr('id');

                if(next) {
                    jQuery('.tl-storyslider').append('<a class="btn-nextphase" data-toggle="nextphase" href="#' + next + '"><i class="fa fa-angle-right"></i></a>')
                }
            } else {
                jQuery('.tl-storyslider .btn-nextphase').remove();
            }
       });
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

function nextPhase(fases, fase) {
    nextphase = false;

    for(var i = 0; i < fases.length; i++) {
                if(fases[i] == fase) {
                    if(fases[i + 1] !== undefined) {
                        nextphase = fases[i+1];
                    }
                } 
            }
    return nextphase;
}