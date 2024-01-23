import { Navigation, Pagination } from 'swiper/modules';


(function ($) {
    "use strict";

    const PostCarouselHandler = function($scope, $) {
        // console.log("check")


        // console.log($scope)

        const $widgetCarousel = $('.elementor-widget-be-posts-carousel')
        
        if ($widgetCarousel.length > 0) {

            $scope.each(function () {
                const $selector = $(this).find('.swiper-container');
                let $dataSwiper = $selector.data('swiper');
                console.log($dataSwiper)
                let opt_df = {
       
                    modules: [Navigation, Pagination],
                };
    
                let widgetSlider =  new Swiper($selector[0],  $dataSwiper)
            })
        }
    
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.default', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-pumori', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-baruntse', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-coropuna', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-andrus', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-saltoro', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-batura', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-changtse', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-taboche', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-castor', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-wilson', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-jorasses', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-michelson', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-cerredo', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-gangri', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-sankar', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-cholatse', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-tronador', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-jimara', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-cosmetics', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-wellness', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-lemon-tattoo', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-beauty', PostCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-lemon-dentist', PostCarouselHandler);
    });

})(jQuery); 