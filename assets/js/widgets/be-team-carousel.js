import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/swiper-bundle.min.css'
import 'swiper/swiper.min.css'


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
        elementorFrontend.hooks.addAction('frontend/element_ready/be-team-carousel.default', SwiperSliderHandler);
    });

})(jQuery); 