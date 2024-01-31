<?php
namespace BearsthemesAddons\Widgets\Team_Carousel;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use \Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team_Carousel extends Widget_Base {

	public function get_name() {
		return 'team-carousel';
	}

	public function get_title() {
		return __( 'Team Carousel', 'lemon-addons' );
	}

	public function get_icon() {
		return 'eicon-nested-carousel';
	}

	public function get_categories() {
		return [ 'lemon-addons' ];
	}

	public function get_script_depends() {
		return [ 'lemon-addons' ];
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

		$repeater = new Repeater();

		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your name' , 'lemon-addons' ),
			]
		);

		$repeater->add_control(
			'position', [
				'label' => __( 'Position', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your position' , 'lemon-addons' ),
			]
		);

		$repeater->add_control(
			'avatar', [
				'label' => __( 'Avatar', 'lemon-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list_teams',
			[
				'label' => __( 'List Teams', 'lemon-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name'     => __( 'James Jakson', 'lemon-addons' ),
						'position' => __( 'Tattoo Expert', 'lemon-addons' ),
						'avatar'   => Utils::get_placeholder_image_src(),
					],
					[
						'name'     => __( 'Jannifar Doks', 'lemon-addons' ),
						'position' => __( 'Tattoo Expert', 'lemon-addons' ),
						'avatar'   => Utils::get_placeholder_image_src(),
					],
					[
						'name'     => __( 'Danni Johnson', 'lemon-addons' ),
						'position' => __( 'Tattoo Expert', 'lemon-addons' ),
						'avatar'   => Utils::get_placeholder_image_src(),
					],
					[
						'name'     => __( 'James Jakson', 'lemon-addons' ),
						'position' => __( 'Tattoo Expert', 'lemon-addons' ),
						'avatar'   => Utils::get_placeholder_image_src(),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$breakpoints = $this->get_breakpoints();

		$this->add_responsive_control(
			'sliders_per_view',[
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
				'separator' => 'before',
	
			] + $breakpoints
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'thumbnail',
				'exclude' => [ 'custom' ],
			]
		);

		$this->end_controls_section();
	}

	protected function register_additional_section_controls() {
		$this->start_controls_section(
			'section_additional_options',[
				'label' => __( 'Additional Options', 'lemon-addons' ),
			]
		);

			$this->add_control(
				'navigation',[
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
				'pagination',[
					'label' => __( 'Pagination', 'lemon-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
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
				'speed',[
					'label' => __( 'Transition Duration', 'lemon-addons' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'autoplay',[
					'label' => __( 'Autoplay', 'lemon-addons' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'autoplay_speed',[
					'label' => __( 'Autoplay Speed', 'lemon-addons' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 5000,
					'condition' => [
						'autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'loop',[
					'label' => __( 'Infinite Loop', 'lemon-addons' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

		$this->end_controls_section();
	}

	protected function register_design_latyout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',[
				'label' => __( 'Layout', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'space_between',[
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
				]
			);

			$this->add_responsive_control(
				'alignment',[
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
						'{{WRAPPER}} .item-team-content' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function register_design_box_section_controls() {
		$this->start_controls_section(
			'section_design_box',[
				'label' => __( 'Box', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					// '_skin' => '',
				],
			]
		);

			$this->add_control(
				'box_border_width',[
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
						'{{WRAPPER}} .item-team-inner' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'box_border_radius',[
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
						'{{WRAPPER}} .item-team-inner' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'box_border_color',
				[
					'label' => __( 'Border Color', 'lemon-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-team-inner' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'box_bg_color',
				[
					'label' => __( 'Background Color', 'lemon-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-team-inner' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'box_padding',[
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
						'{{WRAPPER}} .item-team-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function register_design_image_section_controls() {
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-team__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_content_section_controls() {

    $this->start_controls_section(
		'section_design_content',[
			'label' => __( 'Content', 'lemon-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

		// style name team
    	$this->add_control(
			'name_style',[
				'label' => __( 'Name', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-team--name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name' => 'content_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-team--name',
			]
		);

		// style position team
		$this->add_control(
			'position_style',[
				'label' => __( 'Position', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'position_color',[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-team--position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name' => 'position_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-team--position',
			]
		);
    $this->end_controls_section();
  }

	protected function register_design_navigation_section_controls() {
		$this->start_controls_section(
			'section_design_navigation',[
				'label' => __( 'Navigation', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_arrows' );

			$this->start_controls_tab(
				'tabs_arrow_prev',[
					'label' => __( 'Previous', 'lemon-addons' ),
					'condition' => [
						'navigation!' => '',
					],
				]
			);

			$this->add_control(
				'arrow_prev_icon',[
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
				'arrow_prev_text',[
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
			'tabs_arrow_next',[
				'label' => __( 'Next', 'lemon-addons' ),
				'condition' => [
					'navigation!' => '',
				],
			]
		);

			$this->add_control(
				'arrow_next_icon',[
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
				'arrow_next_text',[
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
			'navigation_position',[
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
			'navigation_show_always',[
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
				'nextEl' => '.swiper-button-next__'.$this->get_id(),
				'prevEl' => '.swiper-button-prev__'.$this->get_id(),
			);
		}

		if( '' !== $settings['pagination'] ) {
			$el_class = '.team-carousel-dots--default';

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
		$classes .= ' be-teams-element--default';

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

	public function render_navigation() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['navigation'] ) {
			return;
		} ?>

		<div class="elementor-swiper-button elementor-swiper-button-prev swiper-button-prev__<?php echo $this->get_id(); ?>">
			<?php
				$this->render_swiper_button_icon( 'prev' );

				if( ( 'both' === $settings['navigation'] || 'text' === $settings['navigation'] ) && '' !== $settings['arrow_prev_text'] ) {
					echo '<span>' . $settings['arrow_prev_text'] . '</span>';
				}
			?>

		</div>
		<div class="elementor-swiper-button elementor-swiper-button-next swiper-button-next__<?php echo $this->get_id(); ?>">
			<?php
				if( ( 'both' === $settings['navigation'] || 'text' === $settings['navigation'] ) && '' !== $settings['arrow_next_text'] ) {
					echo '<span>' . $settings['arrow_next_text'] . '</span>';
				}

				$this->render_swiper_button_icon( 'next' );
			?>
		</div>
		<?php
	}

	public function render_pagination() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['pagination'] ) {
			return;
		}

		$el_class = 'elementor-swiper-pagination';
		$el_class .= ' team-carousel-dots--default';

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

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list_teams'] ) ) {
			return;
		}

		$this->render_loop_header();

		foreach ( $settings['list_teams'] as $index => $item ) {
			$avatar = wp_get_attachment_image_src( $item['avatar']['id'], $settings['thumbnail_size'] );
		?>
			<div class="swiper-slide"> 
				<div class="item-team"> 
					<div class="item-team-inner"> 
						<div class="item-team--avatar"> 
							<?php if(!empty( $avatar ) && isset($avatar)): ?>
								<img src="<?= esc_url( $avatar[0] ) ?>" alt="avatar" /> 
							<?php else : ?>
								<img src="<?= esc_url( $item['avatar']['url'] ) ?>" alt="avatar" /> 
						    <?php endif; ?>			
						</div>

						<div class="item-team-content"> 
							<?php if('' !== $item['name']): ?>
								<h3 class="item-team--name"> <?= $item['name'] ?> </h3>
						   	<?php endif; ?>		

							<?php if('' !== $item['position']): ?>
								<p class="item-team--position"> <?= $item['position'] ?> </p>
						   	<?php endif; ?>		
						</div>
					</div>
				</div>
			</div>

		<?php }

		$this->render_loop_footer();

	}

	protected function content_template() {

	}

}
