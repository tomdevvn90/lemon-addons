<?php
namespace BearsthemesAddons\Widgets\Image_Box\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Saltoro extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-image-box/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-image-box/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-image-box/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-saltoro';
	}


	public function get_title() {
		return __( 'Saltoro', 'lemon-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->parent->start_injection( [
			'at' => 'after',
			'of' => 'desc',
		] );

		$this->add_control(
			'custom_link',
			[
				'label' => __( 'Custom Link', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#',
			]
		);

		$this->parent->end_injection();

	}

	public function register_design_image_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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
					'{{WRAPPER}} .elementor-image-box__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-image-box__image img',
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
				'selector' => '{{WRAPPER}} .elementor-image-box:hover .elementor-image-box__image img',
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
					'{{WRAPPER}} .elementor-image-box__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-image-box__title' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-image-box__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-image-box__title',
			]
		);

		$this->add_control(
			'heading_desc_style',
			[
				'label' => __( 'Description', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-image-box__desc',
			]
		);

		$this->add_control(
			'heading_custom_link_style',
			[
				'label' => __( 'Custom Link', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

    $this->start_controls_tabs( 'custom_link_effects_tabs' );

		$this->start_controls_tab( 'tab_custom_link_normal',
			[
				'label' => __( 'Normal', 'lemon-addons' ),
			]
		);

    $this->add_control(
      'custom_link_color',
      [
        'label' => __( 'Color', 'lemon-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-image-box__custom-link' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'custom_link_bg_color',
      [
        'label' => __( 'Background Color', 'lemon-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-image-box__custom-link' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab( 'tab_custom_link_hover',
      [
        'label' => __( 'Hover', 'lemon-addons' ),
      ]
    );

    $this->add_control(
      'custom_link_color_hover',
      [
        'label' => __( 'Color Hover', 'lemon-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-image-box__read-more:hover' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'custom_link_bg_color_hover',
      [
        'label' => __( 'Background Color', 'lemon-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-image-box__custom-link:hover' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings();

		$this->parent->render_element_header();

		?>

    <div class="elementor-image-box__header">
  		<div class="elementor-image-box__image">
  			<?php
  				if( '' !== $settings['image']['url'] ) {
  					echo '<img src="' . esc_url( $settings['image']['url'] ) . '" alt=""/>';
  				}
  			?>
  		</div>

      <?php
        if( $this->parent->get_instance_value_skin('custom_link') ) {
          echo '<a class="elementor-image-box__custom-link" href="' . esc_url( $this->parent->get_instance_value_skin('custom_link') ) . '">' .
                  bearsthemes_addons_get_icon_svg( 'plus', 16 ) .
               '</a>';
        }
      ?>
    </div>

		<div class="elementor-image-box__content">
			<?php
			if( $settings['title'] ) {
				echo '<h3 class="elementor-image-box__title">'.
							'<a href="' . esc_url( $settings['title_link'] ) . '">' . $settings['title'] . '</a>' .
						'</h3>';
			}

			if( $settings['desc'] ) {
				echo '<div class="elementor-image-box__desc">' . $settings['desc'] . '</div>';
			}
			?>
		</div>

		<?php

		$this->parent->render_element_footer();

	}

	protected function content_template() {

	}

}
