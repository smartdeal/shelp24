jQuery(function($) { 

var window_width, window_height;

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
  
    if ($('.js-slider2-logo').length){
        $('.js-slider2-logo').slick({
            dots: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow:"<div class='slick2-prev pull-left'></div>",
            nextArrow:"<div class='slick2-next pull-right'></div>",
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
    // $('.test-div').text(window_width + ' * ' +window_height);

    if (window_height < 800) 
        $('body').addClass('h800less');
    else
        $('body').removeClass('h800less');

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
            // $('.js-clients-slider__bg').css({'margin-left':cur_clients_offset,'margin-right':cur_clients_offset});
        } else {
            $('.js-team-about__bg').css({'margin-left':0,'margin-right':0});
            // $('.js-clients-slider__bg').css({'margin-left':0,'margin-right':0});
        }
    }

    if ($('.js-team-advantages').length){
        var $carousel = $('.js-team-advantages');
        
        if ( window_width > 1199){
            if ($carousel.hasClass('slick-initialized')) {
                $carousel.slick('unslick');
            }
        } else {
            if (!$carousel.hasClass('slick-initialized')) {
                $carousel.slick({
                    dots: false,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    prevArrow:"<div class='slick-prev pull-left'></div>",
                    nextArrow:"<div class='slick-next pull-right'></div>",
                    responsive: [
                        {
                          breakpoint: 1200,
                          settings: {
                            slidesToShow: 2,
                          }
                        },
                        {
                          breakpoint: 600,
                          settings: {
                            slidesToShow: 1,
                          }
                        },
                      ]
                });
            }
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
        var title = $(this).closest('.b-arch-content__inner').find('.b-arch-content__caption').text();
        if (title.length) {
            $('.form_addservice-archive input[name="vacancy"]').val(title);
        }
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
        // $("html, body").animate({ scrollTop: 0 }, "slow");
        $('.form-get-offer').addClass('opened');
        $(this).closest('.sidebar').addClass('opened');
    });

    $('.js-form-get-offer-close').click(function(event) {
        event.preventDefault();
        $('.form-get-offer').removeClass('opened');
        var $sidebar = $(this);
        setTimeout(function() { 
            $sidebar.closest('.sidebar').removeClass('opened');
        }, 1000);
    });

    $('.js-link-share').click(function(event) {
        event.preventDefault();
        $(this).closest('.js-meta-share').toggleClass('opened');
    });

    $('.menu-item-has-children.dropdown').click(function(event) {
        if ($(this).hasClass('open')) {
            if (event.target.className == 'caret') {
                console.log('ddd',event.target.className);
                event.preventDefault();
                $(this).removeClass('open');
            } else {
                document.location.href = $(this).find('.dropdown-toggle').first().attr('href');
            }
        } else {
            $('.menu-item-has-children.dropdown').removeClass('open');
            $(this).addClass('open');
        }
    });

    $('#menu-collapse').on('shown.bs.collapse', function () {
        $('body').addClass('open-menu');
    });

    $('#menu-collapse').on('hidden.bs.collapse', function () {
        $('body').removeClass('open-menu');
    });

    $('.equalHeights').equalHeights();
/*
    $('.header-mobile .navbar-nav > li > a').click(function(event) {
        console.log("event", event);
        if (event.target.className == 'caret' && $(this).closest('.menu-item').hasClass('open')) {
            // $('#menu-collapse').collapse('hide');
            $(this).closest('.menu-item').find('.dropdown-toggle').dropdown("toggle");
        }
    });
*/
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

    function ruler_to_log() {
        $.ajax({
            type: "POST",
            url: window.ajax_url,
            data: {
                action : 'ajax_ruler_to_log',
                user_ip : window.user_ip,
                site_url : window.site_url,
            }
        });         
    }

    // Рулетка
    if ( $('.js-form-get-roll').length ) {

        if ( $(window).width() >= 1200 ) {
            if ( !$.cookie('roll_popup_sent') ) {
                setTimeout(function() { 
                    open_form_roll();
                }, 20000);
            }
        }

        function open_form_roll() {
            ruler_to_log();
            $('body').addClass('open-form-roll'); 
            yaCounter24815432.reachGoal('roll_show');
            setTimeout(function(){
                $('.js-roll-drum').css('transform', 'rotate(-360deg)');
            }, 1000);                     
        }
        // open_form_roll();

        $('.js-form-get-roll-close').click(function(event) {
            event.preventDefault();
            $('body').removeClass('open-form-roll');
            if ( !$.cookie('roll_popup_sent') && !$.cookie('roll_popup1') ) {
                setTimeout(function() { 
                    $.cookie('roll_popup1', 'value');
                    open_form_roll();
                }, 40000);
            }
        });

        var roll_prize = Math.floor(Math.random() * 10);
        var roll_lap = 1*180;
        var roll_deg = roll_prize*36+(roll_lap)-36;
        var prize = $('.roll__item').eq(roll_prize-1).text();

        $('.js-form-sent-ok-prize').attr('data-deg', roll_deg).text(prize);
        $('.js-form-get-roll input[name=prize]').val(prize);

        $(".wpcf7").on('wpcf7mailsent', function(event){
            if ( 'wpcf7-f3855-o2' == event.target.id) {
                yaCounter24815432.reachGoal('roll_send');
                $.cookie('roll_popup_sent', 'value', { path: '/' });
                $('.js-form-get-roll .wpcf7-submit').attr('disabled', true);
                var roll_deg = $('.js-form-sent-ok-prize').attr('data-deg');
                $('.js-roll-drum').css('transform', 'rotate(-' + roll_deg + 'deg)');
                setTimeout(function(){
                    $('.js-form-get-roll .js-form-roll-sent-ok').fadeIn('slow');
                }, 8000);
            }
        });        
    }

    var portfolio_hover = function () {
        var $portfolio = $('.home .portfolio__link');
        var ms = 350;
        if (!$portfolio.length) return;
        setTimeout(() => {
            // [3,1,6,11,4,9,14,12].forEach(function(item, i, arr) {
            [3,2,7,11,6,1,0,5,10,15,14,9,4,8,13,12].forEach(function(item, i, arr) {
                setTimeout(() => {
                    $portfolio.eq(item).addClass('hover');
                    setTimeout(() => {
                        $portfolio.eq(item).removeClass('hover');
                    }, ms);
                }, i*ms+ms);
            });
        }, 3000);
            
                                
    }
    portfolio_hover();

}); // $(document).ready

$(window).resize(init);

// animate digits on the team-page
var is_team_about_scrolled = false;
$(window).scroll(function() {

    var scroll = $(window).scrollTop();
    if (!is_team_about_scrolled && $('.js-team-about').length) {
        if (window_width >= 1200) {
            var team_about_height = $('.js-team-about').height();
            var team_about_offset_top = $('.js-team-about').offset().top;
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

$('#file-upload').change(function() {
    var i = $(this).closest('form').find('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).closest('form').find('label').text(file);
});

$(document).ready(function() {
    $('.tablepress.tableprice tr:last-child td:not(:first-child)').append('<a class="table-price__btn js-table-price-btn" href="#">Заказать</a>');
});

$('.tablepress.tableprice').on('click', '.js-table-price-btn', function (e) {
    e.preventDefault();
    $('.js-btn-get-offer').trigger('click');
}); 

$('.js-table-price-btn').click(function (e) { 
    e.preventDefault();
    $('.js-btn-get-offer').trigger('click');
});
$('.js-table-price-btn-mobile').click(function (e) { 
    e.preventDefault();
    $('.b-get-offer').trigger('click');
});

$('.js-content-btns-btn').click(function (e) { 
    e.preventDefault();
    var title = $(this).text();
    var $form = $(this).closest('.content-btns').find('.js-content-btns-form');
    $form.find('input[name="title"]').val(title);
    $form.slideToggle();
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

    
        if ( map_container !== null ) {
            if (typeof ymaps === 'undefined') 
                $.loadScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU', function(){
                
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
                        myPlacemark = new ymaps.Placemark([curLat, curLong], 
                            {
                                balloonContentBody: '<span class="ym-balloon">г. Москва, ул. Русаковская, д. 13, оф. 905<br><b>+7 495 266-25-40</b></span>',
                            },
                            {
                                iconLayout: 'default#image',
                                iconImageHref: theme_url+'/img/map-pin.png',
                                iconImageSize: [42, 58],
                                iconImageOffset: [-30, -70]
                            }
                        );
                        myMap.geoObjects.add(myPlacemark);
                    }

            });
        }
    }

    // Targets
    var wpcf7Elm;
    wpcf7Elm = document.getElementById( 'wpcf7-f782-o1' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('zaprosit-offer-header'); }, false ); 
    wpcf7Elm = document.querySelector('.form-content_service .wpcf7');
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('zayavka-usluga'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f1935-p98-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('pryamaya-svyas'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f193-p235-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('case-hochy-takzhe'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f713-p104-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('feedback'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f193-p776-o2' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('100-garantiya'); }, false ); 
    wpcf7Elm = document.getElementById( 'wpcf7-f6043-p2173-o3' );
    if (wpcf7Elm != null) wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {yaCounter24815432.reachGoal('sozdanie-prodvijenie'); }, false ); 
    $('.b-tel_header').click(function(event) {
            yaCounter24815432.reachGoal('zvonok-s-mobilnoi');
    });

$(function() {
 $.fn.scrollToTop = function() {
  $(this).hide().removeAttr("href");
  if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
  var scrollDiv = $(this);
  $(window).scroll(function() {
   if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
   else $(scrollDiv).fadeIn("slow")
  });
  $(this).click(function(e) {
    e.preventDefault();
   $("html, body").animate({scrollTop: 0}, "slow")
  })
 }
});

$(function() {
 $(".js-scrollup").scrollToTop();
});

});

