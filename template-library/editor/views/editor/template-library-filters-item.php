<?php
/**
 * Template Library Header Template
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<label class="bt-elementaddon-template-library-filter-label">
    <input type="radio" value="{{ term_slug }}" <# if ( '' === term_slug ) { #> checked<# } #> name="bt-elementaddon-library-filter">
    <span>{{ term_name }} <span class="ep-category-badge">{{ count }}</span></span>
</label>