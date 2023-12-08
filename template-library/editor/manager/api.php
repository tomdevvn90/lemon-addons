<?php

namespace ElementAddon\Includes\TemplateLibrary\Editor\Manager;
use ElementAddon\Includes\TemplateLibrary\ElementAddon_Template_Library_Base;
use Elementor\Core\Common\Modules\Ajax\Module as Ajax;
use Elementor\TemplateLibrary\Source_Base;

defined('ABSPATH') || exit;
class ElementAddonTemplateLibraryEditorApi extends ElementAddon_Template_Library_Base
{
    protected $source = null;


    public function __construct()
    {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);
        parent::__construct();
        add_action('wp_ajax_bt_element_addon_template_library_get_layouts', [$this, 'get_layouts']);
        add_action('wp_ajax_bt_element_addon_template_library_making_syncing', [$this, 'sync_now']);
        add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions_data' ] );
    }

    public function register_ajax_actions_data( Ajax $ajax ) {

        $ajax->register_ajax_action( 'get_bt_elementaddon_template_data', function( $data ) {
            if ( ! current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            if ( ! empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( ! get_post( $editor_post_id ) ) {
                    throw new \Exception( __( 'Post not found', 'bearsthemes-element-addon' ) );
                }

                \Elementor\Plugin::instance()->db->switch_to_post( $editor_post_id );
            }

            if ( empty( $data['template_id'] ) ) {
                throw new \Exception( __( 'Template id missing', 'bearsthemes-element-addon' ) );
            }

            return $this->get_template_data( $data );
        } );
    }

    public function get_template_data( array $args ) {
        $source = $this->get_source();
        $result = $this->findDemo($args['template_id']);

        if(!is_array($result) || !isset($result['json_url'])){
            throw new \Exception( __( 'Template id missing', 'bearsthemes-element-addon' ) );
        }

        if($result['is_pro'] == 1 && !$this->packLicenseActivated){
            throw new \Exception( __( 'required_activated_license', 'bearsthemes-element-addon' ) );
        }

        $args['demo_json'] = $result['json_url'];
        $data = $source->get_data( $args );
        return $data;
    }

    public function get_source() {
        if ( is_null( $this->source ) ) {
            $this->source = new Library_Source();
        }

        return $this->source;
    }

    public function getCategoriesItems() {

        $this->checkDemoData();
        $demoDataType = $this->demoType;
        // Table Info
        $postTable      = $this->table_post;
        $postCatTable   = $this->table_cat_post;
        $catTable       = $this->table_cat;

        $demoData = $this->wpdb->get_results("SELECT COUNT(*) as ttotal, {$catTable}.* FROM {$postTable}
 LEFT JOIN {$postCatTable}  ON {$postTable}.demo_id = {$postCatTable}.demo_id
LEFT JOIN {$catTable} ON {$catTable}.term_id = {$postCatTable}.term_id
 WHERE type={$demoDataType} GROUP BY term_id", ARRAY_A);

        $navItems = array();
        $totalDemo = 0;
        foreach ( $demoData as $data ) {
            $total = intval($data['ttotal']);
            $totalDemo = $totalDemo + $total;
            $navItems[] = array( 'term_slug' => $data['slug'], 'term_name' => $data['name'],'term_id' => $data['term_id'],'count'=> $total);
        }
        $this->demo_total = $totalDemo;
        $firstItem = array( 'term_slug' => '', 'term_name' => 'All Templates','term_id' => 0,'count'=> $totalDemo);

        return array_merge_recursive([$firstItem], $navItems);
    }

    public function get_layouts()
    {
        isset($_REQUEST['tab']) || exit();

        $tab = (empty($_REQUEST['tab']) ? 'bt_elementaddon_page' : $_REQUEST['tab']);

        if($tab == 'bt_elementaddon_block'){
            $this->demoType = 2;
        }elseif($tab == 'bt_elementaddon_header'){
            $this->demoType = 3;
        }elseif($tab == 'bt_elementaddon_footer'){
            $this->demoType = 4;
        }elseif($tab == 'bt_elementaddon_popups'){
            $this->demoType = 5;
        }else{
            $this->demoType = 1;
        }

        $this->termSlug = 'demo_term_all';
        if(isset($_REQUEST['term_slug']) && !empty($_REQUEST['term_slug'])){
            $this->termSlug = $_REQUEST['term_slug'];
        }

        $this->perPage = 500000;

        echo wp_send_json([
            'data'=>[
                'categories'    => $this->getCategoriesItems(),
                'templates'     => $this->getElementorLibraryData()
            ]
        ],200);

    }

    public function sync_now(){
        $this->createTemplateTables();

        echo json_encode(
            array(
                'success' => true,
                'data'    => array(),
            )
        );

        wp_die();
    }
}

new ElementAddonTemplateLibraryEditorApi();