<?php
namespace BearsthemesAddons\Widgets\Base_Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Base_Widget extends Widget_Base {

	public function get_name() {
		return 'be-base-widget';
	}

	public function get_title() {
		return __( 'Be Base Widget', 'lemon-addons' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'lemon-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Simple( $this ) );

	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'lemon-addons' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'lemon-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'lemon-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'lemon-addons' ),
					'uppercase' => __( 'UPPERCASE', 'lemon-addons' ),
					'lowercase' => __( 'lowercase', 'lemon-addons' ),
					'capitalize' => __( 'Capitalize', 'lemon-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="title">';
		echo $settings['title'];
		echo '</div>';
	}

	protected function content_template() {

	}
}
