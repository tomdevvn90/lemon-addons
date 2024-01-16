import { Navigation, Pagination } from 'swiper/modules';


(function ($) {
    "use strict";

    const SwiperSliderHandler = function($scope, $) {
        
        const $selector = $scope.find('.swiper-container');
        if (!$selector.length) return;

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
    
    };


    // const SwiperSliderThumbsHandler = function($scope, $) {

    //     const $isWidget =  $('.elementor-testimonials--skin-list-coropuna')
    //     if (!$isWidget.length) return;

    //     const $parent = $('.swiper-main.elementor-testimonials--skin-list-coropuna')

        //console.log($scope);

        // const $selector_thumbs = $scope.find('.swiper-thumbs .swiper-container');
        // if (!$selector_thumbs.length) return;

        // let opt_df = {
        //     loop: true,
        //     paginationClickable: true,
        //     navigation: {
        //         nextEl: '.swiper-button-next',
        //         prevEl: '.swiper-button-prev',
        //     },
        //     pagination: {
        //         el: '.swiper-pagination',
        //     },
        //     modules: [Navigation, Pagination],
        // };



        // let $dataSwiperThumbs = $selector_thumbs.data('swiper');
        // const thumbSwiper = new Swiper($selector_thumbs[0],  Object.assign({}, opt_df, $dataSwiperThumbs))


        //     console.log($dataSwiperThumbs)
        // let v = $('.swiper-thumbs')
        // var $selector = $scope.find('.swiper-main .swiper-container'),
        //     $dataSwiper = $selector.data('swiper');

        // // $dataSwiper['thumbs'] = {
        // //     swiper: thumbSwiper,
        // // };

        // let opt_df_s = {
        //     loop: true,
        //     navigation: {
        //         nextEl: ".swiper-button-next",
        //         prevEl: ".swiper-button-prev",
        //       },
        //       thumbs: {
        //         swiper: thumbSwiper,
        //       },
           
        // };

        // console.log(v)

        // const mainSwiper = new Swiper($selector[0],  Object.assign({}, opt_df_s, $dataSwiper))
    // };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.default', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-grid-nevado', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-baruntse', SwiperSliderHandler);
        // elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-coropuna', SwiperSliderThumbsHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-ampato', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-andrus', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-saltoro', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changtse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changla', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-galloway', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-jorasses', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-cholatse', SwiperSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-lemon-tattoo', SwiperSliderHandler);
    });

})(jQuery); 