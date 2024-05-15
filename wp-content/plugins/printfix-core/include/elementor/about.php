<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use RRCore\Elementor\Controls\Group_Control_RRBGGradient;
use RRCore\Elementor\Controls\Group_Control_RRGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'rr-core' );
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


        $this->rr_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4','layout-5']);

   
        // rr_btn_button_group
        $this->start_controls_section(
            'rr_btn_button_group',
            [
                'label' => esc_html__('Button', 'rr-core'),

            ]
        );

        $this->add_control(
            'rr_button_style',
            [
                'label' => esc_html__('Select Button Style', 'rr-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'rr-btn-blue-lg' => esc_html__('Style 1', 'rr-core'),
                    'rr-btn-inner' => esc_html__('Style 2', 'rr-core'),
                ],
                'default' => 'rr-btn-blue-lg',
                'condition' => [
                    'rr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'rr_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'rr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rr-core' ),
                'label_off' => esc_html__( 'Hide', 'rr-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'rr_btn_text',
            [
                'label' => esc_html__('Button Text', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'rr-core'),
                'title' => esc_html__('Enter button text', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_btn_button_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'rr_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'rr-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'rr_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'rr_btn_link',
            [
                'label' => esc_html__('Button link', 'rr-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('htRRs://your-link.com', 'rr-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'rr_btn_link_type' => '1',
                    'rr_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'rr-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_btn_link_type' => '2',
                    'rr_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // _rr_image
		$this->start_controls_section(
            '_rr_image',
            [
                'label' => esc_html__('Thumbnail', 'rr-core'),
            ]
        );
        $this->add_control(
            'rr_image',
            [
                'label' => esc_html__( 'Choose Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'rr_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_design_style' => ['layout-1']
                ]
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

        // shape section
        $this->start_controls_section(
            'rr_about_shape',
                [
                'label' => esc_html__( 'Shape', 'rr-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
            'rr_about_shape_switch',
            [
            'label'        => esc_html__( 'Shape On/Off', 'rr-core' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'rr-core' ),
            'label_off'    => esc_html__( 'Hide', 'rr-core' ),
            'return_value' => 'yes',
            'default'      => '1',
            ]
        );

        $this->end_controls_section();

         // Extra About Section
         $this->start_controls_section(
            'rr_extra_about',
            [
                'label' => esc_html__('About Extra Info', 'rr-core'),
                'condition' => [
                    'rr_design_style' => ['layout-3']
                ]
            ]
        );
        $this->add_control(
            'extra_condition',
            [
                'label' => __( 'Field condition', 'rr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'rr-core' ),
                    'style_2' => __( 'Style 2', 'rr-core' ),
                    'style_3' => __( 'Style 3', 'rr-core' ),
                    'style_4' => __( 'Style 4', 'rr-core' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

       
        $this->add_control(
            'rr_extra_about_big_title',
            [
                'label' => esc_html__('Extra About BIg Title', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'title' => esc_html__('Enter Extra About Big Title', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_design_style' => ['layout-3'],
                    'extra_condition' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'rr_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ],
                'condition' => [
                    'extra_condition' => ['style_2']
                ]
            ]
        );
        $this->add_control(
            'rr_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                'condition' => [
                    'rr_box_icon_type' => 'svg',
                    'extra_condition' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'rr_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_box_icon_type' => 'image',
                    'extra_condition' => ['style_2']
                ]
            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'rr_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_box_icon_type' => 'icon',
                        'extra_condition' => ['style_2']
                    ]
                ]
            );
        } else {
            $this->add_control(
                'rr_box_selected_icon',
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
                        'rr_box_icon_type' => 'icon',
                        'extra_condition' => ['style_2']
                    ]
                ]
            );
        }


        $this->add_control(
            'rr_extra_about_big_discription',
            [
                'label' => esc_html__('Extra About Discription', 'rr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'title' => esc_html__('Enter Extra About Big Discription', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_design_style' => ['layout-2','layout-3'],
                    'extra_condition' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'rr_extra_about_count',
            [
                'label' => esc_html__('Extra About count', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'title' => esc_html__('Enter Extra About count', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_design_style' => ['layout-2'],
                    'extra_condition' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'rr_extra_about_title',
            [
                'label' => esc_html__('Extra About Title', 'rr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'title' => esc_html__('Enter Extra About Date', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_design_style' => ['layout-2'],
                    'extra_condition' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'rr_extra_about_title_2',
            [
                'label' => esc_html__('Extra About Title 2', 'rr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'title' => esc_html__('Enter Extra About Date', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_design_style' => ['layout-4'],
                    'extra_condition' => ['style_3', 'style_4']
                ]
            ]
        );

        $this->add_control(
            'rr_extra_about_cta_title',
            [
                'label' => esc_html__('Cta About Title', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'title' => esc_html__('Enter Extra About Date', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'extra_condition' => ['style_4']
                ]
            ]
        );
        $this->add_control(
            'rr_extra_about_cta_phone',
            [
                'label' => esc_html__('Cta About phone', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'title' => esc_html__('Enter Extra About Date', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'extra_condition' => ['style_4']
                ]
            ]
        );

        $this->end_controls_section();
        // list
        $this->start_controls_section(
            'rr_about_list',
                [
                    'label' => esc_html__( 'Info List', 'rr-core' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'rr_design_style' => ['layout-1', 'layout-4']
                    ]
                ]
            );
            
            $repeater = new \Elementor\Repeater();
            
            $repeater->add_control(
            'rr_about_list_title_1',
                [
                'label'   => esc_html__( 'Title', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Default-value', 'rr-core' ),
                'label_block' => true,
                ]
            );
            
            $this->add_control(
                'rr_about_list_list_1',
                [
                'label'       => esc_html__( 'Features List', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                    'rr_about_list_title_1'   => esc_html__( ' Mistakes To Avoid to dum Auam. ', 'rr-core' ),
                    ],
                    [
                    'rr_about_list_title_1'   => esc_html__( 'Avoid to the dumy mistakes', 'rr-core' ),
                    ],
                    [
                    'rr_about_list_title_1'   => esc_html__( ' Your Startup industry stan', 'rr-core' ),
                    ],
                ],
                'title_field' => '{{{ rr_about_list_title_1 }}}',
                ]
            );
            $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('about_section', 'Section - Style', '.rr-el-section'); 
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('section_desc', 'Section - Description', '.rr-el-desc');
        $this->rr_link_controls_style('about_btn', 'About - Button', '.rr-el-btn');
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
     if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    
    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-btn');
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'rr-section-title pb-15 wow rrfadeUp rr-el-title');
?>
<!-- about area start -->
<section class="rr-about-area pt-90 pb-120 fix p-relative rr-el-section">
    <div class="container ">
        <?php if ( !empty($settings['rr_about_shape_switch']) ) : ?>
        <div class="rr-about-shap-wrap d-none d-lg-block">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/about/shap.png" alt="">
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-6">
                <div class="rr-about-thumb rr-about-thumb-2 wow rrfadeLeft" data-wow-duration=".9s"
                    data-wow-delay=".5s">
                    <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="rr-about-info p-relative">
                    <div class="rr-section-title-wrapper mb-40">
                        <?php if ( !empty($settings['rr_about_sub_title']) ) : ?>
                        <span class="rr-section-subtitle wow rrfadeUp rr-el-sub-title" data-wow-duration=".9s"
                            data-wow-delay=".3s"><?php echo rr_kses( $settings['rr_about_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['rr_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_about_title' ] )
                                );
                            endif; ?>
                        <?php if ( !empty($settings['rr_about_description']) ) : ?>
                        <p class=" wow rrfadeUp rr-el-desc" data-wow-duration=".9s" data-wow-delay=".7s">
                            <?php echo rr_kses( $settings['rr_about_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="rr-about-btn wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                        <?php if ( !empty($settings['rr_btn_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?> <i
                                    class="fa-sharp fa-solid fa-arrow-right"></i></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about area end -->

<?php elseif ( $settings['rr_design_style']  == 'layout-3' ): 
     if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    
    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-2 rr-el-btn');
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-2 rr-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'rr-section-title pb-15 wow rrfadeUp rr-el-title');
?>
<!-- about-3 03 area start -->
<section class="rr-about-3-area pb-90 pt-70 fix rr-el-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                <div class="rr-about-3-thumb">
                <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="rr-about-title-wrapper mt-140 ml-40">
                    <?php if ( !empty($settings['rr_about_sub_title']) ) : ?>
                    <span class="rr-section-subtitle wow rrfadeUp rr-el-sub-title" data-wow-duration=".9s"
                        data-wow-delay=".3s"><?php echo rr_kses( $settings['rr_about_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php if ( !empty($settings['rr_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_about_title' ] )
                                );
                            endif; ?>
                    <?php if ( !empty($settings['rr_about_description']) ) : ?>
                    <div class="rr-section-main mb-40 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                        <p class="rr-el-desc"><?php echo rr_kses( $settings['rr_about_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class=" wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                        <?php if ( !empty($settings['rr_btn_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?> <i
                                    class="fa-sharp fa-solid fa-arrow-right"></i></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-3 03 area end -->
<?php else:

    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-btn');
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'rr-section-title pb-15 wow rrfadeUp rr-el-title');
?>
<!-- about area start -->
<section class="rr-about-area pt-120 pb-60 fix rr-el-section">
    <div class="container">
        <div class="row gx-30 align-items-center justify-content-center">
            <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 p-relative wow rrfadeUp" data-wow-duration=".9s"
                data-wow-delay=".5s">
                <div class="rr-about-thumb rr-about-img d-flex align-items-center justify-content-center"
                    data-background="<?php echo esc_url($rr_image); ?>">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/about/shape.png" alt="">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                <div class="rr-about-main-info text-center">
                    <div class="rr-about-title-wrapper text-center mb-40">
                        <?php if ( !empty($settings['rr_about_sub_title']) ) : ?>
                        <span class="rr-section-subtitle wow rrfadeUp rr-el-sub-title" data-wow-duration=".9s"
                            data-wow-delay=".3s"><?php echo rr_kses( $settings['rr_about_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['rr_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_about_title' ] )
                                );  
                            endif; ?>
                        <?php if ( !empty($settings['rr_about_description']) ) : ?>
                        <p class=" wow rrfadeUp rr-el-desc" data-wow-duration=".9s" data-wow-delay=".7s">
                            <?php echo rr_kses( $settings['rr_about_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="rr-about-btn  wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                        <?php if ( !empty($settings['rr_btn_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?> <i
                                    class="fa-sharp fa-solid fa-arrow-right"></i></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 p-relative wow rrfadeUp" data-wow-duration=".9s"
                data-wow-delay=".9s">
                <div class="rr-about-thumb rr-about-img d-flex align-items-center justify-content-center"
                     data-background="<?php echo esc_url($rr_image_2); ?>">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/about/shape.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about area end -->
<?php endif; 
	}
}
$widgets_manager->register( new rr_About() );