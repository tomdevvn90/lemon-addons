import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';


(function ($) {
    "use strict";

    const SwiperSliderHandler = function($scope, $) {
        
        const $selector = $scope.find('.swiper-container');
        if ($selector.length > 0) {
            
            let $dataSwiper = $selector.data('swiper');

            let opt_df = {
                loop: true,
                paginationClickable: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                modules: [Navigation, Pagination],
			};

            const widgetSlider =  new Swiper($selector[0],  Object.assign({}, opt_df, $dataSwiper))
        }
    
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
    });

})(jQuery); 