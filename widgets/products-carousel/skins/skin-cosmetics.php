<?php
namespace BearsthemesAddons\Widgets\Products_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Cosmetics extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-products-carousel/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-products-carousel/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-products-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-products-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-products-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-cosmetics';
	}


	public function get_title() {
		return __( 'Grid Cosmetics', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$breakpoints = $this->parent->get_breakpoints();

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
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
					'skin_cosmetics_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
				'condition' => [
					'skin_cosmetics_show_thumbnail!'=> '',
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
			'show_price',
			[
				'label' => __( 'Price', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_star_rating',
			[
				'label' => __( 'Star Rating', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
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
					'{{WRAPPER}} .elementor-product' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-product' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-product' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-product__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .elementor-product__category' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-product',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-product:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-product:hover' => 'border-color: {{VALUE}}',
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
					'skin_cosmetics_show_thumbnail!' => '',
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
					'{{WRAPPER}} .elementor-product__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-product__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-product:hover .elementor-product__thumbnail img',
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
			'heading_onsale_style',
			[
				'label' => __( 'On sale', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'onsale_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__onsale' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'onsale_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__onsale' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'onsale_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__onsale',
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'heading_add_to_cart_style',
			[
				'label' => __( 'Add to cart', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'add_to_cart_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product .button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-product .button .icon,
					 {{WRAPPER}} .elementor-product .added_to_cart' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'add_to_cart_secondary_color',
			[
				'label' => __( 'Secondary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product .button .icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .elementor-product .added_to_cart' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-product .button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'add_to_cart_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product .button',
				'condition' => [
					'skin_cosmetics_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cosmetics_show_title!' => '',
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
					'{{WRAPPER}} .elementor-product__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_title!' => '',
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
					' {{WRAPPER}} .elementor-product__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__title',
				'condition' => [
					'skin_cosmetics_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_price_style',
			[
				'label' => __( 'Price', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cosmetics_show_price!' => '',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-product__price ins span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_price!' => '',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__price span',
				'condition' => [
					'skin_cosmetics_show_price!' => '',
				],
			]
		);

		$this->add_control(
			'price_del_color',
			[
				'label' => __( 'Del Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-product__price del span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_price!' => '',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_del_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__price del span',
				'condition' => [
					'skin_cosmetics_show_price!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cosmetics_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__category' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-product__category a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-product__category',
				'condition' => [
					'skin_cosmetics_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'heading_star_rating_style',
			[
				'label' => __( 'Star Rating', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cosmetics_show_star_rating!' => '',
				],
			]
		);

		$this->add_control(
			'star_rating_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-product__star-rating .star-rating' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cosmetics_show_star_rating!' => '',
				],
			]
		);

		$this->add_control(
			'star_rating_size',
			[
				'label' => __( 'Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 16,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-product__star-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin_cosmetics_show_star_rating!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render_post() {
		$product_class = 'elementor-product';

    if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) {
      $product_class .= ' has-thumbnail';
    }

		?>
		<div class="swiper-slide">
			<article id="post-<?php the_ID();  ?>" <?php post_class( $product_class ); ?>>
				<div class="elementor-produc__wrap">
                    <div class="elementor-product__thumbnail">
                        <div class="elementor-product__overlay"></div>
                        <?php echo $this->parent->on_sales(); ?>
                        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
                            <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
                        <?php } ?>
                        <div class="elementor-product__button">
                            <div class="elementor-product__button-cart">
                                <?php echo $this->parent->button_add_to_cart(); ?>
                            </div>
                            <div class="elementor-product__button-readmore">
                                <a class="button readmore" href="<?php echo get_the_permalink(); ?>" title="View detail">
                                    <span class="ion-ios-eye">
                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-eye" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path></svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
				
					<div class="elementor-product__content">
						<?php
							if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
								the_title( '<h3 class="elementor-product__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
							}

                            if( '' !== $this->parent->get_instance_value_skin('show_category') ) {
                                the_terms( get_the_ID(), 'product_cat', '<div class="elementor-product__category">' , ',', '</div>' );
                            }

							if( '' !== $this->parent->get_instance_value_skin('show_price') ) {
								echo $this->parent->price_html();
							}

							if( '' !== $this->parent->get_instance_value_skin('show_star_rating') ) {
								echo $this->parent->star_rating_html();
							}
						?>
					</div>
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
