<?php

    namespace ElementAddon\Includes\TemplateLibrary\Editor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly
    class ElementAddon_Template_Library_Editor_Init {

        function __construct() {

            add_action( 'elementor/editor/before_enqueue_scripts', array($this, 'enqueue_scripts'), 1 );

            // print views and tab variables on footer.
            add_action( 'elementor/editor/footer', array($this, 'admin_inline_js') );
            add_action( 'elementor/editor/footer', array($this, 'print_views') );

            // enqueue editor css.
            add_action( 'elementor/editor/after_enqueue_styles', 'editor_styles' );

            // enqueue modal's preview css.
            add_action( 'elementor/preview/enqueue_styles', 'preview_styles' );

        }

        public function enqueue_scripts() {

            wp_enqueue_script( 'bt-template-library-editor-scripts',
                plugins_url('/') . 'bearsthemes-addons/template-library/editor/assets/js/editor-template-library.min.js',
                array('jquery', 'underscore', 'backbone-marionette'),
                '1.0.0',
                true
            );

        }

        public function editor_styles() {
            $direction_suffix = is_rtl() ? '.rtl' : '';

            wp_enqueue_style( 'bt-template-library-editor-style',
                plugins_url('/') . 'bearsthemes-addons/template-library/editor/assets/css/editor-template-library' . $direction_suffix . '.css',
                array(),
                '1.0.0', true
            );
        }

        public function preview_styles() {

            $direction_suffix = is_rtl() ? '.rtl' : '';

            wp_enqueue_style( 'bt-template-library-preview-style',
                plugins_url('/') . 'bearsthemes-addons/template-library/editor/assets/css/editor-template-preview' . $direction_suffix . '.css',
                array(),
                '1.0.0', true 
            );
        }

        public function admin_inline_js() {
            ?>
            <script type="text/javascript">

                var ElementAddonLibreryData = {
                    "libraryButton"     : "Elements Button",
                    "modalRegions"      : {
                        "modalHeader" : ".dialog-header",
                        "modalContent": ".dialog-message"
                    },
                    "license"           : {
                        "activated": true, // TODO
                        "link"     : "https://elementaddon.com/pricing/"
                    },
                    "tabs"              : {
                        "bt_elementaddon_page"  : {
                            "title": "Ready Pages",
                            "data" : []
                        },
                        "bt_elementaddon_header": {
                            "title": "Headers",
                            "data" : []
                        },
                        "bt_elementaddon_footer": {
                            "title": "Footers",
                            "data" : [],
                        },
                        "bt_elementaddon_popups": {
                            "title": "Popups",
                            "data" : [],
                        },
                        "bt_elementaddon_block" : {
                            "title": "Blocks",
                            "data" : [],
                        },
                    },
                    "defaultTab"        : "bt_elementaddon_page",
                    "new_demo_rang_date": "<?php echo date( 'Ymd', strtotime( '-31 days' ) )?>"
                };

            </script>
            <?php
        }

        public function print_views() {
            foreach ( glob( dirname( __FILE__ ) . '/views/editor/*.php' ) as $file ) {
                $name = basename( $file, '.php' );
                ob_start();
                include $file;
                printf( '<script type="text/html" id="view-bt-elementaddon-%1$s">%2$s</script>', $name, ob_get_clean() );
            }
        }
    }

    new ElementAddon_Template_Library_Editor_Init();