<?php
namespace BearsthemesAddons\Widgets\Posts\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Grid_Changtse extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-grid-changtse';
	}


	public function get_title() {
		return __( 'Grid Changtse', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'bearsthemes-addons' ),
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
				'prefix_class' => 'elementor-grid%s-',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
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
					'skin_grid_changtse_show_thumbnail!'=> '',
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
					'skin_grid_changtse_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => __( 'Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

    $this->add_control(
			'show_comment',
			[
				'label' => __( 'Comments', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
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
			'show_author',
			[
				'label' => __( 'Author', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'column_gap',
			[
				'label' => __( 'Columns Gap', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
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
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .elementor-post' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-post',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
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
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_grid_changtse_show_thumbnail!'=> '',
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
					'{{WRAPPER}} .elementor-post__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-post__thumbnail img',
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
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_date_style',
			[
				'label' => __( 'Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_changtse_show_date!' => '',
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
					'{{WRAPPER}} .elementor-post__date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-post__date svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_changtse_show_date!' => '',
				],
			]
		);

		$this->add_control(
			'date_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__date a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-post__date a:hover svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_changtse_show_date!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__date',
				'condition' => [
					'skin_grid_changtse_show_date!' => '',
				],
			]
		);

    $this->add_control(
      'heading_comment_style',
      [
        'label' => __( 'Comment', 'bearsthemes-addons' ),
        'type' => Controls_Manager::HEADING,
        'condition' => [
          'skin_grid_changtse_show_date!' => '',
        ],
      ]
    );

    $this->add_control(
      'comment_color',
      [
        'label' => __( 'Color', 'bearsthemes-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-post__comment' => 'color: {{VALUE}};',
          '{{WRAPPER}} .elementor-post__comment svg' => 'fill: {{VALUE}};',
        ],
        'condition' => [
          'skin_grid_changtse_show_date!' => '',
        ],
      ]
    );

    $this->add_control(
      'comment_color_hover',
      [
        'label' => __( 'Color Hover', 'bearsthemes-addons' ),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
          '{{WRAPPER}} .elementor-post__comment a:hover' => 'color: {{VALUE}};',
          '{{WRAPPER}} .elementor-post__comment a:hover svg' => 'fill: {{VALUE}};',
        ],
        'condition' => [
          'skin_grid_changtse_show_date!' => '',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'comment_typography',
        'default' => '',
        'selector' => '{{WRAPPER}} .elementor-post__comment',
        'condition' => [
          'skin_grid_changtse_show_date!' => '',
        ],
      ]
    );


    $this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_changtse_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_changtse_show_title!' => '',
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
					' {{WRAPPER}} .elementor-post__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_changtse_show_title!' => '',
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
					'skin_grid_changtse_show_title!' => '',
				],
			]
		);

    	$this->add_control(
			'heading_author_style',
			[
				'label' => __( 'Author', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_changtse_show_author!' => '',
				],
			]
		);

		$this->add_control(
			'author_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__author' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_changtse_show_author!' => '',
				],
			]
		);

		$this->add_control(
			'author_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__author a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_changtse_show_author!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__author',
				'condition' => [
					'skin_grid_changtse_show_author!' => '',
				],
			]
		);


    $this->end_controls_section();
  }

	protected function render_post() {
		$settings = $this->parent->get_settings_for_display();

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-post' ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
          <div class="elementor-post__thumbnail">
						<a href="<?php the_permalink(); ?>">
	            <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
						</a>
					</div>
        <?php } ?>
        <div class="elementor-post__content">
            <ul class="elementor-post__meta">
              <?php if( '' !== $this->parent->get_instance_value_skin('show_date') ) { ?>
    						<li class="elementor-post__date">
    	            <?php
    								echo bearsthemes_addons_get_icon_svg('calendar', 14) .
    										 '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date('M d, Y') ) . '</time>';
    							?>
    	          </li>
    					<?php } ?>
              <?php if( '' !== $this->parent->get_instance_value_skin('show_comment') ) { ?>
                <li class="elementor-post__comment">
                  <a class="elementor-post__comment-count" href="<?php comments_link(); ?>">
                    <?php echo bearsthemes_addons_get_icon_svg('comment', 14); ?>
                    <?php comments_number( '0', '1', '%' ); ?>
                  </a>
                </li>
              <?php } ?>
            </ul>

          <?php
						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}
					?>
          <?php if( '' !== $this->parent->get_instance_value_skin('show_author') ) { ?>
            <div class="elementor-post__author">
              <?php
              echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
                get_avatar( get_the_author_meta( 'ID' ), 40 ) .
                '<span>' . esc_html__('By ', 'bearsthemes-addons') . '</span>' . get_the_author() .
              '</a>';
              ?>
            </div>
          <?php } ?>
        </div>

			</article>
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

		$this->parent->pagination();

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
