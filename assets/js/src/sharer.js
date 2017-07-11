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
                console.log('secondrun');
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