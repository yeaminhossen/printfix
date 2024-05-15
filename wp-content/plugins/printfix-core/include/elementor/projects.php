<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Projects extends Widget_Base {

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
        return 'project';
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
        return __( 'Projects', 'rr-core' );
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
1
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // projects group
        $this->start_controls_section(
            'rr_projects',
            [
                'label' => esc_html__('Projects List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                    'style_2' => __( 'Style 2', 'rr-core' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'rr_projects_image',
            [
                'label' => esc_html__('Upload Project Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );
        
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_pro_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        
        $repeater->add_control(
            'rr_logo_image',
            [
                'label' => esc_html__('Upload Logo Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );

        $repeater->add_control(
            'rr_projects_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('projects Title', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_projects_description',
            [
                'label' => esc_html__('Decription', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Excepteur sint occaecat cupidatat officia non proident',
                'label_block' => true,
            ]
        ); 

        // author
        $repeater->add_control(
			'author_heading',
			[
				'label' => esc_html__( 'Author Info', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $repeater->add_control(
            'rr_author_title', [
                'label' => esc_html__('Author Title', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Author Title', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_author_name', [
                'label' => esc_html__('Author Name', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Jhon Whick', 'rr-core'),
                'label_block' => true,
            ]
        );

        // project budget
        $repeater->add_control(
			'project_info_heading',
			[
				'label' => esc_html__( 'Project Info', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $repeater->add_control(
            'rr_info_title', [
                'label' => esc_html__('Project Info Title', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Budget', 'rr-core'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'rr_info_sub', [
                'label' => esc_html__('Project Info Subtitle', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$200k', 'rr-core'),
                'label_block' => true,
            ]
        );

        // link
        $repeater->add_control(
            'rr_projects_link_switcher',
            [
                'label' => esc_html__( 'Add projects link', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rr-core' ),
                'label_off' => esc_html__( 'No', 'rr-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'rr_projects_btn_text',
            [
                'label' => esc_html__('Button Text', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'rr-core'),
                'title' => esc_html__('Enter button text', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_projects_link_switcher' => 'yes',
                    'repeater_condition' => 'style_3'
                ],
            ]
        );
        $repeater->add_control(
            'rr_projects_link_type',
            [
                'label' => esc_html__( 'projects Link Type', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_projects_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'rr_projects_link',
            [
                'label' => esc_html__( 'projects Link link', 'rr-core' ),
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
                    'rr_projects_link_type' => '1',
                    'rr_projects_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'rr_projects_page_link',
            [
                'label' => esc_html__( 'Select projects Link Page', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_projects_link_type' => '2',
                    'rr_projects_link_switcher' => 'yes',
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
            'rr_projects_list',
            [
                'label' => esc_html__('Projects - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_projects_title' => esc_html__('Business Stratagy', 'rr-core'),
                    ],
                    [
                        'rr_projects_title' => esc_html__('Website Development', 'rr-core')
                    ],
                    [
                        'rr_projects_title' => esc_html__('Marketing & Reporting', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_projects_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('services_section', 'Section Style', '.ele-section');
        $this->rr_basic_style_controls('newsletter_sub_title', 'Subtitle Style', '.ele-subtitle');
        $this->rr_basic_style_controls('newsletter_title', 'Heading Style', '.ele-heading');
        $this->rr_basic_style_controls('newsletter_des', 'Content Style', '.ele-description');
        $this->rr_basic_style_controls('repeater_title', 'Project Title Style', '.ele-repeater-title');
        $this->rr_basic_style_controls('repeater_brand', 'Projects Brand Style', '.ele-repeater-brand');
        $this->rr_section_style_controls('repeater_bg', 'Projects Brand Background Style', '.ele-brand-bg');
        
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

        ?>

<?php if ( $settings['rr_design_style']  == 'layout-2' ): 
    $this->add_render_attribute('title_args', 'class', 'rr-section__title');
?>

<?php else: 

    $this->add_render_attribute('title_args', 'class', 'rr-section__title');
?>




<div class="rr-project__area pt-10 pb-10 fix rr-el-section">
    <div class="container-fluid gx-0">
        <div class="row gx-0">
            <div class="col-xl-12">
                <div class="rr-project__slider-section">
                    <div class=" swiper-container rr-project__slider-active">
                        <div class="swiper-wrapper">

                            <?php foreach ($settings['rr_projects_list'] as $key => $item) : 
                                // Link
                                if ('2' == $item['rr_projects_link_type']) {
                                    $link = get_permalink($item['rr_projects_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['rr_projects_link']['url']) ? $item['rr_projects_link']['url'] : '';
                                    $target = !empty($item['rr_projects_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['rr_projects_link']['nofollow']) ? 'nofollow' : '';
                                }

                                // project image
                                if ( !empty($item['rr_projects_image']['url']) ) {
                                    $rr_projects_image = !empty($item['rr_projects_image']['id']) ? wp_get_attachment_image_url( $item['rr_projects_image']['id'], $item['rr_pro_image_size_size']) : $item['rr_projects_image']['url'];
                                    $rr_projects_image_alt = get_post_meta($item["rr_projects_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                // logo image
                                if ( !empty($item['rr_logo_image']['url']) ) {
                                    $rr_logo_image = !empty($item['rr_logo_image']['id']) ? wp_get_attachment_image_url( $item['rr_logo_image']['id']) : $item['rr_logo_image']['url'];
                                    $rr_logo_image_alt = get_post_meta($item["rr_logo_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <?php if(!empty($item['rr_creative_anima_switcher'])) : ?>
                            <div class="swiper-slide wow <?php echo esc_attr($item['rr_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($item['rr_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($item['rr_anima_delay']); ?>">
                            <?php else : ?>
                            <div class="swiper-slide">
                            <?php endif; ?>
                                <div class="rr-project__slider-wrapper">
                                    <div class="rr-project__item d-flex align-items-center">
                                        <?php if(!empty($rr_projects_image)) : ?>
                                        <div class="rr-project__thumb">
                                            <img src="<?php echo esc_url($rr_projects_image); ?>" alt="<?php echo esc_attr($rr_projects_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                        <div class="rr-project__content">
                                            <?php if(!empty($rr_logo_image)) : ?>
                                            <div class="rr-project__brand-icon">
                                                <img src="<?php echo esc_url($rr_logo_image); ?>" alt="<?php echo esc_attr($rr_logo_image_alt); ?>">
                                            </div>
                                            <?php endif; ?>
                                            <div class="rr-project__title-box">
                                                <?php if(!empty($link)) : ?>
                                                <h4 class="rr-project__title-sm"><a href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_projects_title']); ?></a></h4>
                                                <?php else : ?>
                                                <h4 class="rr-project__title-sm"><?php echo rr_kses($item['rr_projects_title']); ?></h4>
                                                <?php endif; ?>
                                                <?php if(!empty($item['rr_projects_description'])) : ?>
                                                <p><?php echo rr_kses($item['rr_projects_description']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="rr-project__meta d-flex align-items-center">
                                                <div class="rr-project__author-info">
                                                    <?php if(!empty($item['rr_author_title'])) : ?>
                                                    <span><?php echo rr_kses($item['rr_author_title']); ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['rr_author_name'])) : ?>
                                                    <h4><?php echo rr_kses($item['rr_author_name']); ?></h4>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="rr-project__budget">
                                                    <?php if(!empty($item['rr_info_title'])) : ?>
                                                    <span><?php echo rr_kses($item['rr_info_title']); ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['rr_info_sub'])) : ?>
                                                    <h4><?php echo rr_kses($item['rr_info_sub']); ?></h4>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(!empty($link)) : ?>
                                                <div class="rr-project__link">
                                                    <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>">
                                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                            xmlns="htRR://www.w3.org/2000/svg">
                                                            <path d="M1.00098 7H13.001" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M7.00098 1L13.001 7L7.00098 13" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="rr-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endif; 
    }
}

$widgets_manager->register( new rr_Projects() );