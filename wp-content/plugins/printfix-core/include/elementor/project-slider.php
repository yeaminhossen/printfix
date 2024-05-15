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
class rr_Projects_slider extends Widget_Base {

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
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'rr_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-3', 'layout-4', 'layout-5']);
        // Platform Info Repeater
        $this->start_controls_section(
            'rr_platform_area',
            [
                'label' => esc_html__('Platform List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => 'layout-1'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater(); 

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'rr_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Thumbnail Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );    
        $repeater->add_control(
            'rr_platform_active_switch',
            [
              'label'        => esc_html__( 'Platform Active', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
              'condition' => [
                'repeater_condition' => 'style_1'
            ],
            ]
        );
        $repeater->add_control(
            'rr_features_title', [
                'label' => esc_html__('Features link', 'tpcore'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_platform_sub_title',
            [
                'label' => esc_html__('Designation', 'tpcore'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Web Developer',
                'label_block' => true,
            ]
        );    

        $repeater->add_control(
            'rr_features_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'rr_features_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_features_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'rr_features_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'rr_features_link_type' => '1',
                    'rr_features_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'rr_features_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_features_link_type' => '2',
                    'rr_features_link_switcher' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'rr_platform_area_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_platform_area_number' => esc_html__('01.', 'tpcore'),
                        'rr_features_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'rr_platform_area_number' => esc_html__('02.', 'tpcore'),
                        'rr_features_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'rr_platform_area_number' => esc_html__('03.', 'tpcore'),
                        'rr_features_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ rr_features_title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'rr_platform_single_area',
            [
                'label' => esc_html__('Platform List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => 'layout-2'
                ]
            ]
        );


        $this->add_control(
            'repeater_single_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'rr_thumbnail_image_single',
            [
                'label' => esc_html__( 'Choose Thumbnail Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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

        $this->add_control(
            'rr_features_single_title', [
                'label' => esc_html__('Features link', 'tpcore'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_platform_single_sub_title',
            [
                'label' => esc_html__('Designation', 'tpcore'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Web Developer',
                'label_block' => true,
            ]
        );    

        $this->add_control(
            'rr_features_single_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'rr_features_single_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_features_single_link_switcher' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'rr_features_single_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'rr_features_single_link_type' => '1',
                    'rr_features_single_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'rr_features_single_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_features_single_link_type' => '2',
                    'rr_features_single_link_switcher' => 'yes',
                ]
            ]
        );
        
        $this->end_controls_section();
    
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('platform_area_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('platform_area_subtitle', 'Section - Subtitle', '.rr-el-subtitle', ['layout-1', 'layout-2']);
        $this->rr_basic_style_controls('platform_area_title', 'Section - Title', '.rr-el-title', ['layout-1', 'layout-2']);
        $this->rr_basic_style_controls('platform_rep_title', 'Repeater Title', '.rr-rep-title', ['layout-1', 'layout-2']);
    }

	/**
	 * Render the widget output on the frontend.
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
    // thumbnail image
    if ( !empty($settings['rr_thumbnail_image_single']['url']) ) {
        $rr_thumbnail_image_single = !empty($settings['rr_thumbnail_image_single']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image_single']['id'], $settings['rr_image_size_size']) : $settings['rr_thumbnail_image_single']['url'];
        $rr_thumbnail_image_alt = get_post_meta($settings["rr_thumbnail_image_single"]["id"], "_wp_attachment_image_alt", true);
    }

	$this->add_render_attribute('title_args', 'class', 'rr-section-title rr-el-title');
?>

<div class="our-project-item rr-el-section">
    <a href="<?php echo esc_url($rr_thumbnail_image_single); ?>"
        class="our-gallery__item popup-image wow fadeIn animated" data-wow-delay=".7s">
        <?php if( !empty($settings['rr_thumbnail_image_single'] ) ) : ?>
        <img src="<?php echo esc_url($rr_thumbnail_image_single); ?>" alt="<?php echo esc_attr($rr_thumbnail_image_alt); ?>">
        <?php endif; ?>
        <div class="overlay">
            <?php if ( !empty($settings['rr_features_single_title']) ) : ?>
            <h3><?php echo rr_kses($settings['rr_features_single_title' ]); ?></h3>
            <?php endif; ?>
            <?php if ( !empty($settings['rr_platform_single_sub_title']) ) : ?>
            <h6 class="rr-el-subtitle"><?php echo rr_kses($settings['rr_platform_single_sub_title']);?></h6>
            <?php endif; ?>
        </div>
        <span class="hover"><i class="fa-regular fa-plus"></i></span>
    </a>
</div>

<?php else: 

    // shape image
    if ( !empty($settings['rr_shape_image_1']['url']) ) {
        $rr_shape_image = !empty($settings['rr_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['rr_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['rr_shape_image_1']['url'];
        $rr_shape_image_alt = get_post_meta($settings["rr_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
	$this->add_render_attribute('title_args', 'class', 'title wow fadeInLeft animated rr-el-title');
?>
<!-- latest-project area start -->
<section class="project-area pt-120 overflow-hidden latest-project-bg rr-el-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="project__title text-center">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <h6 class="subtitle wow fadeInLeft animated rr-el-subtitle" data-wow-delay=".6s">
                        <?php echo rr_kses($settings['rr_section_sub_title']); ?></h6>
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
                </div>
            </div>
        </div>
        <div class="project-row-custom">
            <?php foreach ($settings['rr_platform_area_list'] as $key => $item) : $key = $key+1; $active = $item['rr_platform_active_switch'] ? 'active' : NULL;
            // thumbnail image
            if ( !empty($item['rr_thumbnail_image']['url']) ) {
                $rr_thumbnail_image = !empty($item['rr_thumbnail_image']['id']) ? wp_get_attachment_image_url( $item['rr_thumbnail_image']['id'], $settings['rr_thumbnail_size_size']) : $item['rr_thumbnail_image']['url'];
                $rr_thumbnail_image_alt = get_post_meta($item["rr_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
            }
            // Link
            if ('2' == $item['rr_features_link_type']) {
                $link = get_permalink($item['rr_features_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($item['rr_features_link']['url']) ? $item['rr_features_link']['url'] : '';
                $target = !empty($item['rr_features_link']['is_external']) ? '_blank' : '';
                $rel = !empty($item['rr_features_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
            <div class="col-custom <?php echo esc_attr($active); ?> p-relative item1 wow fadeInLeft animated"
                data-wow-delay=".6s">
                <div class="project-item p-relative ">
                    <div class="project-thumb">
                        <?php if( !empty($item['rr_thumbnail_image'] ) ) : ?>
                        <img src="<?php echo esc_url($rr_thumbnail_image); ?>"
                            alt="<?php echo esc_attr($rr_thumbnail_image_alt); ?>">
                        <?php endif; ?>
                        <h3 class="project-title rr-rep-title">
                            <?php if (!empty($link)) : ?>
                            <a
                                href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_features_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo rr_kses($item['rr_features_title' ]); ?>
                            <?php endif; ?>
                        </h3>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- latest-project area end -->

<?php endif; 
	}
}

$widgets_manager->register( new rr_Projects_slider() );