(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/plugin"],{

/***/ "./assets/js/plugin.js":
/*!*****************************!*\
  !*** ./assets/js/plugin.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _widgets_be_team_carousel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./widgets/be-team-carousel */ "./assets/js/widgets/be-team-carousel.js");
/* harmony import */ var _widgets_be_posts_carousel__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./widgets/be-posts-carousel */ "./assets/js/widgets/be-posts-carousel.js");



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

__webpack_require__(/*! C:\Users\Vuong\Local Sites\lemon-spa-dev\app\public\wp-content\plugins\lemon-addons\assets\js\plugin.js */"./assets/js/plugin.js");
module.exports = __webpack_require__(/*! C:\Users\Vuong\Local Sites\lemon-spa-dev\app\public\wp-content\plugins\lemon-addons\assets\scss\plugin.scss */"./assets/scss/plugin.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);