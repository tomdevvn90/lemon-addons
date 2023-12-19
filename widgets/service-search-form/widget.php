<?php
namespace BearsthemesAddons\Widgets\Search_Form;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Embed;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Search_Form extends Widget_Base {

	public function get_name() {
		return 'be-search-form';
	}

	public function get_title() {
		return __( 'Be Search Form', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-site-search';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'bearsthemes-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Barber( $this ) );

	}
	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
			'post_type' => 'product',
			'post_status' => 'publish'
		) );

		if ( $wp_query->have_posts() ) {
	    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $supported_ids[get_the_ID()] = get_the_title();
	    }
		}

		return $supported_ids;
	}

	protected function get_supported_taxonomies() {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => 'product_cat',
	    'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
			]
		);

		
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Search', 'bearsthemes-addons' ),
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_layout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'bearsthemes-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-form-box__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-form-box__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'default' => '',
				'selector' => '{{WRAPPER}} .search-form-box__title',
			]
		);

		$this->add_control(
			'heading_desc_style',
			[
				'label' => __( 'Description', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-form-box__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'default' => '',
				'selector' => '{{WRAPPER}} .search-form-box__desc',
			]
		);

		$this->add_control(
			'form_field_style',
			[
				'label' => __( 'Form Field', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'form_field_space',
			[
				'label' => __( 'Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box form input.field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .search-form-box form select.field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',

				],
			]
		);

		$this->add_control(
			'form_field_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-form-box form input.field' => 'color: {{VALUE}};',
					'{{WRAPPER}} .search-form-box form select.field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_form_field',
				'default' => '',
				'selector' => '{{WRAPPER}} .search-form-box form input.field',
				'selector' => '{{WRAPPER}} .search-form-box form select.field'
			]
		);

		$this->add_control(
			'form_field_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form-box form input.field' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .search-form-box form select.field' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'form_field_border_width',
			[
				'label' => __( 'Border Width', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box form input.field' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .search-form-box form select.field' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'form_field_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box form input.field' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .search-form-box form select.field' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'form_field_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form-box form input.field' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .search-form-box form select.field' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Submit', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs( 'button_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_responsive_control(
			'button_space',
			[
				'label' => __( 'Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',

				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_button',
				'default' => '',
				'selector' => '{{WRAPPER}} .search-form-box__submit',
			]
		);

		$this->add_control(
			'but_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'but_border_width',
			[
				'label' => __( 'Border Width', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'but_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'but_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'but_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'but_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form-box__submit:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_design_layout_section_controls();
	}




	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
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
			<?php
			if( $settings['title'] ) {
				echo '<h3 class="search-form-box__title">'. $settings['title'] . '</h3>';
			}
			if( $settings['desc'] ) {
				echo '<div class="search-form-box__desc">' . $settings['desc'] . '</div>';
			}?>
      <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
        <input class="field" type="text" name="s" placeholder="Search Products"/>
        <input type="hidden" name="post_type" value="products" />
				<select class="field" id="cars" name="product_cat">
					<?php
						if( !empty($product_categories) ){
							foreach ($product_categories as $key => $category) {
								echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
							}
						}
					?>
				</select>
        <input class="search-form-box__submit" type="submit" alt="Search" value="<?php echo $settings['button_text'] ?>" />
      </form>
    </div>

		<?php

	}

	protected function content_template() {

	}
}
