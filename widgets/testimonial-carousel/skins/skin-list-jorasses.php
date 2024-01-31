<?php
namespace BearsthemesAddons\Widgets\Testimonial_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_List_Jorasses extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-testimonial-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/before_section_end', [ $this, 'register_design_latyout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-list-jorasses';
	}


	public function get_title() {
		return __( 'List jorasses', 'lemon-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$repeater = new Repeater();

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'lemon-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.' , 'lemon-addons' ),
			]
		);

		$repeater->add_control(
			'list_name', [
				'label' => __( 'Name', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Name' , 'lemon-addons' ),
			]
		);

    $repeater->add_control(
			'list_job', [
				'label' => __( 'Job', 'lemon-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Job' , 'lemon-addons' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Slides', 'lemon-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lemon-addons' ),
						'list_name' => __( 'Name #1', 'lemon-addons' ),
            'list_job' => 'Job #1',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lemon-addons' ),
						'list_name' => __( 'Name #2', 'lemon-addons' ),
            'list_job' => 'Job #2',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lemon-addons' ),
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
					'{{WRAPPER}} .elementor-testimonial' => 'text-align: {{VALUE}};',
				],
			]
		);

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
			'heading_content_style',
			[
				'label' => __( 'Content', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-testimonial__content',
			]
		);

		$this->add_control(
			'heading_name_style',
			[
				'label' => __( 'Name', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-testimonial__name',
			]
		);

    $this->add_control(
			'heading_job_style',
			[
				'label' => __( 'Job', 'lemon-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Color', 'lemon-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-testimonial__job',
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
		?>

		<div class="swiper-slide">
			<div class="elementor-testimonial">

        <?php
					if( '' !== $item['list_content'] ) {
						echo '<div class="elementor-testimonial__content">' .
                  $item['list_content'] .
                '</div>';
					}
				?>

        <div class="elementor-testimonial__infor">
          <?php
            if( '' !== $item['list_name'] ) {
              echo '<h3 class="elementor-testimonial__name">' . $item['list_name'] . '</h3>';
            }

            if( '' !== $item['list_job'] ) {
              echo '<div class="elementor-testimonial__job">' . $item['list_job'] . '</div>';
            }
          ?>
        </div>

			</div>
		</div>

		<?php
		}

		$this->parent->render_loop_footer();

	}

	protected function content_template() {

	}

}
