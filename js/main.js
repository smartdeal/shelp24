jQuery(function($) { 

var window_width, window_height, document_height, footer_h;

function include(scriptUrl) {
    document.write('<script src="'+dir_url + scriptUrl + '"></script>');
}

// Lazy load
function aload(t){"use strict";t=t||window.document.querySelectorAll("[data-aload]"),void 0===t.length&&(t=[t]);var a,e=0,r=t.length;for(e;r>e;e+=1)a=t[e],a["LINK"!==a.tagName?"src":"href"]=a.getAttribute("data-aload"),a.removeAttribute("data-aload");return t}

function preinit() {
    aload();
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
    if ($('.js-result-slider').length){
        $('.js-result-slider').slick({
            dots: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow:"<div class='slick-prev pull-left'></div>",
            nextArrow:"<div class='slick-next pull-right'></div>",
        });
    }    
}
function init() {
    window_width = $(window).width();
    window_height = $(window).height();
    document_height = $(document).height();
    footer_h = $('.js-footer').outerHeight();

    if (window_height < 600) $('body').addClass('h_less600'); else $('body').removeClass('h_less600');
    if (window_height >= 600 && window_height < 768) $('body').addClass('h_less768'); else $('body').removeClass('h_less768');
    if (window_height >= 768 && window_height < 960) $('body').addClass('h_less960'); else $('body').removeClass('h_less960');
    if (window_width < 768) $('body').addClass('w_less768'); else $('body').removeClass('w_less768');
    if (window_width < 992) $('body').addClass('w_less992'); else $('body').removeClass('w_less992');

    var content_height = $('.content__inner').outerHeight();
    var adminbar_height = 0;
    if ($('#wpadminbar').length) adminbar_height = $('#wpadminbar').outerHeight();

            // console.log("adminbar_height", adminbar_height);
            // console.log("window_height", window_height);
            // console.log("content_height", content_height);

    if ((content_height < window_height-adminbar_height-footer_h) && !$('body').hasClass('h_less600')) {
        $('html').addClass('fixed-footer');
    } else {
        $('html').removeClass('fixed-footer');
    }

    if ($('.content__inner_front').length && !$('body').hasClass('w_less992')){
        var content_max_h = window_height - footer_h - adminbar_height;
        $('.portfolio__item').css({'padding-bottom':0,'height':content_max_h/3});
    }

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

$(document).ready(function() {
    preinit();
    setTimeout(function() { 
        init();
        $('.js-sidebar__bottom').show(0);
    }, 1);
    
    $('.preloader').animate({
        opacity: 0,
      }, 1500, function() {
        $('.preloader').hide();
        $('.layout-main').animate({
            opacity: 1,
          }, 500, function() {
          });
        $('body').addClass('loaded');
      });

    $('.fancybox').fancybox();

    $('input[type=tel]').inputmask({
        mask: "+7(999) 999-99-99"
    });

    var location_url = window.location.href;
    $('input[name="url"]').val(location_url);

    if ($('.case').length) {
        var title = $('.case__form .form-content__title').text();
        $('.case__form .wpcf7-submit').val(title);
    }
    $('.form-content .policy .wpcf7-list-item-label').html('Согласен с <a href="'+home_url+'/privacy-policy/">политикой конфиденциальности</a>');

    $('.form_addservice-archive .wpcf7-submit').val('Отправить').addClass('btn_reverse');

    $('.form_addservice-archive .wpcf7-submit').click(function(event) {
        var $form = $(this).closest('form');
        setTimeout(function() { 
            $form.find('.wpcf7-response-output').hide();
        }, 5000);
    });

    $('.js-arch-content__btn_order').click(function(event) {
        event.preventDefault();
        $('.form_addservice-archive').removeClass('sh-visible');
        $('.js-arch-content__btn_order').removeClass('hidden');
        $(this).addClass('hidden');
        $('.form_addservice-archive').prependTo($(this).closest('.b-arch-content__btn-wrap'));
        setTimeout(function() { 
            $('.form_addservice-archive').addClass('sh-visible');
        }, 100);
    });

    $('.js-btn-get-offer').click(function(event) {
        event.preventDefault();
        $('.form-get-offer').toggleClass('opened');
    });

    $('.js-form-get-offer-close').click(function(event) {
        event.preventDefault();
        $('.form-get-offer').removeClass('opened');
    });

    $(".wpcf7").on('wpcf7mailsent', function(event){
        var forms = ['517', '193'];
        if ( forms.indexOf(event.detail.contactFormId) != -1 ) {
            if ($('.js-form-sent-ok').length){
                $('.js-form-sent-ok').fadeIn('slow');
            }
        }
    });

    // document.addEventListener( 'wpcf7submit', function( event ) {
    //         alert( "The contact form ID is 123." );
    //         // do something productive
    //     }
    // }, false );

    $('.js-team-call-boss').click(function(event) {
        event.preventDefault();
        var $fboss = $('.js-team-form-boss');
        if ($fboss.hasClass('active')) {
            $fboss.removeClass('active');
            $('.js-team-item-boss').css({'margin-bottom':''});
        } else {
            var h_item = $('.js-team-item-boss').outerHeight();
            var h_form = $('.js-team-form-inner').outerHeight()+50;
            $('.js-team-item-boss').css({'margin-bottom':h_form+'px'});
            $fboss.css({'top':h_item+'px'}).addClass('active');
        }

    });

    $('.link-ajax').click(function(event) {
        event.preventDefault();
        var cur_link = $(this).attr('href');
        console.log('click', -document_height);
        console.log('state', history.state);

        $('#js-content')
            .css('top',-document_height+'px')
            .load('http://seohelp.the4mobile.com/wp-content/themes/seohelp/ajax.php?link='+cur_link, function() {
                history.pushState({param: 'Value'}, '', cur_link);
                console.log( "Load was performed." );
                $(this).css('top','0');
                preinit();
                init();
            });
            // .css('display','none')
            // .css('top',-window_height+'px')
            // .css('display','block')
    });

    if ($('.js-portfolio-grid').length) {
        console.log("js-portfolio-grid");
        var $portfolio_grid = $('.js-portfolio-grid').isotope({
            itemSelector: '.portfolio__item',
            percentPosition: true,
            layoutMode: 'fitRows',
            fitRows: {
                columnWidth: '.portfolio__item-sizer'
            }
        });

        $('.js-portfolio-btn').click(function(event) {
            var filterValue = $( this ).attr('data-filter');
            if (!$('html').hasClass('fixed-footer')) {
                $('.js-footer').hide();
            }
            $portfolio_grid.isotope({ filter: filterValue });
        });

        $('.js-portfolio-filter-btn').click(function(event) {
            // $(this).closest('.js-portfolio-filter').removeClass('is-hover');
        });

        $portfolio_grid.on( 'layoutComplete',
          function( event, laidOutItems ) {
            setTimeout(function() { 
                var content_height = $('.content__inner').outerHeight();
                if (window_height > content_height + footer_h){
                    $('html').addClass('fixed-footer');
                } else {
                    $('html').removeClass('fixed-footer');
                }
                $('.js-footer').show();
            }, 1);
          }
        );

        $('.js-portfolio-filter').click(function(){
              $(this).toggleClass('is-hover');
        });
    }

    if ($('.js-reviews').length) {
        $('.js-reviews-img').each(function(index, el) {
            var reviews_big_img = $(this).attr('data-img-src');
            $(this).zoom({url: reviews_big_img});
        });
    }

}); // $(document).ready

$(window).resize(init);

// animate digits on the team-page
var is_team_about_scrolled = false;
$(window).scroll(function() {

    if (!is_team_about_scrolled && $('.js-team-about').length) {
        if (window_width >= 1200) {
            var team_about_height = $('.js-team-about').height();
            var team_about_offset_top = $('.js-team-about').offset().top;
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
        } else {
            $('.js-team-about-num').each(function(index, el) {
                var cur_num = $(el).attr('data-max-num');
                $(el).text(cur_num);
            });
        }
    }

});

/* Yandex Map
 ========================================================*/
    var map_container = document.getElementById("map");
    if (map_container) {
        $(document).ready(function () {
            get_map(map_container, map_contact);
        });
    }

    function get_map(map_container, map_array){
        if (map_container !== null) {
            ymaps.ready(init);
            var myMap, 
                myPlacemark,
                curLat,
                curLong,
                curDesc;

            function init(){ 
                curLat = map_array['lat'];
                curLong = map_array['long'];
                myMap = new ymaps.Map(map_container, {
                    // center: [61.582319, 98.112851],
                    center: [curLat, curLong],
                    zoom: 17
                }); 
                // curDesc = map_array['desc'];
                myPlacemark = new ymaps.Placemark([curLat, curLong], {}, {
                    // balloonContent: curDesc
                    iconLayout: 'default#image',
                    iconImageHref: theme_url+'/img/map-pin.png',
                    iconImageSize: [42, 58],
                    iconImageOffset: [-30, -70]
                });
                myMap.geoObjects.add(myPlacemark);
            }
        }
    }


});

