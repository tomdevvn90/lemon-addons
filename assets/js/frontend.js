(function($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var CounterHandler = function($scope, $) {
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

    var CountDownHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.countdown').each(function() {
            var $countdownTime = $(this).attr('data-countdown'),
                $countdownFormat = $(this).attr('data-format');

            $(this).countdown({
                until: $countdownTime,
                format: $countdownFormat,
                padZeroes: true
            });

        });
    };

    var MagnificPopupHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.elementor-open-popup-link').magnificPopup({
            type: 'inline',
            midClick: true
        });

    };

    var FilterPostHandler = function($scope, $) {
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

    function getPieChart($selector) {
        //console.log($selector);
        var $innerText = $selector.data('innertext'),
            $strokeWidth = $selector.data('strokewidth'),
            $easing = $selector.data('easing'),
            $duration = $selector.data('duration'),
            $color = $selector.data('color'),
            $trailColor = $selector.data('trailcolor'),
            $trailWidth = $selector.data('trailwidth'),
            $toColor = $selector.data('tocolor');
        $svgWidth = $selector.data('width'),
            $svgHeight = $selector.data('height');

        var bar = new ProgressBar.Circle($selector[0], {
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

    var PieChartHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.elementor-pie-chart__progress').each(function() {
            if (!$(this).length) {
                return;
            }
            getPieChart($(this));

        });

    };

    function getProgressBar($selector) {

        $selector.find('.give-progress-bar').css('display', 'none');

        var $type = $selector.parent().data('type'),
            $strokeWidth = $selector.parent().data('strokewidth'),
            $easing = $selector.parent().data('easing'),
            $duration = $selector.parent().data('duration'),
            $color = $selector.parent().data('color'),
            $trailColor = $selector.parent().data('trailcolor'),
            $trailWidth = $selector.parent().data('trailwidth'),
            $toColor = $selector.parent().data('tocolor');
        $svgWidth = $selector.parent().data('width'),
            $svgHeight = $selector.parent().data('height');

        if ('circle' === $type) {
            var bar = new ProgressBar.Circle($selector[0], {
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
                    var value = Math.round(bar.value() * 100) + '%';
                    if (value === 0) {
                        bar.setText('');
                    } else {
                        bar.setText(value);
                    }
                }
            });
        } else {
            var bar = new ProgressBar.Line($selector[0], {
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
                }
            });
        }

        var $barWidth = $selector.find('.give-progress-bar').attr('aria-valuenow') / 100,

            waypoint = new Waypoint({
                element: $selector,
                handler: function() {
                    bar.animate($barWidth); // Number from 0.0 to 1.0
                },
                offset: '100%',
                triggerOnce: true
            });
    }

    function getProgressBarFilter($selector) {

        $selector.find('.give-progress-bar').css('display', 'none');

        var $type = $selector.parent().data('type'),
            $strokeWidth = $selector.parent().data('strokewidth'),
            $easing = $selector.parent().data('easing'),
            $duration = $selector.parent().data('duration'),
            $color = $selector.parent().data('color'),
            $trailColor = $selector.parent().data('trailcolor'),
            $trailWidth = $selector.parent().data('trailwidth'),
            $toColor = $selector.parent().data('tocolor');
        $svgWidth = $selector.parent().data('width'),
            $svgHeight = $selector.parent().data('height');

        if ('circle' === $type) {
            var bar = new ProgressBar.Circle($selector[0], {
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
                    var value = Math.round(bar.value() * 100) + '%';
                    if (value === 0) {
                        bar.setText('');
                    } else {
                        bar.setText(value);
                    }
                }
            });
        } else {
            var bar = new ProgressBar.Line($selector[0], {
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
                }
            });
        }

        var $barWidth = $selector.find('.give-progress-bar').attr('aria-valuenow') / 100;

        bar.animate($barWidth); // Number from 0.0 to 1.0
    }

    var ProgressbarHandler = function($scope, $) {
        //console.log($scope);
        $scope.find('.give-card__progress-custom .give-goal-progress').each(function() {
            if (!$(this).parent().hasClass('give-card__progress-custom') || !$(this).find('.give-progress-bar').length) {
                return;
            }

            getProgressBar($(this));

        });

    };

    var SwiperSliderHandler = function($scope, $) {
        //console.log($scope);
        var $selector = $scope.find('.swiper-container'),
            $dataSwiper = $selector.data('swiper'),
            mySwiper = new Swiper($selector, $dataSwiper);

    };

    var SwiperSliderThumbsHandler = function($scope, $) {
        //console.log($scope);
        var $selector_thumbs = $scope.find('.swiper-thumbs .swiper-container'),
            $dataSwiperThumbs = $selector_thumbs.data('swiper'),
            thumbSwiper = new Swiper($selector_thumbs, $dataSwiperThumbs);

        var $selector = $scope.find('.swiper-main .swiper-container'),
            $dataSwiper = $selector.data('swiper');

        $dataSwiper['thumbs'] = {
            swiper: thumbSwiper,
        };
        var mainSwiper = new Swiper($selector, $dataSwiper);
    };

    var GivePopupHandler = function($scope, $) {
        //console.log($scope);
        var modal_skin = $scope.find('.elementor-give-modal-wrap').data('skin'),
            form_id = $scope.find('form').attr('id');

        $scope.find('button.give-btn-modal').attr('data-mfp-src', '#' + form_id);

        $scope.find('button.give-btn-modal').magnificPopup({
            type: 'inline',
            midClick: true,
            callbacks: {
                beforeOpen: function() {
                    // Will fire when this exact popup is opened
                    $scope.find('form.give-form').addClass(modal_skin);

                    if ($scope.find('.give-form-wrap').hasClass('give-display-button')) {
                        $scope.find('button.give-btn-modal').hide();
                    } else {
                        $scope.find('div.give-total-wrap').hide();
                        $scope.find('#give-donation-level-button-wrap').hide();
                        $scope.find('button.give-btn-modal').hide();
                    }
                },
                beforeClose: function() {
                    // Will fire when popup is closed
                    $('.mfp-wrap').find('form.give-form').removeClass(modal_skin);

                    if ($scope.find('.give-form-wrap').hasClass('give-display-button')) {
                        $scope.find('button.give-btn-modal').show();
                    } else {
                        $('.mfp-wrap').find('div.give-total-wrap').show();
                        $('.mfp-wrap').find('#give-donation-level-button-wrap').show();
                        $('.mfp-wrap').find('button.give-btn-modal').show();
                    }
                },
                close: function() {
                    // Will fire when popup is closed
                    $scope.find('form.give-form').removeClass('mfp-hide');
                }
            }
        });
    };

    var BannerAnimationHandler = function($scope, $) {
        let animation_type = $scope.find("#particles-js").data('animation');
        if (animation_type == 'default') {
            particlesJS("particles-js", {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 5,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true,
                "config_demo": {
                    "hide_card": false,
                    "background_color": "#b61924",
                    "background_image": "",
                    "background_position": "50% 50%",
                    "background_repeat": "no-repeat",
                    "background_size": "cover"
                }
            });
        } else if (animation_type == 'bubble') {
            particlesJS("particles-js", {
                particles: {
                    number: {
                        value: 6,
                        density: {
                            enable: true,
                            value_area: 800
                        }
                    },
                    color: {
                        value: "#DCDCDC"
                    },
                    shape: {
                        type: "polygon",
                        stroke: {
                            width: 0,
                            color: "#DCDCDC"
                        },
                        polygon: {
                            nb_sides: 6
                        },
                        image: {
                            src: "img/github.svg",
                            width: 100,
                            height: 100
                        }
                    },
                    opacity: {
                        value: 0.3,
                        random: true,
                        anim: {
                            enable: false,
                            speed: 1,
                            opacity_min: 0.1,
                            sync: false
                        }
                    },
                    size: {
                        value: 160,
                        random: false,
                        anim: {
                            enable: true,
                            speed: 10,
                            size_min: 40,
                            sync: false
                        }
                    },
                    line_linked: {
                        enable: false,
                        distance: 200,
                        color: "#ffffff",
                        opacity: 1,
                        width: 2
                    },
                    move: {
                        enable: true,
                        speed: 8,
                        direction: "none",
                        random: false,
                        straight: false,
                        out_mode: "out",
                        bounce: false,
                        attract: {
                            enable: false,
                            rotateX: 600,
                            rotateY: 1200
                        }
                    }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: {
                        onhover: {
                            enable: false,
                            mode: "grab"
                        },
                        onclick: {
                            enable: false,
                            mode: "push"
                        },
                        resize: true
                    },
                    modes: {
                        grab: {
                            distance: 400,
                            line_linked: {
                                opacity: 1
                            }
                        },
                        bubble: {
                            distance: 400,
                            size: 40,
                            duration: 2,
                            opacity: 8,
                            speed: 3
                        },
                        repulse: {
                            distance: 200,
                            duration: 0.4
                        },
                        push: {
                            particles_nb: 4
                        },
                        remove: {
                            particles_nb: 2
                        }
                    }
                },
                retina_detect: true
            });
        }

        $('.textillate').textillate({
            // the default selector to use when detecting multiple texts to animate
            selector: '.texts',

            // enable looping
            loop: true,

            // sets the minimum display time for each text before it is replaced
            minDisplayTime: 2000,

            // sets the initial delay before starting the animation
            // (note that depending on the in effect you may need to manually apply
            // visibility: hidden to the element before running this plugin)
            initialDelay: 0,

            // set whether or not to automatically start animating
            autoStart: true,

            // custom set of 'in' effects. This effects whether or not the
            // character is shown/hidden before or after an animation
            inEffects: [''],

            // custom set of 'out' effects
            outEffects: [''],

            // in animation settings
            in: {
                // set the effect name
                effect: 'flipInX',

                // set the delay factor applied to each consecutive character
                delayScale: 1.5,

                // set the delay between each character
                delay: 50,

                // set to true to animate all the characters at the same time
                sync: false,

                // randomize the character sequence
                // (note that shuffle doesn't make sense with sync = true)
                shuffle: false,

                // reverse the character sequence
                // (note that reverse doesn't make sense with sync = true)
                reverse: false,

                // callback that executes once the animation has finished
                callback: function() {}
            },

            // out animation settings.
            out: {
                effect: 'flipOutX',
                delayScale: 1.5,
                delay: 50,
                sync: false,
                shuffle: false,
                reverse: false,
                callback: function() {}
            },

            // callback that executes once textillate has finished
            callback: function() {},

            // set the type of token to animate (available types: 'char' and 'word')
            type: 'char'
        });
        $('.textillate h2').textillate({
            // the default selector to use when detecting multiple texts to animate
            selector: '.texts',

            // enable looping
            loop: true,

            // sets the minimum display time for each text before it is replaced
            minDisplayTime: 2000,

            // sets the initial delay before starting the animation
            // (note that depending on the in effect you may need to manually apply
            // visibility: hidden to the element before running this plugin)
            initialDelay: 0,

            // set whether or not to automatically start animating
            autoStart: true,

            // custom set of 'in' effects. This effects whether or not the
            // character is shown/hidden before or after an animation
            inEffects: [''],

            // custom set of 'out' effects
            outEffects: [''],

            // in animation settings
            in: {
                // set the effect name
                effect: 'flipInX',

                // set the delay factor applied to each consecutive character
                delayScale: 1.5,

                // set the delay between each character
                delay: 50,

                // set to true to animate all the characters at the same time
                sync: false,

                // randomize the character sequence
                // (note that shuffle doesn't make sense with sync = true)
                shuffle: false,

                // reverse the character sequence
                // (note that reverse doesn't make sense with sync = true)
                reverse: false,

                // callback that executes once the animation has finished
                callback: function() {}
            },

            // out animation settings.
            out: {
                effect: 'flipOutX',
                delayScale: 1.5,
                delay: 50,
                sync: false,
                shuffle: false,
                reverse: false,
                callback: function() {}
            },

            // callback that executes once textillate has finished
            callback: function() {},

            // set the type of token to animate (available types: 'char' and 'word')
            type: 'char'
        });
    }

    var ProductsMasonryHandler = function($scope, $, callback) {
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

    var ProductsSidebarHandler = function($scope, $, callback) {
        var $parent = $scope.find('.has_child');

        $parent.click(function() {
            $(this).toggleClass('open');
            $(this).find('.__child').slideToggle();
        })
    }

    var TextAnimationHandler = function($scope, $, callback) {
        var $tlt_ele = $scope.find(".tlt");

        $tlt_ele.textillate({
            loop: true,
            initialDelay: 0,
            delay: 50,
        });
    }

    $(document).ready(function() {
    if ($('header').hasClass('header-fixed')) {
        HeaderScrollSticky();
    }

    function HeaderScrollSticky() {
        var stickMenuEl = $('header').children();
        var offsetTop = (stickMenuEl.hasClass('header-fixed')) ? $('html').offset().top : stickMenuEl.offset().top;
        var menuOffset = {
                top: offsetTop,
                height: stickMenuEl.innerHeight()
            },
            scroll = 0,
            position = $(window).scrollTop();

        /* update offset */
        $(window).on('resize', function() {
            stickMenuEl.removeClass('stick-menu', function() {
                menuOffset = {
                    top: offsetTop,
                    height: stickMenuEl.innerHeight()
                };
            });
        })

        $(window).on('scroll', function() {
            scroll = $(this).scrollTop();

            if (scroll >= (menuOffset.top + menuOffset.height)) {
                if (!stickMenuEl.hasClass('stick-menu')) {
                    stickMenuEl.addClass('stick-menu')
                }

                // if( alwaysShow == true && firstScroll == true ) {
                // 	firstScroll = false;
                // 	stickMenuEl.addClass( 'stick-show' );
                // 	console.log(alwaysShow, firstScroll);
                // }

                if (scroll > position) {
                    /* down */
                    if (!stickMenuEl.hasClass('stick-hide'))
                        stickMenuEl.removeClass('stick-show stick-hide').addClass('stick-hide');

                } else {
                    /* up */
                    if (!stickMenuEl.hasClass('stick-show'))
                        stickMenuEl.removeClass('stick-show stick-hide').addClass('stick-show');
                }
            } else {
                stickMenuEl.removeClass('stick-menu');
            }

            position = scroll;
        })
    }
    $('#backtotop').hide();
    $(window).scroll(function(){
        if ($(this).scrollTop() > 500) {
            $('#backtotop').fadeIn();
        } else {
            $('#backtotop').fadeOut();
        }
    });
    $('#backtotop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 'slow');
        return false;
    });
})

// Make sure you run this code under Elementor.
$(window).on('elementor/frontend/init', function() {

elementorFrontend.hooks.addAction('frontend/element_ready/be-counter.default', CounterHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-countdown.default', CountDownHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-pie-chart.default', PieChartHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-video-play-button.default', MagnificPopupHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.default', MagnificPopupHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-pumori', MagnificPopupHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-baruntse', MagnificPopupHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-coropuna', MagnificPopupHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-cholatse', MagnificPopupHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-base-carousel.default', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-base-carousel.skin-grid-pumori', SwiperSliderHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-logo-carousel.default', SwiperSliderHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.default', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-grid-nevado', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-baruntse', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-coropuna', SwiperSliderThumbsHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-ampato', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-andrus', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-saltoro', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changtse', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changla', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-galloway', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-jorasses', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-cholatse', SwiperSliderHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-members.skin-pumori', FilterPostHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.default', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-pumori', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-batura', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-changla', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-havsula', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-taboche', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-cerredo', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-cholatse', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-jimara', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-members-carousel.skin-nuptse', SwiperSliderHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-posts.skin-grid-yutmaru', FilterPostHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.default', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-pumori', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-baruntse', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-coropuna', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-andrus', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-saltoro', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-batura', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-changtse', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-taboche', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-castor', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-wilson', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-jorasses', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-michelson', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-cerredo', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-gangri', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-sankar', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-cholatse', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-tronador', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-jimara', SwiperSliderHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-projects-carousel.default', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-projects-carousel.skin-grid-hardeol', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-projects-carousel.skin-grid-galloway', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-projects-carousel.skin-grid-jorasses', SwiperSliderHandler);

elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-animation.default', BannerAnimationHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-animation.skin-full-content', BannerAnimationHandler);

// WooCommerce.
elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.default', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-andrus', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-havsula', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-ramble', SwiperSliderHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-products-masonry.default', ProductsMasonryHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-products-sidebar.default', ProductsSidebarHandler);
elementorFrontend.hooks.addAction('frontend/element_ready/be-text-animation.default', TextAnimationHandler);

});

})(jQuery);
