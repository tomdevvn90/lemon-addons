(function ($) {
    "use strict";


    const BeforeAfterImageHandler = function( $scope, $ ) {
        const twentytwentyContainer = $scope.find('.twentytwenty-container');
        const data_twentytwenty = twentytwentyContainer.data('twentytwenty');

        twentytwentyContainer.twentytwenty(data_twentytwenty);
    }


    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-before-after.default', BeforeAfterImageHandler);
    });

})(jQuery); 