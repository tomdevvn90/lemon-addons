(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/plugin"],{

/***/ "./assets/js/components/general.js":
/*!*****************************************!*\
  !*** ./assets/js/components/general.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {jQuery(function ($) {
  "use strict";

  var HeaderScrollSticky = function HeaderScrollSticky() {
    if ($('header').hasClass('header-fixed')) {
      __handleScroll();
    }
    function __handleScroll() {
      var stickMenuEl = $('header').children();
      var offsetTop = stickMenuEl.hasClass('header-fixed') ? $('html').offset().top : stickMenuEl.offset().top;
      var menuOffset = {
          top: offsetTop,
          height: stickMenuEl.innerHeight()
        },
        scroll = 0,
        position = $(window).scrollTop();

      /* update offset */
      $(window).on('resize', function () {
        stickMenuEl.removeClass('stick-menu', function () {
          menuOffset = {
            top: offsetTop,
            height: stickMenuEl.innerHeight()
          };
        });
      });
      $(window).on('scroll', function () {
        scroll = $(this).scrollTop();
        if (scroll >= menuOffset.top + menuOffset.height) {
          if (!stickMenuEl.hasClass('stick-menu')) {
            stickMenuEl.addClass('stick-menu');
          }
          if (scroll > position) {
            /* down */
            if (!stickMenuEl.hasClass('stick-hide')) stickMenuEl.removeClass('stick-show stick-hide').addClass('stick-hide');
          } else {
            /* up */
            if (!stickMenuEl.hasClass('stick-show')) stickMenuEl.removeClass('stick-show stick-hide').addClass('stick-show');
          }
        } else {
          stickMenuEl.removeClass('stick-menu');
        }
        position = scroll;
      });
    }
  };
  var BtnBackTop = function BtnBackTop() {
    $('#backtotop').hide();
    $(window).scroll(function () {
      if ($(this).scrollTop() > 500) {
        $('#backtotop').fadeIn();
      } else {
        $('#backtotop').fadeOut();
      }
    });
    $('#backtotop').click(function () {
      $("html, body").animate({
        scrollTop: 0
      }, 'slow');
      return false;
    });
  };
  $(document).ready(function () {
    HeaderScrollSticky();
    BtnBackTop();
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/plugin.js":
/*!*****************************!*\
  !*** ./assets/js/plugin.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_general__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/general */ "./assets/js/components/general.js");
/* harmony import */ var _components_general__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_components_general__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _widgets_be_team_carousel__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./widgets/be-team-carousel */ "./assets/js/widgets/be-team-carousel.js");
/* harmony import */ var _widgets_be_posts_carousel__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./widgets/be-posts-carousel */ "./assets/js/widgets/be-posts-carousel.js");
/* harmony import */ var _widgets_be_testimonial_carousel__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./widgets/be-testimonial-carousel */ "./assets/js/widgets/be-testimonial-carousel.js");
/* harmony import */ var _widgets_be_logo_carousel__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./widgets/be-logo-carousel */ "./assets/js/widgets/be-logo-carousel.js");
/* harmony import */ var _widgets_be_base_carousel__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./widgets/be-base-carousel */ "./assets/js/widgets/be-base-carousel.js");
/* harmony import */ var _widgets_be_products_carousel__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./widgets/be-products-carousel */ "./assets/js/widgets/be-products-carousel.js");
/* harmony import */ var _widgets_be_products_sidebar__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./widgets/be-products-sidebar */ "./assets/js/widgets/be-products-sidebar.js");
/* harmony import */ var _widgets_be_products_sidebar__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_products_sidebar__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _widgets_be_text_animations__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./widgets/be-text-animations */ "./assets/js/widgets/be-text-animations.js");
/* harmony import */ var _widgets_be_text_animations__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_text_animations__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _widgets_be_before_after__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./widgets/be-before-after */ "./assets/js/widgets/be-before-after.js");
/* harmony import */ var _widgets_be_before_after__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_before_after__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var _widgets_be_banner_image_box__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./widgets/be-banner-image-box */ "./assets/js/widgets/be-banner-image-box.js");
/* harmony import */ var _widgets_be_banner_image_box__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_banner_image_box__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var _widgets_be_banner_animation__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./widgets/be-banner-animation */ "./assets/js/widgets/be-banner-animation.js");
/* harmony import */ var _widgets_be_banner_animation__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_banner_animation__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var _widgets_be_posts__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./widgets/be-posts */ "./assets/js/widgets/be-posts.js");
/* harmony import */ var _widgets_be_posts__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_posts__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var _widgets_be_video_box__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./widgets/be-video-box */ "./assets/js/widgets/be-video-box.js");
/* harmony import */ var _widgets_be_video_box__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_video_box__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var _widgets_be_pie_chart__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./widgets/be-pie-chart */ "./assets/js/widgets/be-pie-chart.js");
/* harmony import */ var _widgets_be_pie_chart__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_pie_chart__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var _widgets_be_counter__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./widgets/be-counter */ "./assets/js/widgets/be-counter.js");
/* harmony import */ var _widgets_be_countdown__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./widgets/be-countdown */ "./assets/js/widgets/be-countdown.js");
/* harmony import */ var _widgets_be_countdown__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(_widgets_be_countdown__WEBPACK_IMPORTED_MODULE_16__);
//component


// all widgets

















/***/ }),

/***/ "./assets/js/widgets/be-banner-animation.js":
/*!**************************************************!*\
  !*** ./assets/js/widgets/be-banner-animation.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var BannerAnimationHandler = function BannerAnimationHandler($scope, $) {
    var animation_type = $scope.find("#particles-js").data('animation');
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
      "in": {
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
        callback: function callback() {}
      },
      // out animation settings.
      out: {
        effect: 'flipOutX',
        delayScale: 1.5,
        delay: 50,
        sync: false,
        shuffle: false,
        reverse: false,
        callback: function callback() {}
      },
      // callback that executes once textillate has finished
      callback: function callback() {},
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
      "in": {
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
        callback: function callback() {}
      },
      // out animation settings.
      out: {
        effect: 'flipOutX',
        delayScale: 1.5,
        delay: 50,
        sync: false,
        shuffle: false,
        reverse: false,
        callback: function callback() {}
      },
      // callback that executes once textillate has finished
      callback: function callback() {},
      // set the type of token to animate (available types: 'char' and 'word')
      type: 'char'
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-animation.default', BannerAnimationHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-animation.skin-full-content', BannerAnimationHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-banner-image-box.js":
/*!**************************************************!*\
  !*** ./assets/js/widgets/be-banner-image-box.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var BannerImageBoxHandler = function BannerImageBoxHandler($scope, $) {
    var $element = $scope.find('.elementor-banner-image-box');
    var bannerImage = $element.find('.elementor-banner-image-box--banner-image');
    var $tlt_ele = $element.find(".tlt");
    $tlt_ele.textillate({
      loop: true,
      initialDelay: 0,
      delay: 50
    });
    function bannerImageBoxPositionTop(bannerImage) {
      var bannerImageThumb = bannerImage.find('.img-item-banner img');
      var bannerImageItemTwo = bannerImage.find('.img-item-two');
      var bannerImageTwo = bannerImage.find('.img-two');
      var bannerImageItemThree = bannerImage.find('.img-item-three');
      var bannerImageThree = bannerImage.find('.img-three');
      var bannerImageHeight = bannerImageThumb ? bannerImageThumb.innerHeight() : bannerImage.innerHeight();
      console.log(bannerImageHeight);
      var bannerImageTwoHeight = bannerImageTwo.innerHeight();
      var bannerImageTwoBottom = bannerImageHeight - bannerImageTwoHeight / 1.35;
      bannerImageItemTwo.css('bottom', bannerImageTwoBottom + 'px');
      var bannerImageThreeHeight = bannerImageThree.innerHeight();
      var bannerImageThreeBottom = bannerImageHeight - bannerImageThreeHeight / 1.35;
      bannerImageItemThree.css('bottom', bannerImageThreeBottom + 'px');
    }
    $(window).on('load', function () {
      bannerImageBoxPositionTop(bannerImage);
    });
    $(window).on('resize', function () {
      bannerImageBoxPositionTop(bannerImage);
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-image-box.default', BannerImageBoxHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-base-carousel.js":
/*!***********************************************!*\
  !*** ./assets/js/widgets/be-base-carousel.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var SwiperSliderHandler = function SwiperSliderHandler($scope, $) {
    var $selector = $scope.find('.swiper-container');
    if ($selector.length > 0) {
      var $dataSwiper = $selector.data('swiper');
      var opt_df = {
        loop: true,
        paginationClickable: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination'
        },
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Navigation"], swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Pagination"]]
      };
      var widgetSlider = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"]($selector[0], Object.assign({}, opt_df, $dataSwiper));
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-base-carousel.default', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-base-carousel.skin-grid-pumori', SwiperSliderHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-before-after.js":
/*!**********************************************!*\
  !*** ./assets/js/widgets/be-before-after.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var BeforeAfterImageHandler = function BeforeAfterImageHandler($scope, $) {
    var twentytwentyContainer = $scope.find('.twentytwenty-container');
    var data_twentytwenty = twentytwentyContainer.data('twentytwenty');
    twentytwentyContainer.twentytwenty(data_twentytwenty);
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-before-after.default', BeforeAfterImageHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-countdown.js":
/*!*******************************************!*\
  !*** ./assets/js/widgets/be-countdown.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var CountDownHandler = function CountDownHandler($scope, $) {
    //console.log($scope);
    $scope.find('.countdown').each(function () {
      var $countdownTime = $(this).attr('data-countdown'),
        $countdownFormat = $(this).attr('data-format');
      $(this).countdown({
        until: $countdownTime,
        format: $countdownFormat,
        padZeroes: true
      });
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-countdown.default', CountDownHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-counter.js":
/*!*****************************************!*\
  !*** ./assets/js/widgets/be-counter.js ***!
  \*****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var CounterHandler = function CounterHandler($scope, $) {
    //console.log($scope);
    var $selector = $scope.find('.elementor-counter__number'),
      $dataCounter = $selector.data('counter'),
      waypoint = new Waypoint({
        element: $selector,
        handler: function handler() {
          $selector.numerator($dataCounter);
        },
        offset: '100%',
        triggerOnce: true
      });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-counter.default', CounterHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-logo-carousel.js":
/*!***********************************************!*\
  !*** ./assets/js/widgets/be-logo-carousel.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var SwiperSliderHandler = function SwiperSliderHandler($scope, $) {
    var $selector = $scope.find('.swiper-container');
    if ($selector.length > 0) {
      var $dataSwiper = $selector.data('swiper');
      var opt_df = {
        loop: true,
        paginationClickable: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination'
        },
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Navigation"], swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Pagination"]]
      };
      var widgetSlider = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"]($selector[0], Object.assign({}, opt_df, $dataSwiper));
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-logo-carousel.default', SwiperSliderHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-pie-chart.js":
/*!*******************************************!*\
  !*** ./assets/js/widgets/be-pie-chart.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var PieChartHandler = function PieChartHandler($scope, $) {
    //console.log($scope);
    $scope.find('.elementor-pie-chart__progress').each(function () {
      if (!$(this).length) {
        return;
      }
      getPieChart($(this));
    });
    function getPieChart($selector) {
      var $innerText = $selector.data('innertext'),
        $strokeWidth = $selector.data('strokewidth'),
        $easing = $selector.data('easing'),
        $duration = $selector.data('duration'),
        $color = $selector.data('color'),
        $trailColor = $selector.data('trailcolor'),
        $trailWidth = $selector.data('trailwidth'),
        $toColor = $selector.data('tocolor'),
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
        step: function step(state, bar) {
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
          handler: function handler() {
            bar.animate($barWidth); // Number from 0.0 to 1.0
          },
          offset: '100%',
          triggerOnce: true
        });
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-pie-chart.default', PieChartHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-posts-carousel.js":
/*!************************************************!*\
  !*** ./assets/js/widgets/be-posts-carousel.js ***!
  \************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var SwiperSliderHandler = function SwiperSliderHandler($scope, $) {
    var $selector = $scope.find('.swiper-container');
    if ($selector.length > 0) {
      var $dataSwiper = $selector.data('swiper');
      var opt_df = {
        loop: true,
        paginationClickable: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination'
        },
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Navigation"], swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Pagination"]]
      };
      var widgetSlider = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"]($selector[0], Object.assign({}, opt_df, $dataSwiper));
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
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
    elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-cosmetics', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-wellness', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-lemon-tattoo', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-grid-beauty', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-posts-carousel.skin-lemon-dentist', SwiperSliderHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-posts.js":
/*!***************************************!*\
  !*** ./assets/js/widgets/be-posts.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var FilterPostHandler = function FilterPostHandler($scope, $) {
    //console.log($scope);
    // Get all items
    var items = [];
    $scope.find('.elementor-item').each(function () {
      items.push('<div class="animate__hide ' + $(this).attr('class') + '" data-group="' + $(this).data('group') + '">' + $(this).html() + '</div>');
    });

    // click filter navigation
    $scope.find('.elementor-filter a').click(function (e) {
      e.preventDefault();
      if ($(this).hasClass('active')) {
        return;
      }
      $('.elementor-filter a').removeClass('active');
      $(this).addClass('active');
      var group = $(this).data('filter');
      $scope.find('.elementor-item').addClass('animate__hide');
      $scope.find('.elementor-item').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
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
          }
          ;
        }
        if ('' === result) {
          result += '<div class="elementor-' + $scope.find('.elementor-filter').data('type') + ' elementor-item no-result" data-group="' + group + '"><strong>No result.</strong> Please add post to category!</div>';
        }
        $scope.find('.elementor-grid').html(result);
        $scope.find('.elementor-item').removeClass('animate__hide').addClass('animate__show');
        $scope.find('.give-card__progress-custom .give-goal-progress').each(function () {
          if (!$(this).parent().hasClass('give-card__progress-custom') || !$(this).find('.give-progress-bar').length) {
            return;
          }
          getProgressBarFilter($(this));
        });
      });
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-posts.skin-grid-yutmaru', FilterPostHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-products-carousel.js":
/*!***************************************************!*\
  !*** ./assets/js/widgets/be-products-carousel.js ***!
  \***************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var SwiperSliderHandler = function SwiperSliderHandler($scope, $) {
    var $selector = $scope.find('.swiper-container');
    if ($selector.length > 0) {
      var $dataSwiper = $selector.data('swiper');
      var opt_df = {
        loop: true,
        paginationClickable: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination'
        },
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Navigation"], swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Pagination"]]
      };
      var widgetSlider = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"]($selector[0], Object.assign({}, opt_df, $dataSwiper));
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.default', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-andrus', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-grid-havsula', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-ramble', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-cosmetics', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-wellness', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-carousel.skin-list-spa', SwiperSliderHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-products-sidebar.js":
/*!**************************************************!*\
  !*** ./assets/js/widgets/be-products-sidebar.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var ProductsSidebarHandler = function ProductsSidebarHandler($scope, $, callback) {
    var $parent = $scope.find('.has_child');
    $parent.click(function () {
      $(this).toggleClass('open');
      $(this).find('.__child').slideToggle();
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-products-sidebar.default', ProductsSidebarHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-team-carousel.js":
/*!***********************************************!*\
  !*** ./assets/js/widgets/be-team-carousel.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var SwiperSliderHandler = function SwiperSliderHandler($scope, $) {
    var $selector = $scope.find('.swiper-container');
    if ($selector.length > 0) {
      var $dataSwiper = $selector.data('swiper');
      var opt_df = {
        loop: true,
        paginationClickable: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination'
        },
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Navigation"], swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Pagination"]]
      };
      var widgetSlider = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"]($selector[0], Object.assign({}, opt_df, $dataSwiper));
    }
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-team-carousel.default', SwiperSliderHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-testimonial-carousel.js":
/*!******************************************************!*\
  !*** ./assets/js/widgets/be-testimonial-carousel.js ***!
  \******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(jQuery) {/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");


(function ($) {
  "use strict";

  var SwiperSliderHandler = function SwiperSliderHandler($scope, $) {
    var $selector = $scope.find('.swiper-container');
    if (!$selector.length) return;
    var $dataSwiper = $selector.data('swiper');
    var opt_df = {
      loop: true,
      paginationClickable: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      pagination: {
        el: '.swiper-pagination'
      },
      modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Navigation"], swiper_modules__WEBPACK_IMPORTED_MODULE_1__["Pagination"]]
    };
    var widgetSlider = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"]($selector[0], Object.assign({}, opt_df, $dataSwiper));
  };

  // const SwiperSliderThumbsHandler = function($scope, $) {

  //     const $isWidget =  $('.elementor-testimonials--skin-list-coropuna')
  //     if (!$isWidget.length) return;

  //     const $parent = $('.swiper-main.elementor-testimonials--skin-list-coropuna')

  //console.log($scope);

  // const $selector_thumbs = $scope.find('.swiper-thumbs .swiper-container');
  // if (!$selector_thumbs.length) return;

  // let opt_df = {
  //     loop: true,
  //     paginationClickable: true,
  //     navigation: {
  //         nextEl: '.swiper-button-next',
  //         prevEl: '.swiper-button-prev',
  //     },
  //     pagination: {
  //         el: '.swiper-pagination',
  //     },
  //     modules: [Navigation, Pagination],
  // };

  // let $dataSwiperThumbs = $selector_thumbs.data('swiper');
  // const thumbSwiper = new Swiper($selector_thumbs[0],  Object.assign({}, opt_df, $dataSwiperThumbs))

  //     console.log($dataSwiperThumbs)
  // let v = $('.swiper-thumbs')
  // var $selector = $scope.find('.swiper-main .swiper-container'),
  //     $dataSwiper = $selector.data('swiper');

  // // $dataSwiper['thumbs'] = {
  // //     swiper: thumbSwiper,
  // // };

  // let opt_df_s = {
  //     loop: true,
  //     navigation: {
  //         nextEl: ".swiper-button-next",
  //         prevEl: ".swiper-button-prev",
  //       },
  //       thumbs: {
  //         swiper: thumbSwiper,
  //       },

  // };

  // console.log(v)

  // const mainSwiper = new Swiper($selector[0],  Object.assign({}, opt_df_s, $dataSwiper))
  // };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.default', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-grid-nevado', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-baruntse', SwiperSliderHandler);
    // elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-coropuna', SwiperSliderThumbsHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-ampato', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-andrus', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-saltoro', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changtse', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-changla', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-galloway', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-jorasses', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-list-cholatse', SwiperSliderHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-testimonial-carousel.skin-lemon-tattoo', SwiperSliderHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-text-animations.js":
/*!*************************************************!*\
  !*** ./assets/js/widgets/be-text-animations.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var TextAnimationHandler = function TextAnimationHandler($scope, $, callback) {
    var $tlt_ele = $scope.find(".tlt");
    $tlt_ele.textillate({
      loop: true,
      initialDelay: 0,
      delay: 50
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-text-animation.default', TextAnimationHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/js/widgets/be-video-box.js":
/*!*******************************************!*\
  !*** ./assets/js/widgets/be-video-box.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function ($) {
  "use strict";

  var MagnificPopupHandler = function MagnificPopupHandler($scope, $) {
    //console.log($scope);
    $scope.find('.elementor-open-popup-link').magnificPopup({
      type: 'inline',
      midClick: true
    });
  };

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/be-video-play-button.default', MagnificPopupHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.default', MagnificPopupHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-pumori', MagnificPopupHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-baruntse', MagnificPopupHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-coropuna', MagnificPopupHandler);
    elementorFrontend.hooks.addAction('frontend/element_ready/be-video-box.skin-cholatse', MagnificPopupHandler);
  });
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/scss/plugin.scss":
/*!*********************************!*\
  !*** ./assets/scss/plugin.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./assets/js/plugin.js ./assets/scss/plugin.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/buitantoan/Local Sites/lemonspa/app/public/wp-content/plugins/lemon-addons/assets/js/plugin.js */"./assets/js/plugin.js");
module.exports = __webpack_require__(/*! /Users/buitantoan/Local Sites/lemonspa/app/public/wp-content/plugins/lemon-addons/assets/scss/plugin.scss */"./assets/scss/plugin.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);