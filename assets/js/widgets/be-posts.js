(function ($) {
    "use strict";

    const FilterPostHandler = function($scope, $) {
        //console.log($scope);
        // Get all items
        var items = [];
        $scope.find('.elementor-item').each(function() {
            items.push('<div class="animate__hide ' + $(this).attr('class') + '" data-group="' + $(this).data('group') + '">' + $(this).html() + '</div>');
        });

        // click filter navigation
        $scope.find('.elementor-filter a').click(function(e) {
            e.preventDefault();
            if ($(this).hasClass('active')) {
                return;
            }

            $('.elementor-filter a').removeClass('active');
            $(this).addClass('active');

            var group = $(this).data('filter');
            $scope.find('.elementor-item').addClass('animate__hide');
            $scope.find('.elementor-item').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                $scope.find('.elementor-grid').html(''); // empty list content

                // get filter result
                var result = '';
                if ('all' === group) {
                    result = items;
                } else {
                    for (var i = 0; i < items.length; i++) {
                        if ($(items[i]).data('group').split(' ').includes(group)) {
                            result += items[i];
                        }
                    };
                }

                if ('' === result) {
                    result += '<div class="elementor-' + $scope.find('.elementor-filter').data('type') + ' elementor-item no-result" data-group="' + group + '"><strong>No result.</strong> Please add post to category!</div>';

                }

                $scope.find('.elementor-grid').html(result);
                $scope.find('.elementor-item').removeClass('animate__hide').addClass('animate__show');

                $scope.find('.give-card__progress-custom .give-goal-progress').each(function() {
                    if (!$(this).parent().hasClass('give-card__progress-custom') || !$(this).find('.give-progress-bar').length) {
                        return;
                    }

                    getProgressBarFilter($(this));

                });

            });
        });

    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-posts.skin-grid-yutmaru', FilterPostHandler);
    });

})(jQuery); 