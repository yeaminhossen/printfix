<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Info_Card extends Widget_Base {

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
		return 'rr-info-card';
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
		return __( 'Info Card', 'rr-core' );
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


    public function get_rr_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $rr_cfa         = array();
        $rr_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $rr_forms       = get_posts( $rr_cf_args );
        $rr_cfa         = ['0' => esc_html__( 'Select Form', 'rr-core' ) ];
        if( $rr_forms ){
            foreach ( $rr_forms as $rr_form ){
                $rr_cfa[$rr_form->ID] = $rr_form->post_title;
            }
        }else{
            $rr_cfa[ esc_html__( 'No contact form found', 'rr-core' ) ] = 0;
        }
        return $rr_cfa;
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

    protected function register_controls_section(){
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'rr-core_contact',
            [
                'label' => esc_html__('Contact Form', 'rr-core'),
            ]
        );

        $this->add_control(
            'rr-core_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'rr-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_rr_contact_form(),
            ]
        );

        $this->end_controls_section();
		$this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1'] );
        // Contact info list
        $this->start_controls_section(
            '_rr_contact_info',
            [
                'label' => esc_html__('Contact  List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
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
            'rr_box_icon_type',
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
            'rr_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                'condition' => [
                    'rr_box_icon_type' => 'svg'
                ]
            ]
        );

        $repeater->add_control(
            'rr_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_box_icon_type' => 'image',
                ]
            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'rr_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'rr_box_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
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
                        'rr_box_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'rr_contact_title',
            [
                'label'       => esc_html__( 'Title', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Title here', 'rr-core' ),
                'placeholder' => esc_html__( 'Your Heading Text', 'rr-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_contact_des',
            [
                'label'       => esc_html__( 'Description', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Your Description here', 'rr-core' ),
                'placeholder' => esc_html__( 'Your Descripion Text', 'rr-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_list',
            [
                'label' => esc_html__('Contact - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_contact_title' => esc_html__('Text 1', 'rr-core'),
                    ],
                    [
                        'rr_contact_title' => esc_html__('Text 2', 'rr-core')
                    ],
                ],
                'title_field' => '{{{ rr_contact_title }}}',
            ]
        );
        $this->end_controls_section();
                // Contact info list
                $this->start_controls_section(
                    'social_rr_contact_info',
                    [
                        'label' => esc_html__('Contact  social', 'rr-core'),
                        'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );
        
                $repeater = new \Elementor\Repeater();
        
                $repeater->add_control(
                    'social_repeater_condition',
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
                    'rr_box_icon_type',
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
                    'rr_box_icon_svg',
                    [
                        'show_label' => false,
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                        'condition' => [
                            'rr_box_icon_type' => 'svg'
                        ]
                    ]
                );
        
                $repeater->add_control(
                    'rr_box_icon_image',
                    [
                        'label' => esc_html__('Upload Icon Image', 'rr-core'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
                            'rr_box_icon_type' => 'image',
                        ]
                    ]
                );
        
                if (rr_is_elementor_version('<', '2.6.0')) {
                    $repeater->add_control(
                        'rr_box_icon',
                        [
                            'show_label' => false,
                            'type' => Controls_Manager::ICON,
                            'label_block' => true,
                            'default' => 'fa fa-star',
                            'condition' => [
                                'rr_box_icon_type' => 'icon'
                            ]
                        ]
                    );
                } else {
                    $repeater->add_control(
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
                                'rr_box_icon_type' => 'icon'
                            ]
                        ]
                    );
                }
                
        $this->add_control(
            'rr_list_social',
            [
                'label' => esc_html__('Contact - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ rr_box_icon_svg }}}',
            ]
        );
        $this->end_controls_section();

        
    }

    protected function style_tab_content(){
		$this->rr_basic_style_controls('history_title', 'Title', '.rr-el-box-title');
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

<?php if ( $settings['rr_design_style']  == 'layout-2' ): ?>

<?php else: 
     $this->add_render_attribute('title_args', 'class', 'rr-contact-breadcrumb-title');
 ?>

<!-- contact area start -->
<section class="rr-contact-breadcrumb-area pt-120 pb-90 rr-el-box-title">
    <div class="container">
        <div class="rr-contact-breadcrumb-box">
            <div class="rr-contact-breadcrumb-social">

                <?php foreach ($settings['rr_list_social'] as $key => $item) : ?>
                <a href="#">
                    <?php if($item['rr_box_icon_type'] == 'icon') : ?>
                    <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
                    <span><?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?></span>
                    <?php endif; ?>
                    <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
                    <span><img src="<?php echo $item['rr_box_icon_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($item['rr_box_icon_svg'])): ?>
                    <span><?php echo $item['rr_box_icon_svg']; ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="rr-contact-breadcrumb-content">
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
                        <div id="contact-form">
                        <?php if( !empty($settings['rr-core_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['rr-core_select_contact_form'].'"]' ); ?>
                        <?php else : ?>
                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'rr-core' ). '</p></div>'; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="rr-contact-breadcrumb-wrapper">
                        <?php foreach ($settings['rr_list'] as $key => $item) : 
                            $class = '';
                            if($key == 0){
                                $class = 'theme-color';
                            } elseif ($key == 1){
                                $class = 'theme-background';
                            } elseif ($key == 2){
                                $class = 'theme-color-2';
                            }
                            ?>
                        <div class="rr-contact-breadcrumb-item mb-40 d-flex">
                            <div class="rr-contact-breadcrumb-item-icon">
                                <span>
                                    <?php if($item['rr_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
                                    <span><?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                    <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
                                    <span><img src="<?php echo $item['rr_box_icon_image']['url']; ?>"
                                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['rr_box_icon_svg'])): ?>
                                    <span><?php echo $item['rr_box_icon_svg']; ?></span>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="rr-contact-breadcrumb-item-content">

                                <?php if(!empty($item['rr_contact_title'])) : ?>
                                <h3 class="rr-contact-breadcrumb-item-title">
                                    <?php echo rr_kses($item['rr_contact_title']); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($item['rr_contact_des'])) : ?>
                                <p><?php echo rr_kses($item['rr_contact_des']); ?></p>
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
<!-- contact area end -->
<?php endif; 
	}
}

$widgets_manager->register( new rr_Info_Card() );