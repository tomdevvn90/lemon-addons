<?php
namespace BearsthemesAddons\Widgets\Products_Sidebar;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Products_Sidebar extends Widget_Base {

	public function get_name() {
		return 'be-products-sidebar';
	}

	public function get_title() {
		return __( 'Be Product Sidebar', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-sidebar';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'bearsthemes-addons' ];
	}

	protected function register_skins() {
	}

    protected function get_supported_ids() {
        $supported_ids = [];

        $wp_query = new \WP_Query( array(
			'post_type' => 'product',
			'post_status' => 'publish'
		) );

		if ( $wp_query->have_posts() ) {
	        while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $supported_ids[get_the_ID()] = get_the_title();
    	    }
		}

		return $supported_ids;
    }

    protected function get_supported_taxonomies() {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => 'product_cat',
	        'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

    protected function register_layout_section_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => 'Layout'
            ]
        );

        $this->add_control(
            'product_categories',
            [
                'label' => __( 'Product Categories', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bearsthemes-addons' ),
				'label_off' => esc_html__( 'Hide', 'bearsthemes-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
            'product_categories_heading',
            [
                'label' => __( 'Heading', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
				'default' => 'Product Categories',
                'label_block' => 'true',
                'separator' => 'after',
                'condition' => [
                    'product_categories' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'feature_product',
            [
                'label' => __( 'Featured Products', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bearsthemes-addons' ),
				'label_off' => esc_html__( 'Hide', 'bearsthemes-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
            'feature_product_heading',
            [
                'label' => __( 'Heading', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
				'default' => 'Featured Products',
                'label_block' => 'true',
                'separator' => 'after',
                'condition' => [
                    'feature_product' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'top_rate_product',
            [
                'label' => __( 'Top Rate Products', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bearsthemes-addons' ),
				'label_off' => esc_html__( 'Hide', 'bearsthemes-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
            'top_rate_product_heading',
            [
                'label' => __( 'Heading', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
				'default' => 'Top Rated Products',
                'label_block' => 'true',
                'separator' => 'after',
                'condition' => [
                    'top_rate_product' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'product_tags',
            [
                'label' => __( 'Product Tags', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bearsthemes-addons' ),
				'label_off' => esc_html__( 'Hide', 'bearsthemes-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
            'product_tags_heading',
            [
                'label' => __( 'Heading', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
				'default' => 'Product Tags',
                'label_block' => 'true',
                'separator' => 'after',
                'condition' => [
                    'product_tags' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'search_product',
            [
                'label' => __( 'Search Product', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bearsthemes-addons' ),
				'label_off' => esc_html__( 'Hide', 'bearsthemes-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_query_section_controls() {
        $this->start_controls_section(
            'query_section',
            [
                'label' => __('Query', 'bearsthemes-addons'),
            ]
        );

        $this->start_controls_tabs( 'tabs_query' );

        $this->start_controls_tab(
            'tab_query_include',
            [
                'label' => __('Include', 'bearsthemes-addons'),
            ]
        );

        $this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

        $this->add_control(
			'category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_query_exclude',
            [
                'label' => __('Exclude', 'bearsthemes-addons'),
            ]
        );

        $this->add_control(
            'ids_exclude',
            [
                'label' => __( 'Ids', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_supported_ids(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->add_control(
            'category_exclude',
            [
                'label' => __( 'Category', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_supported_taxonomies(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->end_controls_tab();

        $this-> end_controls_tabs();

        $this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', 'bearsthemes-addons' ),
					'title' => __( 'Title', 'bearsthemes-addons' ),
					'price' => __( 'Price', 'bearsthemes-addons' ),
					'selling' => __( 'Selling', 'bearsthemes-addons' ),
					'rated' => __( 'Rated', 'bearsthemes-addons' ),
					'rand' => __( 'Random', 'bearsthemes-addons' ),
					'menu_order' => __( 'Menu Order', 'bearsthemes-addons' ),
                    'separator' => 'before',
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'bearsthemes-addons' ),
					'desc' => __( 'DESC', 'bearsthemes-addons' ),
				],
			]
		);

        $this->add_control(
			'ignore_sticky_posts',
			[
				'label' => __( 'Ignore Sticky Posts', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Sticky-posts ordering is visible on frontend only', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'show',
			[
				'label' => __( 'Show', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all_products',
				'options' => [
					'all_products' => __( 'All Products', 'bearsthemes-addons' ),
					'featured' => __( 'Featured Products', 'bearsthemes-addons' ),
					'onsale' => __( 'On-sale Products', 'bearsthemes-addons' ),
				],
			]
		);

		$this->add_control(
			'hide_free',
			[
				'label' => __( 'Hide Free', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Hide free product.', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'show_hidden',
			[
				'label' => __( 'Show Hidden', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Show Hidden product.', 'bearsthemes-addons' ),
			]
		);

        $this->end_controls_section();
    }

	protected function register_style_section_controls() {
		$this->start_controls_section(
			'heading_style',
			[
				'label' => 'Heading',
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-products-sidebar h2._heading',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => 'Color',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-products-sidebar h2._heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_cate_style',
			[
				'label' => 'Product Categories',
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cate_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-products-sidebar .product-categories .wrapper ._list .__item a',
			]
		);

		$this->add_control(
			'cate_color',
			[
				'label' => 'Color',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-products-sidebar .product-categories .wrapper ._list .__item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

    protected function register_controls() {
        $this->register_layout_section_controls();
        $this->register_query_section_controls();
        $this->register_style_section_controls();
    }

    public function query_posts() {
		$settings = $this->get_settings_for_display();

		if( is_front_page() ) {
	    $paged = (get_query_var('page')) ? absint( get_query_var('page') ) : 1;
		} else {
	    $paged = (get_query_var('paged')) ? absint( get_query_var('paged') ) : 1;
		}

		$args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			// 'posts_per_page' => $this->get_instance_value_skin('posts_count'),
			'paged' => $paged,
			'order' => $settings['order'],
			'ignore_sticky_posts' => ('yes' !== $settings['ignore_sticky_posts']) ? true : false,
		];

		if( ! empty( $settings['ids'] ) ) {
			$args['post__in'] = $settings['ids'];
		}

		if( ! empty( $settings['ids_exclude'] ) ) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if( ! empty( $settings['category'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> $settings['category'],
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
			);
		}

		if( ! empty( $settings['category_exclude'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> $settings['category_exclude'],
					'field' 		=> 'term_id',
					'operator' 		=> 'NOT IN'
				)
			);
		}

		if( 0 !== absint( $settings['offset'] ) ) {
			$args['offset'] = $settings['offset'];
		}

		$args['meta_query'] = array();

		if ( 'yes' === $settings['show_hidden'] ) {
			$args['meta_query'][] = WC()->query->visibility_meta_query();
			$args['post_parent']  = 0;
		}

		if ( 'yes' === $settings['hide_free'] ) {
			$args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}

		$args['meta_query'][] = WC()->query->stock_status_meta_query();
    	$args['meta_query']   = array_filter( $args['meta_query'] );

		// switch ( $settings['show'] ) {
		// 	case 'featured' :
		// 		$args['meta_query'][] = array(
		// 			'key'   => '_featured',
		// 			'value' => 'yes'
		// 		);
		// 		break;
		//
		// 	case 'onsale' :
		// 		$product_ids_on_sale = wc_get_product_ids_on_sale();
		// 		$product_ids_on_sale[] = 0;
		// 		$args['post__in'] = $product_ids_on_sale;
		// 		break;
		// }

    	switch ( $settings['orderby'] ) {
			case 'price' :
				$args['meta_key'] = '_price';
				$args['orderby']  = 'meta_value_num';
				break;

			case 'selling' :
				$args['meta_key'] = 'total_sales';
				$args['orderby']  = 'meta_value_num';
				break;

			case 'rated' :
				$args['meta_key'] = '_wc_average_rating';
				$args['orderby']  = 'meta_value_num';
				break;

			default :
				$args['orderby']  = $settings['orderby'];
    	}


		return $query = new \WP_Query( $args );
	}

    protected function render_product_categories() {
        $settings = $this->get_settings_for_display();

        if( empty( $settings['category'] ) && empty( $settings['category_exclude'] )  ) {
            $categories = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'orderby' => 'name',
                'hierarchical' => true,
            ) );
        }

        if( ! empty( $settings['category'] ) ) {
            $categories = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'orderby' => 'name',
                'hierarchical' => true,
                'include' => $settings['category'],
            ) );
        }

        if( ! empty( $settings['category_exclude'] ) ) {
            $categories = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'orderby' => 'name',
                'hierarchical' => true,
                'exclude' => $settings['category_exclude'],
            ) );
        }

        ?>
        <div class="product-categories">
            <div class="wrapper">
                <?php if($settings['product_categories_heading']) : ?>
                    <h2 class="_heading"><?php echo $settings['product_categories_heading']; ?></h2>
                <?php endif; ?>
                <ul class="_list">
                    <?php foreach($categories as $key => $category) : ?>
                        <?php $childs = get_terms("product_cat", array("orderby" => "slug", "parent" => $category->term_id)); ?>
                        <li class="__item <?php if($childs) { echo 'has_child'; }; ?>">
                            <?php
                            if($childs) {
                            ?>
                            <div class="parent">
                                <a href="<?php echo get_term_link($category->term_id); ?>">
                                    <?php echo $category->name; ?><sup>(<?php echo $category->count; ?>)</sup>
                                </a>
                                <div class="toggle">
                                    <span class="plus-1"></span>
                                    <span class="plus-2"></span>
                                </div>
                            </div>
                            <ul class="__child">
                                <?php foreach($childs as $key => $child) : ?>
                                    <li class="__item"><a href="<?php echo get_term_link($child->term_id); ?>"><?php echo $child->name; ?><sup>(<?php echo $child->count; ?>)</sup></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php
                            } elseif (!$childs) {
                                ?>
                                <a href="<?php echo get_term_link($category->term_id); ?>">
                                    <?php echo $category->name; ?><sup>(<?php echo $category->count; ?>)</sup>
                                </a>
                                <?php
                            }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php
    }

	public function price_html() {
        global $product;

        return sprintf(
            '<span class="elementor-product__price">%s</span>',
            $product->get_price_html()
        );
    }

	public function on_sales() {
        global $product;

        $sale_html = '';

        if ( $product->is_on_sale() ) {
            $sale_html = '<span class="elementor-product__onsale">' . __( 'Sale!', 'bearsthemes-addons' ) . '</span>';
        }

        return $sale_html;
    }

	protected function render_featured_products() {
		$settings = $this->get_settings_for_display();
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => '5',
		    'post__in'            => wc_get_featured_product_ids(),
		);

		$query = new \WP_Query($args);

		?>
		<div class="featured_products">
			<div class="wrapper">
				<?php if($settings['feature_product_heading']) : ?>
					<h2 class="_heading"><?php echo $settings['feature_product_heading']; ?></h2>
                <?php endif; ?>
				<?php
				if($query->have_posts()) :
					while($query->have_posts()) :
						$query->the_post();
				?>
				<article class="post-<?php the_ID(); ?>" <?php post_class( 'elementor-product' ); ?>>
					<div class="elementor-product__thumbnail">
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
						<?php $this->on_sales(); ?>
                    </div>
					<div class="elementor-product__content">
	                    <?php
                            the_title( '<h3 class="elementor-product__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );

                            echo $this->price_html();
	                    ?>
	                </div>
				</article>
				<?php
					endwhile;
				endif;
				?>
			</div>
		</div>
		<?php
	}

	protected function render_rated_products() {
		$settings = $this->get_settings_for_display();
		$query_args = array(
			'posts_per_page' => '5',
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'meta_key'       => '_wc_average_rating',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
			'meta_query'     => WC()->query->get_meta_query(),
			'tax_query'      => WC()->query->get_tax_query(),
		); // WPCS: slow query ok.
		$top_rated = new \WP_Query( $query_args );
		?>
		<div class="rated-products">
			<div class="wrapper">
				<?php if($settings['top_rate_product_heading']) : ?>
					<h2 class="_heading"><?php echo $settings['top_rate_product_heading']; ?></h2>
                <?php endif; ?>
				<?php
				if($top_rated->have_posts()) :
					while($top_rated->have_posts()) :
						$top_rated->the_post();
				?>
				<article class="post-<?php the_ID(); ?>" <?php post_class( 'elementor-product' ); ?>>
					<div class="elementor-product__thumbnail">
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
						<?php
						$product = wc_get_product( get_the_ID() );
						echo $rating  = $product->get_average_rating();
						?>
						<?php $this->on_sales(); ?>
                    </div>
					<div class="elementor-product__content">
	                    <?php
                            the_title( '<h3 class="elementor-product__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );

                            echo $this->price_html();
	                    ?>
	                </div>
				</article>
				<?php
					endwhile;
				endif;
				?>
			</div>
		</div>
		<?php
	}

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="products-sidebar-widget elementor-products-sidebar">
            <div class="widget-wrap">
            <?php
            if($settings['product_categories'] === 'yes') {
                $this->render_product_categories();
            }

            if($settings['feature_product'] === 'yes') {
                $this->render_featured_products();
            }

            if($settings['top_rate_product'] === 'yes') {
                $this->render_rated_products();
            }

            ?>
            </div>
        </div>
        <?php
    }

}
