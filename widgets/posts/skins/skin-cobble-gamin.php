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

class Skin_Cobble_Gamin extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-cobble-gamin';
	}


	public function get_title() {
		return __( 'Cobble Gamin', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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
					'skin_cobble_gamin_show_thumbnail!'=> '',
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
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'gamin_excerpt_length', 8 ),
				'condition' => [
					'skin_cobble_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'gamin_excerpt_more', '' ),
				'condition' => [
					'skin_cobble_gamin_show_excerpt!' => '',
				],
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
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post-feature' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post-feature' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post-feature' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-post,
                       {{WRAPPER}} .elementor-post-feature',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post-feature' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post-feature' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover,
                       {{WRAPPER}} .elementor-post-feature:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover,
           {{WRAPPER}} .elementor-post-feature:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover,
           {{WRAPPER}} .elementor-post-feature:hover' => 'border-color: {{VALUE}}',
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
					'skin_cobble_gamin_show_thumbnail!'=> '',
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
				'selector' => '{{WRAPPER}} .elementor-post__thumbnail img,
                       {{WRAPPER}} .elementor-post-feature__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover .elementor-post__thumbnail img,
                       {{WRAPPER}} .elementor-post-feature:hover .elementor-post-feature__thumbnail img',
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
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_gamin_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title,
           {{WRAPPER}} .elementor-post-feature__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_gamin_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title a:hover,
           {{WRAPPER}} .elementor-post-feature__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_gamin_show_title!' => '',
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
					'skin_cobble_gamin_show_title!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_title_typography',
        'label' => __( 'Feature Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post-feature__title',
				'condition' => [
					'skin_cobble_gamin_show_title!' => '',
				],
			]
		);

    	$this->add_control(
			'excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__excerpt,
           {{WRAPPER}} .elementor-post-feature__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__excerpt,
                       {{WRAPPER}} .elementor-post-feature__excerpt',
				'condition' => [
					'skin_cobble_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_gamin_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__date,
           {{WRAPPER}} .elementor-post-feature__meta li' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_gamin_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__date,
                       {{WRAPPER}} .elementor-post-feature__meta li',
				'condition' => [
					'skin_cobble_gamin_show_meta!' => '',
				],
			]
		);

    $this->end_controls_section();
  }

  protected function render_loop_header() {

		$classes = 'elementor-grid-wrap';
		$classes .= ' elementor-posts--skin-cobble-gamin';

		?>
			<div class="<?php echo esc_attr( $classes ); ?>">
		<?php
	}

	protected function render_loop_footer() {

		?>
			</div>
		<?php
	}

  public function filter_feature_excerpt_length() {

		return $this->parent->get_instance_value_skin('excerpt_length') * 3;
	}

  protected function render_post_feature( $count ) {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post-feature';
    $post_classes .= ' elementor-post--' . $count;

		if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) {
			$post_classes .= ' has-thumbnail';
		}

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
          <div class="elementor-post-feature__thumbnail-wrap">
            <div class="elementor-post-feature__thumbnail">
              <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
              <div class="elementor-post-feature__overlay"></div>
            </div>
          </div>
        <?php } ?>

        <div class="elementor-post-feature__content">
          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<ul class="elementor-post-feature__meta">
              <li>
                <?php
                  echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
                    get_avatar( get_the_author_meta( 'ID' ), 40 ) .
                    '<span>' . esc_html__('by ', 'bearsthemes-addons') . '</span>' . get_the_author() .
                  '</a>';
                ?>
              </li>
  	          <li>
  	            <?php
                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	          </li>
  	        </ul>
  				<?php } ?>

          <?php
						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post-feature__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}

            if( '' !== $this->parent->get_instance_value_skin('show_excerpt') ) {
							add_filter( 'excerpt_more', [ $this->parent, 'filter_excerpt_more' ], 20 );
							add_filter( 'excerpt_length', [ $this, 'filter_feature_excerpt_length' ], 20 );

							?>
							<div class="elementor-post-feature__excerpt">
								<?php the_excerpt(); ?>
							</div>
							<?php

							remove_filter( 'excerpt_length', [ $this, 'filter_feature_excerpt_length' ], 20 );
							remove_filter( 'excerpt_more', [ $this->parent, 'filter_excerpt_more' ], 20 );
						}
					?>
        </div>

			</article>
		<?php
  }

	protected function render_post( $count ) {
		$settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post';
    $post_classes .= ' elementor-post--' . $count;

		if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) {
			$post_classes .= ' has-thumbnail';
		}

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
          <div class="elementor-post__thumbnail-wrap">
            <div class="elementor-post__thumbnail">
              <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
              <div class="elementor-post__overlay"></div>
            </div>
          </div>
        <?php } ?>

        <div class="elementor-post__content">
          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<div class="elementor-post__date">
  	            <?php
                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	        </div>
  				<?php } ?>
          <?php
						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}
					?>
        </div>

			</article>
		<?php
	}

  protected function render_post_no_image( $count ) {
		$settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post';
    $post_classes .= ' elementor-post--' . $count;
    $post_classes .= ' no-thumbnail';

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <div class="elementor-post__content">
          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<div class="elementor-post__date">
  	            <?php
                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	        </div>
  				<?php } ?>
          <?php
						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}

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
					?>
        </div>

			</article>
		<?php
	}

  public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

      $this->render_loop_header();

        $count = 0;
        $total = $query->post_count;
        while ( $query->have_posts() ) {
          $query->the_post();
          $count ++;

          if( $count < 3 ) {
            if($count == 1) echo '<div class="col-post-image">';
              $this->render_post( $count );
            if($count == 2 && $count <= $total) echo '</div>';
          } elseif($count == 3) {
            echo '<div class="col-post-feature">';
              $this->render_post_feature( $count );
            echo '</div>';
          } elseif($count < 7) {
            if($count == 4) echo '<div class="col-post-no-image">';
              $this->render_post_no_image( $count );
            if($count == 6 && $count <= $total) echo '</div>';
          } else {
            if($count == 7) echo '<div class="col-post-grid">';
              $this->render_post( $count );
            if($count == $total) echo '</div>';
          }
        }

			$this->render_loop_footer();

		} else {
		    // no posts found
		}

		$this->parent->pagination();

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
