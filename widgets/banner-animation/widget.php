<?php
namespace BearsthemesAddons\Widgets\Banner_Animation;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Banner_Animation extends Widget_Base {
    public function get_name() {
		return 'be-banner-animation';
	}

	public function get_title() {
		return __( 'Be Banner with Animation', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-elementor';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

    protected function register_skins() {
		$this->add_skin( new Skins\SkinFullContent( $this ) );
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
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);
        $this->add_control(
        	'animation_type',
        	[
        		'label' => __( 'Animation type', 'bearsthemes-addons' ),
        		'type' => Controls_Manager::SELECT,
        		'options' => [
        			'default' => esc_html__( 'Default', 'bearsthemes-addons' ),
        			'bubble' => esc_html__( 'Bubble', 'bearsthemes-addons' ),
        		],
                'default' => 'default'
        	]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'bearsthemes-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elementor-banner-animation',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#000',
                    ],
                ],
			]
		);
        $this->add_control(
			'wrap_height',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Height', 'bearsthemes-addons' ),
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 720,
				],
                'selectors' => [
                    '{{WRAPPER}} .elementor-banner-animation' => 'height: {{SIZE}}{{UNIT}};',
                ],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
			]
		);
        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Logo', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'include' => [],
				'default' => 'thumbnail',
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Title' , 'bearsthemes-addons' ),
				'label_block' => true,
			]
		);

        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'List Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'bearsthemes-addons' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'bearsthemes-addons' ),
					],
					[
						'list_title' => esc_html__( 'Title #3', 'bearsthemes-addons' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
                'condition' => [
					'_skin' => '',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function register_style_section_controls() {
        $this->start_controls_section(
            'content_text',
            [
                'label' => esc_html__( 'Content Text', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'_skin' => '',
				],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'default' => '#ffff',
                'selectors' => [
                    '{{WRAPPER}} ._content .__text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} ._content .__text',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ._content .__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ._content .__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this-> end_controls_section();
    }

    protected function register_layout_style_section_controls() {
        $this->start_controls_section(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'_skin' => 'skin-full-content',
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_heading_style_section_controls() {
        $this->start_controls_section(
            'heading_text',
            [
                'label' => esc_html__( 'Heading', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'_skin' => 'skin-full-content',
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_desc_style_section_controls() {
        $this->start_controls_section(
            'desc_text',
            [
                'label' => esc_html__( 'Description', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'_skin' => 'skin-full-content',
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_cta_style_section_controls() {
        $this->start_controls_section(
            'cta',
            [
                'label' => esc_html__( 'CTA', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'_skin' => 'skin-full-content',
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_controls() {
        $this->register_layout_section_controls();
        $this->register_style_section_controls();
        $this->register_layout_style_section_controls();
        $this->register_heading_style_section_controls();
        $this->register_desc_style_section_controls();
        $this->register_cta_style_section_controls();
    }

    public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}

    public function render_background() {
        ?>
        <div id="particles-js" class="particles-wrap" data-animation="<?php echo $this->get_settings_for_display('animation_type'); ?>">
        </div>
        <?php
    }

    public function render_logo() {
        ?>
        <div class="__logo">
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $this->get_settings_for_display(), 'thumbnail', 'image' ); ?>
        </div>
        <?php
    }

    public function render_element_header() {
		$settings = $this->get_settings_for_display();
        if( $settings['_skin'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'elementor-banner-animation elementor-banner-animation--' . $settings['_skin'] );
        } else {
            $this->add_render_attribute( 'wrapper', 'class', 'elementor-banner-animation elementor-banner-animation--default' );
        }
		?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
		<?php
	}

	public function render_element_footer() {
		?>
			</div>
		<?php
	}

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->render_element_header();
        ?>
 
        <?php $this->render_background(); ?>
        <div class="_content">
            <?php
            if( $settings['image'] ) {
             $this->render_logo();
            }
             ?>
            <div class="__text">
            	<ul class="textillate" data-textillate-handle="{"selector":".texts","loop":1,"initialDelay":0,"autoStart":1,"in":{"effect":"flipInX","delayScale":1.5,"delay":50,"":true},"out":{"effect":"flipOutX","delayScale":1.5,"delay":50,"":true},"type":"char"}">
                    <?php
                    if ( $settings['list'] ) :
                        foreach($settings['list'] as $item) :
                    ?>
                		<li><?php echo $item['list_title']; ?></li>
                    <?php
                        endforeach;
                    endif
                    ?>
            	</ul>
            </div>
        </div>
        <?php

        $this->render_element_footer();
    }

}
