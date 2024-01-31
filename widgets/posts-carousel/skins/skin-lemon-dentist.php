<?php
namespace BearsthemesAddons\Widgets\Posts_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Lemon_dentist extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts-carousel/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-lemon-dentist';
	}


	public function get_title() {
		return __( 'Lemon Dentist', 'lemon-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$breakpoints = $this->parent->get_breakpoints();

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'lemon-addons' ),
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
			] + $breakpoints
		);

		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts Count', 'lemon-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
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
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_lm_dentist_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.66,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
				'condition' => [
					'skin_lm_dentist_show_thumbnail!'=> '',
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
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' => __( 'Meta', 'lemon-addons' ),
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default'  => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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
				'selectors' => [
					'{{WRAPPER}} .item-post-inner' => 'text-align: {{VALUE}};',
				],
			]
		);

	}

    public function register_design_box_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

        $this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .item-post' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .item-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
						'selector' => '{{WRAPPER}} .item-post',
					]
				);

				$this->add_control(
					'box_bg_color',
					[
						'label' => __( 'Background Color', 'lemon-addons' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .item-post' => 'background-color: {{VALUE}}',
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
						'selector' => '{{WRAPPER}} .item-post:hover',
					]
				);

				$this->add_control(
					'box_bg_color_hover',
					[
						'label' => __( 'Background Color', 'lemon-addons' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .item-post:hover' => 'background-color: {{VALUE}}',
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

		// style title
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

        $this->start_controls_tabs( 'title_style_tabs' );

        $this->start_controls_tab( 'title_style_normal',
            [
                'label' => __( 'Normal', 'lemon-addons' ),
            ]
        );

            $this->add_control(
                'title_color',[
                    'label' => __( 'Color', 'lemon-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .item-post--heading a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_title!' => '',
                    ],
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab( 'title_style_hover',
            [
                'label' => __( 'Hover', 'lemon-addons' ),
            ]
        );

            $this->add_control(
                'title_color_hv',[
                    'label' => __( 'Color', 'lemon-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .item-post--heading a:hover' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'show_title!' => '',
                    ],
                ]
            );
            
            $this->end_controls_tab();
        $this->end_controls_tabs(); 

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-post--heading a',
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		// style date
		$this->add_control(
			'date_style',
			[
				'label' => __( 'Date', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

        $this->start_controls_tabs( 'date_style_tabs' );

            $this->start_controls_tab( 'date_style_normal',
                [
                    'label' => __( 'Normal', 'lemon-addons' ),
                ]
            );

                $this->add_control(
                    'date_color',[
                        'label' => __( 'Color', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--date' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'show_meta!' => '',
                        ],
                    ]
                );

                $this->add_control(
                    'date_bg',[
                        'label' => __( 'Background', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--date' => 'background: {{VALUE}};',
                        ],
                        'condition' => [
                            'show_meta!' => '',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'date_style_hover',
                [
                    'label' => __( 'Hover', 'lemon-addons' ),
                ]
            );

                $this->add_control(
                    'date_color_hv',[
                        'label' => __( 'Color', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--date:hover' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'show_meta!' => '',
                        ],
                    ]
                );

                $this->add_control(
                    'date_bg_hv',[
                        'label' => __( 'Background', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--date:hover' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'show_meta!' => '',
                        ],
                    ]
                );
                
            $this->end_controls_tab();
        $this->end_controls_tabs(); 

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-post--date',
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		// style comment
		$this->add_control(
			'btn_cmt_style',
			[
				'label' => __( 'Button Comment', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->start_controls_tabs( 'btn_cmt_style_tabs' );

            $this->start_controls_tab( 'btn_cmt_style_normal',
                [
                    'label' => __( 'Normal', 'lemon-addons' ),
                ]
            );

                $this->add_control(
                    'btn_cmt_color',[
                        'label' => __( 'Color', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--comment svg path' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'btn_cmt_bg',[
                        'label' => __( 'Background', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--comment a' => 'background: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'btn_cmt_style_hover',
                [
                    'label' => __( 'Hover', 'lemon-addons' ),
                ]
            );

                $this->add_control(
                    'btn_cmt_color_hv',[
                        'label' => __( 'Color', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--comment:hover svg path' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'btn_cmt_bg_hv',[
                        'label' => __( 'Background', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--comment a:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                
            $this->end_controls_tab();
        $this->end_controls_tabs();  

		// style text content
		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->start_controls_tabs( 'text_style_tabs' );

            $this->start_controls_tab( 'text_style_normal',
                [
                    'label' => __( 'Normal', 'lemon-addons' ),
                ]
            );

                $this->add_control(
                    'text_color',[
                        'label' => __( 'Color', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post--excerpt' => 'color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'text_style_hover',
                [
                    'label' => __( 'Hover', 'lemon-addons' ),
                ]
            );

                $this->add_control(
                    'text_color_Hover',[
                        'label' => __( 'Color', 'lemon-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .item-post:hover .item-post--excerpt' => 'color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();    

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-post--excerpt',
			]
		);

		// style button
        $this->add_control(
			'button_style',
			[
				'label' => __( 'Button', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab( 'button_style_normal',
			[
				'label' => __( 'Normal', 'lemon-addons' ),
			]
		);

			$this->add_control(
				'button_color',
				[
					'label' => __( 'Color', 'lemon-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_bg',
				[
					'label' => __( 'Background Color', 'lemon-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a' => 'background-color: {{VALUE}}',
					],
				]
			);

			
		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover',
			[
				'label' => __( 'Hover', 'lemon-addons' ),
			]
		);

			$this->add_control(
				'button_color_hv',
				[
					'label' => __( 'Color', 'lemon-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a:hover svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_bg_hover',
				[
					'label' => __( 'Background Color', 'lemon-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a:hover' => 'background: {{VALUE}};border-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_tab();
	$this->end_controls_tabs();

    $this->end_controls_section();
  }

	protected function render_post() {
        $date = get_the_date('j M Y') ;
	?>
		<div class="swiper-slide">
            <div id="post-lm-dentist--<?php the_ID();  ?>" class="item-post"> 
                <div class="item-post-inner"> 
                    <div class="item-post-warp"> 
                        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ): ?>
                            <div class="item-post--thumbnail"> 
                                <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
                            </div>
                        <?php endif; ?>   

                        <div class="item-post-meta"> 
                            <p class="item-post--date"> <?= $date; ?> </p>
                            <p class="item-post--comment"> 
                                <a href="<?= esc_url(get_the_permalink()) ?>">   
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M255.998 451.959H117.336c-8.77 0-16.082-4.1-19.561-10.968-3.478-6.867-2.456-15.189 2.734-22.26l17.427-23.674C80.985 358.36 60.041 308.423 60.041 256c0-108.052 87.906-195.959 195.957-195.959 108.054 0 195.961 87.907 195.961 195.959 0 108.053-87.907 195.959-195.961 195.959zm0-30c91.511 0 165.961-74.448 165.961-165.959 0-91.51-74.45-165.959-165.961-165.959-91.509 0-165.957 74.449-165.957 165.959 0 48.346 21.034 94.196 57.709 125.796l10.524 9.067-22.89 31.096z" fill="#000000" opacity="1" data-original="#000000"></path><path d="M203.758 256c0 11.53-9.346 20.878-20.877 20.878C171.348 276.878 162 267.53 162 256c0-11.533 9.348-20.881 20.881-20.881 11.531 0 20.877 9.349 20.877 20.881z" fill="#000000" opacity="1" data-original="#000000"></path><circle cx="256.008" cy="256" r="20.878" fill="#000000" opacity="1" data-original="#000000"></circle><circle cx="329.139" cy="256" r="20.879" fill="#000000" opacity="1" data-original="#000000"></circle></g></svg>
                                </a>
                            </p>
                        </div>
                    </div>

                
                    <?php if( '' !== $this->parent->get_instance_value_skin('show_title') ):?>
                        <h3 class="item-post--heading"> 
                            <a href="<?= esc_url(get_the_permalink()) ?>"> <?php the_title() ?>  </a>
                        </h3>
                    <?php endif;?>    

                    <div class="item-post--excerpt"> <?php the_excerpt() ?> </div>
                    
                    <div class="item-post--cta"> 
                        <a href="<?= esc_url(get_the_permalink()) ?>"> 
                            <span> READ MORE </span>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z" fill="#000000" opacity="1" data-original="#000000"></path></g></svg>
                        </a>
                    </div>
                </div>
            </div>
		</div>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

			$this->parent->render_loop_header();

				while ( $query->have_posts() ) {
					$query->the_post();

					$this->render_post();

				}

			$this->parent->render_loop_footer();

		} else {
		    // no posts found
		}

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
