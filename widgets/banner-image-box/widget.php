<?php
namespace BearsthemesAddons\Widgets\Banner_Image_Box;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Banner_Image_Box extends Widget_Base {
    public function get_name() {
		return 'be-banner-image-box';
	}

	public function get_title() {
		return __( 'Be Banner Image Box', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-elementor';
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
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'bearsthemes-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elementor-banner-image-box',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#ffffff',
                    ],
                ],
			]
		);

        $this->add_control(
			'banner_height',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Min Height', 'bearsthemes-addons' ),
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
                        'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
                'selectors' => [
                    '{{WRAPPER}} .elementor-banner-image-box--inner' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->add_control(
			'banner_image',
			[
				'label' => esc_html__( 'Banner Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
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

        $this->end_controls_section();

        $this->start_controls_section(
			'section_image_box_one',
			[
				'label' => __( 'Image Box One', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_one_img',
			[
				'label' => esc_html__( 'Choose Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'banner_image_box_one_heading',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading one', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_one_sub_heading',
			[
				'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __( 'This is the sub heading one', 'bearsthemes-addons' ),
			]
		);


        $this-> end_controls_section();

        $this->start_controls_section(
			'section_image_box_two',
			[
				'label' => __( 'Image Box Two', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_two_img',
			[
				'label' => esc_html__( 'Choose Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'banner_image_box_two_heading',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading two', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_two_sub_heading',
			[
				'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __( 'This is the sub heading two', 'bearsthemes-addons' ),
			]
		);


        $this-> end_controls_section();

        $this->start_controls_section(
			'section_image_box_three',
			[
				'label' => __( 'Image Box Three', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_three_img',
			[
				'label' => esc_html__( 'Choose Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'banner_image_box_three_heading',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading three', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_three_sub_heading',
			[
				'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __( 'This is the sub heading three', 'bearsthemes-addons' ),
			]
		);


        $this-> end_controls_section();

        $this->start_controls_section(
			'section_image_box_fourth',
			[
				'label' => __( 'Image Box Fourth', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_fourth_img',
			[
				'label' => esc_html__( 'Choose Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'banner_image_box_fourth_heading',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading fourth', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'banner_image_box_fourth_sub_heading',
			[
				'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __( 'This is the sub heading fourth', 'bearsthemes-addons' ),
			]
		);


        $this-> end_controls_section();
    }

    protected function register_design_layout_section_controls() {

        $this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'banner_img_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .img-item-banner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this-> end_controls_section();

        $this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'heading_color',
            [
                'label' => 'Heading Color',
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-banner-image-box__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .elementor-banner-image-box__heading',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => 'Sub Heading Color',
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-banner-image-box__sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .elementor-banner-image-box__sub-heading',
            ]
        );


        $this-> end_controls_section();
    }

    protected function register_controls() {
        $this->register_layout_section_controls();
        $this->register_design_layout_section_controls();
    }

    public function render_element_header() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-banner-image-box elementor-banner-image-box--default' );
        
		?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
		<?php
    }

    public function render_element_footer() {
		?>
			</div>
		<?php
	}

    public function render_element_image_box_one() {
        $settings = $this->get_settings_for_display();

        $image = $settings['banner_image_box_one_img'];
        $heading = $settings['banner_image_box_one_heading'];
        $sub_heading = $settings['banner_image_box_one_sub_heading'];

        $class = 'elementor-banner-image-box--one elementor-banner-image-box__item';

        $this->add_render_attribute( 'banner_image_box_one_wrapper', 'class', $class );

		?>
            <div <?php echo $this->get_render_attribute_string( 'banner_image_box_one_wrapper' ); ?>>
                <div class="elementor-banner-image-box__wrap">    
                    <div class="elementor-banner-image-box__content">
                        <?php
                        if( !empty( $heading ) ) {
                            echo '<h3 class="tlt elementor-banner-image-box__heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >'. $heading .'</h3>';
                        }

                        if( !empty( $sub_heading ) ) {
                            echo '<div class="elementor-banner-image-box__sub-heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >' . $sub_heading . '</div>';
                        }
                        ?>
                    </div>
                    <div class="elementor-banner-image-box__image">
                        <?php
                            if( '' !== $image['url'] ) {
                                echo '<img src="' . esc_url( $image['url'] ) . '" alt=""/>';
                            }
                        ?>
                    </div>
                </div>
			</div>
		<?php
	}

    public function render_element_image_box_two() {
        $settings = $this->get_settings_for_display();

        $image = $settings['banner_image_box_two_img'];
        $heading = $settings['banner_image_box_two_heading'];
        $sub_heading = $settings['banner_image_box_two_sub_heading'];

        $class = 'elementor-banner-image-box--two elementor-banner-image-box__item';

        $this->add_render_attribute( 'banner_image_box_two_wrapper', 'class', $class );

		?>
            <div <?php echo $this->get_render_attribute_string( 'banner_image_box_two_wrapper' ); ?>>
                <div class="elementor-banner-image-box__wrap">
                    <div class="elementor-banner-image-box__content">
                        <?php
                        if( !empty( $heading ) ) {
                            echo '<h3 class="tlt elementor-banner-image-box__heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >'. $heading .'</h3>';
                        }

                        if( !empty( $sub_heading ) ) {
                            echo '<div class="elementor-banner-image-box__sub-heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >' . $sub_heading . '</div>';
                        }
                        ?>
                    </div>
                    <div class="elementor-banner-image-box__image">
                        <?php
                            if( '' !== $image['url'] ) {
                                echo '<img src="' . esc_url( $image['url'] ) . '" alt=""/>';
                            }
                        ?>
                    </div>
                </div>
			</div>
		<?php
	}

    public function render_element_image_box_three() {
        $settings = $this->get_settings_for_display();

        $image = $settings['banner_image_box_three_img'];
        $heading = $settings['banner_image_box_three_heading'];
        $sub_heading = $settings['banner_image_box_three_sub_heading'];

        $class = 'elementor-banner-image-box--three elementor-banner-image-box__item';

        $this->add_render_attribute( 'banner_image_box_three_wrapper', 'class', $class );

		?>
            <div <?php echo $this->get_render_attribute_string( 'banner_image_box_three_wrapper' ); ?>>
                <div class="elementor-banner-image-box__wrap">    
                    <div class="elementor-banner-image-box__content">
                        <?php
                        if( !empty( $heading ) ) {
                            echo '<h3 class="tlt elementor-banner-image-box__heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >'. $heading .'</h3>';
                        }

                        if( !empty( $sub_heading ) ) {
                            echo '<div class="elementor-banner-image-box__sub-heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >' . $sub_heading . '</div>';
                        }
                        ?>
                    </div>
                    <div class="elementor-banner-image-box__image">
                        <?php
                            if( '' !== $image['url'] ) {
                                echo '<img src="' . esc_url( $image['url'] ) . '" alt=""/>';
                            }
                        ?>
                    </div>
                </div>
			</div>
		<?php
	}

    public function render_element_image_box_fourth() {
        $settings = $this->get_settings_for_display();

        $image = $settings['banner_image_box_fourth_img'];
        $heading = $settings['banner_image_box_fourth_heading'];
        $sub_heading = $settings['banner_image_box_fourth_sub_heading'];

        $class = 'elementor-banner-image-box--fourth elementor-banner-image-box__item';

        $this->add_render_attribute( 'banner_image_box_fourth_wrapper', 'class', $class );

		?>
            <div <?php echo $this->get_render_attribute_string( 'banner_image_box_fourth_wrapper' ); ?>>
                <div class="elementor-banner-image-box__wrap">    
                    <div class="elementor-banner-image-box__content">
                        <?php
                        if( !empty( $heading ) ) {
                            echo '<h3 class="tlt elementor-banner-image-box__heading" 
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >'. $heading .'</h3>';
                        }

                        if( !empty( $sub_heading ) ) {
                            echo '<div class="elementor-banner-image-box__sub-heading"
                            data-in-effect="fadeInDown"
                            data-out-effect="none"
                            data-in-shuffle="false"
                            data-out-shuffle="true"
                            >' . $sub_heading . '</div>';
                        }
                        ?>
                    </div>
                    <div class="elementor-banner-image-box__image">
                        <?php
                            if( '' !== $image['url'] ) {
                                echo '<img src="' . esc_url( $image['url'] ) . '" alt=""/>';
                            }
                        ?>
                    </div>
                </div>
			</div>
		<?php
	}

    public function render_element_banner_image() {
        $settings = $this->get_settings_for_display();

        $banner_image = $settings['banner_image'];
        $imageOne = $settings['banner_image_box_one_img'];
        $imageTwo = $settings['banner_image_box_two_img'];
        $imageThree = $settings['banner_image_box_three_img'];
        $imageFourth = $settings['banner_image_box_fourth_img'];

		?>
            <div class="elementor-banner-image-box--banner-image">
			<?php
                if( '' !== $imageOne['url'] ) {
                    echo '<div class="img-item img-item-one rotateInDownRight">
                            <img class="img img-one" src="' . esc_url( $imageOne['url'] ) . '" alt=""/>
                        </div>';
                }
                if( '' !== $imageTwo['url'] ) {
                    echo '<div class="img-item img-item-two rotateInUpRight">
                            <img class="img img-two" src="' . esc_url( $imageTwo['url'] ) . '" alt=""/>
                        </div>';
                }
                if( '' !== $imageThree['url'] ) {
                    echo '<div class="img-item img-item-three rotateInUpRight">
                            <img class="img img-three" src="' . esc_url( $imageThree['url'] ) . '" alt=""/>
                        </div>';
                }
                if( '' !== $imageFourth['url'] ) {
                    echo '<div class="img-item img-item-fourth rotateInDownLeft">
                            <img class="img img-fourth" src="' . esc_url( $imageFourth['url'] ) . '" alt=""/>
                        </div>';
                }
				if( '' !== $banner_image['url'] ) {
					echo '<div class="img-item-banner">'. 
                            Group_Control_Image_Size::get_attachment_image_html( $this->get_settings_for_display(), 'thumbnail', 'banner_image' )
                        .'</div>';
				}
			?>
			</div>
		<?php
	}

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->render_element_header();

		?>
			<div class="elementor-banner-image-box--inner">

                <?php $this->render_element_image_box_one(); ?>
                <?php $this->render_element_image_box_two(); ?>
                <?php $this->render_element_image_box_three(); ?>
                <?php $this->render_element_image_box_fourth(); ?>
                <?php $this->render_element_banner_image(); ?>
                
            </div>
		<?php

        $this->render_element_footer();

    }

    protected function content_template() {

	}

}