(function($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */



    $(document).ready(function() {
        if ($('header').hasClass('header-fixed')) {
            HeaderScrollSticky();
        }

        function HeaderScrollSticky() {
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

                    // if( alwaysShow == true && firstScroll == true ) {
                    // 	firstScroll = false;
                    // 	stickMenuEl.addClass( 'stick-show' );
                    // 	console.log(alwaysShow, firstScroll);
                    // }

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
    })
    $(window).load(function() {

    
    })

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
    
        // WooCommerce.

      
    

    });

})(jQuery);
