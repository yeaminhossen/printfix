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
class rr_Features extends Widget_Base {

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
		return 'features';
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
		return __( 'Features', 'rr-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        // title/content
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.' );

        // Features group
        $this->start_controls_section(
            'rr_features',
            [
                'label' => esc_html__('Features List', 'rr-core'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'rr_features_main_image',
            [
                'label' => esc_html__('Upload Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]

            ]
        );

        $repeater->add_control(
            'rr_features_icon_type',
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
            'rr_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_features_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'rr_features_icon_svg',
            [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                    'condition' => [
                        'rr_features_icon_type' => 'svg'
                    ]
            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'rr_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'rr_features_selected_icon',
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
                        'rr_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'rr_features_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_features_description',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );
        

        $repeater->add_control(
            'rr_features_link_switcher',
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
            'rr_features_btn_text',
            [
                'label' => esc_html__('Button Text', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'rr-core'),
                'title' => esc_html__('Enter button text', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_features_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'rr_features_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'rr-core' ),
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
                    'rr_features_link_type' => '1',
                    'rr_features_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'rr_features_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_features_link_type' => '2',
                    'rr_features_link_switcher' => 'yes',
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
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
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
                    'repeater_condition' => ['style_1']
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
                    'repeater_condition' => ['style_1']
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
                    'repeater_condition' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'rr_features_list',
            [
                'label' => esc_html__('Services - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_features_title' => esc_html__('Discover', 'rr-core'),
                    ],
                    [
                        'rr_features_title' => esc_html__('Define', 'rr-core')
                    ],
                    [
                        'rr_features_title' => esc_html__('Develop', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_features_title }}}',
            ]
        );
        $this->end_controls_section();
        
        // shape section
        $this->start_controls_section(
            'rr_features_img',
            [
                'label' => esc_html__( 'Image', 'rr-core' ),
                'condition' => [
                    'rr_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'rr_features_image',
            [
                'label' => esc_html__( 'Choose Features Image', 'rr-core' ),
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
                'exclude' => ['custom'],
                'default' => 'full'
            ]
        );
        $this->end_controls_section();

        // section column
        $this->rr_columns('col');


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('features_section', 'Section - Style', '.rr-el-section'); 
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
    // thumbnail image
    if ( !empty($settings['rr_features_image']['url']) ) {
        $rr_features_image = !empty($settings['rr_features_image']['id']) ? wp_get_attachment_image_url( $settings['rr_features_image']['id'], $settings['rr_image_size_size']) : $settings['rr_features_image']['url'];
        $rr_thumbnail_image_alt = get_post_meta($settings["rr_features_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>
<!-- features area strat -->
<section class="rr-features-box-area rr-features-box-bg-color p-relative pb-20 d-none d-md-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12">
                <div class="rr-features-box-wrap p-relative">
                    <div class="rr-features-box-img d-none d-lg-block">
                    <?php if(!empty($rr_features_image)) : ?>
                        <img src="<?php echo esc_url($rr_features_image); ?>"
                            alt="<?php echo esc_attr($rr_thumbnail_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="rr-features-box-item d-flex justify-content-end align-items-center">
                        <?php foreach ($settings['rr_features_list'] as $key => $item) :
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
                        <div class="rr-features-box-box d-flex align-items-center">
                            <div class="rr-features-box-icon mr-25">
                                <?php if($item['rr_features_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['rr_features_icon']) || !empty($item['rr_features_selected_icon']['value'])) : ?>
                                <span>
                                    <?php rr_render_icon($item, 'rr_features_icon', 'rr_features_selected_icon'); ?>
                                </span>
                                <?php endif; ?>
                                <?php elseif( $item['rr_features_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['rr_features_image']['url'])): ?>
                                <span>
                                    <img src="<?php echo $item['rr_features_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </span>
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($item['rr_features_icon_svg'])): ?>
                                <span>
                                    <?php echo $item['rr_features_icon_svg']; ?>
                                </span>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="rr-features-box-text">
                                <h4>
                                    <?php if (!empty($link)) : ?>
                                    <a
                                        href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_features_title' ]); ?></a>
                                    <?php else : ?>
                                    <?php echo rr_kses($item['rr_features_title' ]); ?>
                                    <?php endif; ?>
                                </h4>
                                <?php if (!empty($item['rr_features_description' ])): ?>
                                <b><?php echo rr_kses($item['rr_features_description']); ?></b>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- features area end -->

<?php else: 

    // shape image
    if ( !empty($settings['rr_shape_image_1']['url']) ) {
        $rr_shape_image = !empty($settings['rr_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['rr_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['rr_shape_image_1']['url'];
        $rr_shape_image_alt = get_post_meta($settings["rr_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    $shapeClass = $settings['rr_about_shape_switch'] ? NULL : 'feature-breadcrumb' ;
    
    $this->add_render_attribute('title_args', 'class', 'rr-section-title'); 
?>
<!-- features area start -->
<section class="rr-features-area pt-90 pb-70 fix">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="rr-features-title-box text-center mb-45">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <span class="rr-section-subtitle p-relative"><img
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
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <?php foreach ($settings['rr_features_list'] as $key => $item) :
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

                // thumbnail image
                if ( !empty($item['rr_features_main_image']['url']) ) {
                    $rr_features_main_image = !empty($item['rr_features_main_image']['id']) ? wp_get_attachment_image_url( $item['rr_features_main_image']['id'], 'full' ) : $item['rr_features_main_image']['url'];
                    $rr_features_main_image_alt = get_post_meta($item["rr_features_main_image"]["id"], "_wp_attachment_image_alt", true);
                }

            ?>
            <div
                class="col-xl-<?php echo esc_attr($settings['rr_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['rr_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['rr_col_for_tablet']); ?> col-<?php echo esc_attr($settings['rr_col_for_mobile']); ?>">
                <div class="rr-features-item p-relative wow <?php echo esc_attr($item['rr_anima_type']); ?>"
                    data-wow-delay="<?php echo esc_attr($item['rr_anima_delay']); ?>">
                    <div class="rr-features-thumb p-relative">
                        <?php if(!empty($rr_features_main_image)) : ?>
                        <img class="thumb" src="<?php echo esc_url($rr_features_main_image); ?>"
                            alt="<?php echo esc_attr($rr_features_main_image_alt); ?>">
                        <?php endif; ?>
                        <span>0<?php echo ($key+1); ;?></span>
                    </div>
                    <div class="rr-features-icon">
                        <?php if($item['rr_features_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['rr_features_icon']) || !empty($item['rr_features_selected_icon']['value'])) : ?>
                        <div class="shape">
                            <?php rr_render_icon($item, 'rr_features_icon', 'rr_features_selected_icon'); ?>
                        </div>
                        <?php endif; ?>
                        <?php elseif( $item['rr_features_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['rr_features_image']['url'])): ?>
                        <div class="shape">
                            <img src="<?php echo $item['rr_features_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($item['rr_features_icon_svg'])): ?>
                        <div class="shape">
                            <?php echo $item['rr_features_icon_svg']; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="rr-features-content text-center">
                        <?php if (!empty($item['rr_features_title' ])): ?>
                        <h3 class="rr-features-title">
                            <?php if (!empty($link)) : ?>
                            <a
                                href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_features_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo rr_kses($item['rr_features_title' ]); ?>
                            <?php endif; ?>
                        </h3>
                        <?php endif; ?>
                        <?php if (!empty($item['rr_features_description' ])): ?>
                        <p><?php echo rr_kses($item['rr_features_description']); ?></p>
                        <?php endif; ?>
                        <a class="rr-features-btn"
                            href="<?php echo esc_url($link); ?>"><span><?php echo rr_kses($item['rr_features_btn_text']);?>
                                <i class="fa-solid fa-angle-right"></i></span></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- features area end -->
<?php endif;
	}
}

$widgets_manager->register( new rr_Features() );