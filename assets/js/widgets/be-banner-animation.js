(function ($) {
    "use strict";


    const BannerAnimationHandler = function($scope, $) {
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

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-animation.default', BannerAnimationHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-animation.skin-full-content', BannerAnimationHandler);
    });

})(jQuery); 