

jQuery(function($) { 

function include(scriptUrl) {
    document.write('<script src="'+dir_url + scriptUrl + '"></script>');
}

function init() {
    var content_height = $('.content').outerHeight();
    // var window_width = $(window).width();
    var window_height = $(window).height();
    var adminbar_height;
    if ($('#wpadminbar').length) adminbar_height = $('#wpadminbar').outerHeight()
        else adminbar_height = 0;

    if (window_height >= 900) {
        $('body').removeClass('less900');
    } else {
        $('body').addClass('less900');
    }

    if (!$('html').hasClass('fixed-footer')) {
        if (content_height < window_height-adminbar_height) {
            $('html').addClass('fixed-footer');
        } else {
            $('html').removeClass('fixed-footer');
        }
    }
    $('.footer').show(300);
}

function aload(t){"use strict";t=t||window.document.querySelectorAll("[data-aload]"),void 0===t.length&&(t=[t]);var a,e=0,r=t.length;for(e;r>e;e+=1)a=t[e],a["LINK"!==a.tagName?"src":"href"]=a.getAttribute("data-aload"),a.removeAttribute("data-aload");return t}

$(document).ready(function() {

    setTimeout(function() { init() }, 1);

    aload();
    

    $('body').addClass('loaded');

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

    if ($('.case').length) {
        var title = $('.case__form .form-content__title').text();
        $('.case__form .wpcf7-submit').val(title);
    }
    $('.form-content .wpcf7-list-item-label').html('Согласен с <a href="'+home_url+'/privacy-policy/">политикой конфиденциальности</a>');

    $('.form_addservice-archive .wpcf7-submit').val('Отправить').addClass('btn_reverse');
    $('.js-arch-content__btn_order').click(function(event) {
        $(".form_addservice-archive").removeClass('sh-visible');
        $('.js-arch-content__btn_order').removeClass('hidden');
        $(this).addClass('hidden');
        $(".form_addservice-archive").prependTo($(this).closest('.b-arch-content__btn-wrap'));
        setTimeout(function() { 
            $(".form_addservice-archive").addClass('sh-visible');
        }, 100);
    });

    $('.b-arch-content__btn.btn_more').click(function(event) {
        event.preventDefault();
        $(".form_addservice-archive").toggleClass('sh-visible');
    });


}); // $(document).ready

$(window).resize(init);

});

