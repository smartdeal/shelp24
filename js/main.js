jQuery(function($) { 

var window_height, document_height;

function include(scriptUrl) {
    document.write('<script src="'+dir_url + scriptUrl + '"></script>');
}

function init() {
    window_width = $(window).width();
    window_height = $(window).height();
    document_height = $(document).height();


    if (window_height < 768) $('body').addClass('h_less768'); else $('body').removeClass('h_less768');
    if (window_height >= 768 && window_height < 960) $('body').addClass('h_less960'); else $('body').removeClass('h_less960');

    var content_height = $('.content').outerHeight();
    // var window_width = $(window).width();
    var adminbar_height;
    if ($('#wpadminbar').length) adminbar_height = $('#wpadminbar').outerHeight()
        else adminbar_height = 0;

    if (!$('html').hasClass('fixed-footer')) {
        if (content_height < window_height-adminbar_height) {
            $('html').addClass('fixed-footer');
        } else {
            $('html').removeClass('fixed-footer');
        }
    }
    $('.footer').show(300);

    if ($('.js-team-about').length){
        if (window_width >= 1200) {
            $.stellar({
                horizontalScrolling: false,
                verticalOffset: 10
            });
        } else {
            $.stellar('destroy');
        }
    }
    if ($('.js-team-about__bg').length){
        if ( window_width >= 1200){
            var w_team_bg = $('.js-team-about').innerWidth();
            var w_clients_bg = $('.js-clients-slider').innerWidth();
            var w_sidebar = $('.sidebar').outerWidth();
            var cur_team_offset = '-'+((window_width - w_sidebar - w_team_bg) / 2)+'px';
            var cur_clients_offset = '-'+((window_width - w_sidebar - w_clients_bg) / 2)+'px';
            $('.js-team-about__bg').css({'margin-left':cur_team_offset,'margin-right':cur_team_offset});
            $('.js-clients-slider__bg').css({'margin-left':cur_clients_offset,'margin-right':cur_clients_offset});
        } else {
            $('.js-team-about__bg').css({'margin-left':0,'margin-right':0});
            $('.js-clients-slider__bg').css({'margin-left':0,'margin-right':0});
        }
    }
}

// Lazy load
function aload(t){"use strict";t=t||window.document.querySelectorAll("[data-aload]"),void 0===t.length&&(t=[t]);var a,e=0,r=t.length;for(e;r>e;e+=1)a=t[e],a["LINK"!==a.tagName?"src":"href"]=a.getAttribute("data-aload"),a.removeAttribute("data-aload");return t}

$(document).ready(function() {


    setTimeout(function() { 
        init();
        $('.js-sidebar__bottom').show(400);
    }, 1);

    aload();
    

    $('body').addClass('loaded');

    $('.fancybox').fancybox();

    if ($('.js-slider-logo').length){
        $('.js-slider-logo').slick({
            dots: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow:"<div class='slick-prev pull-left'></div>",
            nextArrow:"<div class='slick-next pull-right'></div>",
            responsive: [{
                breakpoint: 550,
                settings: {
                    slidesToShow: 2,
                }
            }]
        });
    }

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
        event.preventDefault();
        $(".form_addservice-archive").removeClass('sh-visible');
        $('.js-arch-content__btn_order').removeClass('hidden');
        $(this).addClass('hidden');
        $(".form_addservice-archive").prependTo($(this).closest('.b-arch-content__btn-wrap'));
        setTimeout(function() { 
            $(".form_addservice-archive").addClass('sh-visible');
        }, 100);
    });

    $('.b-arch-content__btn.btn_more').click(function(event) {
        // event.preventDefault();
        // $(".form_addservice-archive").toggleClass('sh-visible');
    });

}); // $(document).ready

$(window).resize(init);


if ($('.js-team-about').length) {
    var team_about_height = $('.js-team-about').height();
    var team_about_offset_top = $('.js-team-about').offset().top;
}

// animate digits on the team-page
var is_team_about_scrolled = false;
$(window).scroll(function() {

    if (!is_team_about_scrolled && $('.js-team-about').length) {
        var scroll = $(window).scrollTop();
        if ( scroll+window_height-team_about_height > team_about_offset_top) {
            is_team_about_scrolled = true;
            $('.js-team-about-num').each(function(index, el) {
                  $({someValue: 0}).animate({someValue: $(el).attr('data-max-num')}, {
                      duration: 2000,
                      easing:'swing', // can be anything
                      step: function() { // called on every step
                          $(el).text(Math.round(this.someValue));
                      }
                  });
            });
        }

    }

});

});

