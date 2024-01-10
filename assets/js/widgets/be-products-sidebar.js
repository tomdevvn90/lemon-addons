(function ($) {
    "use strict";


    const ProductsSidebarHandler = function($scope, $, callback) {
        var $parent = $scope.find('.has_child');

        $parent.click(function() {
            $(this).toggleClass('open');
            $(this).find('.__child').slideToggle();
        })
    }


    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-sidebar.default', ProductsSidebarHandler);
    });

})(jQuery); 