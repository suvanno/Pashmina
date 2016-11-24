jQuery(document).ready(function() {

    // Sticky Menu
    var stickyNavTop = jQuery( '.dt-sticky' );

    if (stickyNavTop.length) {
        var stickyNavTop = stickyNavTop.offset().top;

        var stickyNav = function(){
            var scrollTop = jQuery(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                jQuery( '.dt-sticky' ).addClass( 'dt-menu-sticky');
            } else {
                jQuery( '.dt-sticky' ).removeClass( 'dt-menu-sticky' );
            }
        };

        jQuery(window).scroll(function() {
            stickyNav();
        });
    }

    // Toggle Menu
    jQuery( '.dt-menu-md' ).on( 'click', function(){
        jQuery( '.dt-menu-wrap .menu' ).toggleClass( 'menu-show' );
        jQuery(this).find( '.fa' ).toggleClass( 'fa-bars fa-close' );
    });

    // Featured Posts Slider
    var pashmina_window_width = jQuery(window).width();

    var pashmina_slider_num = 3;
    var pashmina_space_between = 30;

    if ( pashmina_window_width < 992 ) {
        var pashmina_slider_num = 2;
    }

    if ( pashmina_window_width < 768 ) {
        var pashmina_space_between = 15;
    }

    if ( pashmina_window_width < 600 ) {
        var pashmina_slider_num = 1;
        var pashmina_space_between = 0;
    }

    var dt_featured_post_slider = new Swiper('.dt-featured-post-slider', {
        pagination: '.swiper-pagination',
        slidesPerView: pashmina_slider_num,
        paginationClickable: true,
        spaceBetween: pashmina_space_between,
        autoplay: 3000,
        speed: 800,
        touchEventsTarget: 'swiper-wrapper'
    });

    // Back to Top
    if (jQuery('#back-to-top').length) {
        var scrollTrigger = 500, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('#back-to-top').addClass('show');
                } else {
                    jQuery('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop();
        });
        jQuery('#back-to-top').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 600);
        });
    }
});
