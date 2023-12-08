<?php
/**
 * Template item
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<# var proLink = window.ElementAddonLibreryData.license.link; #>
<# var isActivated = window.ElementAddonLibreryData.license.activated; #>
<# var newDemoRateDate = window.ElementAddonLibreryData.new_demo_rang_date; #>

<div class="elementor-template-library-template-body">
	<div class="elementor-template-library-template-screenshot">
		<div class="elementor-template-library-template-preview">
			<i class="fa fa-search-plus"></i>
		</div>
		<img src="{{ thumbnail }}" alt="">
	</div>
    <# if ( newDemoRateDate < date ) { #>
    <span class="bt-new-item">NEW</span>
    <# } #>
    <# if ( 1 == is_pro ) { #>
    <span class="bt-pro-item">PRO</span>
    <# } #>
</div>
<div class="elementor-template-library-template-controls">
    <# if ( 1 != is_pro ) { #>
        <?php include('bt-template-library-item-import-btn.php'); ?>
    <# } else { #>
        <# if(isActivated) { #>
            <?php include('bt-template-library-item-import-btn.php'); ?>
        <# } else { #>
            <a class="elementor-template-library-template-action elementor-button bt-elementaddon-template-library-template-go-pro" href="{{ proLink }}" target="_blank">
                <i class="eicon-heart"></i><span class="elementor-button-title"><?php
                    esc_html_e( 'Get Pro', 'bearsthemes-element-addon' );
                ?></span>
            </a>
	    <# } #>
	<# } #>

</div>
<div class="elementor-template-library-template-name">{{ title }}</div>