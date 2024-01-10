(function ($) {
    "use strict";

    const MagnificPopupHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.elementor-open-popup-link').magnificPopup({
            type: 'inline',
            midClick: true
        });

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-video-play-button.default', MagnificPopupHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.default', MagnificPopupHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-pumori', MagnificPopupHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-baruntse', MagnificPopupHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-coropuna', MagnificPopupHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-cholatse', MagnificPopupHandler);
    });

})(jQuery); 