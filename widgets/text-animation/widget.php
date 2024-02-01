<?php
namespace BearsthemesAddons\Widgets\Text_Animation;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Text_Animation extends Widget_Base {
    public function get_name() {
		return 'be-text-animation';
	}

	public function get_title() {
		return __( 'Be Text with Animation', 'lemon-addons' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

	public function get_categories() {
		return [ 'lemon-addons' ];
	}

    public function get_style_depends() {
        return [
            'animate',
        ];
    }

    public function get_script_depends() {
        return [
            'jquery-particles',
            'jquery-textillate',
            'jquery-lettering',
            'lemon-addons-plugin',
		];
    }

    protected function register_layout_section_controls() {
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __( 'Layout', 'lemon-addons' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'lemon-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
                'rows' => '4',
            ]
        );

        $this->add_control(
            'in_animation',
            [
                'label' => __( 'In Animation', 'lemon-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bounce',
				'options' => [
					'none' => esc_html__( 'none', 'lemon-addons' ),
					'bounce' => esc_html__( 'bounce', 'lemon-addons' ),
					'flash'  => esc_html__( 'flash', 'lemon-addons' ),
					'pulse' => esc_html__( 'pulse', 'lemon-addons' ),
					'rubberBand' => esc_html__( 'rubberBand', 'lemon-addons' ),
					'shake' => esc_html__( 'shake', 'lemon-addons' ),
					'headShake' => esc_html__( 'headShake', 'lemon-addons' ),
					'swing' => esc_html__( 'swing', 'lemon-addons' ),
					'tada' => esc_html__( 'tada', 'lemon-addons' ),
					'wobble' => esc_html__( 'wobble', 'lemon-addons' ),
					'jello' => esc_html__( 'jello', 'lemon-addons' ),
					'bounceIn' => esc_html__( 'bounceIn', 'lemon-addons' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'lemon-addons' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'lemon-addons' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'lemon-addons' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'lemon-addons' ),
					'fadeIn' => esc_html__( 'fadeIn', 'lemon-addons' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'lemon-addons' ),
					'fadeInDownBig' => esc_html__( 'fadeInDownBig', 'lemon-addons' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'lemon-addons' ),
					'fadeInLeftBig' => esc_html__( 'fadeInLeftBig', 'lemon-addons' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'lemon-addons' ),
					'fadeInRightBig' => esc_html__( 'fadeInRightBig', 'lemon-addons' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'lemon-addons' ),
					'fadeInUpBig' => esc_html__( 'fadeInUpBig', 'lemon-addons' ),
					'flipInX' => esc_html__( 'flipInX', 'lemon-addons' ),
					'flipInY' => esc_html__( 'flipInY', 'lemon-addons' ),
					'lightSpeedIn' => esc_html__( 'lightSpeedIn', 'lemon-addons' ),
					'rotateIn' => esc_html__( 'rotateIn', 'lemon-addons' ),
					'rotateInDownLeft' => esc_html__( 'rotateInDownLeft', 'lemon-addons' ),
					'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'lemon-addons' ),
					'rotateInUpLeft' => esc_html__( 'rotateInUpLeft', 'lemon-addons' ),
					'rotateInUpRight' => esc_html__( 'rotateInUpRight', 'lemon-addons' ),
					'hinge' => esc_html__( 'hinge', 'lemon-addons' ),
					'jackInTheBox' => esc_html__( 'jackInTheBox', 'lemon-addons' ),
					'rollIn' => esc_html__( 'rollIn', 'lemon-addons' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'lemon-addons' ),
                    'zoomInDown' => esc_html__( 'zoomInDown', 'lemon-addons' ),
                    'zoomInLeft' => esc_html__( 'zoomInLeft', 'lemon-addons' ),
                    'zoomInRight' => esc_html__( 'zoomInRight', 'lemon-addons' ),
                    'zoomInUp' => esc_html__( 'zoomInUp', 'lemon-addons' ),
                    'slideInDown' => esc_html__( 'slideInDown', 'lemon-addons' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'lemon-addons' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'lemon-addons' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'lemon-addons' ),
                    'heartBeat' => esc_html__( 'heartBeat', 'lemon-addons' ),
				],
            ]
        );
        $this->add_control(
            'out_animation',
            [
                'label' => __( 'Out Animation', 'lemon-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeOut',
				'options' => [
					'none' => esc_html__( 'none', 'lemon-addons' ),
					'bounceInUp' => esc_html__( 'bounce', 'lemon-addons' ),
					'flash'  => esc_html__( 'flash', 'lemon-addons' ),
					'pulse' => esc_html__( 'pulse', 'lemon-addons' ),
					'rubberBand' => esc_html__( 'rubberBand', 'lemon-addons' ),
					'shake' => esc_html__( 'shake', 'lemon-addons' ),
					'headShake' => esc_html__( 'headShake', 'lemon-addons' ),
					'swing' => esc_html__( 'swing', 'lemon-addons' ),
					'tada' => esc_html__( 'tada', 'lemon-addons' ),
					'wobble' => esc_html__( 'wobble', 'lemon-addons' ),
					'jello' => esc_html__( 'jello', 'lemon-addons' ),
					'bounceOut' => esc_html__( 'bounceOut', 'lemon-addons' ),
                    'bounceOutDown' => esc_html__( 'bounceOutDown', 'lemon-addons' ),
					'bounceOutLeft' => esc_html__( 'bounceOutLeft', 'lemon-addons' ),
					'bounceOutRight' => esc_html__( 'bounceOutRight', 'lemon-addons' ),
					'bounceOutUp' => esc_html__( 'bounceOutUp', 'lemon-addons' ),
					'fadeOut' => esc_html__( 'fadeOut', 'lemon-addons' ),
					'fadeOutDown' => esc_html__( 'fadeOutDown', 'lemon-addons' ),
					'fadeOutDownBig' => esc_html__( 'fadeOutDownBig', 'lemon-addons' ),
					'fadeOutLeft' => esc_html__( 'fadeOutLeft', 'lemon-addons' ),
					'fadeOutLeftBig' => esc_html__( 'fadeOutLeftBig', 'lemon-addons' ),
					'fadeOutRight' => esc_html__( 'fadeOutRight', 'lemon-addons' ),
					'fadeOutRightBig' => esc_html__( 'fadeOutRightBig', 'lemon-addons' ),
					'fadeOutUp' => esc_html__( 'fadeOutUp', 'lemon-addons' ),
					'fadeOutUpBig' => esc_html__( 'fadeOutUpBig', 'lemon-addons' ),
					'flipOutX' => esc_html__( 'flipOutX', 'lemon-addons' ),
					'flipOutY' => esc_html__( 'flipOutY', 'lemon-addons' ),
					'lightSpeedOut' => esc_html__( 'lightSpeedOut', 'lemon-addons' ),
					'rotateOut' => esc_html__( 'rotateOut', 'lemon-addons' ),
					'rotateOutDownLeft' => esc_html__( 'rotateOutDownLeft', 'lemon-addons' ),
					'rotateOutDownRight' => esc_html__( 'rotateOutDownRight', 'lemon-addons' ),
					'rotateOutUpRight' => esc_html__( 'rotateOutUpRight', 'lemon-addons' ),
					'hinge' => esc_html__( 'hinge', 'lemon-addons' ),
					'rollOut' => esc_html__( 'rollOut', 'lemon-addons' ),
					'zoomOut' => esc_html__( 'zoomOut', 'lemon-addons' ),
					'zoomOutDown' => esc_html__( 'zoomOutDown', 'lemon-addons' ),
					'zoomOutLeft' => esc_html__( 'zoomOutLeft', 'lemon-addons' ),
					'zoomOutRight' => esc_html__( 'zoomOutRight', 'lemon-addons' ),
					'zoomOutUp' => esc_html__( 'zoomOutUp', 'lemon-addons' ),
					'slideOutDown' => esc_html__( 'slideOutDown', 'lemon-addons' ),
					'slideOutDown' => esc_html__( 'slideOutDown', 'lemon-addons' ),
					'slideOutLeft' => esc_html__( 'slideOutLeft', 'lemon-addons' ),
					'slideOutRight' => esc_html__( 'slideOutRight', 'lemon-addons' ),
					'slideOutUp' => esc_html__( 'slideOutUp', 'lemon-addons' ),
					'heartBeat' => esc_html__( 'heartBeat', 'lemon-addons' ),
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_controls() {
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'lemon-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'lemon-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'lemon-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'lemon-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'lemon-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .tlt' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .tlt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .tlt',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_controls() {
        $this->register_layout_section_controls();
        $this->register_style_section_controls();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <span class="tlt" data-in-effect="<?php echo $settings['in_animation']; ?>" data-out-effect="<?php echo $settings['out_animation']; ?>" data-in-shuffle="false" data-out-shuffle="true"><?php echo $settings['content']; ?></span>
        <?php
    }
}
