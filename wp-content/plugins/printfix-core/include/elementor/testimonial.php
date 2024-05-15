<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use RRCore\Elementor\Controls\Group_Control_RRBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Testimonial extends Widget_Base {

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
		return 'rr-testimonial';
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
		return __( 'Testimonial', 'rr-core' );
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
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2','layout-3']);

        
        // testi shape
        $this->start_controls_section(
            'rr_testi_shape',
                [
                  'label' => esc_html__( 'Testimonial Shape', 'rr-core' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'rr_design_style' => ['layout-2']
                  ]
                ]
           );
   
           $this->add_control(
            'rr_testi_shape_switch',
            [
              'label'        => esc_html__( 'Shape On/Off', 'rr-core' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'rr-core' ),
              'label_off'    => esc_html__( 'Hide', 'rr-core' ),
              'return_value' => 'yes',
              'default'      => '1',
            ]
           );
   
           $this->add_control(
               'rr_bg_image_1',
               [
                   'label' => esc_html__( 'Choose Bg Image', 'rr-core' ),
                   'type' => \Elementor\Controls_Manager::MEDIA,
                   'default' => [
                       'url' => \Elementor\Utils::get_placeholder_image_src(),
                   ]
               ]
           );

           $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                   'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                   'exclude' => ['custom']
               ]
           );
           
           $this->end_controls_section();

        
        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'rr_testimonail_switcher',
            [
                'label' => esc_html__( 'Shap Active', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
                'label_off' => esc_html__( 'No', 'rr-core   ' ),
                'return_value' => 'yes',
                'default' => '0',
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
            'brand_logo',
            [
                'label' => esc_html__('Client Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1','style_2']
                ]

            ]
        );

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'rr-core' ),
            ]
        );

        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'rr-core' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'rr-core' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        // rating
        $repeater->add_control(
            'rr_testi_rating',
            [
                'label' => esc_html__('Select Rating Count', 'rr-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('Single Star', 'rr-core'),
                    '2' => esc_html__('2 Star', 'rr-core'),
                    '3' => esc_html__('3 Star', 'rr-core'),
                    '4' => esc_html__('4 Star', 'rr-core'),
                    '5' => esc_html__('5 Star', 'rr-core'),
                ],
                'default' => '5',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );


        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'rr-core' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'rr-core' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'rr-core' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William 2', 'rr-core' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'rr-core' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'rr-core' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William 3', 'rr-core' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'rr-core' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'rr-core' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'full',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );


        $this->end_controls_section();


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('testimonial_section', 'Section Style', '.ele-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('testimonial_title', 'testimonial Title', '.rr-el-re-Title');
        $this->rr_basic_style_controls('testimonial_desc', 'testimonial Description', '.rr-el-re-dec');
        $this->rr_basic_style_controls('testimonial_designation', 'testimonial Designation', '.rr-el-re-designation');
        $this->rr_section_style_controls('testimonial_box', 'testimonial Box', '.testimonial-box');
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

<!--	testimonial style 3 -->
<?php if ( $settings['rr_design_style']  == 'layout-2' ):
    $this->add_render_attribute('title_args', 'class', 'testimonial-3__title-wrapper-title rr-el-title');   

?>
<!--testimonial-area start -->
<section class="testimonial-3__area feedback-2 position-relative overflow-hidden section-space ele-section">
    <div class="container">
        <div class="testimonial-3__shape-wrapper">
            <div class="testimonial-3__shape-wrapper-bg-shape">
                <img class="upDown"
                    src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/testimonial-3/testmonial-3-bg-shape.svg"
                    alt="img not found">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="testimonial-3__title-wrapper text-center mb-50">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <h6 class="testimonial-3__title-wrapper-subtitle rr-el-sub-title">
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
        <div class="row">
            <div class="col-12">
                <div class="testimonial-3__wrapper feedback-2__wrapper">
                    <div class="swiper testimonial-3__wrapper-active-2 feedback__active-2  wow fadeIn animated"
                        data-wow-delay=".9s">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['reviews_list'] as $index => $item) : 
                                if ( !empty($item['brand_logo']['url']) ) {
                                $rr_brand_logo = !empty($item['brand_logo']['id']) ? wp_get_attachment_image_url( $item['brand_logo']['id'], $settings['thumbnail_size_size']) : $item['brand_logo']['url'];
                                $rr_brand_logo_alt = get_post_meta($item["brand_logo"]["id"], "_wp_attachment_image_alt", true);
                                }
                                ?>
                            <div class="swiper-slide">
                                <div class="testimonial-3__wrapper-item-2 feedback__item-2">
                                    <div
                                        class="testimonial-3__wrapper-item-2-content feedback__item-2-content d-flex mb-sm-35 mb-xs-30">
                                        <div class="testimonial-3__wrapper-item-2-content-right-img">
                                            <img src="<?php echo esc_url($rr_brand_logo); ?>"
                                                alt="<?php echo esc_attr($rr_brand_logo_alt); ?>">
                                        </div>

                                        <div class="content-thumb-social">
                                            <div class="testimonial-3__wrapper-item-2-content-social mb-10">
                                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                                        fill="#FFB016" />
                                                </svg>
                                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                                        fill="#FFB016" />
                                                </svg>
                                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                                        fill="#FFB016" />
                                                </svg>
                                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                                        fill="#FFB016" />
                                                </svg>
                                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                                        fill="#FFB016" />
                                                </svg>
                                            </div>

                                            <?php if ( !empty($item['review_content']) ) : ?>
                                            <p class="testimonial-3__wrapper-item-2-content-description rr-el-re-dec">
                                                <?php echo rr_kses($item['review_content']); ?></p>
                                            <?php endif; ?>

                                            <div
                                                class="testimonial-3__wrapper-item-2-author feedback__item-2-author d-flex align-items-end justify-content-between">
                                                <div class="testimonial-3__wrapper-item-2-author feedback__item-2-info">
                                                    <?php if(!empty($item['reviewer_name']) ) : ?>
                                                    <h4 class="text-capitalize rr-el-re-Title">
                                                        <?php echo rr_kses($item['reviewer_name']); ?></h4>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['reviewer_title'])) : ?>
                                                    <span
                                                        class="rr-el-re-designation"><?php echo rr_kses($item['reviewer_title']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="feedback-2__nav-pre wrapper">
                        <!-- If we need navigation buttons -->
                        <div class="feedback-2__navigation">
                            <button class="feedback-2__slider-button-prev">
                                <svg width="14" height="24" viewBox="0 0 14 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22L2 12L12 2" stroke="#001D08" stroke-opacity="1" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <!-- If we need pagination -->
                            <button class="feedback-2__slider-button-next">
                                <svg width="14" height="24" viewBox="0 0 14 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 22L12 12L2 2" stroke="#001D08" stroke-opacity="1" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--testimonial-area end -->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'testimonial__title-wrapper-title wow fadeInLeft animated rr-el-title');      

?>
<!-- latest-testimonial area start -->
<section class="testimonial__area overflow-hidden section-space p-relative ele-section" data-bg-color="#fff">
    <div class="container">
        <?php if ( !empty($settings['rr_testimonail_switcher']) ) : ?>
        <div class="testimonial__big-dotted-shape">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/testimonial/big-dotted.svg"
                alt="img not found">
        </div>
        <div class="testimonial__bg-shape">
            <img class="upDown" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/testimonial/bg-shape.svg"
                alt="img not found">
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-12">
                <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="testimonial__title-wrapper text-center mb-40">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <h6 class="testimonial__title-wrapper-subtitle wow fadeInLeft animated rr-el-sub-title"
                        data-wow-delay=".2s">
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
        <div class="row">
            <div class="col-xl-12">
                <div class="testi-carousel-wrap text-center">
                    <div class="testi-thumb-wrap">
                        <div class="swiper thumb-carousel">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) : 
                                    if ( !empty($item['brand_logo']['url']) ) {
                                    $rr_brand_logo = !empty($item['brand_logo']['id']) ? wp_get_attachment_image_url( $item['brand_logo']['id'], $settings['thumbnail_size_size']) : $item['brand_logo']['url'];
                                    $rr_brand_logo_alt = get_post_meta($item["brand_logo"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="testi-thumb">
                                        <img src="<?php echo esc_url($rr_brand_logo); ?>"
                                            alt="<?php echo esc_attr($rr_brand_logo_alt); ?>">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="swiper content-carousel">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['reviews_list'] as $index => $item) : 
                            if ( !empty($item['brand_logo']['url']) ) {
                            $rr_brand_logo = !empty($item['brand_logo']['id']) ? wp_get_attachment_image_url( $item['brand_logo']['id'], $settings['thumbnail_size_size']) : $item['brand_logo']['url'];
                            $rr_brand_logo_alt = get_post_meta($item["brand_logo"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="testimonial__content">
                                    <?php if ( !empty($item['review_content']) ) : ?>
                                    <p class="rr-el-re-dec"><?php echo rr_kses($item['review_content']); ?></p>
                                    <?php endif; ?>
                                    <div class="testimonial__content-title">
                                        <?php if(!empty($item['reviewer_name']) ) : ?>
                                        <h4 class="rr-testimonial-title rr-el-re-Title">
                                            <?php echo rr_kses($item['reviewer_name']); ?></h4>
                                        <?php endif; ?>

                                        <?php if(!empty($item['reviewer_title'])) : ?>
                                        <h6 class="rr-el-re-designation"><?php echo rr_kses($item['reviewer_title']); ?>
                                        </h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="testimonial-buttons d-flex justify-content-between">
                            <div class="testimonial-prev"><i class="fa-solid fa-angle-left"></i></div>
                            <div class="testimonial-next"><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- latest-testimonial area end -->
<?php endif; 
	}
}

$widgets_manager->register( new rr_Testimonial() );