<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class rr_Services extends Widget_Base {

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
        return 'rr-services';
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
        return __( 'Services', 'rr-core' );
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
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2']);

        // Service group
        $this->start_controls_section( 
            'rr_services',
            [
                'label' => esc_html__('Services List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
          // creative animation
          $this->add_control(
			'rr_shap_switcher',
			[
				'label' => esc_html__( 'Services Shap', 'rr-core' ), 
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
				'label_off' => esc_html__( 'No', 'rr-core   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

       
        $repeater->add_control(
            'rr_service_number', [
                'label' => esc_html__('Number Field', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('a', 'rr-core'),
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'rr_service_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_service_description',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered.', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_services_link_switcher',
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
            'rr_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_services_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'rr_services_link',
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
                    'rr_services_link_type' => '1',
                    'rr_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'rr_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_services_link_type' => '2',
                    'rr_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'rr_image_thumb',
            [
                'label' => esc_html__( 'Choose Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ], 
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'rr_service_btn', [
                'label' => esc_html__('Button', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Button', 'rr-core'),
                'label_block' => true,
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
            'rr_service_list',
            [
                'label' => esc_html__('Services - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_service_title' => esc_html__('Business Stratagy', 'rr-core'),
                    ],
                    [
                        'rr_service_title' => esc_html__('Website Development', 'rr-core')
                    ],
                    [
                        'rr_service_title' => esc_html__('Marketing & Reporting', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_service_title }}}',
            ]
        );
        $this->end_controls_section();
             

        // section column
        $this->rr_columns('col', ['layout-1', 'layout-2']);

    }

    // style_tab_content
    protected function style_tab_content(){

        $this->rr_section_style_controls('services_section', 'Section Style', '.ele-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('services_title', 'services Title', '.rr-el-re-Title');
        $this->rr_basic_style_controls('services_desc', 'services Description', '.rr-el-re-dec');
        $this->rr_link_controls_style('repiter_btn', 'services - Button', '.rr-el-btn');
        $this->rr_section_style_controls('services_box', 'Services Box', '.services-box');
        
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
  
    $this->add_render_attribute('title_args', 'class', 'latest-service2__title-wrapper-title rr-el-title');
?>
<!-- latest-service2__area start -->
<section class="latest-service2__area latest-service-bg section-space ele-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="latest-service2__title-wrapper text-center mb-40">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <h6 class="latest-service2__title-wrapper-subtitle rr-el-sub-title">
                        <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
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
                <?php endif; ?>
            </div>
        </div>
        <div class="row mb-minus-30">
            <?php foreach ($settings['rr_service_list'] as $key => $item) :
                // Link
                if ( !empty($item['rr_image_thumb']['url']) ) {
                    $rr_image_thumb = !empty($item['rr_image_thumb']['id']) ? wp_get_attachment_image_url( $item['rr_image_thumb']['id'], $item['rr_image_size_size']) : $item['rr_image_thumb']['url'];
                    $rr_image_alt = get_post_meta($item["rr_image_thumb"]["id"], "_wp_attachment_image_alt", true);
                } 

                if ('2' == $item['rr_services_link_type']) {
                    $link = get_permalink($item['rr_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['rr_services_link']['url']) ? $item['rr_services_link']['url'] : '';
                    $target = !empty($item['rr_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['rr_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['rr_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['rr_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['rr_col_for_tablet']); ?> col-<?php echo esc_attr($settings['rr_col_for_mobile']); ?> mb-30 wow <?php echo esc_attr($item['rr_anima_type']); ?>"
                data-wow-duration="<?php echo esc_attr($item['rr_anima_dura']); ?>"
                data-wow-delay="<?php echo esc_attr($item['rr_anima_delay']); ?>">
                <div class="latest-service2__item text-center mb-30 services-box">
                    <div class="latest-service2__item-icon mt-30">
                        <?php if(!empty($rr_image_thumb)) : ?>
                        <img src="<?php echo esc_url($rr_image_thumb); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="latest-service2__item-text">
                        <h4 class="rr-el-re-Title"><?php if ($item['rr_services_link_switcher'] == 'yes') : ?> <a
                                href="<?php echo esc_url($link); ?>">
                                <?php echo rr_kses($item['rr_service_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo rr_kses($item['rr_service_title' ]); ?>
                            <?php endif; ?></h4>
                        <?php if (!empty($item['rr_service_description' ])): ?>
                        <p class="rr-el-re-dec"><?php echo rr_kses($item['rr_service_description']); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($link); ?>"
                            class="readmore d-flex align-items-center justify-content-center rr-el-btn"><?php echo rr_kses($item['rr_service_btn']); ?>
                            <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- latest-service2__area end -->
<?php elseif ( $settings['rr_design_style']  == 'layout-3' ):
  
  $this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeLeft rr-el-title');
?>
<!-- feature area start -->
<section class="latest-feature__area pt-80 pb-50 latest-feature-bg">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['rr_service_list'] as $key => $item) :
                // Link
                if ( !empty($item['rr_image_thumb']['url']) ) {
                    $rr_image_thumb = !empty($item['rr_image_thumb']['id']) ? wp_get_attachment_image_url( $item['rr_image_thumb']['id'], $item['rr_image_size_size']) : $item['rr_image_thumb']['url'];
                    $rr_image_alt = get_post_meta($item["rr_image_thumb"]["id"], "_wp_attachment_image_alt", true);
                } 

                if ('2' == $item['rr_services_link_type']) {
                    $link = get_permalink($item['rr_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['rr_services_link']['url']) ? $item['rr_services_link']['url'] : '';
                    $target = !empty($item['rr_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['rr_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>

            <div class="col-xl-4 col-lg-4 col-md-6 ">
                <div class="latest-feature__item mb-30 d-flex wow fadeInLeft animated" data-wow-delay=".8s">
                    <div class="latest-feature__item-icon">
                        <?php if(!empty($rr_image_thumb)) : ?>
                        <img src="<?php echo esc_url($rr_image_thumb); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="latest-feature__item-content">
                    <h4 class="rr-el-re-Title"><?php if ($item['rr_services_link_switcher'] == 'yes') : ?> <a
                                href="<?php echo esc_url($link); ?>">
                                <?php echo rr_kses($item['rr_service_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo rr_kses($item['rr_service_title' ]); ?>
                            <?php endif; ?></h4>
                        <?php if (!empty($item['rr_service_description' ])): ?>
                        <p class="rr-el-re-dec"><?php echo rr_kses($item['rr_service_description']); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_service_btn']); ?> <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div> 
    </div>
</section>
<!-- feature area end -->
<?php else: 
  
    $this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeUp rr-el-title');
?>
<!-- service area start -->
<section class="latest-service__area pt-120 pb-90 p-relative overflow-hidden latest-service-bg">
    <div class="container p-relative">
        <?php if ( !empty($settings['rr_shap_switcher']) ) : ?>
        <div class="latest-service__all-shape">
            <div class="latest-service__right-shape">
                <img class="upDown"
                    src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/service/right-shape.svg"
                    alt="img not found">
            </div>
            <div class="latest-service__bg-shape">
                <img class="upDown"
                    src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/service/service-bg-shape.png"
                    alt="img not found">
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-12">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="latest-service__title-box mb-40 text-center">
                    <div class="latest-service__title-box-subtitle wow fadeInLeft animated" data-wow-delay=".6s">
                        <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                        <h6><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
                        <?php endif; ?>
                    </div>
                    <div class="latest-service__title-box-title wow fadeInLeft animated" data-wow-delay=".8s">
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
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <?php foreach ($settings['rr_service_list'] as $key => $item) :
                // Link
                if ( !empty($item['rr_image_thumb']['url']) ) {
                    $rr_image_thumb = !empty($item['rr_image_thumb']['id']) ? wp_get_attachment_image_url( $item['rr_image_thumb']['id'], $item['rr_image_size_size']) : $item['rr_image_thumb']['url'];
                    $rr_image_alt = get_post_meta($item["rr_image_thumb"]["id"], "_wp_attachment_image_alt", true);
                } 

                if ('2' == $item['rr_services_link_type']) {
                    $link = get_permalink($item['rr_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['rr_services_link']['url']) ? $item['rr_services_link']['url'] : '';
                    $target = !empty($item['rr_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['rr_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['rr_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['rr_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['rr_col_for_tablet']); ?> col-<?php echo esc_attr($settings['rr_col_for_mobile']); ?> mb-30 wow <?php echo esc_attr($item['rr_anima_type']); ?>"
                data-wow-duration="<?php echo esc_attr($item['rr_anima_dura']); ?>"
                data-wow-delay="<?php echo esc_attr($item['rr_anima_delay']); ?>">
                <div class="latest-service__item text-center">
                    <div class="latest-service__item-icon">
                        <?php if(!empty($rr_image_thumb)) : ?>
                        <img src="<?php echo esc_url($rr_image_thumb); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="latest-service__item-title">
                        <?php if ($item['rr_services_link_switcher'] == 'yes') : ?> <a
                            href="<?php echo esc_url($link); ?>">
                            <?php echo rr_kses($item['rr_service_title' ]); ?></a>
                        <?php else : ?>
                        <?php echo rr_kses($item['rr_service_title' ]); ?>
                        <?php endif; ?>
                    </div>
                    <div class="latest-service__item-text">
                        <?php if (!empty($item['rr_service_description' ])): ?>
                        <p class="rr-el-re-dec"><?php echo rr_kses($item['rr_service_description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- service area end -->
<?php endif; 
    }
}

$widgets_manager->register( new rr_Services() ); 