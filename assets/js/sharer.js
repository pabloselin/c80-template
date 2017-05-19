function singleCounter() {
	//Toma contador Facebook y twitter
        var sharer = jQuery('.social-share');
        var durl = sharer.data('url');
        var oldurl = durl.replace('https', 'http');
        var fbshares = 0;
        var twts = 0;
        var nsh = 0;
        console.log('running counter in single with both urls');

        jQuery.getJSON('https://graph.facebook.com/?id=' + durl, function(json) {
            fbshares = +json.share.share_count || 0;
            nsh = roundNumber(parseInt(fbshares));
        });

        jQuery.getJSON('https://graph.facebook.com/?id=' + oldurl, function(json) {
            fbshares = +json.share.share_count || 0;
            nsh += roundNumber(parseInt(fbshares));
        });

        if(nsh != 0)
            jQuery('.sharer__facebook', sharer).append('<span>' + nsh + '</span>').addClass('with-shares');

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