<?php
namespace BearsthemesAddons\Widgets\Icon_Box\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Cholatse extends Skin_Base {

	protected function _register_controls_actions() {
    add_action( 'elementor/element/be-icon-box/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-icon-box/section_design_layout/after_section_end', [ $this, 'register_design_icon_section_controls' ] );
		add_action( 'elementor/element/be-icon-box/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-cholatse';
	}


	public function get_title() {
		return __( 'Cholatse', 'lemon-addons' );
	}

  public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

    $this->add_control(
			'show_read_more',
			[
				'label' => __( 'Read More', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'lemon-addons' ),
				'condition' => [
					'skin_cholatse_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_link',
			[
				'label' => __( 'Read More Link', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#', 'lemon-addons' ),
				'condition' => [
					'skin_cholatse_show_read_more!' => '',
				],
			]
		);

		$this->parent->end_injection();

	}

	public function register_design_icon_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_icon',
			[
				'label' => __( 'Icon', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_size',
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
					'{{WRAPPER}} .elementor-icon-box__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-box__icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_size_wrap',
			[
				'label' => __( 'Wrap Size', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 60,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-box__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box__icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-box__icon:before' => 'border-right-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box:hover .elementor-icon-box__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-box:hover .elementor-icon-box__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_hover',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box:hover .elementor-icon-box__icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function register_design_content_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'lemon-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box__content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box__title' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-icon-box__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-icon-box__title',
			]
		);

    $this->add_control(
      'heading_read_more_style',
      [
        'label' => __( 'Read More', 'lemon-addons' ),
        'type' => Controls_Manager::HEADING,
        'condition' => [
          'skin_cholatse_show_read_more!' => '',
        ],
      ]
    );

    $this->add_control(
      'read_more_color',
      [
        'label' => __( 'Color', 'lemon-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-icon-box__read-more' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'skin_cholatse_show_read_more!' => '',
        ],
      ]
    );

    $this->add_control(
      'read_more_color_hover',
      [
        'label' => __( 'Color Hover', 'lemon-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          ' {{WRAPPER}} .elementor-icon-box__read-more:hover' => 'color: {{VALUE}};',
        ],
        'condition' => [
          'skin_cholatse_show_read_more!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'read_more_typography',
        'default' => '',
        'selector' => '{{WRAPPER}} .elementor-icon-box__read-more',
        'condition' => [
          'skin_cholatse_show_read_more!' => '',
        ],
      ]
    );

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings();

		$this->parent->render_element_header();

		?>

		<div class="elementor-icon-box__icon-wrap">
			<div class="elementor-icon-box__icon">
				<?php echo $this->parent->render_icon(); ?>
			</div>
		</div>
		<div class="elementor-icon-box__content">
			<?php
			if( $settings['title'] ) {
				echo '<h3 class="elementor-icon-box__title">'.
							'<a href="' . esc_url( $settings['title_link'] ) . '">' . $settings['title'] . '</a>' .
						'</h3>';
			}

      if( '' !== $this->parent->get_instance_value_skin('show_read_more') ) {
        echo '<a class="elementor-icon-box__read-more" href="' . $this->parent->get_instance_value_skin('read_more_link') . '">' . $this->parent->get_instance_value_skin('read_more_text') . '</a>';
      }
			?>
		</div>

		<?php

		$this->parent->render_element_footer();

	}

	protected function content_template() {

	}

}
