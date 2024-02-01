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

class Skin_Grid_Sankar extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts-carousel/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-posts-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-grid-sankar';
	}


	public function get_title() {
		return __( 'Grid Sankar', 'lemon-addons' );
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
					'skin_grid_sankar_show_thumbnail!'=> '',
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
					'skin_grid_sankar_show_thumbnail!'=> '',
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

    $this->add_control(
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'lemon-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'lemon-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'sankar_excerpt_length', 15 ),
				'condition' => [
					'skin_grid_sankar_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'sankar_excerpt_more', '' ),
				'condition' => [
					'skin_grid_sankar_show_excerpt!' => '',
				],
			]
		);

    $this->add_control(
			'show_read_more',
			[
				'label' => __( 'Read More', 'lemon-addons' ),
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'lemon-addons' ),
				'label_off' => __( 'Hide', 'lemon-addons' ),
				'default'  => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'lemon-addons' ),
				'type' 	=> Controls_Manager::TEXT,
				'default' => __( 'Read More', 'lemon-addons' ),
				'condition' => [
					'skin_grid_sankar_show_read_more!' => '',
				],
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
					'{{WRAPPER}} .elementor-post' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-post' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-post',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

  }

	public function register_design_image_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_grid_sankar_show_thumbnail!'=> '',
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
					'{{WRAPPER}} .elementor-post__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-post__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover .elementor-post__thumbnail img',
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

    $this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_sankar_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_sankar_show_title!' => '',
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
					' {{WRAPPER}} .elementor-post__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_sankar_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__title',
				'condition' => [
					'skin_grid_sankar_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_sankar_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color Text', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta li' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_sankar_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color_hover',
			[
				'label' => __( 'Color Text Hover', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta li:first-child,
           {{WRAPPER}} .elementor-post__meta li a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'skin_grid_sankar_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__meta',
				'condition' => [
					'skin_grid_sankar_show_meta!' => '',
				],
			]
		);

    	$this->add_control(
			'excerpt_style',
			[
				'label' => __( 'Excerpt', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_sankar_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_sankar_show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__excerpt',
				'condition' => [
					'skin_grid_sankar_show_excerpt!' => '',
				],
			]
		);

    	$this->add_control(
			'heading_readmore_style',
			[
				'label' => __( 'Read More', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_sankar_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_sankar_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label' => __( 'Color Hover', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__read-more:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_sankar_show_read_more!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__read-more',
				'condition' => [
					'skin_grid_sankar_show_read_more!' => '',
				],
			]
		);

    $this->end_controls_section();
  }

	protected function render_post() {

		?>
		<div class="swiper-slide">
      <article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-post' ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
          <div class="elementor-post__thumbnail">
						<a href="<?php the_permalink(); ?>">
	            <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
						</a>
					</div>
        <?php } ?>
        <div class="elementor-post__content">
          <?php
						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}
					?>

          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<ul class="elementor-post__meta">
              <li>
                <?php
  								echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
  									bearsthemes_addons_get_icon_svg('user', 14) .
  									'<span>' . esc_html__('By ', 'lemon-addons') . '</span>' . get_the_author() .
  								'</a>';
  							?>
  	          </li>
  	          <li>
								<?php
                  echo bearsthemes_addons_get_icon_svg('calendar', 14) .
                    	 '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	          </li>
  	        </ul>
  				<?php } ?>

          <?php
						if( '' !== $this->parent->get_instance_value_skin('show_excerpt') ) {
							add_filter( 'excerpt_more', [ $this->parent, 'filter_excerpt_more' ], 20 );
							add_filter( 'excerpt_length', [ $this->parent, 'filter_excerpt_length' ], 20 );

							?>
							<div class="elementor-post__excerpt">
								<?php the_excerpt(); ?>
							</div>
							<?php

							remove_filter( 'excerpt_length', [ $this->parent, 'filter_excerpt_length' ], 20 );
							remove_filter( 'excerpt_more', [ $this->parent, 'filter_excerpt_more' ], 20 );
						}

						if( '' !== $this->parent->get_instance_value_skin('show_read_more' ) ){
							echo '<a class="elementor-post__read-more" href="' . get_the_permalink() . '">' . $this->parent->get_instance_value_skin('read_more_text') . '</a>';
						}
					?>
        </div>
			</article>
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
