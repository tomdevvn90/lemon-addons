(function($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    var SwiperSliderHandler = function($scope, $) {
        
        var $selector = $scope.find('.swiper-container'),
            $dataSwiper = $selector.data('swiper');
            // mySwiper = new Swiper($selector, $dataSwiper);  
            if ( 'undefined' === typeof Swiper ) {
                var asyncSwiper = elementorFrontend.utils.swiper;
        
                new asyncSwiper( $selector, $dataSwiper ).then( ( newSwiperInstance ) => {
                    console.log( 'New Swiper instance is ready: ', newSwiperInstance );
        
                    mySwiper = newSwiperInstance;
                });
            } else {
                console.log( 'Swiper global variable is ready, create a new instance: ', Swiper );
        
                mySwiper = new Swiper( $selector, $dataSwiper );
            }

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {

        // Be Posts
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.default', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-pumori', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-baruntse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-coropuna', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-andrus', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-saltoro', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-batura', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-changtse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-taboche', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-castor', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-wilson', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-jorasses', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-michelson', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-cerredo', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-gangri', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-sankar', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-cholatse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-tronador', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-jimara', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-cosmetics', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-wellness', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-lemon-tattoo', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-beauty', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-lemon-dentist', SwiperSliderHandler);

        // Be Testimonial
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.default', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-grid-nevado', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-baruntse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-ampato', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-andrus', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-saltoro', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changtse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changla', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-galloway', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-jorasses', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-cholatse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-lemon-tattoo', SwiperSliderHandler);
        
        // Be Logo
        elementorFrontend.hooks.addAction('frontend/element_ready/be-logo-carousel.default', SwiperSliderHandler);
        
        // Be Base
        elementorFrontend.hooks.addAction('frontend/element_ready/be-base-carousel.default', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-base-carousel.skin-grid-pumori', SwiperSliderHandler);

        // Be Products 
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.default', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-andrus', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-havsula', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-ramble', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-cosmetics', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-wellness', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-list-spa', SwiperSliderHandler);
    });

})(jQuery);