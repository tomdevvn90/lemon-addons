import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';


(function ($) {
    "use strict";

    const CounterHandler = function($scope, $) {
        //console.log($scope);
        var $selector = $scope.find('.elementor-counter__number'),
            $dataCounter = $selector.data('counter'),
            waypoint = new Waypoint({
                element: $selector,
                handler: function() {
                    $selector.numerator($dataCounter);
                },
                offset: '100%',
                triggerOnce: true
            });

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-counter.default', CounterHandler);
    });

})(jQuery); 