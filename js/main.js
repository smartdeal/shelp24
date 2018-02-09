jQuery(function($) { 

var window_width, window_height, document_height, footer_h;

function include(scriptUrl) {
    document.write('<script src="'+dir_url + scriptUrl + '"></script>');
}

// Lazy load
function aload(t){"use strict";t=t||window.document.querySelectorAll("[data-aload]"),void 0===t.length&&(t=[t]);var a,e=0,r=t.length;for(e;r>e;e+=1)a=t[e],a["LINK"!==a.tagName?"src":"href"]=a.getAttribute("data-aload"),a.removeAttribute("data-aload");return t}


$.loadScript = function (url, callback) {$.ajax({url: url, dataType: 'script', success: callback, async: true }); }
//if (typeof someObject == 'undefined') $.loadScript('url_to_someScript.js', function(){
    //Stuff to do after someScript has loaded
//});

function loadCSS(url){$("<link/>", {rel: "stylesheet", type: "text/css", href: url }).appendTo("head"); }

function preinit() {

    loadCSS('https://fonts.googleapis.com/css?family=Open+Sans:400,600i,700&amp;subset=cyrillic');
    loadCSS('https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic');
    loadCSS('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=cyrillic');

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
            adaptiveHeight: true
        });
    }    
}
function init() {
    window_width = $(window).width();
    window_height = $(window).height();
    document_height = $(document).height();
    footer_h = $('.js-footer').outerHeight();

    // if ($('.dimentions').length) {
    //     $('.dimentions').text( window_width+'x'+window_height);
    // } else {
    //     $('body').prepend('<div class="dimentions"></div>').find('.dimentions').text( window_width+'x'+window_height);
    // }
    // $('.dimentions').css({
    //     'position':'fixed',
    //     'font-size':'16px',
    //     'top': '5px',
    //     'z-index':'999'
    // });    

    if (window_height < 550) $('body').addClass('h_less600'); else $('body').removeClass('h_less600');
    if (window_height >= 550 && window_height < 768) $('body').addClass('h_less768'); else $('body').removeClass('h_less768');
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

    var cur_h;
    if ($('.content__inner_front').length && !$('body').hasClass('w_less992')){
        $('body').addClass('fullpage');
        if ($('body').hasClass('h_less600')) {
            cur_h = ($('.js-sidebar__inner').outerHeight())/3;
        } 
        else {
            cur_h = (window_height - footer_h - adminbar_height)/3;
        }
        $('.portfolio__item').css({'padding-bottom':0,'height':cur_h});
    } else {
        $('body').removeClass('fullpage');
    }
    if ($('.content__inner_contacts').length && $('html').hasClass('fixed-footer')){
        cur_h = window_height - $('.content__inner_contacts .container-fluid').outerHeight()-footer_h-adminbar_height;
        $('#map').css({'height':cur_h});
    }

    if ($('.js-team-about').length){
        if (typeof $.stellar == 'undefined') {
            $.loadScript(theme_url+'/js/stellar.js', function(){
                if (window_width >= 1200) {
                    $.stellar({
                        horizontalScrolling: false,
                        verticalOffset: 10
                    });
                } else {
                    $.stellar('destroy');
                }
            });        
        } else {
            if (window_width >= 1200) {
                $.stellar({
                    horizontalScrolling: false,
                    verticalOffset: 10
                });
            } else {
                $.stellar('destroy');
            }            
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

    $('body').addClass('loaded');
    
    // $('.preloader').animate({
    //     opacity: 0,
    //   }, 1500, function() {
    //     $('.preloader').hide();
    //     $('.layout-main').animate({
    //         opacity: 1,
    //       }, 500, function() {
    //       });
    //     $('body').addClass('loaded');
    //   });

    $.loadScript(theme_url+'/js/fancybox/jquery.fancybox.pack.js', function(){
        loadCSS(theme_url+'/js/fancybox/jquery.fancybox.css');
        $('.fancybox').fancybox();
    });

    $.loadScript(theme_url+'/js/jquery.inputmask.bundle.min.js', function(){
        $('input[type=tel]').inputmask({mask: "+7(999) 999-99-99"});
    });

    $.loadScript(theme_url+'/js/plugins.js', function(){
    });

    var location_url = window.location.href;
    $('input[name="url"]').val(location_url);

    if ($('.case').length) {
        var title = $('.case__form .form-content__title').text();
        $('.case__form .wpcf7-submit').val(title);
    }
    $('.form-content .policy .wpcf7-list-item-label').html('Согласен с <a href="'+home_url+'/privacy-policy/">политикой конфиденциальности</a>');

    $('.form_addservice-archive .wpcf7-submit').val('Отправить').addClass('btn_reverse');

    $('.wpcf7-submit').click(function(event) {
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

    $('.js-link-share').click(function(event) {
        event.preventDefault();
        $(this).closest('.js-meta-share').toggleClass('opened');
    });

    $(".wpcf7").on('wpcf7mailsent', function(event){
        if ($(this).closest('.js-form-wrap').find('.js-form-sent-ok').length){
            $(this).closest('.js-form-wrap').find('.js-form-sent-ok').fadeIn('slow');
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

    if ($('.js-portfolio-grid').length) {

        $('.js-portfolio-btn').click(function(event) {
            event.preventDefault();
            var filterValue = $( this ).attr('data-filter');
            $('.js-portfolio-grid')
                .find('.portfolio__item').fadeOut(0)
                .filter(filterValue).fadeIn(500);
            if (!$('html').hasClass('fixed-footer')) {
                $('.js-footer').hide();
            }
        });


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

    if ($('.js-widget-reviews').length){
        if (typeof Swiper == 'undefined') {
            // loadCSS(theme_url+'/js/swiper.min.css');
            $.loadScript(theme_url+'/js/swiper.min.js', function(){
            var swiper = new Swiper('.js-widget-reviews', {
              effect: 'coverflow',
              grabCursor: true,
              // centeredSlides: true,
              slidesPerView: 'auto',
              autoplay: {
                delay: 3000,
              },
              coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows : true,
              },
              autoplay: {
                delay: 5000,
              },
            });                
            swiper.slideTo(2);
            });        
        }    
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

    // Targets
    var wpcf7Elm;
    wpcf7Elm = document.getElementById( 'wpcf7-f782-o1' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('zaprosit-offer-header'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f517-p7-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('zayavka-usluga'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f1935-p98-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('pryamaya-svyas'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f193-p235-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('case-hochy-takzhe'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f713-p104-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('feedback'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f193-p776-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('100-garantiya'); }, false ); 

});

