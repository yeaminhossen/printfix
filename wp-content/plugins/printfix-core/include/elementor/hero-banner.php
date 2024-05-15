<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
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
class rr_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'rr-core' );
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
                    'layout-2' => esc_html__('Layout 2', 'rr-core')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->rr_section_title_render_controls('banner', 'Banner Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4','layout-5']);
        // button
        $this->rr_button_render('banner', 'Button', ['layout-1', 'layout-2']);
    
        // banner shape
        $this->start_controls_section(
         'rr_banner_shape',
             [
               'label' => esc_html__( 'Hero Shape', 'rr-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
         
        );

        $this->add_control(
         'rr_banner_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'rr-core' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'rr-core' ),
           'label_off'    => esc_html__( 'Hide', 'rr-core' ),
           'return_value' => 'yes',
           'default'      => '0',
         ]
        );
        $this->end_controls_section();


        // thumbnail image
        $this->start_controls_section(
        'rr_thumbnail_section',
            [
                'label' => esc_html__( 'Thumbnail', 'rr-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'rr_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Thumbnail Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'rr_thumbnail_image2',
            [
                'label' => esc_html__( 'Choose Thumbnail 2', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'rr_thumbnail_image3',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 3', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // hero slider
        $this->start_controls_section(
            'rr-core_hero_sider_area',
            [
                'label' => esc_html__('Hero Slider Area', 'rr-core'),
                'condition' => [
                    'rr_design_style' => 'layout-4'
                ]
            ]
        );

        // repeter field with text 
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'rr-core_hero_slider_title',
            [
                'label'       => esc_html__( 'Title', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Title', 'rr-core' ),
                'placeholder' => esc_html__( 'Your Title Text', 'rr-core' ),
                'description' => 'Type Your Title In This Field',
                'label_block' => true,
            ]
        );


        $this->add_control(
            'rr-core_hero_slider_list',
            [
                'label' => esc_html__( 'Hero Slider List', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'rr_banner_video',
                [
                  'label' => esc_html__( 'Hero Video', 'rr-core' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'rr_design_style' => 'layout-1'
                ]
                ]
            
           );
   
           $this->add_control(
            'rr_core_video_title',
            [
                'label'       => esc_html__( 'Title', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Watch Video', 'rr-core' ),
                'description' => 'Type Your Video Title',
                'label_block' => true,
            ]
        );
           $this->add_control(
            'rr_core_video_url',
            [
                'label'       => esc_html__( 'Url', 'rr-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '#', 'rr-core' ),
                'description' => 'Type Your Video Url',
                'label_block' => true,
            ]
        );
           $this->end_controls_section();

       
	}
    

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('banner_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('banner_dec', 'banner Description', '.rr-el-desc');
        $this->rr_link_controls_style('repiter_btn', 'banner - Button', '.rr-el-btn');
        $this->rr_basic_style_controls('video_text', 'Video Text', '.rr-el-video-text');
        $this->rr_link_controls_style('video_btn', 'video - Button', '.rr-el-video-btn');
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

   // thumbnail image
   if ( !empty($settings['rr_thumbnail_image']['url']) ) {
    $rr_thumbnail_image = !empty($settings['rr_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image']['url'];
    $rr_thumbnail_image_alt = get_post_meta($settings["rr_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
}
// thumbnail image2
if ( !empty($settings['rr_thumbnail_image2']['url']) ) {
    $rr_thumbnail_image2 = !empty($settings['rr_thumbnail_image2']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image2']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image2']['url'];
    $rr_thumbnail_image_alt2 = get_post_meta($settings["rr_thumbnail_image2"]["id"], "_wp_attachment_image_alt", true);
}
// thumbnail image2
if ( !empty($settings['rr_thumbnail_image3']['url']) ) {
    $rr_thumbnail_image3 = !empty($settings['rr_thumbnail_image3']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image3']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image3']['url'];
    $rr_thumbnail_image_alt3 = get_post_meta($settings["rr_thumbnail_image3"]["id"], "_wp_attachment_image_alt", true);
}
    
  
    // Link
    if ('2' == $settings['rr_banner_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_banner_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn wow rrfadeUp rr-el-btn');
    } else {
        if ( ! empty( $settings['rr_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_banner_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn wow rrfadeUp rr-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'rr-hero-3-title wow rrfadeUp rr-el-title');

?>
<!-- hero area start -->
<section class="rr-hero-3-area  rr-hero-3-bg-color pt-145 p-relative rr-el-section">
<?php if(!empty($settings['rr_banner_shape_switch'])) : ?>
    <div class="rr-hero-shap d-none d-xl-block">
        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/full.png" alt="">
    </div>
    <div class="rr-hero-shap-full-2 d-none d-xl-block">
        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/full-2.png" alt="">
    </div>
    <div class="rr-hero-shap-full-3 d-none d-xl-block">
        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/full-3.png" alt="">
    </div>
    <div class="rr-hero-shap-full-4 d-none d-xl-block">
        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/full-4.png" alt="">
    </div>
    <?php endif; ?>
    <div class="container ">
        <div class="row ">
            <div class="col-xl-12 col-12">
                <div class="rr-hero-3-info text-center">
                    <?php if ( !empty($settings['rr_banner_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_banner_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_banner_title' ] )
                                );
                        endif; ?>
                    <?php if ( !empty($settings['rr_banner_btn_text']) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_banner_btn_text']); ?>
                            <i class="fa-solid fa-arrow-right"></i></span></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row p-relative">
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <div class="rr-hero-3-lr-thumb ">
                        <?php if(!empty($rr_thumbnail_image2)) : ?>
                        <div class="rr-hero-3-lr-img text-center">
                            <img src="<?php echo esc_url($rr_thumbnail_image2); ?>"
                                alt="<?php echo esc_url($rr_thumbnail_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <div class="rr-hero-3-md-thumb ">
                        <?php if(!empty($rr_thumbnail_image)) : ?>
                        <div class="rr-hero-3-md-img text-center">
                            <img src="<?php echo esc_url($rr_thumbnail_image); ?>"
                                alt="<?php echo esc_url($rr_thumbnail_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <div class="rr-hero-3-rl-thumb">
                        <?php if(!empty($rr_thumbnail_image3)) : ?>
                        <div class="rr-hero-3-rl-img text-center">
                            <img src="<?php echo esc_url($rr_thumbnail_image3); ?>"
                                alt="<?php echo esc_url($rr_thumbnail_image_alt3); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero area end -->

<?php else:

    // thumbnail image
    if ( !empty($settings['rr_thumbnail_image']['url']) ) {
        $rr_thumbnail_image = !empty($settings['rr_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image']['url'];
        $rr_thumbnail_image_alt = get_post_meta($settings["rr_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // thumbnail image2
    if ( !empty($settings['rr_thumbnail_image2']['url']) ) {
        $rr_thumbnail_image2 = !empty($settings['rr_thumbnail_image2']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image2']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image2']['url'];
        $rr_thumbnail_image_alt2 = get_post_meta($settings["rr_thumbnail_image2"]["id"], "_wp_attachment_image_alt", true);
    }
    // thumbnail image2
    if ( !empty($settings['rr_thumbnail_image3']['url']) ) {
        $rr_thumbnail_image3 = !empty($settings['rr_thumbnail_image3']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image3']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image3']['url'];
        $rr_thumbnail_image_alt3 = get_post_meta($settings["rr_thumbnail_image3"]["id"], "_wp_attachment_image_alt", true);
    }
        
    $this->add_render_attribute('title_args', 'class', 'rr-hero-title wow rrfadeUp rr-el-title');
    // Link
    if ('2' == $settings['rr_banner_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_banner_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-btn');
    } else {
        if ( ! empty( $settings['rr_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_banner_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-btn');
        }
    }

?>
<!-- hero area start -->
<section class="rr-hero-area rr-hero-bg pt-120 pb-120 p-relative rr-el-section">
    <?php if(!empty($settings['rr_banner_shape_switch'])) : ?>
    <div class="rr-hero-main-shap">
        <div class="rr-hero-shap-1 d-none d-xxl-block">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/shap.png" alt="">
        </div>
        <div class="rr-hero-shap-2">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/shape2.png" alt="">
        </div>
        <div class="rr-hero-shap-3">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/shape3.png" alt="">
        </div>
        <div class="rr-hero-shap-4">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/shape4.png" alt="">
        </div>
    </div>
    <?php endif; ?>
    <div class="rr-hero-main-wrap">
        <div class="container">
            <div class="row gx-30">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="rr-hero-banner">
                        <?php if ( !empty($settings['rr_banner_sub_title' ]) ) : ?>
                        <h6 class="rr-hero-subtitle wow rrfadeUp rr-el-sub-title" data-wow-duration=".9s"
                            data-wow-delay=".3s">
                            <?php echo rr_kses($settings['rr_banner_sub_title']); ?></h6>
                        <?php endif; ?>
                        <?php if ( !empty($settings['rr_banner_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['rr_banner_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        rr_kses( $settings['rr_banner_title' ] )
                                        );
                                endif; ?>
                        <?php if ( !empty($settings['rr_banner_description' ]) ) : ?>
                        <p class=" wow rrfadeUp rr-el-desc" data-wow-duration=".9s" data-wow-delay=".7s">
                            <?php echo rr_kses($settings['rr_banner_description']); ?></p>
                        <?php endif; ?>
                        <div class="rr-hero-banner-info d-flex align-items-center ">
                            <div class="rr-hero-banner-btn mr-35 wow rrfadeUp" data-wow-duration=".9s"
                                data-wow-delay=".9s">
                                <?php if ( !empty($settings['rr_banner_btn_text']) ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_banner_btn_text']); ?>
                                        <i class="fa-solid fa-arrow-right"></i></span></a>
                                <?php endif; ?>
                            </div>
                            <div class="rr-hero-banner-play d-flex align-items-center wow rrfadeUp"
                                data-wow-duration=".9s" data-wow-delay=".9s">
                                <div class="rr-hero-banner-play z-index-2">
                                    <span><a class="popup-video rr-el-video-btn "
                                            href="<?php echo esc_url($settings['rr_core_video_url']);?>"><i
                                                class="fa-sharp fa-regular fa-play"></i></a></span>
                                </div>
                                <?php if(!empty($settings['rr_core_video_title'])) : ?>
                                <div class="rr-hero-banner-text">
                                    <b><a class="popup-video rr-el-video-text"
                                            href="<?php echo esc_url($settings['rr_core_video_url']);?>"><?php echo rr_kses($settings['rr_core_video_title']);?></a></b>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-12 p-relative">
                    <div class="rr-hero-thumb text-end">
                        <?php if(!empty($settings['rr_banner_shape_switch'])) : ?>
                        <div class="rr-hero-banner-shap">
                            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/camera.png" alt="">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($rr_thumbnail_image)) : ?>
                        <div class="rr-hero-main-thumb wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                            <img src="<?php echo esc_url($rr_thumbnail_image); ?>"
                                alt="<?php echo esc_url($rr_thumbnail_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($rr_thumbnail_image2)) : ?>
                        <div class="rr-hero-sm d-none d-xxl-block wow rrfadeRight" data-wow-duration=".9s"
                            data-wow-delay=".3s">
                            <img src="<?php echo esc_url($rr_thumbnail_image2); ?>"
                                alt="<?php echo esc_url($rr_thumbnail_image_alt2); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="rr-hero-border-img wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                            <?php if(!empty($rr_thumbnail_image3)) : ?>
                            <div class="rr-hero-md d-none d-md-block">
                                <img src="<?php echo esc_url($rr_thumbnail_image3); ?>"
                                    alt="<?php echo esc_url($rr_thumbnail_image_alt3); ?>">
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($rr_thumbnail_image3)) : ?>
                            <div class="rr-hero-border-full">
                                <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/img-full.png"
                                    alt="">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero area end -->
<?php endif; 
		
	}
}


$widgets_manager->register( new rr_Hero_Banner() );