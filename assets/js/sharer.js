function singleCounter() {
	//Toma contador Facebook y twitter
        var sharer = jQuery('.social-share');
        var durl = sharer.data('url');
        if(durl){
            var oldurl = durl.replace('https', 'http');
            getFbJson(durl, sharer);
        }
        

        
        
    
            

        // jQuery.getJSON('http://cdn.api.twitter.com/1/urls/count.json?url=' + durl + '&callback=?', function(json) {
        //     twts = +json.count || 0;
        //     ntw = roundNumber(parseInt(twts));
        //     jQuery('.sharer__twitter', sharer).append('<span>' + ntw + '</span>');
        // });
        // //http://www.linkedin.com/countserv/count/share?url=' + url + '&callback=?

        // $.getJSON('http://www.linkedin.com/countserv/count/share?url=' + durl + '&callback=?', function(json) {
        //     linkdin = +json.count || 0;
        //     nln = roundNumber(parseInt(linkdin));
        //     $('.sharer__linkedin', sharer).append('<span>' + nln + '</span>');
        // });
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
                console.log('secondrun');
                //fbshares += json.share.share_count;
                nsh_old = roundNumber(parseInt(json.share.share_count));
                sumsh = nsh + nsh_old;
                //console.log(nsh_old);
                jQuery('.sharer__facebook', sharer).append(' ').append(sumsh).addClass('with-shares');
            });

        });
}

// function sumCounts(sharer) {
//     var sharerfb = jQuery('.sharer__facebook', sharer).attr('data-count');
//     var oldsharerfb = jQuery('.sharer__facebook', sharer).attr('data-oldcount');
//     var newcount = parseInt(sharerfb, 10) + parseInt(oldsharerfb, 10);
//     jQuery('.sharer__facebook', sharer).append(' ').append(newcount).addClass('with-shares');
// }

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