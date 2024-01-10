<?php
namespace BearsthemesAddons\Widgets\Before_After;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Embed;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Before_After extends Widget_Base {

	public function get_name() {
		return 'be-before-after';
	}

	public function get_title() {
		return __( 'Be Before After', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'jquery.event.move', 'jquery.twentytwenty', 'lemon-addons-plugin' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'image_before',
			[
				'label' => __( 'Image Before', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    	$this->add_control(
			'image_after',
			[
				'label' => __( 'Image After', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_additional_settings_section_controls() {
		$this->start_controls_section(
			'section_additional_settings',
			[
				'label' => __( 'Additional Settings', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'default_offset_pct',
			[
				'label' => __( 'Default Offset PCT', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0.1,
				'max' => 1,
				'step' => 0.1,
				'default' => 0.5,
			]
		);

		$this->add_control(
			'orientation',
			[
				'label' => __( 'Orientation', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'bearsthemes-addons'),
					'vertical' => esc_html__('Vertical', 'bearsthemes-addons'),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_layout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'twentytwenty_overlay',
			[
				'label' => __( 'Overlay', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'twentytwenty_overlay_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-overlay' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'twentytwenty_overlay_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-overlay:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'twentytwenty_label',
			[
				'label' => __( 'Before After Label', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'twentytwenty_before_after_label',
				'default' => '',
				'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
			]
		);

		$this->add_control(
			'twentytwenty_before_after_label_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'twentytwenty_before_after_label_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'background: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_additional_settings_section_controls();
		$this->register_design_layout_section_controls();
	}

	protected function twentytwenty_data() {
		$settings = $this->get_settings_for_display();

		$default_offset_pct = !empty($settings['default_offset_pct'])? $settings['default_offset_pct'] : 0.5;
		$orientation = !empty($settings['orientation'])? $settings['orientation'] : 'horizontal';

		$twentytwenty__data = array(
			'default_offset_pct' => $default_offset_pct,
			'orientation' => $orientation,
		);


		return $twentytwenty_json = json_encode($twentytwenty__data);

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="before-after-image-wrapper">
			<div class="twentytwenty-container" data-twentytwenty="<?php echo esc_attr( $this->twentytwenty_data() ); ?>">
			<?php
				if( $settings['image_before'] ) {
				echo '<img src="'.$settings['image_before']['url'].'" alt="Image Before"/>';
				}

				if( $settings['image_after'] ) {
				echo '<img src="'.$settings['image_after']['url'].'" alt="Image After"/>';
				}
				?>
			</div>
		</div>
		<?php

	}

	protected function content_template() {

	}
}
