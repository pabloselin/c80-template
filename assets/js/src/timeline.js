var timeline;
var timelineObj;
var fases = ['fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5'];

jQuery(document).ready(function($) {

    customvh();

    var location = window.location;
    var hash = window.location.hash.substr(1);


    console.log(location);

    buildShareLinks(location);

    if(hash) {
        var phasetoLoad = c80.timelinehitosfases[hash];
        if(phasetoLoad !== null && phasetoLoad !== undefined) {
            console.log('starting timeline from hash', phasetoLoad);
            jQuery('body').addClass('timeline-on');
            $('#timeline-js-container').empty().append('<div class="loadingZone"><i class="fa fa-spin fa-circle-o-notch"></i></div>');
            var timeline = window.setTimeout(function(){ startTimeline(phasetoLoad, 'fase_5'); }, 1000);
            //startTimeline(phasetoLoad, 'fase_5');
        }
    }

    $('body').scrollspy({ target: '#timeline-nav'});
    
    $(window).on('activate.bs.scrollspy', function (e) {
        history.replaceState({}, "", $("a[href^='#']", e.target).attr("href"));
        buildShareLinks(location);
    });


    $('.toggle-timeline, .gotophase, .gotophase-mobile, .header-presentacion-fase').on('click', function(e) {
      e.preventDefault();
      var fase = $(this).attr('data-fase');
      var nextfase = $(this).attr('data-nextfase');  
      jQuery('body').addClass('timeline-on');
      $('#timeline-js-container').empty().append('<div class="loadingZone"><i class="fa fa-spin fa-circle-o-notch"></i></div>');
      var timeline = window.setTimeout(function(){ startTimeline(fase, nextfase); }, 1000);
      $('#timeline-active ul.fases-main li#navfase-' + fase).addClass('running');
  });

    $('#timeline-active .fase-arrow a.faselink').on('click', function(e) {
        $('body').removeClass('timeline-on');
        $('#timeline-active ul.fases-main li').removeClass('running');

    });

    $('body').on('click', 'a.btn-nextphase, span.closetimeline', function(e) {
        closeTimeline();
    });



    $('.toggle-timeline-nav, a.faselink').on('click', function(e) {
        $('.fases-nav-home#timeline-nav').toggleClass('active');
    });

    $('a.faselink').on('click', function(e) {
        closeTimeline();
    });

    $(document).keydown(function(e) {
        if(e.which == 39) {
         var next = $('body a.btn-nextphase').attr('href');
         if(next) {
            console.log(next);
            $('body').removeClass('timeline-on');
            $('#timeline-active ul.fases-main li').removeClass('running');
            $('html, body').animate({
                'scrollTop':   $(next).offset().top
            }, 500);
        }
    }
});

    // var zt = new ZingTouch.Region(document.body); 
    
    // $('.presentacion-fase').each( function(e) {    
    //     zt.bind(this, 'swipe', function(e) {

    //         console.log(e.detail.data[0].currentDirection);

    //        var fase = $(this).attr('data-fase');
    //        var nextfase = $(this).attr('data-nextfase');
    //        jQuery('body').addClass('timeline-on');

    //         $('#timeline-js-container').empty().append('<div class="loadingZone"><i class="fa fa-spin fa-circle-o-notch"></i></div>');

    //         var timeline = window.setTimeout(function(){ startTimeline(fase, nextfase); }, 1000);

    //         $('#timeline-active ul.fases-main li#navfase-' + fase).addClass('running');
    //     });
    // });

    if(isMobile()) {
        $(document).click(function(event) { 
            $target = $(event.target);
            console.log($target);
            if(!$target.closest('#timeline-nav').length && 
                $('#timeline-nav').hasClass('active') && !$target.hasClass('toggle-timeline-nav') && !$target.hasClass('fa-bars') && !$target.hasClass('sharer-display') && !$target.hasClass('share-link')) {
                $('#timeline-nav').removeClass('active');
        }        
    });    
    }

    $('.sharer-display').on('click', function() {
        $('.sharers').toggleClass('active');
    });

    $('a.plusc80timeline').on('click', function(e) {
        e.preventDefault();
        $('.extra-info').toggleClass('active');
    });
    

});

function closeTimeline() {
    jQuery('body').removeClass('timeline-on');
    jQuery('#timeline-active ul.fases-main li').removeClass('running');
    restoreMobileTLHeader();
}

function restoreMobileTLHeader() {
    jQuery('div.timeline-mobile-header').removeClass('shownext');
    jQuery('div.nextphase-mobile').removeClass('active');
    jQuery('div.mobile-interaction').empty().append('<span class="closetimeline"><i class="fa fa-times"></i></span>');
}

function startTimeline(fase, nextfase) {
    var last;
    jQuery.getJSON(c80.timelineurl, function(data) {

        if(isMobile()) {
            console.log(isMobile());
            var tloptions = {
                language: 'es',
                hash_bookmark: true,
                group_order: ['Constitucional', 'Político social', 'Presidencial'],
                max_rows: 3,
                timenav_mobile_height_percentage: 25,
                timenav_height_min: 160,
                marker_height_min: 14
            }

        } else {
            var tloptions = {
                language: 'es',
                hash_bookmark: true,
                group_order: ['Constitucional', 'Político social', 'Presidencial'],
                max_rows: 3
            }
        }

        timelineObj = new TL.Timeline('timeline-js-container', data[fase], tloptions);
        //console.log(data);

        var events = data[fase].events;
        var lastSlide = timelineObj.getSlide(events.length - 1);
        var firstSlideHash = timelineObj.getSlide(0).data.unique_id;
      
        var hash = window.location.hash.substr(1);
        var hashfase = c80.timelinehitosfases[hash];

        //console.log(hashfase);
        if(hashfase == undefined) {
            updateHash(firstSlideHash);        
            buildShareLinks(window.location);
        }
        
        
        

        
        last = data[fase].lastevent;

        timelineObj.on("change", function(data) {

            console.log('change');
            hash = data.unique_id;

            updateHash(hash);

            buildShareLinks(window.location);

            if(data.unique_id == lastSlide.data.unique_id) {
                console.log(nextfase);
                var next = $('section.presentacion-fase[data-fase="' + nextfase + '"]').attr('id');
                var nextText = $('#timeline-nav li a[href="#' + next +'"] h1').text();

                if(next) {
                    if(isMobile()) {
                        jQuery('div.timeline-mobile-header').addClass('shownext');
                        jQuery('div.nextphase-mobile').addClass('active');
                        jQuery('div.nextphase-mobile a').attr('href', '#' + next);
                        jQuery('div.nextphase-mobile a span.range').text(': ' + nextText);
                        jQuery('div.mobile-interaction').empty().append('<a class="btn-nextphase" data-toggle="nextphase" href="#' + next + '"><span class="msg">Próximo período</span> <i class="fa fa-angle-right"></i></a>');
                    } else {
                        jQuery('.tl-storyslider').append('<a class="btn-nextphase" data-toggle="nextphase" href="#' + next + '"><i class="fa fa-angle-right"></i></a>');
                    }
                }
            } else {
                jQuery('.tl-storyslider .btn-nextphase').remove();
                restoreMobileTLHeader();
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

function customvh() {
    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
    console.log(vh);
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

function buildShareLinks(location) {
    $('.sharers a').each(function() {
        var shareHref = location.href.replace('#', '%23');
        var shareUrl = $(this).attr('data-base') + shareHref;

        $(this).attr('href', shareUrl);
    });  
}

function updateHash(hash) {
   if(history.pushState) {
    history.pushState(null, null, '#' + hash);
} else {
    location.hash = '#' + hash;
}
}