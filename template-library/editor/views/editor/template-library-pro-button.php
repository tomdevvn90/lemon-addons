<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly
include('bt-template-library-live-button.php');
?>
<# var isActivated = window.ElementAddonLibreryData.license.activated; #>

<# if(isActivated == false){ #>
<# var proLink = window.ElementAddonLibreryData.license.link; #>

<a  href="{{ proLink }}" target="_blank" >
	<button class="elementor-template-library-template-action bt-elementaddon-preview-button-go-pro bt-elementaddon-template-library-template-insert bt-elementaddon-preview-button-go-pro elementor-button elementor-button-success" >
		<i class="eicon-heart"></i><span class="elementor-button-title"><?php
			esc_html_e( 'Go Pro', 'bearsthemes-element-addon' );
		?></span>
	</button>
</a>
<# } #>