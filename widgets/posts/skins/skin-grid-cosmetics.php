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

class Skin_Grid_Cosmetics extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_filter_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-grid-cosmetics';
	}


	public function get_title() {
		return __( 'Grid Cosmetics', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'tablet_default' => '1',
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
				'default' => 3,
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label' => __( 'Show Filter', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => '',
			]
		);

		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->parent->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'skin_grid_cosmetics_show_filter!' => '',
				],
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
					'skin_grid_cosmetics_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.80,
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
					'skin_grid_cosmetics_show_thumbnail!'=> '',
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
				'default' => apply_filters( 'yutmaru_excerpt_length', 12 ),
				'condition' => [
					'skin_grid_cosmetics_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'yutmaru_excerpt_more', '' ),
				'condition' => [
					'skin_grid_cosmetics_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default'  => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'bearsthemes-addons' ),
				'type' 	=> Controls_Manager::TEXT,
				'default' => __( 'Read More', 'bearsthemes-addons' ),
				'condition' => [
					'skin_grid_cosmetics_show_read_more!' => '',
				],
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
					'size' => 50,
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

	public function register_design_filter_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_filter',
			[
				'label' => __( 'Filter', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filter_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-filter-wrap .elementor-filter li a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_filter!' => '',
				],
			]
		);

		$this->add_control(
			'filter_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-filter-wrap .elementor-filter li a.active,
					 {{WRAPPER}} .elementor-filter-wrap .elementor-filter li a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-filter-wrap .elementor-filter li a.active:after,
 					 {{WRAPPER}} .elementor-filter-wrap .elementor-filter li a:hover:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_filter!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-filter',
				'condition' => [
					'skin_grid_cosmetics_show_filter!' => '',
				],
			]
		);

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
					'skin_grid_cosmetics_show_thumbnail!'=> '',
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
					'skin_grid_cosmetics_show_date!' => '',
				],
			]
		);

		$this->add_control(
			'date_first_color',
			[
				'label' => __( 'First Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__date::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-post__date .first' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-post__date .first svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_date!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_first_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__date .first',
				'condition' => [
					'skin_grid_cosmetics_show_date!' => '',
				],
			]
		);

		$this->add_control(
			'date_last_color',
			[
				'label' => __( 'Last Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-post__date svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_date!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_last_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__date',
				'condition' => [
					'skin_grid_cosmetics_show_date!' => '',
				],
			]
		);

    	$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_cosmetics_show_title!' => '',
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
					'skin_grid_cosmetics_show_title!' => '',
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
					'skin_grid_cosmetics_show_title!' => '',
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
					'skin_grid_cosmetics_show_title!' => '',
				],
			]
		);

    	$this->add_control(
			'heading_excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_cosmetics_show_excerpt!' => '',
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
					'{{WRAPPER}} .elementor-post__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_excerpt!' => '',
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
					'skin_grid_cosmetics_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_readmore_style',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_cosmetics_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__read-more:hover' => 'color: {{VALUE}};',
					' {{WRAPPER}} .elementor-post__read-more:hover::before' => 'background: {{VALUE}};',
					' {{WRAPPER}} .elementor-post__read-more:hover::after' => 'background: {{VALUE}};',
					' {{WRAPPER}} .elementor-post__read-more:hover .read-more-wrap::before' => 'background: {{VALUE}};',
					' {{WRAPPER}} .elementor-post__read-more:hover .read-more-wrap::after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_cosmetics_show_read_more!' => '',
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
					'skin_grid_cosmetics_show_read_more!' => '',
				],
			]
		);

    $this->end_controls_section();
  }

	protected function render_post() {
		$settings = $this->parent->get_settings_for_display();

		$group = array();
		foreach ( get_the_terms( get_the_ID(), 'category' ) as $tax ) {
			$group[] = $tax->slug;
		}

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-post elementor-item' ); ?> data-group="<?php echo implode(' ', $group); ?>" >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
					<div class="elementor-post__thumbnail-wrap">
	          <div class="elementor-post__thumbnail">
	            <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
	          </div>
					</div>
        <?php } ?>

        <div class="elementor-post__content">
			<?php
				if( '' !== $this->parent->get_instance_value_skin('show_date') ) {
					echo '<div class="elementor-post__date">' .
						'<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' 
						. __( '<span class="first">'.get_the_date('d').'</span> <span class="last">'.get_the_date('F').'<br>'.get_the_date('Y').'</span>', 'bearsthemes-addons' ) . 
						'</time>' .
					'</div>';
				}

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

				if( '' !== $this->parent->get_instance_value_skin('show_read_more' ) ){
					echo '<a class="elementor-post__read-more" href="' . get_the_permalink() . '">
						<span class="read-more-wrap">' .$this->parent->get_instance_value_skin('read_more_text') .'
							<svg width="24" height="12" viewBox="0 0 24 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.937361 5.06249H20.7916L17.5027 1.78949C17.1357 1.42424 17.1343 0.830668 17.4996 0.463684C17.8648 0.096653 18.4584 0.095294 18.8254 0.460497L23.724 5.33549C23.7244 5.33577 23.7246 5.3361 23.7249 5.33638C24.0909 5.70163 24.0921 6.29713 23.725 6.6636C23.7247 6.66388 23.7244 6.66421 23.7241 6.66449L18.8255 11.5395C18.4586 11.9046 17.865 11.9034 17.4997 11.5363C17.1344 11.1693 17.1358 10.5757 17.5028 10.2105L20.7916 6.93749H0.937361C0.41958 6.93749 -0.000139236 6.51777 -0.000139236 5.99999C-0.000139236 5.48221 0.41958 5.06249 0.937361 5.06249Z"/>
							</svg>
						</span>' .
					'</a>';
				}
			?>
        </div>
			</article>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

			$this->parent->render_filter();

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
