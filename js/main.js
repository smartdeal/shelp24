jQuery(function($) { 

var window_height, document_height, footer_h;

function include(scriptUrl) {
    document.write('<script src="'+dir_url + scriptUrl + '"></script>');
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
    // var window_width = $(window).width();
    var adminbar_height = 0;
    if ($('#wpadminbar').length) adminbar_height = $('#wpadminbar').outerHeight();

            // console.log("adminbar_height", adminbar_height);
            // console.log("window_height", window_height);
            // console.log("content_height", content_height);

    if (!$('html').hasClass('fixed-footer')) {
        if ((content_height < window_height-adminbar_height) && !$('body').hasClass('h_less600')) {
            $('html').addClass('fixed-footer');
        } else {
            $('html').removeClass('fixed-footer');
        }
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

// Lazy load
function aload(t){"use strict";t=t||window.document.querySelectorAll("[data-aload]"),void 0===t.length&&(t=[t]);var a,e=0,r=t.length;for(e;r>e;e+=1)a=t[e],a["LINK"!==a.tagName?"src":"href"]=a.getAttribute("data-aload"),a.removeAttribute("data-aload");return t}

$(document).ready(function() {

    setTimeout(function() { 
        init();
        $('.js-sidebar__bottom').show(0);
    }, 1);

    aload();
    
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

        $('.js-portfolio-filter').hover(
            function(){
              $(this).addClass('is-hover');
            },
            function(){
              $(this).removeClass('is-hover');
        });
    }

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

