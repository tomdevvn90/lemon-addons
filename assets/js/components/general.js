jQuery(function ($) {
    "use strict";

    const HeaderScrollSticky = () =>{
        if ($('header').hasClass('header-fixed')) {
            __handleScroll()
        }

        function __handleScroll(){
            var stickMenuEl = $('header').children();
            var offsetTop = (stickMenuEl.hasClass('header-fixed')) ? $('html').offset().top : stickMenuEl.offset().top;
            var menuOffset = {
                    top: offsetTop,
                    height: stickMenuEl.innerHeight()
                },
                scroll = 0,
                position = $(window).scrollTop();

            /* update offset */
            $(window).on('resize', function() {
                stickMenuEl.removeClass('stick-menu', function() {
                    menuOffset = {
                        top: offsetTop,
                        height: stickMenuEl.innerHeight()
                    };
                });
            })

            $(window).on('scroll', function() {
                scroll = $(this).scrollTop();

                if (scroll >= (menuOffset.top + menuOffset.height)) {
                    if (!stickMenuEl.hasClass('stick-menu')) {
                        stickMenuEl.addClass('stick-menu')
                    }

                    if (scroll > position) {
                        /* down */
                        if (!stickMenuEl.hasClass('stick-hide'))
                            stickMenuEl.removeClass('stick-show stick-hide').addClass('stick-hide');

                    } else {
                        /* up */
                        if (!stickMenuEl.hasClass('stick-show'))
                            stickMenuEl.removeClass('stick-show stick-hide').addClass('stick-show');
                    }
                } else {
                    stickMenuEl.removeClass('stick-menu');
                }

                position = scroll;
            })
        }
    }


    const BtnBackTop = () => {
        $('#backtotop').hide();

        $(window).scroll(function(){
            if ($(this).scrollTop() > 500) {
                $('#backtotop').fadeIn();
            } else {
                $('#backtotop').fadeOut();
            }
        });

        $('#backtotop').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 'slow');
            return false;
        });
    }

    $(document).ready(function () {
        HeaderScrollSticky()
        BtnBackTop()
    });
});

