$(document).ready(function(){
    $('span.stat').each(function(){
        var statElement = $(this), statUrl = '/stats/get/';
        if(statElement.data('target'))
            statUrl += statElement.data('target') +'/';
        if(statElement.data('filter'))
            statUrl += statElement.data('filter').replace(/[=]/g,'><');

        $.ajax({
            'url' : statUrl,
            'success' : function (res){
                if(res.status === 1){
                    statElement.html(res['result']['count']);
                }else {
                    statElement.html('00');
                    statElement.addClass('error');
                    console.error(res);
                }
            },
            'error' : function(xhr,stt,err){
                statElement.html('00');
                statElement.addClass('error');
                console.error(xhr.responseText);
                console.error(err);
            }
        })
    })
})