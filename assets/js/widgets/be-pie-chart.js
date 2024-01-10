(function ($) {
    "use strict";

    const PieChartHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.elementor-pie-chart__progress').each(function() {
            if (!$(this).length) {
                return;
            }
            getPieChart($(this));

        });


        function getPieChart($selector) {
           
            let $innerText = $selector.data('innertext'),
                $strokeWidth = $selector.data('strokewidth'),
                $easing = $selector.data('easing'),
                $duration = $selector.data('duration'),
                $color = $selector.data('color'),
                $trailColor = $selector.data('trailcolor'),
                $trailWidth = $selector.data('trailwidth'),
                $toColor = $selector.data('tocolor'),
                $svgWidth = $selector.data('width'),
                $svgHeight = $selector.data('height');
    
            const bar = new ProgressBar.Circle($selector[0], {
                strokeWidth: $strokeWidth,
                easing: $easing,
                duration: $duration,
                color: $color,
                trailColor: $trailColor,
                trailWidth: $trailWidth,
                svgStyle: {
                    width: $svgWidth,
                    height: $svgHeight
                },
                from: {
                    color: $color
                },
                to: {
                    color: $toColor
                },
                step: (state, bar) => {
                    bar.path.setAttribute('stroke', state.color);
    
                    var value = Math.round(bar.value() * 100);
                    if ($innerText) {
                        bar.setText(value + '% <span>' + $innerText + '</span>');
                    } else {
                        bar.setText(value + '%');
                    }
    
                }
            });
    
            var $barWidth = $selector.attr('aria-valuenow') / 100,
                waypoint = new Waypoint({
                    element: $selector,
                    handler: function() {
                        bar.animate($barWidth); // Number from 0.0 to 1.0
                    },
                    offset: '100%',
                    triggerOnce: true
                });
        }

    };

    

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-pie-chart.default', PieChartHandler);
    });

})(jQuery); 