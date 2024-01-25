(function($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */


    var SwiperSliderHandler = function($scope, $) {
        
        var $selector = $scope.find('.swiper-container'),
            $dataSwiper = $selector.data('swiper'),
            mySwiper = new Swiper($selector, $dataSwiper);

    };


    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {

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

    });

})(jQuery);