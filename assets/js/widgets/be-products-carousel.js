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
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.default', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-andrus', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-havsula', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-ramble', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-cosmetics', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-wellness', SwiperSliderHandler);
    });

})(jQuery); 