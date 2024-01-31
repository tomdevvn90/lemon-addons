<?php
namespace BearsthemesAddons\Widgets\Testimonial_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Lemon_Tattoo extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-testimonial-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/before_section_end', [ $this, 'register_design_latyout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-lemon-tattoo';
	}


	public function get_title() {
		return __( 'Lemon Tattoo', 'lemon-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$repeater = new Repeater();

        $repeater->add_control(
			'list_name', [
				'label' => __( 'Name', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Name' , 'lemon-addons' ),
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Description', 'lemon-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.' , 'lemon-addons' ),
			]
		);

		$repeater->add_control(
			'list_image', [
				'label' => __( 'Thumbnail', 'lemon-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list',[
				'label' => __( 'Slides', 'lemon-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lemon-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #1', 'lemon-addons' ),
						'list_job' => 'Job #1',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lemon-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #2', 'lemon-addons' ),
						'list_job' => 'Job #2',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lemon-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #3', 'lemon-addons' ),
						'list_job' => 'Job #3',
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$breakpoints = $this->parent->get_breakpoints();

    	$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'separator' => 'before',
			] + $breakpoints
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'thumbnail',
				'exclude' => [ 'custom' ],
			]
		);

	}


	public function register_design_latyout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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
					'{{WRAPPER}} .item-testimonial-inner' => 'text-align: {{VALUE}};',
				],
			]
		);
	}

	public function register_design_content_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

        $this->start_controls_section(
			'section_design_content',[
				'label' => __( 'Content', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'name_style',[
				'label' => __( 'Name', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-testimonial--name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name' => 'name_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-testimonial--name',
			]
		);

		$this->add_control(
			'desc_style',[
				'label' => __( 'Description', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'desc_color',[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-testimonial--desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name' => 'desc_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .item-testimonial--desc',
			]
		);

        $this->add_control(
			'icon_style',[
				'label' => __( 'Icon Quocte', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->add_control(
			'ic_quocte_color',[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .item-testimonial--desc svg path' => 'fill: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
			'icon_fontsize',[
				'label' => __( 'Size', 'lemon-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-testimonial--desc svg' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .elementor-testimonial__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings();

		if ( empty( $this->parent->get_instance_value_skin( 'list' ) ) ) {
			return;
		}

		$this->parent->render_loop_header();

		foreach ( $this->parent->get_instance_value_skin( 'list' ) as $index => $item ) {
            $thumbnail = wp_get_attachment_image_src( $item['list_image']['id'], $this->parent->get_instance_value_skin( 'thumbnail_size' ) );
        ?>

            <div class="swiper-slide"> 
				<div class="item-testimonial"> 
					<div class="item-testimonial-inner"> 
						<div class="item-testimonial--thumbnail"> 
							<?php if(!empty($thumbnail) && isset($thumbnail)): ?>
								<img src="<?= esc_url( $thumbnail[0] ) ?>" alt="avatar" />
							<?php else: ?>
								<img src="<?= esc_url( $item['list_image']['url'] ) ?>" />
							<?php endif; ?>		
						</div>

						<div class="item-testimonial-content">
						   	<?php if( '' !== $item['list_content'] ): ?>
								<div class="item-testimonial--desc"> 
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M4.7 17.7c-1-1.1-1.6-2.3-1.6-4.3 0-3.5 2.5-6.6 6-8.2l.9 1.3c-3.3 1.8-4 4.1-4.2 5.6.5-.3 1.2-.4 1.9-.3 1.8.2 3.2 1.6 3.2 3.5 0 .9-.4 1.8-1 2.5-.7.7-1.5 1-2.5 1-1.1 0-2.1-.5-2.7-1.1zm10 0c-1-1.1-1.6-2.3-1.6-4.3 0-3.5 2.5-6.6 6-8.2l.9 1.3c-3.3 1.8-4 4.1-4.2 5.6.5-.3 1.2-.4 1.9-.3 1.8.2 3.2 1.6 3.2 3.5 0 .9-.4 1.8-1 2.5s-1.5 1-2.5 1c-1.1 0-2.1-.5-2.7-1.1z" fill="#8abf89" opacity="1" data-original="#000000" class=""></path></g></svg>
									<?= $item['list_content'] ?>
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M19.3 6.3c1 1.1 1.6 2.3 1.6 4.3 0 3.5-2.5 6.6-6 8.2l-.9-1.3c3.3-1.8 4-4.1 4.2-5.6-.5.3-1.2.4-1.9.3-1.8-.2-3.2-1.6-3.2-3.5 0-.9.4-1.8 1-2.5.7-.7 1.5-1 2.5-1 1.1 0 2.1.5 2.7 1.1zm-10 0c1 1.1 1.6 2.3 1.6 4.3 0 3.5-2.5 6.6-6 8.2L4 17.5c3.3-1.8 4-4.1 4.2-5.6-.5.3-1.2.4-1.9.3-1.8-.2-3.2-1.7-3.2-3.5 0-.9.4-1.8 1-2.5.7-.7 1.5-1 2.5-1 1.1 0 2.1.5 2.7 1.1z" fill="#8abf89" opacity="1" data-original="#000000" class=""></path></g></svg>
								</div>
							<?php endif; ?>

							<?php if( '' !== $item['list_name'] ): ?>
								<h3 class="item-testimonial--name"> <?= $item['list_name'] ?> </h3>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>

		<?php }

		$this->parent->render_loop_footer();

	}

	protected function content_template() {

	}

}
