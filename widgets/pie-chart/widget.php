<?php
namespace BearsthemesAddons\Widgets\Pie_Chart;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Pie_Chart extends Widget_Base {

	public function get_name() {
		return 'be-pie-chart';
	}

	public function get_title() {
		return __( 'Be Pie Chart', 'lemon-addons' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'lemon-addons' ];
	}

	public function get_script_depends() {
		return [ 'elementor-waypoints', 'jquery-progressbar', 'lemon-addons-plugin' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'percentage',
			[
				'label' => __( 'Percentage', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
			]
		);

		$this->add_control(
			'inner_text',
			[
				'label' => __( 'Inner Text', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is ineer text', 'lemon-addons' ),
			]
		);

		$this->end_controls_section();
	}


	protected function register_design_content_section_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-pie-chart__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-pie-chart__title',
			]
		);

		$this->add_control(
			'heading_percentage_style',
			[
				'label' => __( 'Percentage', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'percentage_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .progressbar-text' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_percentage',
				'default' => '',
				'selector' => '{{WRAPPER}} .progressbar-text',
			]
		);

		$this->add_control(
			'heading_inner_text_style',
			[
				'label' => __( 'Inner Text', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'inner_text_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .progressbar-text span' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_inner_text',
				'default' => '',
				'selector' => '{{WRAPPER}} .progressbar-text span',
			]
		);

		$this->end_controls_section();
	}


	protected function register_design_progress_section_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'progress_easing',
			[
				'label' => __( 'Easing', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'linear',
				'options' => [
					'linear' => __( 'Linear', 'lemon-addons' ),
					'easeOut' => __( 'EaseOut', 'lemon-addons' ),
					'bounce' => __( 'Bounce', 'lemon-addons' ),
				],
			]
		);

		$this->add_control(
			'progress_duration',
			[
				'label' => __( 'Duration', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
			]
		);

		$this->add_control(
			'progress_color_from',
			[
				'label' => __( 'from Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFEA82',
			]
		);

		$this->add_control(
			'progress_color_to',
			[
				'label' => __( 'to Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ED6A5A',
			]
		);

		$this->add_control(
			'progress_trailcolor',
			[
				'label' => __( 'Trail Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#EEEEEE',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();

		$this->register_design_content_section_controls();
		$this->register_design_progress_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$percentage = $settings['percentage']['size'];
		$unit = $settings['percentage']['unit'];

		$bar_opts = array(
			'innertext' => $settings['inner_text'],
			'strokewidth' => 4,
			'easing' => $settings['progress_easing'],
			'duration' => absint( $settings['progress_duration']['size'] ),
			'color' => $settings['progress_color_from'],
			'color' => $settings['progress_color_from'],
			'trailcolor' => $settings['progress_trailcolor'],
			'trailwidth' => 1,
			'tocolor' => $settings['progress_color_to'],
			'width' => '100%',
			'height' => '100%',
		);

		$data_attr = 'class="elementor-pie-chart__progress"';

  	foreach ($bar_opts as $key => $value) {
  		$data_attr .= ' data-' . $key . '="' . esc_attr( $value ) . '"';
  	}

		?>
		<div class="elementor-pie-chart">
			<?php
				echo '<div role="progresschart" aria-valuemin="0" aria-valuemax="100"
					 aria-valuenow="' . esc_attr( $percentage ) . '" '. $data_attr .'></div>';

				if( !empty( $settings['title'] ) ) {
					echo '<h3 class="elementor-pie-chart__title">' . $settings['title'] . '</h3>';
				}
			?>
		</div>
		<?php

	}

	protected function content_template() {

	}
}
