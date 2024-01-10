(function ($) {
    "use strict";

    const ProductsMasonryHandler = function($scope, $, callback) {
        var $grid = $('.grid-masonry').isotope({
            itemSelector: '.elementor-product',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer',
            }
        });

        /*Dropdown Menu*/
        $scope.find('.dropdown').click(function() {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.dropdown-menu').slideToggle(300);
        });
        $scope.find('.dropdown').focusout(function() {
            $(this).removeClass('active');
            $(this).find('.dropdown-menu').slideUp(300);
        });
        $scope.find('.dropdown .dropdown-menu li').click(function() {
            $(this).parents('.dropdown').find('span').text($(this).text());
            $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
        });
        /*End Dropdown Menu*/

        $scope.find('.dropdown-menu li').click(function() {
            var input = $(this).attr('value');
            $grid.isotope({
                filter: input
            });
        });

        $scope.find('.filter-menu span:first-child').addClass('active');
        $scope.find('.filter-menu span').click(function() {
            var input = $(this).attr('value');
            $('.filter-menu span').removeClass('active');
            $(this).addClass('active');
            $grid.isotope({
                filter: input
            });
        });

        var initShow = $scope.find('#ajax_load_more').data('product-to-show'); //number of items loaded on init & onclick load more button
        var counter = initShow; //counter for load more button
        var iso = $grid.data('isotope'); // get Isotope instance

        loadMore(initShow); //execute function onload

        function loadMore(toShow) {
            $grid.find(".hidden").removeClass("hidden");

            var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
                return item.element;
            });
            $(hiddenElems).addClass('hidden');
            $grid.isotope('layout');

            //when no more to load, hide show more button
            if (hiddenElems.length == 0) {
                jQuery("#ajax_load_more").hide();
            } else {
                jQuery("#ajax_load_more").show();
            };

        }

        //when load more button clicked
        $scope.find("#ajax_load_more").click(function() {
            if ($('.dropdown-menu li').data('clicked')) {
                //when filter button clicked, set initial value for counter
                counter = initShow;
                $scope.find('.dropdown-menu li').data('clicked', false);
                $scope.find('.filter-menu span').data('clicked', false);
            } else {
                counter = counter;
            };

            counter = counter + initShow;

            loadMore(counter);
        });

        //when filter button clicked
        $scope.find(".dropdown-menu li").click(function() {
            $(this).data('clicked', true);

            loadMore(initShow);
        });

        $scope.find(".filter-menu span").click(function() {
            $(this).data('clicked', true);

            loadMore(initShow);
        });
    }

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-products-masonry.default', ProductsMasonryHandler);
    });

})(jQuery); 