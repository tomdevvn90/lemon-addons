import { Navigation, Pagination } from 'swiper/modules';

(function ($) {
    "use strict";

    const LogoCarouselHandler = function($scope, $) {
        const $widgetCarousel = $('.elementor-widget-be-logo-carousel')
        if ($widgetCarousel.length === 0) return;

        $scope.each(function () {
            const $selector = $(this).find('.swiper-container');
            let $dataSwiper = $selector.data('swiper');

            console.log($dataSwiper)

            let opt_df = {
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

            let widgetSliderss =  new Swiper($selector[0],  Object.assign({}, opt_df, $dataSwiper))

            // let widgetSwiperCarousel =  new Swiper($selector[0],  $dataSwiper)
        })
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-logo-carousel.default', LogoCarouselHandler);
    });

})(jQuery); 