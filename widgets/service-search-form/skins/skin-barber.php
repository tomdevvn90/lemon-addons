<?php
namespace BearsthemesAddons\Widgets\Search_Form\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Barber extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-testimonial-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
	
	}

	public function get_id() { 
		return 'skin-barber';
	}


	public function get_title() {
		return __( 'Barber', 'bearsthemes-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;


	}



	public function render() {
		$settings = $this->parent->get_settings();
		if( $settings['_skin'] ) {
			$class_form = 'search-form-box search-form-box--' . $settings['_skin'];
		} else {
			$class_form = 'search-form-box  search-form-box--default';
		}

		$cat_args = array(
			'post_type' => 'product',
			'post_status' => 'publish'
		);
		$product_categories = get_terms( 'product_cat', $cat_args );

		
		?>

    <div class="<?php echo $class_form; ?>">   
      <h3><?php echo $settings['title'] ?></h3>
      <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
        <input type="text" name="s" placeholder="Search Products"/>
        <input type="hidden" name="post_type" value="products" />
				<select id="cars" name="product_cat">
					<?php
						if( !empty($product_categories) ){
							foreach ($product_categories as $key => $category) {
								echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
							}
						}
					?>
				</select>
        <input type="submit" alt="Search" value="<?php echo $settings['button_text'] ?>" />
      </form>
    </div>

		<?php

	}

	protected function content_template() {

	}

}
