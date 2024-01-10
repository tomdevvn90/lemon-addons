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