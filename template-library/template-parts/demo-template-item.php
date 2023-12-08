<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
$termslug      = isset($data['term_slug']) ? $data['term_slug'] : '';
$template_id   = isset($data['demo_id']) ? $data['demo_id'] : '';
$is_pro        = isset($data['is_pro']) ? $data['is_pro'] : '';
$demo_title    = isset($data['title']) ? $data['title'] : '';
$demo_desc     = isset($data['short_desc']) ? $data['short_desc'] : '';
$preview_url   = isset($data['demo_url']) ? $data['demo_url'] : '';
$json_url      = isset($data['json_url']) ? $data['json_url'] : '';
$demo_thumb    = isset($data['thumbnail']) ? $data['thumbnail'] : '';
$template_date = isset($data['date']) ? $data['date'] : '';
$plugins       = (isset($data['plugins']) && is_array($data['plugins'])) ? $data['plugins'] : array();
$tags          = (isset($data['tags']) && is_array($data['tags'])) ? $data['tags'] : array();
$is_new_demo   = $template_date > $this->new_demo_rang_date;

$tagsString    = "";
if(is_array($tags)){
    $tagsString = implode(" ", $tags);
}
$sorting_date = str_replace('-', '', $template_date);

if (!$demo_thumb) {
    $demo_thumb = BTEP_ASSETS_URL . 'images/block.jpg';
}
?>
<div class="demo-importer-template-item demo-importer-template-item-index"
     data-demo="<?php echo esc_attr($template_date) ?>"
     data-title="<?php echo strtolower($demo_title) ?> <?php echo strtolower($tagsString); ?>"
     data-category="<?php echo esc_attr($termslug); ?>"
     data-pro="<?php echo esc_attr($is_pro); ?>">
    <div class="bt-hidden plugin-content-item">
        <?php
            $install_txt = esc_html__('This template need this plugin install and active', 'bearsthemes-element-addon');
        ?>
        <li title="<?php echo esc_html($install_txt); ?>" data-slug="bearsthemes-element-addon" ><span class="bt-plugin installed"></span> <span class="bt-plugin-name">Element Addon</span></li>
        <?php foreach($plugins as $key=>$val): ?>
            <li title="<?php echo esc_html($install_txt); ?>" data-slug="<?php echo esc_attr($key) ?>" ><span class="bt-plugin installed"></span> <span class="bt-plugin-name"><?php echo esc_attr($val) ?></span></li>
        <?php endforeach ?>
    </div>

    <div class="bt-template-library-item bt-pro bt-card bt-card-default <?php echo esc_attr(($is_new_demo) ? 'new-template' : '') ?>">
        <div class="thumbnail bt-position-relative">
            <img src="<?php echo $demo_thumb ?>" alt="<?php echo esc_attr($demo_title) ?>">

            <div class="bt-position-top-right bt-position-small">
                <span class="bt-badge bt-background-<?php echo esc_html(($is_pro == 1) ? 'pro' : 'free') ?>">
                    <?php echo esc_html(($is_pro == 1) ? 'Pro' : 'Free') ?>
                </span>
            </div>

            <div class="demo-template-action bt-flex bt-position-bottom bt-position-small">
                <a href="javascript:void(0)"
                   class="bt-button bt-button-secondary import-demo-btn"
                   data-demo-id="<?php echo esc_attr($template_id) ?>"
                   data-demo-url="<?php echo esc_attr($json_url) ?>"
                   data-demo-title="<?php echo esc_html($demo_title) ?>">Import</a>

                <a href="<?php echo esc_url($preview_url) ?>"
                   class="bt-button bt-button-danger"
                   target="_blank">Preview</a>
            </div>

        </div>

        <div class="bt-card-footer">
            <h2 class="title"><?php echo esc_html($demo_title) ?></h2>
        </div>
    </div>
</div>