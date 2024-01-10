(function ($) {
    "use strict";


    const TextAnimationHandler = function($scope, $, callback) {
        const $tlt_ele = $scope.find(".tlt");

        $tlt_ele.textillate({
            loop: true,
            initialDelay: 0,
            delay: 50,
        });
    }


    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-text-animation.default', TextAnimationHandler);
    });

})(jQuery); 