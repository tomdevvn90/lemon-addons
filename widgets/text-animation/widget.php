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
		return __( 'Be Text with Animation', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
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
            'bearsthemes-addons',
		];
    }

    protected function register_layout_section_controls() {
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __( 'Layout', 'bearsthemes-addons' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
                'rows' => '4',
            ]
        );

        $this->add_control(
            'in_animation',
            [
                'label' => __( 'In Animation', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bounce',
				'options' => [
					'bounce' => esc_html__( 'bounce', 'bearsthemes-addons' ),
					'flash'  => esc_html__( 'flash', 'bearsthemes-addons' ),
					'pulse' => esc_html__( 'pulse', 'bearsthemes-addons' ),
					'rubberBand' => esc_html__( 'rubberBand', 'bearsthemes-addons' ),
					'shake' => esc_html__( 'shake', 'bearsthemes-addons' ),
					'headShake' => esc_html__( 'headShake', 'bearsthemes-addons' ),
					'swing' => esc_html__( 'swing', 'bearsthemes-addons' ),
					'tada' => esc_html__( 'tada', 'bearsthemes-addons' ),
					'wobble' => esc_html__( 'wobble', 'bearsthemes-addons' ),
					'jello' => esc_html__( 'jello', 'bearsthemes-addons' ),
					'bounceIn' => esc_html__( 'bounceIn', 'bearsthemes-addons' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'bearsthemes-addons' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'bearsthemes-addons' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'bearsthemes-addons' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'bearsthemes-addons' ),
					'fadeIn' => esc_html__( 'fadeIn', 'bearsthemes-addons' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'bearsthemes-addons' ),
					'fadeInDownBig' => esc_html__( 'fadeInDownBig', 'bearsthemes-addons' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'bearsthemes-addons' ),
					'fadeInLeftBig' => esc_html__( 'fadeInLeftBig', 'bearsthemes-addons' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'bearsthemes-addons' ),
					'fadeInRightBig' => esc_html__( 'fadeInRightBig', 'bearsthemes-addons' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'bearsthemes-addons' ),
					'fadeInUpBig' => esc_html__( 'fadeInUpBig', 'bearsthemes-addons' ),
					'flipInX' => esc_html__( 'flipInX', 'bearsthemes-addons' ),
					'flipInY' => esc_html__( 'flipInY', 'bearsthemes-addons' ),
					'lightSpeedIn' => esc_html__( 'lightSpeedIn', 'bearsthemes-addons' ),
					'rotateIn' => esc_html__( 'rotateIn', 'bearsthemes-addons' ),
					'rotateInDownLeft' => esc_html__( 'rotateInDownLeft', 'bearsthemes-addons' ),
					'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'bearsthemes-addons' ),
					'rotateInUpLeft' => esc_html__( 'rotateInUpLeft', 'bearsthemes-addons' ),
					'rotateInUpRight' => esc_html__( 'rotateInUpRight', 'bearsthemes-addons' ),
					'hinge' => esc_html__( 'hinge', 'bearsthemes-addons' ),
					'jackInTheBox' => esc_html__( 'jackInTheBox', 'bearsthemes-addons' ),
					'rollIn' => esc_html__( 'rollIn', 'bearsthemes-addons' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'bearsthemes-addons' ),
                    'zoomInDown' => esc_html__( 'zoomInDown', 'bearsthemes-addons' ),
                    'zoomInLeft' => esc_html__( 'zoomInLeft', 'bearsthemes-addons' ),
                    'zoomInRight' => esc_html__( 'zoomInRight', 'bearsthemes-addons' ),
                    'zoomInUp' => esc_html__( 'zoomInUp', 'bearsthemes-addons' ),
                    'slideInDown' => esc_html__( 'slideInDown', 'bearsthemes-addons' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'bearsthemes-addons' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'bearsthemes-addons' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'bearsthemes-addons' ),
                    'heartBeat' => esc_html__( 'heartBeat', 'bearsthemes-addons' ),
				],
            ]
        );
        $this->add_control(
            'out_animation',
            [
                'label' => __( 'Out Animation', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeOut',
				'options' => [
					'bounceInUp' => esc_html__( 'bounce', 'bearsthemes-addons' ),
					'flash'  => esc_html__( 'flash', 'bearsthemes-addons' ),
					'pulse' => esc_html__( 'pulse', 'bearsthemes-addons' ),
					'rubberBand' => esc_html__( 'rubberBand', 'bearsthemes-addons' ),
					'shake' => esc_html__( 'shake', 'bearsthemes-addons' ),
					'headShake' => esc_html__( 'headShake', 'bearsthemes-addons' ),
					'swing' => esc_html__( 'swing', 'bearsthemes-addons' ),
					'tada' => esc_html__( 'tada', 'bearsthemes-addons' ),
					'wobble' => esc_html__( 'wobble', 'bearsthemes-addons' ),
					'jello' => esc_html__( 'jello', 'bearsthemes-addons' ),
					'bounceOut' => esc_html__( 'bounceOut', 'bearsthemes-addons' ),
                    'bounceOutDown' => esc_html__( 'bounceOutDown', 'bearsthemes-addons' ),
					'bounceOutLeft' => esc_html__( 'bounceOutLeft', 'bearsthemes-addons' ),
					'bounceOutRight' => esc_html__( 'bounceOutRight', 'bearsthemes-addons' ),
					'bounceOutUp' => esc_html__( 'bounceOutUp', 'bearsthemes-addons' ),
					'fadeOut' => esc_html__( 'fadeOut', 'bearsthemes-addons' ),
					'fadeOutDown' => esc_html__( 'fadeOutDown', 'bearsthemes-addons' ),
					'fadeOutDownBig' => esc_html__( 'fadeOutDownBig', 'bearsthemes-addons' ),
					'fadeOutLeft' => esc_html__( 'fadeOutLeft', 'bearsthemes-addons' ),
					'fadeOutLeftBig' => esc_html__( 'fadeOutLeftBig', 'bearsthemes-addons' ),
					'fadeOutRight' => esc_html__( 'fadeOutRight', 'bearsthemes-addons' ),
					'fadeOutRightBig' => esc_html__( 'fadeOutRightBig', 'bearsthemes-addons' ),
					'fadeOutUp' => esc_html__( 'fadeOutUp', 'bearsthemes-addons' ),
					'fadeOutUpBig' => esc_html__( 'fadeOutUpBig', 'bearsthemes-addons' ),
					'flipOutX' => esc_html__( 'flipOutX', 'bearsthemes-addons' ),
					'flipOutY' => esc_html__( 'flipOutY', 'bearsthemes-addons' ),
					'lightSpeedOut' => esc_html__( 'lightSpeedOut', 'bearsthemes-addons' ),
					'rotateOut' => esc_html__( 'rotateOut', 'bearsthemes-addons' ),
					'rotateOutDownLeft' => esc_html__( 'rotateOutDownLeft', 'bearsthemes-addons' ),
					'rotateOutDownRight' => esc_html__( 'rotateOutDownRight', 'bearsthemes-addons' ),
					'rotateOutUpRight' => esc_html__( 'rotateOutUpRight', 'bearsthemes-addons' ),
					'hinge' => esc_html__( 'hinge', 'bearsthemes-addons' ),
					'rollOut' => esc_html__( 'rollOut', 'bearsthemes-addons' ),
					'zoomOut' => esc_html__( 'zoomOut', 'bearsthemes-addons' ),
					'zoomOutDown' => esc_html__( 'zoomOutDown', 'bearsthemes-addons' ),
					'zoomOutLeft' => esc_html__( 'zoomOutLeft', 'bearsthemes-addons' ),
					'zoomOutRight' => esc_html__( 'zoomOutRight', 'bearsthemes-addons' ),
					'zoomOutUp' => esc_html__( 'zoomOutUp', 'bearsthemes-addons' ),
					'slideOutDown' => esc_html__( 'slideOutDown', 'bearsthemes-addons' ),
					'slideOutDown' => esc_html__( 'slideOutDown', 'bearsthemes-addons' ),
					'slideOutLeft' => esc_html__( 'slideOutLeft', 'bearsthemes-addons' ),
					'slideOutRight' => esc_html__( 'slideOutRight', 'bearsthemes-addons' ),
					'slideOutUp' => esc_html__( 'slideOutUp', 'bearsthemes-addons' ),
					'heartBeat' => esc_html__( 'heartBeat', 'bearsthemes-addons' ),
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section_controls() {
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bearsthemes-addons' ),
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
