<?php
namespace BearsthemesAddons\Widgets\Members_Carousel;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Members_Carousel extends Widget_Base {

	public function get_name() {
		return 'be-members-carousel';
	}

	public function get_title() {
		return __( 'Be Members Carousel', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'bearsthemes-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Pumori( $this ) );
		$this->add_skin( new Skins\Skin_Batura( $this ) );
		$this->add_skin( new Skins\Skin_Changla( $this ) );
		$this->add_skin( new Skins\Skin_Havsula( $this ) );
		$this->add_skin( new Skins\Skin_Taboche( $this ) );
		$this->add_skin( new Skins\Skin_Cerredo( $this ) );
		$this->add_skin( new Skins\Skin_Jimara( $this ) );
		$this->add_skin( new Skins\Skin_Nuptse( $this ) );

	}

	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
														'post_type' => 'team',
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
			'taxonomy' => 'team_category',
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
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$breakpoints = $this->get_breakpoints();

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
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
				'label' => __( 'Posts count', 'bearsthemes-addons' ),
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
				'label' => __( 'Thumbnail', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
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
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1.05,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-member__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
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
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_position',
			[
				'label' => __( 'Position', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_socials',
			[
				'label' => __( 'Socials', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
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
				'label' => __( 'Query', 'bearsthemes-addons' ),
			]
		);

		$this->start_controls_tabs( 'tabs_query' );

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __( 'Include', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
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
				'label' => __( 'Exclude', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __( 'Offset', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __( 'Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'bearsthemes-addons' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __( 'Date', 'bearsthemes-addons' ),
					'post_title' => __( 'Title', 'bearsthemes-addons' ),
					'menu_order' => __( 'Menu Order', 'bearsthemes-addons' ),
					'rand' => __( 'Random', 'bearsthemes-addons' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'bearsthemes-addons' ),
					'desc' => __( 'DESC', 'bearsthemes-addons' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_additional_section_controls() {
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Navigation', 'bearsthemes-addons' ),
				'default' => 'icon',
				'options' => [
					'' => __( 'None', 'bearsthemes-addons' ),
					'icon' => __( 'Icon', 'bearsthemes-addons' ),
					'text' => __( 'Text', 'bearsthemes-addons' ),
					'both' => __( 'Icon and Text', 'bearsthemes-addons' ),
				],
				'prefix_class' => 'elementor-navigation-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'' => __( 'None', 'bearsthemes-addons' ),
					'bullets' => __( 'Dots', 'bearsthemes-addons' ),
					'fraction' => __( 'Fraction', 'bearsthemes-addons' ),
					'progressbar' => __( 'Progress', 'bearsthemes-addons' ),
				],
				'prefix_class' => 'elementor-pagination-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Transition Duration', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'bearsthemes-addons' ),
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
				'label' => __( 'Infinite Loop', 'bearsthemes-addons' ),
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
				'label' => __( 'Layout', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'bearsthemes-addons' ),
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
				'condition' => [
					'_skin' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-member' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_box_section_controls() {
		$this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'box_border_width',
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
					'{{WRAPPER}} .elementor-member' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
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
					'{{WRAPPER}} .elementor-member' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
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
					'{{WRAPPER}} .elementor-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-member__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-member',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-member' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-member' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .elementor-member:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-member:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-member:hover' => 'border-color: {{VALUE}}',
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
				'label' => __( 'Image', 'bearsthemes-addons' ),
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
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-member__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .elementor-member__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .elementor-member:hover .elementor-member__thumbnail img',
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
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-member__title' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .elementor-member__title',
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_position_style',
			[
				'label' => __( 'Position', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_position!' => '',
				],
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-member__position' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_position!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-member__position',
				'condition' => [
					'show_position!' => '',
				],
			]
		);

		$this->add_control(
			'heading_socials_style',
			[
				'label' => __( 'Socials', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_socials!' => '',
				],
			]
		);

		$this->add_control(
			'socials_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} ..elementor-member__socials a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_socials!' => '',
				],
			]
		);

		$this->add_control(
			'socials_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-member__socials a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_socials!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_navigation_section_controls() {
		$this->start_controls_section(
			'section_design_navigation',
			[
				'label' => __( 'Navigation', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_arrows' );

		$this->start_controls_tab(
			'tabs_arrow_prev',
			[
				'label' => __( 'Previous', 'bearsthemes-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'arrow_prev_icon',
			[
				'label' => __( 'Previous Icon', 'bearsthemes-addons' ),
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
				'label' => __( 'Previous Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Prev', 'bearsthemes-addons' ),
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
				'label' => __( 'Next', 'bearsthemes-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'arrow_next_icon',
			[
				'label' => __( 'Next Icon', 'bearsthemes-addons' ),
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
				'label' => __( 'Next Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Next', 'bearsthemes-addons' ),
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
				'label' => __( 'Position', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'bearsthemes-addons' ),
					'outside' => __( 'Outside', 'bearsthemes-addons' ),
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
				'label' => __( 'Show Always', 'bearsthemes-addons' ),
				'description' => __( 'Check this to navigation show always.', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'bearsthemes-addons' ),
				'label_off' => __( 'Off', 'bearsthemes-addons' ),
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
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
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
				'label' => __( 'Button Size', 'bearsthemes-addons' ),
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
				'label' => __( 'Icon Size', 'bearsthemes-addons' ),
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
				'label' => __( 'Text Typography', 'bearsthemes-addons' ),
				'selector' => '{{WRAPPER}} .elementor-swiper-button span',
				'condition' => [
					'navigation!' => ['icon', ''],
				],
			]
		);

		$this->add_control(
			'navigation_border_width',
			[
				'label' => __( 'Border Width', 'bearsthemes-addons' ),
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
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
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
				'label' => __( 'Normal', 'bearsthemes-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_icon_color',
			[
				'label' => __( 'Icon Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Text Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Hover', 'bearsthemes-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

		$this->add_control(
			'navigation_icon_color_hover',
			[
				'label' => __( 'Icon Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Text Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pagination_position',
			[
				'label' => __( 'Position', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'bearsthemes-addons' ),
					'outside' => __( 'Outside', 'bearsthemes-addons' ),
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
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
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
				'label' => __( 'Alignment', 'bearsthemes-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
				'label' => __( 'Size', 'bearsthemes-addons' ),
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
				'label' => __( 'Space Between', 'bearsthemes-addons' ),
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
				'label' => __( 'Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Typography', 'bearsthemes-addons' ),
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
		return $settings[$key];
	}

	public function query_posts() {
		$settings = $this->get_settings_for_display();

		$args = [
			'post_type' => 'team',
			'post_status' => 'publish',
			'posts_per_page' => $this->get_instance_value_skin('posts_count'),
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
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
					'taxonomy' 		=> 'team_category',
					'terms' 		=> $settings['category'],
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
			);
		}

		if( ! empty( $settings['category_exclude'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'team_category',
					'terms' 		=> $settings['category_exclude'],
					'field' 		=> 'term_id',
					'operator' 		=> 'NOT IN'
				)
			);
		}

		if( 0 !== absint( $settings['offset'] ) ) {
			$args['offset'] = $settings['offset'];
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

		$slides_per_view = $this->get_instance_value_skin('sliders_per_view') ? $this->get_instance_value_skin('sliders_per_view') : 3;
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
				$el_class = '.members-carousel-dots--' . $settings['_skin'];
			} else {
				$el_class = '.members-carousel-dots--default';
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
			$classes .= ' elementor-members--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-members--default';
		}

		?>
		<div class="<?php echo esc_attr( $classes ); ?>" data-swiper="<?php echo esc_attr( $this->swiper_data() ); ?>">
		<div class="swiper-wrapper">
		<?php
	}

	protected function render_icon( $icon ) {
		$icon_html = '';

		if( !empty( $icon['value'] ) ) {
			if( 'svg' !== $icon['library'] ) {
				$icon_html = '<i class="' . esc_attr( $icon['value'] ) . '" aria-hidden="true"></i>';
			} else {
				$icon_html = file_get_contents($icon['value']['url']);;
			}
		}

		return $icon_html;
	}

	protected function render_navigation() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['navigation'] ) {
			return;
		}

		?>
		<div class="elementor-swiper-button elementor-swiper-button-prev">
			<?php
				if( '' !== $this->render_icon( $settings['arrow_prev_icon'] ) ) {
					echo $this->render_icon( $settings['arrow_prev_icon'] );
				}

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

				if( '' !== $this->render_icon( $settings['arrow_next_icon'] ) ) {
					echo $this->render_icon( $settings['arrow_next_icon'] );
				}
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
			$el_class .= ' members-carousel-dots--' . $settings['_skin'];
		} else {
			$el_class .= ' members-carousel-dots--default';
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

	// public function render_position() {
	// 	$position = get_field( 'team_position' );

	// 	if ( empty( $position ) ) {
	// 		return;
	// 	}

	// 	return '<div class="elementor-member__position">' . $position . '</div>';
	// }

	// public function render_email() {
	// 	$email = get_field( 'team_email' );

	// 	if ( empty( $email ) ) {
	// 		return;
	// 	}

	// 	return '<div class="elementor-member__email">' .
	// 						'<a href="mailto:' . $email . '">' . $email . '</a>' .
	// 					'</div>';
	// }

	// public function render_phone() {
	// 	$phone = get_field( 'team_phone' );

	// 	if ( empty( $phone ) ) {
	// 		return;
	// 	}

	// 	return '<div class="elementor-member__phone">' .
	// 						'<a href="tel:' . preg_replace( '/[^0-9]/', '', $phone ) . '">' . $phone . '</a>' .
	// 					'</div>';
	// }

	// public function render_socials() {
	// 	$socials = get_field( 'team_socials' );

	// 	if( empty( $socials ) ) {
	// 		return;
	// 	}

	// 	$output = '';

	// 	foreach ( $socials as $social ) {
	// 		if( !empty( $social['icon'] ) ) {
	// 			$icon_ep = explode(' ', $social['icon']);
	// 			$class_ep = explode('-', str_replace( '"','',$icon_ep[2] ) );
	// 			$output .= '<a class="' . esc_attr( $class_ep[1] ) . '" href="' . esc_url( $social['url'] ) . '" title="' . esc_attr( $social['title'] ) . '">' . $social['icon'] . '</a>';
	// 		}
	// 	}

	// 	return '<div class="elementor-member__socials">' . $output . '</div>';
	// }

	protected function render_post() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="swiper-slide">
			<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-member' ); ?>>
				<?php if( '' !== $settings['show_thumbnail'] ) { ?>
					<div class="elementor-member__thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $settings['thumbnail_size'] ); ?>
						</a>
					</div>
				<?php } ?>

				<div class="elementor-member__content">
					<?php
						if( '' !== $settings['show_title'] ) {
							the_title( '<h3 class="elementor-member__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}

						// if( '' !== $settings['show_position'] ) {
						// 	echo $this->render_position();
						// }

						// if( '' !== $settings['show_socials'] ) {
						// 	echo $this->render_socials();
						// }
					?>
				</div>
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
