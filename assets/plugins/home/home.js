$('h4.play.video-modal').on('click',function(){
    $('#video-modal').iziModal({
        'title': 'Introduction of <em>Closet to Cleaners</em>',
        'overlayClose' : true,
        'closeButton' :true,
        'closeOnEscape' :true,
        'headerColor' : '#212060',
        'fullscreen': true,
        'onOpening': function(modal){
            modal.startLoading();
            $.get('/ajax/video_intro', function(data) {
                $('#video-modal .contents').html(data);
                modal.stopLoading();
            });
        },
        'onClosing' : function(modal){
            $('#video-modal .contents').html('');
        }
    }).iziModal('open');
});