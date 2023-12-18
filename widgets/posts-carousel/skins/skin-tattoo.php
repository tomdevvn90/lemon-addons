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

class Skin_Lemon_Tattoo extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts-carousel/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-lemon-tattoo';
	}


	public function get_title() {
		return __( 'Lemon Tattoo', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts Count', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
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
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_lm_tattoo_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
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
					'skin_lm_tattoo_show_thumbnail!'=> '',
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
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default'  => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .item-post' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .item-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
						'selector' => '{{WRAPPER}} .item-post',
					]
				);

				$this->add_control(
					'box_bg_color',
					[
						'label' => __( 'Background Color', 'bearsthemes-addons' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .item-post' => 'background-color: {{VALUE}}',
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
						'selector' => '{{WRAPPER}} .item-post:hover',
					]
				);

				$this->add_control(
					'box_bg_color_hover',
					[
						'label' => __( 'Background Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// style title
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
			'title_color_normal',
			[
				'label' => __( 'Color Normal', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-post--heading' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
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
					'{{WRAPPER}} .item-post--heading:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .item-post--heading',
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		// style date
		$this->add_control(
			'date_style',
			[
				'label' => __( 'Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
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

		// style author
		$this->add_control(
			'author_style',
			[
				'label' => __( 'Author', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'author_color_normal',
			[
				'label' => __( 'Color Normal', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-post--author' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'author_color_active',
			[
				'label' => __( 'Color Active', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-post--author > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-post--author',
			]
		);

		// style text content
		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-post--excerpt' => 'color: {{VALUE}};',
				],
			]
		);

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
				'label' => __( 'Button', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab( 'button_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

			$this->add_control(
				'button_color',
				[
					'label' => __( 'Color', 'bearsthemes-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_bg',
				[
					'label' => __( 'Background Color', 'bearsthemes-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a' => 'background-color: {{VALUE}}',
					],
				]
			);

			
		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

			$this->add_control(
				'button_color_hv',
				[
					'label' => __( 'Color', 'bearsthemes-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a:hover svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_bg_hover',
				[
					'label' => __( 'Background Color', 'bearsthemes-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-post--cta > a:hover' => 'background: {{VALUE}}',
						'{{WRAPPER}} .item-post--cta > a:hover' => 'border-color: {{VALUE}}',
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
            <div id="post-lm-tattoo--<?php the_ID();  ?>" class="item-post"> 
                <div class="item-post-inner"> 
                    <p class="item-post--date"> <?= $date; ?> </p>

                    <?php if( '' !== $this->parent->get_instance_value_skin('show_title') ):?>
                        <h3 class="item-post--heading"> 
                            <a href="<?= esc_url(get_the_permalink()) ?>"> <?php the_title() ?>  </a>
                        </h3>
                    <?php endif;?>    

                    <div class="item-post--excerpt"> <?php the_excerpt() ?> </div>

                    <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ): ?>
                        <div class="item-post--author"> Posted By <a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"> <?= get_the_author_meta('display_name', get_the_author_ID()) ?> </a> </div>
                    <?php endif;?> 
                    
                    <div class="item-post--cta"> 
                        <a href="<?= esc_url(get_the_permalink()) ?>"> 
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M502.628 278.627 389.25 392.005c-6.249 6.249-14.438 9.373-22.628 9.373s-16.379-3.124-22.628-9.373c-12.496-12.497-12.496-32.758 0-45.255L402.745 288H32c-17.673 0-32-14.327-32-32s14.327-32 32-32h370.745l-58.751-58.75c-12.496-12.497-12.496-32.758 0-45.255 12.498-12.497 32.758-12.497 45.256 0l113.378 113.378c12.496 12.496 12.496 32.758 0 45.254z" fill="#000000" opacity="1" data-original="#000000"></path></g></svg>
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
