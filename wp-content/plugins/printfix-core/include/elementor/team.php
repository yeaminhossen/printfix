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
class rr_Team extends Widget_Base {

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
        return 'rr-team';
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
        return __( 'Team', 'rr-core' );
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

          // rr_section_title
          $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2']);


        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'rr-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

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

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'rr-core' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'rr-core' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'rr-core' ),
                'default' => __( 'RR Member Name', 'rr-core' ),
                'placeholder' => __( 'Type title here', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'rr-core' ),
                'default' => __( 'RR Officer', 'rr-core' ),
                'placeholder' => __( 'Type designation here', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );  

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'rr-core' ),
                'default' => __( '#', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
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
        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'rr-core' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Social Links?', 'rr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'rr-core' ),
                'label_off' => __( 'No', 'rr-core' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'rr-core' ),
                'placeholder' => __( 'Add your profile link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'rr-core' ),
                'placeholder' => __( 'Add your email link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'rr-core' ),
                'placeholder' => __( 'Add your phone link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'rr-core' ),
                'default' => __( '#', 'rr-core' ),
                'placeholder' => __( 'Add your facebook link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'rr-core' ),
                'default' => __( '#', 'rr-core' ),
                'placeholder' => __( 'Add your twitter link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'rr-core' ),
                'default' => __( '#', 'rr-core' ),
                'placeholder' => __( 'Add your instagram link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'rr-core' ),
                'placeholder' => __( 'Add your linkedin link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'rr-core' ),
                'placeholder' => __( 'Add your youtube link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'rr-core' ),
                'placeholder' => __( 'Add your Google Plus link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'rr-core' ),
                'placeholder' => __( 'Add your flickr link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'rr-core' ),
                'placeholder' => __( 'Add your vimeo link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'rr-core' ),
                'placeholder' => __( 'Add your hehance link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'rr-core' ),
                'placeholder' => __( 'Add your dribbble link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'rr-core' ),
                'placeholder' => __( 'Add your pinterest link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'rr-core' ),
                'placeholder' => __( 'Add your github link', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'rr-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'rr-core' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'rr-core' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'rr-core' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'rr-core' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'rr-core' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'rr-core' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'rr-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'rr-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'rr-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'rr-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->rr_button_render('team', 'Button', ['layout-2']);  

    }

    protected function style_tab_content(){
        $this->rr_section_style_controls('team_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('team_title', 'Team Title', '.rr-el-re-Title');
        $this->rr_basic_style_controls('team_desc', 'Team Description', '.rr-el-re-dec');
        $this->rr_section_style_controls('team_box', 'Team Box', '.team-box');
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

<!-- style 2 -->
<?php if ( $settings['rr_design_style'] === 'layout-2' ) :
      $this->add_render_attribute('title_args', 'class', 'main-team__title-wrapper-title rr-el-title');   
    ?>
    <!-- latest-team area start -->
    <section class="latest-team__area overflow-hidden main-team__area section-space rr-el-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-team__title-wrapper text-center mb-40">
                        <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                        <h6 class="main-team__title-wrapper-subtitle rr-el-sub-title" data-wow-delay=".6s">
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
                </div>
            </div>
            <div class="row p-relative mb-minus-30">
                <?php foreach ( $settings['teams'] as $key => $item ) :
                    $title = rr_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);
                    $key = $key+1;
                    if ( !empty($item['image']['url']) ) {
                        $rr_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $rr_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }     
                    $this->add_render_attribute( 'title_team', 'class', 'rr-team-title rr-el-re-Title' );       
                ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="latest-team__item-slide item-3  wow fadeInLeft animated" data-wow-delay=".4s">
                        <div class="latest-team__item-media">
                        <?php if( !empty($item['show_social'] ) ) : ?>
                                    <div class="latest-team__item-media-social d-flex">
                                        <?php if( !empty($item['web_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                                class="fas fa-globe"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['phone_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                                class="fas fa-phone"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['facebook_title'] ); ?>" class="rr-btn"><i
                                                class="fa-brands fa-facebook-f"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['twitter_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['twitter_title'] ); ?>" class="rr-btn"><i
                                                class="fa-brands fa-twitter"></i></a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                        <a href="instagram.com" class="rr-btn"><i
                                                class="fa-brands fa-instagram"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><svg width="18"
                                                height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="htRR://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1999 6.05273C13.4729 6.05273 14.6938 6.58506 15.594 7.53262C16.4942 8.48017 16.9999 9.76532 16.9999 11.1054V17.0001H13.7999V11.1054C13.7999 10.6587 13.6313 10.2303 13.3313 9.91445C13.0312 9.5986 12.6242 9.42116 12.1999 9.42116C11.7756 9.42116 11.3686 9.5986 11.0685 9.91445C10.7685 10.2303 10.5999 10.6587 10.5999 11.1054V17.0001H7.3999V11.1054C7.3999 9.76532 7.90562 8.48017 8.80579 7.53262C9.70596 6.58506 10.9269 6.05273 12.1999 6.05273Z"
                                                    stroke="#54595F" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M4.2 6.89478H1V17H4.2V6.89478Z" stroke="#54595F"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M2.6 4.36842C3.48366 4.36842 4.2 3.61437 4.2 2.68421C4.2 1.75405 3.48366 1 2.6 1C1.71634 1 1 1.75405 1 2.68421C1 3.61437 1.71634 4.36842 2.6 4.36842Z"
                                                    stroke="#54595F" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                                class="fab fa-youtube"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                                class="fab fa-google-plus-g"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                                class="fab fa-flickr"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                                class="fab fa-vimeo-v"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['behance_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                                class="fab fa-behance"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                                class="fab fa-dribbble"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                                class="fab fa-pinterest-p"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                                class="fab fa-github"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                            <div class="latest-team__item-media-img-title title">
                            <?php if( !empty($item['designation']) ) : ?>
                            <h5 class="rr-el-re-dec"><?php echo rr_kses( $item['designation'] ); ?></h5>
                            <?php endif; ?>
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>
                            </div>
                          <div class="latest-item_thumb">
                        <a href="<?php echo esc_url( $item['item_url'] )?>">
                            <?php if(!empty($rr_team_image_url)) : ?>
                            <img src="<?php echo esc_url($rr_team_image_url); ?>"
                                alt="<?php echo esc_attr($rr_team_image_alt); ?>">
                            <?php endif; ?>
                        </a>
                          </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- latest-team area end -->
<?php else : 
    // Link
    if ('2' == $settings['rr_team_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_team_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-black');
    } else {
        if ( ! empty( $settings['rr_team_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_team_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-black');
        }
    }
  $this->add_render_attribute('title_args', 'class', 'title wow fadeInLeft animated rr-el-title');  
?>
<!-- latest-team area start -->
<section class="latest-team__area overflow-hidden section-space latest-team-bg rr-el-section">
    <div class="container">
        <div class="team-top heading-space">
            <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
            <div class="latest-team__title-wrapper">
                <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                <h6 class="subtitle wow fadeInLeft animated rr-el-sub-title" data-wow-delay=".6s">
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
            <div class="latest-team__button-right  wow fadeInRight animated" data-wow-delay=".3s">
                <button class="small-btn  right-icon team__slider-button-prev">
                    <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17L1 9L9 1" stroke="#001D08" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="small-btn team__slider-button-next">
                    <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 17L9 9L1 1" stroke="#001D08" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="row p-relative">
            <div class="col-12">
                <div class="latest-team__item margin-minus-400 mb-30">
                    <div class="swiper card-slide">
                        <div class="swiper-wrapper">
                            <?php foreach ( $settings['teams'] as $key => $item ) :
                                $title = rr_kses( $item['title' ] );
                                $item_url = esc_url($item['item_url']);
                                $key = $key+1;
                                if ( !empty($item['image']['url']) ) {
                                    $rr_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                    $rr_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                }     
                                $this->add_render_attribute( 'title_team', 'class', 'rr-team-title rr-el-re-Title' );       
                            ?>
                            <div class="swiper-slide latest-team__item-slide wow fadeInLeft animated"
                                data-wow-delay=".4s">
                                <div class="latest-team__item-media">
                                    <?php if( !empty($item['show_social'] ) ) : ?>
                                    <div class="latest-team__item-media-social d-flex">
                                        <?php if( !empty($item['web_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                                class="fas fa-globe"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['phone_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                                class="fas fa-phone"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['facebook_title'] ); ?>" class="rr-btn"><i
                                                class="fa-brands fa-facebook-f"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['twitter_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['twitter_title'] ); ?>" class="rr-btn"><i
                                                class="fa-brands fa-twitter"></i></a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                        <a href="instagram.com" class="rr-btn"><i
                                                class="fa-brands fa-instagram"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><svg width="18"
                                                height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="htRR://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.1999 6.05273C13.4729 6.05273 14.6938 6.58506 15.594 7.53262C16.4942 8.48017 16.9999 9.76532 16.9999 11.1054V17.0001H13.7999V11.1054C13.7999 10.6587 13.6313 10.2303 13.3313 9.91445C13.0312 9.5986 12.6242 9.42116 12.1999 9.42116C11.7756 9.42116 11.3686 9.5986 11.0685 9.91445C10.7685 10.2303 10.5999 10.6587 10.5999 11.1054V17.0001H7.3999V11.1054C7.3999 9.76532 7.90562 8.48017 8.80579 7.53262C9.70596 6.58506 10.9269 6.05273 12.1999 6.05273Z"
                                                    stroke="#54595F" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M4.2 6.89478H1V17H4.2V6.89478Z" stroke="#54595F"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M2.6 4.36842C3.48366 4.36842 4.2 3.61437 4.2 2.68421C4.2 1.75405 3.48366 1 2.6 1C1.71634 1 1 1.75405 1 2.68421C1 3.61437 1.71634 4.36842 2.6 4.36842Z"
                                                    stroke="#54595F" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                                class="fab fa-youtube"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                                class="fab fa-google-plus-g"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                                class="fab fa-flickr"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                                class="fab fa-vimeo-v"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['behance_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                                class="fab fa-behance"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                                class="fab fa-dribbble"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                                class="fab fa-pinterest-p"></i></a>
                                        <?php endif; ?>
                                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                                        <a class="rr-el-team-social"
                                            href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                                class="fab fa-github"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="latest-team__item-media-img-title ">
                                        <?php if( !empty($item['designation']) ) : ?>
                                        <h5 class="rr-el-re-dec"><?php echo rr_kses( $item['designation'] ); ?></h5>
                                        <?php endif; ?>
                                        <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                            tag_escape( $settings['title_tag'] ),
                                            $this->get_render_attribute_string( 'title_team' ),
                                            $title,
                                            $item_url
                                        ); ?>
                                    </div>
                                    <div class="latest-item_thumb">
                                        <a href="<?php echo esc_url( $item['item_url'] )?>">
                                            <?php if(!empty($rr_team_image_url)) : ?>
                                            <img src="<?php echo esc_url($rr_team_image_url); ?>"
                                                alt="<?php echo esc_attr($rr_team_image_alt); ?>">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- latest-team area end -->
<?php endif;
    }
}

$widgets_manager->register( new rr_Team() );