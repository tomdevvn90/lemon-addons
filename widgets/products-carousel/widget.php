<?php
namespace BearsthemesAddons\Widgets\Products_Carousel;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use \Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Products_Carousel extends Widget_Base {

	public function get_name() {
		return 'be-products-carousel';
	}

	public function get_title() {
		return __( 'Be Products Carousel', 'lemon-addons' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'lemon-addons' ];
	}

	public function get_style_depends() {
		return [ ];
	}

	public function get_script_depends() {
		return [ 'lemon-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Grid_Andrus( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Havsula( $this ) );
		$this->add_skin( new Skins\Skin_Ramble( $this ) );
		$this->add_skin( new Skins\Skin_Cosmetics( $this ) );
		$this->add_skin( new Skins\Skin_Wellness( $this ) );
		$this->add_skin( new Skins\Skin_List_Spa( $this ) );

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

	public function get_breakpoints(){
		$breakpoints_active = Plugin::$instance->breakpoints->get_active_breakpoints();
		
		$breakpoints = array();
		
		if( !empty( $breakpoints_active ) ){
			$slide_show = 4;
			
			foreach ($breakpoints_active as $key => $breakpoint ) {
				$breakpoint_key = $key . '_default';
				
				switch ($key) {
					case 'widescreen':
						$slide_show = 4;
						break;
					case 'laptop':
						$slide_show = 3;
						break;
					case 'tablet_extra':
						$slide_show = 3;
						break;
					case 'tablet':
						$slide_show = 2;
						break;
					case 'mobile_extra':
						$slide_show = 2;
						break;
					case 'mobile':
						$slide_show = 1;
						break;
					default:
						$slide_show = 4;
						break;
				}
	
				$breakpoints[$breakpoint_key] = $slide_show;
			}
		}

		return $breakpoints;
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'lemon-addons' ),
			]
		);

		$breakpoints = $this->get_breakpoints();

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'condition' => [
					'_skin' => '',
				],
			] + $breakpoints
		);

		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts Count', 'lemon-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'Thumbnail', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'exclude' => [ 'custom' ],
				'condition' => [
					'_skin' => '',
					'show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
				'condition' => [
					'_skin' => '',
					'show_thumbnail!'=> '',
				],
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_price',
			[
				'label' => __( 'Price', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_star_rating',
			[
				'label' => __( 'Star Rating', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_section_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'lemon-addons' ),
			]
		);

		$this->start_controls_tabs( 'tabs_query' );

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __( 'Include', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_query_exnlude',
			[
				'label' => __( 'Exclude', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __( 'Ids', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __( 'Category', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __( 'Offset', 'lemon-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __( 'Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'lemon-addons' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', 'lemon-addons' ),
					'title' => __( 'Title', 'lemon-addons' ),
					'price' => __( 'Price', 'lemon-addons' ),
					'selling' => __( 'Selling', 'lemon-addons' ),
					'rated' => __( 'Rated', 'lemon-addons' ),
					'rand' => __( 'Random', 'lemon-addons' ),
					'menu_order' => __( 'Menu Order', 'lemon-addons' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'lemon-addons' ),
					'desc' => __( 'DESC', 'lemon-addons' ),
				],
			]
		);

		$this->add_control(
			'ignore_sticky_posts',
			[
				'label' => __( 'Ignore Sticky Posts', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Sticky-posts ordering is visible on frontend only', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'show',
			[
				'label' => __( 'Show', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all_products',
				'options' => [
					'all_products' => __( 'All Products', 'lemon-addons' ),
					'featured' => __( 'Featured Products', 'lemon-addons' ),
					'onsale' => __( 'On-sale Products', 'lemon-addons' ),
				],
			]
		);

		$this->add_control(
			'hide_free',
			[
				'label' => __( 'Hide Free', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Hide free product.', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'show_hidden',
			[
				'label' => __( 'Show Hidden', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Show Hidden product.', 'lemon-addons' ),
			]
		);

		$this->end_controls_section();
	}

	protected function register_additional_section_controls() {
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Navigation', 'lemon-addons' ),
				'default' => 'icon',
				'options' => [
					'' => __( 'None', 'lemon-addons' ),
					'icon' => __( 'Icon', 'lemon-addons' ),
					'text' => __( 'Text', 'lemon-addons' ),
					'both' => __( 'Icon and Text', 'lemon-addons' ),
				],
				'prefix_class' => 'elementor-navigation-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'' => __( 'None', 'lemon-addons' ),
					'bullets' => __( 'Dots', 'lemon-addons' ),
					'fraction' => __( 'Fraction', 'lemon-addons' ),
					'progressbar' => __( 'Progress', 'lemon-addons' ),
				],
				'prefix_class' => 'elementor-pagination-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Transition Duration', 'lemon-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'lemon-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Infinite Loop', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_latyout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Layout', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 30,
				],
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'lemon-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'lemon-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'lemon-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'lemon-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'condition' => [
					'_skin' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_box_section_controls() {
		$this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'box_border_width',
			[
				'label' => __( 'Border Width', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'lemon-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-product',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'lemon-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .elementor-product:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_image_section_controls() {
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-product__header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'lemon-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .elementor-product__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'lemon-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .elementor-product:hover .elementor-product__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_content_section_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'heading_onsale_style',
			[
				'label' => __( 'On sale', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'onsale_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__onsale' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'onsale_bg_color',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__onsale' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'onsale_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__onsale',
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'heading_add_to_cart_style',
			[
				'label' => __( 'Add to cart', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'add_to_cart_primary_color',
			[
				'label' => __( 'Primary Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product .button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-product .button .icon,
					 {{WRAPPER}} .elementor-product .added_to_cart' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'add_to_cart_secondary_color',
			[
				'label' => __( 'Secondary Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product .button .icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .elementor-product .added_to_cart' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-product .button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'add_to_cart_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product .button',
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Color Hover', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-product__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__title',
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_price_style',
			[
				'label' => __( 'Price', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_price!' => '',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__price' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_price!' => '',
				],
			]
		);

		$this->add_control(
			'price_del_color',
			[
				'label' => __( 'Del Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-product__price del' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_price!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__price',
				'condition' => [
					'show_price!' => '',
				],
			]
		);

		$this->add_control(
			'heading_star_rating_style',
			[
				'label' => __( 'Star Rating', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_star_rating!' => '',
				],
			]
		);

		$this->add_control(
			'star_rating_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__star-rating .star-rating' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_star_rating!' => '',
				],
			]
		);

		$this->add_control(
			'star_rating_size',
			[
				'label' => __( 'Size', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 16,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product__star-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'show_star_rating!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_navigation_section_controls() {
		$this->start_controls_section(
			'section_design_navigation',
			[
				'label' => __( 'Navigation', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_arrows' );

		$this->start_controls_tab(
			'tabs_arrow_prev',
			[
				'label' => __( 'Previous', 'lemon-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'arrow_prev_icon',
			[
				'label' => __( 'Previous Icon', 'lemon-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-angle-left',
					'library' => 'fa-solid',
				],
				'condition' => [
					'navigation!' => ['text', ''],
				],
			]
		);

		$this->add_control(
			'arrow_prev_text',
			[
				'label' => __( 'Previous Text', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Prev', 'lemon-addons' ),
				'label_block' => true,
				'condition' => [
					'navigation!' => ['icon', ''],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_arrow_next',
			[
				'label' => __( 'Next', 'lemon-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'arrow_next_icon',
			[
				'label' => __( 'Next Icon', 'lemon-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'navigation!' => ['text', ''],
				],
			]
		);

		$this->add_control(
			'arrow_next_text',
			[
				'label' => __( 'Next Text', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Next', 'lemon-addons' ),
				'label_block' => true,
				'condition' => [
					'navigation!' => ['icon', ''],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'navigation_position',
			[
				'label' => __( 'Position', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'lemon-addons' ),
					'outside' => __( 'Outside', 'lemon-addons' ),
				],
				'prefix_class' => 'elementor-navigation-position-',
				'render_type' => 'template',
				'separator' => 'before',
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_show_always',
			[
				'label' => __( 'Show Always', 'lemon-addons' ),
				'description' => __( 'Check this to navigation show always.', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'lemon-addons' ),
				'label_off' => __( 'Off', 'lemon-addons' ),
				'default' => 'yes',
				'prefix_class' => 'elementor-navigation-always-',
				'render_type' => 'template',
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_space',
			[
				'label' => __( 'Spacing', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-navigation-position-inside .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-navigation-position-inside .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-navigation-position-outside .elementor-swiper-button-prev' => 'left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-navigation-position-outside .elementor-swiper-button-next' => 'right: -{{SIZE}}{{UNIT}};',

				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_size',
			[
				'label' => __( 'Button Size', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 120,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button' => 'height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_icon_size',
			[
				'label' => __( 'Icon Size', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-swiper-button img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['text', ''],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'navigation_text_typography',
				'label' => __( 'Text Typography', 'lemon-addons' ),
				'selector' => '{{WRAPPER}} .elementor-swiper-button span',
				'condition' => [
					'navigation!' => ['icon', ''],
				],
			]
		);

		$this->add_control(
			'navigation_border_width',
			[
				'label' => __( 'Border Width', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_border_radius',
			[
				'label' => __( 'Border Radius', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_navigation' );

		$this->start_controls_tab(
			'tabs_navigation_normal',
			[
				'label' => __( 'Normal', 'lemon-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_icon_color',
			[
				'label' => __( 'Icon Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-swiper-button svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['text', ''],
				],
			]
		);

		$this->add_control(
			'navigation_text_color',
			[
				'label' => __( 'Text Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['icon', ''],
				],
			]
		);

		$this->add_control(
			'navigation_background',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_border_color',
			[
				'label' => __( 'Border Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_navigation_hover',
			[
				'label' => __( 'Hover', 'lemon-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_icon_color_hover',
			[
				'label' => __( 'Icon Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-swiper-button:hover svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['text', ''],
				],
			]
		);

		$this->add_control(
			'navigation_text_color_hover',
			[
				'label' => __( 'Text Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button:hover span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['icon', ''],
				],
			]
		);

		$this->add_control(
			'navigation_background_hover',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_border_color_hover',
			[
				'label' => __( 'Border Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_pagination_section_controls() {
		$this->start_controls_section(
			'section_design_pagination',
			[
				'label' => __( 'Pagination', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pagination_position',
			[
				'label' => __( 'Position', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'lemon-addons' ),
					'outside' => __( 'Outside', 'lemon-addons' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'render_type' => 'template',
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_space',
			[
				'label' => __( 'Spacing', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-pagination-position-inside .elementor-swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-pagination-position-outside .swiper-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',

				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_align',
			[
				'label' => __( 'Alignment', 'lemon-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'lemon-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'lemon-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'lemon-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-pagination' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_size',
			[
				'label' => __( 'Size', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'min' => 4,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'pagination!' => ['fraction', ''],
				],
			]
		);

		$this->add_control(
			'pagination_space_between',
			[
				'label' => __( 'Space Between', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-pagination .swiper-pagination-bullet' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'pagination' => 'bullets',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
					'{{WRAPPER}} .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_typography',
				'label' => __( 'Typography', 'lemon-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-fraction',
				'condition' => [
					'pagination' => 'fraction',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function register_controls() {

		$this->register_layout_section_controls();
		$this->register_query_section_controls();
		$this->register_additional_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_box_section_controls();
		$this->register_design_image_section_controls();
		$this->register_design_content_section_controls();
		$this->register_design_navigation_section_controls();
		$this->register_design_pagination_section_controls();

	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		
		if( isset( $settings[$key] ) ){
			return $settings[$key];
		}

		return ;
	}

	public function query_posts() {
		$settings = $this->get_settings_for_display();

		if( is_front_page() ) {
	    $paged = (get_query_var('page')) ? absint( get_query_var('page') ) : 1;
		} else {
	    $paged = (get_query_var('paged')) ? absint( get_query_var('paged') ) : 1;
		}

		$args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $this->get_instance_value_skin('posts_count'),
			'paged' => $paged,
			'order' => $settings['order'],
			'ignore_sticky_posts' => ('yes' !== $settings['ignore_sticky_posts']) ? true : false,
		];

		if( ! empty( $settings['ids'] ) ) {
			$args['post__in'] = $settings['ids'];
		}

		if( ! empty( $settings['ids_exclude'] ) ) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if( ! empty( $settings['category'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> $settings['category'],
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
			);
		}

		if( ! empty( $settings['category_exclude'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> $settings['category_exclude'],
					'field' 		=> 'term_id',
					'operator' 		=> 'NOT IN'
				)
			);
		}

		if( 0 !== absint( $settings['offset'] ) ) {
			$args['offset'] = $settings['offset'];
		}

		$args['meta_query'] = array();

		if ( 'yes' === $settings['show_hidden'] ) {
			$args['meta_query'][] = WC()->query->visibility_meta_query();
			$args['post_parent']  = 0;
		}

		if ( 'yes' === $settings['hide_free'] ) {
			$args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}

		$args['meta_query'][] = WC()->query->stock_status_meta_query();
    	$args['meta_query']   = array_filter( $args['meta_query'] );

		switch ( $settings['show'] ) {
			case 'featured' :
				$args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;

			case 'onsale' :
				$product_ids_on_sale = wc_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;
				$args['post__in'] = $product_ids_on_sale;
				break;
		}

    	switch ( $settings['orderby'] ) {
			case 'price' :
				$args['meta_key'] = '_price';
				$args['orderby']  = 'meta_value_num';
				break;

			case 'selling' :
				$args['meta_key'] = 'total_sales';
				$args['orderby']  = 'meta_value_num';
				break;

			case 'rated' :
				$args['meta_key'] = '_wc_average_rating';
				$args['orderby']  = 'meta_value_num';
				break;

			default :
				$args['orderby']  = $settings['orderby'];
    	}


		return $query = new \WP_Query( $args );
	}

	protected function swiper_breakpoints() {
		$settings = $this->get_settings_for_display();

		$devices_list = array_reverse( Plugin::$instance->breakpoints->get_active_devices_list() );
		$breakpoints_active = Plugin::$instance->breakpoints->get_active_breakpoints();

		$swiper_breakpoints = array();

		if( !empty($devices_list) ){
			$slide_show = $this->get_instance_value_skin('sliders_per_view') ? $this->get_instance_value_skin('sliders_per_view') : 4;
			$space_between = !empty( $this->get_instance_value_skin('space_between')['size'] ) ? $this->get_instance_value_skin('space_between')['size'] : 30;
	
			foreach ( $devices_list as $key => $device ) {
			
				$desktop_point = Plugin::$instance->breakpoints->get_device_min_breakpoint($device);
				
				if( $device == 'desktop' ){
					$slide_show = $this->get_instance_value_skin( 'sliders_per_view' );
					$swiper_breakpoints[$desktop_point] = array(
						'slidesPerView' => $slide_show,
						'spaceBetween' => $space_between,
					);
	
				}else{
	
					$slide_show = $this->get_instance_value_skin( 'sliders_per_view_'.$device ) ? $this->get_instance_value_skin( 'sliders_per_view_'.$device ) : $slide_show;
					$space_between = !empty( $this->get_instance_value_skin( 'space_between_'.$device )['size']) ? $this->get_instance_value_skin( 'space_between_'.$device )['size'] : $space_between;
	
					$swiper_breakpoints[$desktop_point] = array(
						'slidesPerView' => $slide_show,
						'spaceBetween' => $space_between,
					);
	
				}
	
			}
		}

		return $swiper_breakpoints;

	}

	protected function swiper_data() {
		$settings = $this->get_settings_for_display();

		$slides_per_view = $this->get_instance_value_skin('sliders_per_view') ? $this->get_instance_value_skin('sliders_per_view') : 4;
		$slides_per_view_tablet = $this->get_instance_value_skin('sliders_per_view_tablet') ? $this->get_instance_value_skin('sliders_per_view_tablet') : $slides_per_view;
		$slides_per_view_mobile = $this->get_instance_value_skin('sliders_per_view_mobile') ? $this->get_instance_value_skin('sliders_per_view_mobile') : $slides_per_view_tablet;
		
		$space_between = !empty( $this->get_instance_value_skin('space_between')['size'] ) ? $this->get_instance_value_skin('space_between')['size'] : 30;
		$space_between_tablet = !empty( $this->get_instance_value_skin('space_between_tablet')['size'] ) ? $this->get_instance_value_skin('space_between_tablet')['size'] : $space_between;
		$space_between_mobile = !empty( $this->get_instance_value_skin('space_between_mobile')['size'] ) ? $this->get_instance_value_skin('space_between_mobile')['size'] : $space_between_tablet;

		$breakpoints = $this->swiper_breakpoints();

		$swiper_data = array(
			'slidesPerView' => $slides_per_view_mobile,
			'spaceBetween' => $space_between_mobile,
			'speed' => $settings['speed'],
			'loop' => $settings['loop'] == 'yes' ? true : false,
			'breakpoints' => $breakpoints,
		);

		if( '' !== $settings['navigation'] ) {
			$swiper_data['navigation'] = array(
				'nextEl' => '.elementor-swiper-button-next',
				'prevEl' => '.elementor-swiper-button-prev',
			);
		}

		if( '' !== $settings['pagination'] ) {
			if( '' !== $settings['_skin'] ) {
				$el_class = '.products-carousel-dots--' . $settings['_skin'];
			} else {
				$el_class = '.products-carousel-dots--default';
			}

			$swiper_data['pagination'] = array(
				'el' => $el_class,
				'type' => $settings['pagination'],
				'clickable' => true,
			);
		}

		if( $settings['autoplay'] === 'yes' ) {
			$swiper_data['autoplay'] = array(
				'delay' => $settings['autoplay_speed'],
			);
		}

		return $swiper_json = json_encode($swiper_data);
	}

	public function render_loop_header() {
		$settings = $this->get_settings_for_display();

		$classes = 'elementor-swiper swiper-container';
		
		if( $settings['_skin'] ) {
			$classes .= ' elementor-products--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-products--default';
		}

		if( !empty($settings['navigation']) ) {
			$classes .= ' has-navigation';
		}

		if( !empty($settings['pagination']) ) {
			$classes .= ' has-pagination';
		}

		?>
		<div class="<?php echo esc_attr( $classes ); ?>" data-swiper="<?php echo esc_attr( $this->swiper_data() ); ?>">
		<div class="swiper-wrapper">
		<?php
		
	}

	protected function render_swiper_button_icon( $type ) {
		$direction = 'next' === $type ? 'right' : 'left';
		$icon_settings = $this->get_settings_for_display( 'arrow_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			$icon_settings = [
				'library' => 'eicons',
				'value' => 'eicon-chevron-' . $direction,
			];
		}

		Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
	}

	protected function render_navigation() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['navigation'] ) {
			return;
		}

		?>
		<div class="elementor-swiper-button elementor-swiper-button-prev">
			<?php

				$this->render_swiper_button_icon( 'prev' );

				if( ( 'both' === $settings['navigation'] || 'text' === $settings['navigation'] ) && '' !== $settings['arrow_prev_text'] ) {
					echo '<span>' . $settings['arrow_prev_text'] . '</span>';
				}
			?>

		</div>
		<div class="elementor-swiper-button elementor-swiper-button-next">
			<?php
				if( ( 'both' === $settings['navigation'] || 'text' === $settings['navigation'] ) && '' !== $settings['arrow_next_text'] ) {
					echo '<span>' . $settings['arrow_next_text'] . '</span>';
				}

				$this->render_swiper_button_icon( 'next' );
			?>
		</div>
		<?php
	}

	protected function render_pagination() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['pagination'] ) {
			return;
		}

		$el_class = 'elementor-swiper-pagination';
		if( '' !== $settings['_skin'] ) {
			$el_class .= ' products-carousel-dots--' . $settings['_skin'];
		} else {
			$el_class .= ' products-carousel-dots--default';
		}

		echo '<div class="' . esc_attr( $el_class ) . '"></div>';
	}

	public function render_loop_footer() {
		$settings = $this->get_settings_for_display();

		?>
				</div>

					<?php
						if( 'inside' === $settings['pagination_position'] ) {
							$this->render_pagination();
						}

						if( 'inside' === $settings['navigation_position'] ) {
							$this->render_navigation();
						}
					?>

			</div>

			<?php
				if( 'outside' === $settings['pagination_position'] ) {
					$this->render_pagination();
				}

				if( 'outside' === $settings['navigation_position'] ) {
					$this->render_navigation();
				}
			?>

		<?php
	}

	public function on_sales() {
		global $product;

		$sale_html = '';

		if ( $product->is_on_sale() ) {
			$sale_html = '<span class="elementor-product__onsale">' . __( 'Sale!', 'lemon-addons' ) . '</span>';
		}

		return $sale_html;
	}

	public function button_add_to_cart() {
		global $product;

	  $defaults = array(
			'quantity'   => 1,
	    'data-quantity' => 1,
			'class'      => implode(
				' ',
				array_filter(
					array(
						'button',
						'product_type_' . $product->get_type(),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
					)
				)
			),
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);

		$args = apply_filters( 'woocommerce_loop_add_to_cart_args', $defaults, $product );

		if ( isset( $args['attributes']['aria-label'] ) ) {
			$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
		}

		switch ( $product->get_type() ) {

			case 'external':
				$icon = lemon_get_icon_svg( 'woo-bag', 16 );

			break;
			case 'grouped':
				$icon = lemon_get_icon_svg( 'woo-reply', 16 );

			break;
			case 'simple':
				$icon = lemon_get_icon_svg( 'woo-bag', 16 );

			break;
			case 'variable':
				$icon = lemon_get_icon_svg( 'woo-bag', 16 );

			break;
			default:
				$icon = lemon_get_icon_svg( 'woo-reply', 16 );

		}

	  return sprintf(
			'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		  '<span class="icon">' . $icon . '</span>' . '<span class="text">' . esc_html( $product->add_to_cart_text() ) . '</span>'
		);
	}

	public function price_html() {
		global $product;

		return sprintf(
			'<span class="elementor-product__price">%s</span>',
			$product->get_price_html()
		);
	}

	public function star_rating_html() {
		global $product;

		$rating  = $product->get_average_rating();
		$count   = $product->get_rating_count();

		return sprintf(
			'<div class="woocommerce elementor-product__star-rating">%s</div>',
			wc_get_rating_html( $rating, $count )
		);
	}

	protected function render_post() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="swiper-slide">
			<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-product' ); ?>>
				<a href="<?php echo get_the_permalink(); ?>">
					<?php if( '' !== $settings['show_thumbnail'] ) { ?>
						<div class="elementor-product__header">
							<div class="elementor-product__overlay"></div>

							<?php echo $this->on_sales(); ?>

							<div class="elementor-product__thumbnail">
								<?php the_post_thumbnail( $settings['thumbnail_size'] ); ?>
							</div>

							<?php echo $this->button_add_to_cart(); ?>
						</div>
					<?php } ?>

					<div class="elementor-product__content">
						<?php
							if( '' !== $settings['show_title'] ) {
								the_title( '<h3 class="elementor-product__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
							}

							if( '' !== $settings['show_price'] ) {
								echo $this->price_html();
							}

							if( '' !== $settings['show_star_rating'] ) {
								echo $this->star_rating_html();
							}
						?>
					</div>
				</a>
			</article>
		</div>
		<?php
	}

	protected function render() {

		$query = $this->query_posts();

		if ( $query->have_posts() ) {

			$this->render_loop_header();

				while ( $query->have_posts() ) {
					$query->the_post();

					$this->render_post();

				}

			$this->render_loop_footer();

		} else {
		    // no posts found
		}

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
