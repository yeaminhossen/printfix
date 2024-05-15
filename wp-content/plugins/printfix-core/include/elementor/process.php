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
class rr_Process extends Widget_Base {

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
		return 'rr-process';
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
		return __( 'Process', 'rr-core' );
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
            // title/content
    $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2'] );
        // Process group
        $this->start_controls_section(
            'rr_process',
            [
                'label' => esc_html__('Process List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-1']
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
                    'style_2' => __( 'Style 2', 'rr-core' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ] 
        );
        
        

        $repeater->add_control(
            'rr_process_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ],
            ]
        );

        $repeater->add_control(
            'rr_process_image',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_process_icon_type' => 'image'
                ]

            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'rr_process_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_process_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'rr_process_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'rr_process_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'rr_process_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                'condition' => [
                    'rr_process_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'rr_process_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_process_des', [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('onec suscipit ante ipsum. Donec quam at tortor hendrerit', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_1',
                ]
            ]
        );

        $this->add_control(
            'rr_process_list',
            [
                'label' => esc_html__('Processs - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_process_title' => esc_html__('Discover', 'rr-core'),
                    ],
                    [
                        'rr_process_title' => esc_html__('Define', 'rr-core')
                    ],
                    [
                        'rr_process_title' => esc_html__('Develop', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_process_title }}}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'rr_process_list_2',
            [
                'label' => esc_html__('Process List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-2']
                ]
            ]
        );


        $this->add_control(
            'repeater_condition_list',
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
        
        

        $this->add_control(
            'rr_process_icon_type_list',
            [
                'label' => esc_html__('Select Icon Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ],
            ]
        );

        $this->add_control(
            'rr_process_image_list',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_process_icon_type_list' => 'image'
                ]

            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'rr_process_icon_list',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_process_icon_type_list' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'rr_process_selected_icon_list',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'rr_process_icon_type_list' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'rr_process_icon_svg_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                'condition' => [
                    'rr_process_icon_type_list' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'rr_process_title_list', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_process_des_list', [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('onec suscipit ante ipsum. Donec quam at tortor hendrerit', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition_list' => 'style_1',
                ]
            ]
        );
        $this->add_control(
            'rr_process_main_image',
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
        $this->start_controls_section(
            'rr_process_list_main',
            [
                'label' => esc_html__('Process List 2', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-2']
                ]
            ]
        );


        $this->add_control(
            'repeater_condition_list_2',
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
        
        

        $this->add_control(
            'rr_process_icon_type_list_2',
            [
                'label' => esc_html__('Select Icon Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ],
            ]
        );

        $this->add_control(
            'rr_process_image_list_2',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_process_icon_type_list_2' => 'image'
                ]

            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'rr_process_icon_list_2',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_process_icon_type_list_2' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'rr_process_selected_icon_list_2',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'rr_process_icon_type_list_2' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'rr_process_icon_svg_list_2',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                'condition' => [
                    'rr_process_icon_type_list_2' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'rr_process_title_list_2', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_process_des_list_2', [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('onec suscipit ante ipsum. Donec quam at tortor hendrerit', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition_list' => 'style_1',
                ]
            ]
        );
        $this->add_control(
            'rr_process_main_image_2',
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
                'name' => 'rr_image_size_2',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'rr_process_list_main_3',
            [
                'label' => esc_html__('Process List 3', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-2']
                ]
            ]
        );


        $this->add_control(
            'repeater_condition_list_3',
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
        
        

        $this->add_control(
            'rr_process_icon_type_list_3',
            [
                'label' => esc_html__('Select Icon Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ],
            ]
        );

        $this->add_control(
            'rr_process_image_list_3',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_process_icon_type_list_3' => 'image'
                ]

            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'rr_process_icon_list_3',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_process_icon_type_list_3' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'rr_process_selected_icon_list_3',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'rr_process_icon_type_list_3' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'rr_process_icon_svg_list_3',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                'condition' => [
                    'rr_process_icon_type_list_3' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'rr_process_title_list_3', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_process_des_list_3', [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('onec suscipit ante ipsum. Donec quam at tortor hendrerit', 'rr-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_process_main_image_3',
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
                'name' => 'rr_image_size_3',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();
    // button
    $this->rr_button_render('process', 'Button', ['layout-1']);
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('process_section', 'Section - Style', '.rr-el-section'); 
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

<?php if ( $settings['rr_design_style']  == 'layout-2' ) :

    if ( !empty($settings['rr_process_main_image']['url']) ) {
        $rr_process_main_image = !empty($settings['rr_process_main_image']['id']) ? wp_get_attachment_image_url( $settings['rr_process_main_image']['id'], $settings['rr_image_size_size']) : $settings['rr_process_main_image']['url'];
        $rr_bg_image_alt = get_post_meta($settings["rr_process_main_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_process_main_image_2']['url']) ) {
        $rr_process_main_image_2 = !empty($settings['rr_process_main_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_process_main_image_2']['id'], $settings['rr_image_size_2_size']) : $settings['rr_process_main_image_2']['url'];
        $rr_bg_image_alt = get_post_meta($settings["rr_process_main_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_process_main_image_3']['url']) ) {
        $rr_process_main_image_3 = !empty($settings['rr_process_main_image_3']['id']) ? wp_get_attachment_image_url( $settings['rr_process_main_image_3']['id'], $settings['rr_image_size_3_size']) : $settings['rr_process_main_image_3']['url'];
        $rr_bg_image_alt = get_post_meta($settings["rr_process_main_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
        // Link
        if ('2' == $settings['rr_process_btn_link_type']) {
            $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_process_btn_page_link']));
            $this->add_render_attribute('rr-button-arg', 'target', '_self');
            $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn');
        } else {
            if ( ! empty( $settings['rr_process_btn_link']['url'] ) ) {
                $this->add_link_attributes( 'rr-button-arg', $settings['rr_process_btn_link'] );
                $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn');
            }
        }
        $this->add_render_attribute('title_args', 'class', 'rr-section-title rr-section-title-space'); 
    ?>
<!-- process area start -->
<section class="rr-process-area grey-bg pt-100 pb-100 p-relative fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-8 col-lg-10 ">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="rr-pricing -2-title-box text-center mb-45">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <span class="rr-section-subtitle p-relativ "><img
                            src="<?php echo get_template_directory_uri(  ); ?>/assets/img/testimonial/section-icon.png"
                            alt="img"> <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?> <img
                            src="<?php echo get_template_directory_uri(  ); ?>/assets/img/testimonial/section-icon.png"
                            alt="img"></span>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['rr_section_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['rr_section_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            rr_kses( $settings['rr_section_title' ] )
                            );
                        endif;
                    ?>
                    <?php if ( !empty($settings['rr_section_description']) ) : ?>
                    <p><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row mb-10">
            <div class="rr-process-shap-img">
                <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/process/shap-broder.png" alt="img">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="rr-work-2__item text-center pb-25">
                    <div class="rr-work-2__icon">
                        <span>
                            <?php if($settings['rr_process_icon_type_list'] == 'icon') : ?>
                            <?php if (!empty($settings['rr_process_icon_list']) || !empty($settings['rr_process_selected_icon_list']['value'])) : ?>
                            <?php rr_render_icon($settings, 'rr_process_icon_list', 'rr_process_selected_icon_list'); ?>
                            <?php endif; ?>
                            <?php elseif( $settings['rr_process_icon_type_list'] == 'image' ) : ?>
                            <?php if (!empty($settings['rr_process_image_list']['url'])): ?>
                            <img src="<?php echo $settings['rr_process_image_list']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['rr_process_image_list']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($settings['rr_process_icon_svg_list'])): ?>
                            <?php echo $settings['rr_process_icon_svg_list']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="rr-work-2__content  pt-25  z-index-3">
                        <?php if (!empty($settings['rr_process_title_list'])): ?>
                        <h3 class="rr-work-2-title-3"><?php echo rr_kses($settings['rr_process_title_list' ]); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($settings['rr_process_des_list'])): ?>
                        <p><?php echo rr_kses($settings['rr_process_des_list' ]); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="rr-work-2__item text-center pb-25">
                    <?php if(!empty($rr_process_main_image_2)) : ?>
                    <div class="rr-work-2-img z-index-2">
                        <img src="<?php echo esc_url($rr_process_main_image_2); ?>"
                            alt="<?php echo esc_attr($rr_bg_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="rr-work-2__item text-center pb-25">
                    <div class="rr-work-2__icon">
                        <span>
                            <?php if($settings['rr_process_icon_type_list'] == 'icon') : ?>
                            <?php if (!empty($settings['rr_process_icon_list']) || !empty($settings['rr_process_selected_icon_list']['value'])) : ?>
                            <?php rr_render_icon($settings, 'rr_process_icon_list', 'rr_process_selected_icon_list'); ?>
                            <?php endif; ?>
                            <?php elseif( $settings['rr_process_icon_type_list'] == 'image' ) : ?>
                            <?php if (!empty($settings['rr_process_image_list']['url'])): ?>
                            <img src="<?php echo $settings['rr_process_image_list']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['rr_process_image_list']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($settings['rr_process_icon_svg_list'])): ?>
                            <?php echo $settings['rr_process_icon_svg_list']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="rr-work-2__content  pt-25 z-index-3 ">
                    <?php if (!empty($settings['rr_process_title_list_2'])): ?>
                    <h3 class="rr-work-2-title-3"><?php echo rr_kses($settings['rr_process_title_list_2' ]); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($settings['rr_process_des_list_2'])): ?>
                    <p><?php echo rr_kses($settings['rr_process_des_list_2' ]); ?></p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="rr-work-2__item text-center pb-25">
                    <?php if(!empty($rr_process_main_image)) : ?>
                    <div class="rr-work-2-img z-index-2">
                        <img src="<?php echo esc_url($rr_process_main_image); ?>"
                            alt="<?php echo esc_attr($rr_bg_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="rr-work-2__item text-center pb-25 ">
                    <div class="rr-work-2__icon">
                        <span>
                        <?php if($settings['rr_process_icon_type_list_3'] == 'icon') : ?>
                            <?php if (!empty($settings['rr_process_icon_list_3']) || !empty($settings['rr_process_selected_icon_list_3']['value'])) : ?>
                            <?php rr_render_icon($settings, 'rr_process_icon_list_3', 'rr_process_selected_icon_list_3'); ?>
                            <?php endif; ?>
                            <?php elseif( $settings['rr_process_icon_type_list_3'] == 'image' ) : ?>
                            <?php if (!empty($settings['rr_process_image_list_3']['url'])): ?>
                            <img src="<?php echo $settings['rr_process_image_list_3']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['rr_process_image_list_3']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($settings['rr_process_icon_svg_list_3'])): ?>
                            <?php echo $settings['rr_process_icon_svg_list_3']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="rr-work-2__content  pt-25 z-index-3">
                    <?php if (!empty($settings['rr_process_title_list_3'])): ?>
                    <h3 class="rr-work-2-title-3"><?php echo rr_kses($settings['rr_process_title_list_3' ]); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($settings['rr_process_des_list_3'])): ?>
                    <p><?php echo rr_kses($settings['rr_process_des_list_3' ]); ?></p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="rr-work-2__item text-center pb-25">
                <?php if(!empty($rr_process_main_image_3)) : ?>
                    <div class="rr-work-2-img z-index-2">
                    <img src="<?php echo esc_url($rr_process_main_image_3); ?>"
                            alt="<?php echo esc_attr($rr_bg_image_alt); ?>">
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- process area end -->


<?php else: 

     if ( !empty($settings['rr_bg_image_1']['url']) ) {
        $rr_bg_image = !empty($settings['rr_bg_image_1']['id']) ? wp_get_attachment_image_url( $settings['rr_bg_image_1']['id'], $settings['bg_image_size_size']) : $settings['rr_bg_image_1']['url'];
        $rr_bg_image_alt = get_post_meta($settings["rr_bg_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'rr-section-title  rr-section-title-space'); 
    // Link
    if ('2' == $settings['rr_process_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_process_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-black');
    } else {
        if ( ! empty( $settings['rr_process_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_process_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-black');
        }
    }
?>
<!-- process area start -->
<section class="rr-process-area rr-process-padding grey-bg pt-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-8 col-lg-10 ">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="rr-price-2-title-box text-center mb-45">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <span class="rr-section-subtitle p-relative">
                        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/testimonial/section-icon.png"
                            alt="img"> <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?> <img
                            src="<?php echo get_template_directory_uri(  ); ?>/assets/img/testimonial/section-icon.png"
                            alt="img"></span>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['rr_section_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['rr_section_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            rr_kses( $settings['rr_section_title' ] )
                            );
                        endif;
                    ?>
                    <?php if ( !empty($settings['rr_section_description']) ) : ?>
                    <p><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="rr-work-2__wrapper p-relative">
            <div class="row">
                <div class="rr-work-2__shap-img">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/process/bg-shap.png" alt="img">
                </div>
                <?php foreach ($settings['rr_process_list'] as $key => $item) : ?>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="rr-work-2__item text-center pb-25">
                        <div class="rr-work-2__icon">
                            <?php if($item['rr_process_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['rr_process_icon']) || !empty($item['rr_process_selected_icon']['value'])) : ?>
                            <?php rr_render_icon($item, 'rr_process_icon', 'rr_process_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif( $item['rr_process_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['rr_process_image']['url'])): ?>
                            <img src="<?php echo $item['rr_process_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['rr_process_icon_svg'])): ?>
                            <?php echo $item['rr_process_icon_svg']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="rr-work-2__content  pt-25 ">
                            <?php if (!empty($item['rr_process_title'])): ?>
                            <h3 class="rr-work-2-title-3"><?php echo rr_kses($item['rr_process_title' ]); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($item['rr_process_des'])): ?>
                            <p><?php echo rr_kses($item['rr_process_des' ]); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if ( !empty($settings['rr_process_btn_text']) ) : ?>
                <div class="rr-work-2-btn text-center">
                    <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_process_btn_text']); ?>
                            <i class="fa-sharp fa-solid fa-plus"></i></span></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- process area end -->
<?php endif;
	}
}

$widgets_manager->register( new rr_Process() );