jQuery(function($) { 

function include(scriptUrl) {
    document.write('<script src="'+dir_url + scriptUrl + '"></script>');
}


$(document).ready(function() {

    $('.fancybox').fancybox();

    // $('.js-mreviews').slick({
    //     dots: false,
    //     infinite: true,
    //     slidesToShow: 3,
    //     slidesToScroll: 3,
    //     responsive: [{
    //         breakpoint: 992,
    //         settings: {
    //             slidesToShow: 1,
    //             slidesToScroll: 1,
    //         }
    //     }]
    // });

    $('input[type=tel]').inputmask({
        mask: "+7(999) 999-99-99"
    });

    var location_url = window.location.href;
    $('input[name="url"]').val(location_url);

    function init() {
        var cur_width = $(window).width();
        var cur_height = $(window).height();
        console.log("cur_width", cur_width);
        console.log("cur_height", cur_height);
        if (cur_height >= 900) {
            $('body').removeClass('less900');
        } else {
            $('body').addClass('less900');
        }

        var doc_height = $('html').height();
        var win_height = $(window).height();
        if (doc_height < win_height) {
            // $('.content').css('min-height', $('.content').innerHeight() + win_height - doc_height);
        }
    }

    $(window).ready(init);
    $(window).resize(init);



}); // $(document).ready

});

