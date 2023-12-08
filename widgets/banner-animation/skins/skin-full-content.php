<?php
namespace BearsthemesAddons\Widgets\Banner_Animation\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SkinFullContent extends Skin_Base {
    protected function _register_controls_actions() {
		add_action( 'elementor/element/be-banner-animation/section_content/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-banner-animation/layout/before_section_end', [ $this, 'register_layout_style_section_controls' ] );
		add_action( 'elementor/element/be-banner-animation/heading_text/before_section_end', [ $this, 'register_heading_style_section_controls' ] );
		add_action( 'elementor/element/be-banner-animation/desc_text/before_section_end', [ $this, 'register_desc_style_section_controls' ] );
		add_action( 'elementor/element/be-banner-animation/cta/before_section_end', [ $this, 'register_cta_style_section_controls' ] );
	}

    public function get_id() {
		return 'skin-full-content';
	}

	public function get_title() {
		return __( 'Full Content', 'bearsthemes-addons' );
	}

    public function register_layout_section_controls( Widget_Base $widget ) {
        $this->parent = $widget;

        $this->parent->start_injection( [
			'at' => 'after',
			'of' => 'desc',
		] );

        $this->add_control(
			'heading',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is Heading', 'bearsthemes-addons' ),
                'label_block' => true,
			]
		);

        $this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'bearsthemes-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'This is Description', 'bearsthemes-addons' ),
                'label_block' => true,
			]
		);

        $this->add_control(
            'cta_text',
            [
                'label' => __( 'CTA Text', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Click here', 'bearsthemes-addons' ),
            ]
        );

        $this->add_control(
    		'cta_icon',
    		[
    			'label' => __( 'CTA Icon', 'bearsthemes-addons' ),
    			'type' => Controls_Manager::ICONS,
    			'default' => [
    				'value' => 'fas fa-star',
    				'library' => 'solid',
    			],
    		]
    	);

        $this->add_control(
            'cta_link',
            [
				'label' => esc_html__( 'CTA Link', 'bearsthemes-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'bearsthemes-addons' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
                'dynamic' => [
        			'active' => true,
        		],
				'label_block' => true,
			]
        );

        $this->parent->end_injection();
    }

    public function register_layout_style_section_controls(Widget_Base $widget) {
        $this->parent = $widget;

        $this->add_responsive_control(
			'container_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Content Width', 'bearsthemes-addons' ),
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1140,
				],
                'selectors' => [
                    '{{WRAPPER}} .content-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
			]
		);
        $this->add_responsive_control(
			'container_max_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Content Max Width', 'bearsthemes-addons' ),
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
                'selectors' => [
                    '{{WRAPPER}} ._content .content_wrap' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->add_responsive_control (
			'alignment',
			[
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} ._content .content_wrap' => 'text-align: {{VALUE}}',
                ]
			]
		);

        $this->add_responsive_control(
			'align_items',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Horizontal Align', 'textdomain' ),
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-arrow-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html__( 'right', 'textdomain' ),
						'icon' => 'eicon-arrow-right',
					],
				],
				'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} ._content' => 'align-items: {{VALUE}}',
                ]
			]
		);

        $this->add_responsive_control(
			'justify_content',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Vertical Align', 'textdomain' ),
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'textdomain' ),
						'icon' => 'eicon-arrow-up',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-justify-center-v',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'textdomain' ),
						'icon' => 'eicon-arrow-down',
					],
				],
				'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} ._content' => 'justify-content: {{VALUE}}',
                ]
			]
		);
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ._content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ._content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    public function register_heading_style_section_controls(Widget_Base $widget) {
        $this->parent = $widget;

        $this->add_control(
            'heading_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ._content .__heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} ._content .__heading',
            ]
        );
    }

    public function register_desc_style_section_controls(Widget_Base $widget) {
        $this->parent = $widget;

        $this->add_control(
            'desc_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ._content .__desc' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} ._content .__desc',
            ]
        );
        $this->add_control(
			'desc_spacing',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Spacing', 'bearsthemes-addons' ),
                'selectors' => [
                    '{{WRAPPER}} ._content .__desc' => 'margin-top: {{SIZE}}px;',
                ],
			]
		);
    }

    public function register_cta_style_section_controls(Widget_Base $widget) {
        $this->parent = $widget;

        $this->start_controls_tabs( 'tabs_cta' );

		$this->start_controls_tab(
			'cta_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);
        $this->add_control(
            'cta_bgcolor',
            [
                'label' => 'Background Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ._content .__cta a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cta_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ._content .__cta a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
			'cta_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);
        $this->add_control(
            'cta_bgcolor_hover',
            [
                'label' => 'Background Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ._content .__cta a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cta_color_hover',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ._content .__cta a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cta_typography',
                'selector' => '{{WRAPPER}} ._content .__cta a',
            ]
        );
        $this->add_responsive_control(
            'cta_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ._content .__cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'cta_spacing',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Spacing', 'bearsthemes-addons' ),
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
                'selectors' => [
                    '{{WRAPPER}} .__cta a i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
			]
		);
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ._content .__cta a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}

    public function render() {
        $settings = $this->parent->get_settings();
        if ( ! empty( $this->parent->get_instance_value_skin('cta_link')['url'] ) ) {
			$this->parent->add_link_attributes( 'cta_link', $this->parent->get_instance_value_skin('cta_link') );
		}
		$this->parent->render_element_header();
        ?>

        <?php $this->parent->render_background(); ?>
        <div class="content-container">
            <div class="_content">
                <div class="content_wrap">
                    <?php $this->parent->render_logo(); ?>
                    <div class="__heading">
                        <?php echo $this->parent->get_instance_value_skin('heading'); ?>
                    </div>
                    <div class="__desc">
                        <?php echo $this->parent->get_instance_value_skin('desc'); ?>
                    </div>
                    <div class="__cta">
                        <a href="<?php echo $this->parent->get_render_attribute_string( 'cta_link' ); ?>"><?php echo $this->parent->get_instance_value_skin('cta_text'); ?><?php Icons_Manager::render_icon( $this->parent->get_instance_value_skin('cta_icon'), [ 'aria-hidden' => 'true' ] ); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $this->parent->render_element_footer();
    }

}
