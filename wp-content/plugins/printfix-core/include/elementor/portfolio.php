<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use RRCore\Elementor\Controls\Group_Control_RRBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Portfolio extends Widget_Base {

    use \RRCore\Widgets\RRCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rr-portfolio';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Portfolio Main', 'rr-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'rr-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'rr-core' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'rr-core' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   

	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'rr_layout',
            [
                'label' => esc_html__('Design Layout', 'rr-core'),
            ]
        );
        $this->add_control(
            'rr_design_style',
            [
                'label' => esc_html__('Select Layout', 'rr-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'rr-core'),
                    'layout-2' => esc_html__('Layout 2', 'rr-core'),
                    'layout-3' => esc_html__('Layout 3', 'rr-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->rr_section_title_render_controls('portfolio', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-2', 'layout-3']);

      

        // Portfolio group
        $this->start_controls_section(
            'rr_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        ); 

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'rr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'rr-core' ),
                    'style_6' => __( 'Style 2', 'rr-core' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'rr_portfolio_image',
            [
                'label' => esc_html__('Upload Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'rr_portfolio_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_portfolio_description', [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Portfolio description', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_portfolio_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rr-core' ),
                'label_off' => esc_html__( 'No', 'rr-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'rr_portfolio_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'rr_portfolio_link',
            [
                'label' => esc_html__( 'Service Link link', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'htRRs://your-link.com', 'rr-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'rr_portfolio_link_type' => '1',
                    'rr_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'rr_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_portfolio_link_type' => '2',
                    'rr_portfolio_link_switcher' => 'yes',
                ]
            ]
        );

  // creative animation
  $repeater->add_control(
    'rr_creative_anima_switcher',
    [
        'label' => esc_html__( 'Active Animation', 'rr-core' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
        'label_off' => esc_html__( 'No', 'rr-core   ' ),
        'return_value' => 'yes',
        'default' => '0',
        'separator' => 'before',
    ]
);

$repeater->add_control(
    'rr_anima_type',
    [
        'label' => __( 'Animation Type', 'rr-core' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'fadeInUp' => __( 'fadeInUp', 'rr-core' ),
            'fadeInDown' => __( 'fadeInDown', 'rr-core' ),
            'fadeInLeft' => __( 'fadeInLeft', 'rr-core' ),
            'fadeInRight' => __( 'fadeInRight', 'rr-core' ),
        ],
        'default' => 'fadeInUp',
        'frontend_available' => true,
        'style_transfer' => true,
        'condition' => [
            'rr_creative_anima_switcher' => 'yes',
        ],
    ]
);

$repeater->add_control(
    'rr_anima_dura', [
        'label' => esc_html__('Animation Duration', 'rr-core'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('0.3s', 'rr-core'),
        'condition' => [
            'rr_creative_anima_switcher' => 'yes',
        ],
    ]
);

$repeater->add_control(
    'rr_anima_delay', [
        'label' => esc_html__('Animation Delay', 'rr-core'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__('0.6s', 'rr-core'),
        'condition' => [
            'rr_creative_anima_switcher' => 'yes',
        ],
    ]
);

        $this->add_control(
            'rr_portfolio_list',
            [
                'label' => esc_html__('Portfolio - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_portfolio_title' => esc_html__('Business Stratagy', 'rr-core'),
                    ],
                    [
                        'rr_portfolio_title' => esc_html__('Website Development', 'rr-core')
                    ],
                    [
                        'rr_portfolio_title' => esc_html__('Marketing & Reporting', 'rr-core')
                    ],
                    [
                        'rr_portfolio_title' => esc_html__('Mobile Development', 'rr-core')
                    ],
                ],
                'title_field' => '{{{ rr_portfolio_title }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'rr-post-thumb',
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'rr_portfolio_content_list',
            [
                'label' => esc_html__('Portfolio List', 'rr-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-1']
                ]
            ]
        );
        $this->add_control(
            'rr_portfolio_main_title', [
                'label' => esc_html__('Heading Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('This is Title', 'rr-core'),
            ]
        );
        $this->add_control(
            'rr_portfolio_url', [
                'label' => esc_html__('Heading url', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'rr-core'),
            ]
        );
        $this->add_control(
            'rr_portfoilo_desc', [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('This is desc', 'rr-core'),
            ]
        );
        $this->add_control(
            'rr_portfolio_image',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->rr_columns('col', ['layout-2', 'layout-3']);

	}

        // style_tab_content
    protected function style_tab_content(){

        $this->rr_section_style_controls('section_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_subtitle', 'Section - Subtitle', '.rr-el-subtitle');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('portfolio_box_title', 'Portfolio - Title', '.rr-el-box-title');
        $this->rr_basic_style_controls('portfolio_box_desc', 'Portfolio - Description', '.rr-el-box-desc');
  
  }

	/**
	 * Render the widget ouRRut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected 
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        $this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeLeft rr-el-title');
		?>
<?php if ( $settings['rr_design_style']  == 'layout-2' ):   ?>
<!-- project-slider area start -->
<section class="rr-project-slider-area pt-120 rr-project-slider-bg p-relative fix rr-el-section">
    <div class="container-fluid">
        <div class="row gx-30">
            <div class="col-lg-12">
                <div class="rr-section-title-wrapper mb-40 text-center p-relative z-index-1">
                    <?php if ( !empty($settings['rr_portfolio_sub_title']) ) : ?>
                    <span class="rr-section-subtitle wow rrfadeRight rr-el-subtitle" data-wow-duration=".9s"
                        data-wow-delay=".5s"><?php echo rr_kses( $settings['rr_portfolio_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['rr_portfolio_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_portfolio_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_portfolio_title' ] )
                                );
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="swiper-container rr-project-active">
            <div class="swiper-wrapper">
                <?php foreach ($settings['rr_portfolio_list'] as $item) :
                    if ( !empty($item['rr_portfolio_image']['url']) ) {
                        $rr_portfolio_image_url = !empty($item['rr_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['rr_portfolio_image']['id'], $settings['thumbnail_size']) : $item['rr_portfolio_image']['url'];
                        $rr_portfolio_image_alt = get_post_meta($item["rr_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // Link
                    if ('2' == $item['rr_portfolio_link_type']) {
                        $link = get_permalink($item['rr_portfolio_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['rr_portfolio_link']['url']) ? $item['rr_portfolio_link']['url'] : '';
                        $target = !empty($item['rr_portfolio_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['rr_portfolio_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                <div class="swiper-slide">
                    <div class="rr-project-slider-item wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                        <div class="rr-project-slider-thumb">
                            <?php if(!empty($rr_portfolio_image_url)) : ?>
                            <img src="<?php echo esc_url($rr_portfolio_image_url); ?>"
                                alt="<?php echo esc_attr($rr_portfolio_image_alt); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="rr-project-slider-content text-center">
                            <h3 class="rr-project-slider-title rr-el-box-title">
                                <?php if ($item['rr_portfolio_link_switcher'] == 'yes') : ?>
                                <a
                                    href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_portfolio_title' ]); ?></a>
                                <?php else : ?>
                                <?php echo rr_kses($item['rr_portfolio_title' ]); ?>
                                <?php endif; ?>
                            </h3>
                            <?php if (!empty($item['rr_portfolio_description' ])): ?>
                            <span
                                class="rr-el-box-desc"><?php echo rr_kses($item['rr_portfolio_description' ]); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- project-slider area end -->
<?php elseif ( $settings['rr_design_style']  == 'layout-3' ): 
      $this->add_render_attribute('title_args', 'class', 'rr-section-title rr-el-title');
    ?>
<section class="rr-project-slider-area pt-120 pb-90 fix p-relative fix rr-el-section">
    <div class="container">
        <div class="row gx-30">
            <div class="col-lg-12">
                <div class="rr-section-title-wrapper mb-40 text-center p-relative">
                    <?php if ( !empty($settings['rr_portfolio_sub_title']) ) : ?>
                    <span
                        class="rr-section-subtitle rr-el-subtitle"><?php echo rr_kses( $settings['rr_portfolio_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['rr_portfolio_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_portfolio_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_portfolio_title' ] )
                                );
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="row gx-30">
            <?php foreach ($settings['rr_portfolio_list'] as $item) :
                if ( !empty($item['rr_portfolio_image']['url']) ) {
                    $rr_portfolio_image_url = !empty($item['rr_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['rr_portfolio_image']['id'], $settings['thumbnail_size']) : $item['rr_portfolio_image']['url'];
                    $rr_portfolio_image_alt = get_post_meta($item["rr_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                }

                // Link
                if ('2' == $item['rr_portfolio_link_type']) {
                    $link = get_permalink($item['rr_portfolio_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['rr_portfolio_link']['url']) ? $item['rr_portfolio_link']['url'] : '';
                    $target = !empty($item['rr_portfolio_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['rr_portfolio_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['rr_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['rr_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['rr_col_for_tablet']); ?> col-<?php echo esc_attr($settings['rr_col_for_mobile']); ?> wow <?php echo esc_attr($item['rr_anima_type']); ?>"
                data-wow-duration="<?php echo esc_attr($item['rr_anima_dura']); ?>"
                data-wow-delay="<?php echo esc_attr($item['rr_anima_delay']); ?>">
                <div class="rr-project-slider-item mb-30">
                    <div class="rr-project-slider-thumb">
                        <?php if(!empty($rr_portfolio_image_url)) : ?>
                        <img src="<?php echo esc_url($rr_portfolio_image_url); ?>"
                            alt="<?php echo esc_attr($rr_portfolio_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="rr-project-slider-content text-center">
                        <h3 class="rr-project-slider-title rr-el-box-title">
                            <?php if ($item['rr_portfolio_link_switcher'] == 'yes') : ?>
                            <a
                                href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_portfolio_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo rr_kses($item['rr_portfolio_title' ]); ?>
                            <?php endif; ?>
                        </h3>
                        <?php if (!empty($item['rr_portfolio_description' ])): ?>
                        <span class="rr-el-box-desc"><?php echo rr_kses($item['rr_portfolio_description' ]); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php else:

$this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeLeft rr-el-title');

if ( !empty($settings['rr_portfolio_image']['url']) ) {
    $rr_portfolio_image = !empty($settings['rr_portfolio_image']['id']) ? wp_get_attachment_image_url( $settings['rr_portfolio_image']['id'], $settings['rr_image_size_size']) : $settings['rr_portfolio_image']['url'];
    $rr_bg_image_alt = get_post_meta($settings["rr_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
}
	?>
<div class="rr-work-item">
    <div class="rr-work-thumb">
        <?php if(!empty($rr_portfolio_image)) : ?>
        <img src="<?php echo esc_url($rr_portfolio_image); ?>" alt="<?php echo esc_attr($rr_portfolio_image_alt); ?>">
        <?php endif; ?>
        <div class="rr-work-content text-center">
            <h3 class="rr-work-title rr-el-box-title">
                <a
                    href="<?php echo esc_url($settings['rr_portfolio_url' ]); ?>"><?php echo rr_kses($settings['rr_portfolio_main_title' ]); ?></a>
            </h3>
            <?php if (!empty($settings['rr_portfoilo_desc' ])): ?>
            <span class="rr-el-box-desc"><?php echo rr_kses($settings['rr_portfoilo_desc' ]); ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- out work area end -->
<?php endif; ?>

<?php
	}
}

$widgets_manager->register( new rr_Portfolio() );