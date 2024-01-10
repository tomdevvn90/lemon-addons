(function ($) {
    "use strict";

    const CountDownHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.countdown').each(function() {
            const $countdownTime = $(this).attr('data-countdown'),
                $countdownFormat = $(this).attr('data-format');

            $(this).countdown({
                until: $countdownTime,
                format: $countdownFormat,
                padZeroes: true
            });

        });
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-countdown.default', CountDownHandler);
    });

})(jQuery); 