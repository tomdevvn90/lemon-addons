(function ($) {
    "use strict";


    const BannerImageBoxHandler = function( $scope, $ ) {
  
        const $element = $scope.find('.elementor-banner-image-box');

        const bannerImage = $element.find('.elementor-banner-image-box--banner-image');

        const $tlt_ele = $element.find(".tlt");

        $tlt_ele.textillate({
            loop: true,
            initialDelay: 0,
            delay: 50,
        });

        function bannerImageBoxPositionTop( bannerImage ) {
            const bannerImageThumb = bannerImage.find('.img-item-banner img');
            const bannerImageItemTwo = bannerImage.find('.img-item-two');
            const bannerImageTwo = bannerImage.find('.img-two');
            const bannerImageItemThree = bannerImage.find('.img-item-three');
            const bannerImageThree = bannerImage.find('.img-three');

            const bannerImageHeight = (bannerImageThumb)? bannerImageThumb.innerHeight() : bannerImage.innerHeight();
            console.log( bannerImageHeight );
            const bannerImageTwoHeight = bannerImageTwo.innerHeight();
            const bannerImageTwoBottom = bannerImageHeight - ( bannerImageTwoHeight / 1.35);
            bannerImageItemTwo.css( 'bottom', bannerImageTwoBottom + 'px' );

            const bannerImageThreeHeight = bannerImageThree.innerHeight();
            const bannerImageThreeBottom = bannerImageHeight - ( bannerImageThreeHeight / 1.35);
            bannerImageItemThree.css( 'bottom', bannerImageThreeBottom + 'px' );
        }
        
        $(window).on('load', function() {
            bannerImageBoxPositionTop( bannerImage );
        });

        $(window).on('resize', function() {
            bannerImageBoxPositionTop( bannerImage );
        });

    }


    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/be-banner-image-box.default', BannerImageBoxHandler);
    });

})(jQuery); 