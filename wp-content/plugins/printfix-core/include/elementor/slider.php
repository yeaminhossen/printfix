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
class rr_Slider extends Widget_Base {

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
		return 'rr-slider';
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
		return __( 'Slider', 'rr-core' );
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


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'rr-core'),
            'behance' => esc_html__('Behance', 'rr-core'),
            'bitbucket' => esc_html__('BitBucket', 'rr-core'),
            'codepen' => esc_html__('CodePen', 'rr-core'),
            'delicious' => esc_html__('Delicious', 'rr-core'),
            'deviantart' => esc_html__('DeviantArt', 'rr-core'),
            'digg' => esc_html__('Digg', 'rr-core'),
            'dribbble' => esc_html__('Dribbble', 'rr-core'),
            'email' => esc_html__('Email', 'rr-core'),
            'facebook' => esc_html__('Facebook', 'rr-core'),
            'flickr' => esc_html__('Flicker', 'rr-core'),
            'foursquare' => esc_html__('FourSquare', 'rr-core'),
            'github' => esc_html__('Github', 'rr-core'),
            'houzz' => esc_html__('Houzz', 'rr-core'),
            'instagram' => esc_html__('Instagram', 'rr-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'rr-core'),
            'linkedin' => esc_html__('LinkedIn', 'rr-core'),
            'medium' => esc_html__('Medium', 'rr-core'),
            'pinterest' => esc_html__('Pinterest', 'rr-core'),
            'product-hunt' => esc_html__('Product Hunt', 'rr-core'),
            'reddit' => esc_html__('Reddit', 'rr-core'),
            'slideshare' => esc_html__('Slide Share', 'rr-core'),
            'snapchat' => esc_html__('Snapchat', 'rr-core'),
            'soundcloud' => esc_html__('SoundCloud', 'rr-core'),
            'spotify' => esc_html__('Spotify', 'rr-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'rr-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'rr-core'),
            'tumblr' => esc_html__('Tumblr', 'rr-core'),
            'twitch' => esc_html__('Twitch', 'rr-core'),
            'twitter' => esc_html__('Twitter', 'rr-core'),
            'vimeo' => esc_html__('Vimeo', 'rr-core'),
            'vk' => esc_html__('VK', 'rr-core'),
            'website' => esc_html__('Website', 'rr-core'),
            'whatsapp' => esc_html__('WhatsApp', 'rr-core'),
            'wordpress' => esc_html__('WordPress', 'rr-core'),
            'xing' => esc_html__('Xing', 'rr-core'),
            'yelp' => esc_html__('Yelp', 'rr-core'),
            'youtube' => esc_html__('YouTube', 'rr-core'),
        ];
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

		
		$this->start_controls_section(
            'rr_main_slider',
            [
                'label' => esc_html__('Main Slider', 'rr-core'),
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
            'rr_slider_image',
            [
                'label' => esc_html__('Upload Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'rr_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Subtitle',
                'placeholder' => esc_html__('Type Before Heading Text', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_slider_title',
            [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Grow business.', 'rr-core'),
                'placeholder' => esc_html__('Type Heading Text', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'rr-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'rr-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'rr-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'rr-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'rr-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'rr-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'rr-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'rr_slider_description',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'rr-core'),
                'placeholder' => esc_html__('Type section description here', 'rr-core'),
            ]
        );

        
		$repeater->add_control(
            'rr_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rr-core' ),
                'label_off' => esc_html__( 'No', 'rr-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'rr_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'rr-core'),
                'title' => esc_html__('Enter button text', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_btn_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'rr_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_btn_link_switcher' => 'yes',
                ]
            ]
        );
        
        $repeater->add_control(
            'rr_btn_link',
            [
                'label' => esc_html__( 'Button Link link', 'rr-core' ),
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
                    'rr_btn_link_type' => '1',
                    'rr_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'rr_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_btn_link_type' => '2',
                    'rr_btn_link_switcher' => 'yes',
                ]
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
        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_slider_title' => esc_html__('Grow business.', 'rr-core')
                    ],
                    [
                        'rr_slider_title' => esc_html__('Development.', 'rr-core')
                    ],
                    [
                        'rr_slider_title' => esc_html__('Marketing.', 'rr-core')
                    ],
                ],
                'title_field' => '{{{ rr_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'rr-portfolio-thumb',
            ]
        );
        $this->end_controls_section();

        
	}

    
    protected function style_tab_content(){
        $this->rr_section_style_controls('banner_section', 'Section Style', '.ele-section');
        $this->rr_basic_style_controls('banner_sub_title', 'Sub Heading Style', '.ele-sub-heading');
        $this->rr_basic_style_controls('banner_title', 'Heading Style', '.ele-heading');
        $this->rr_link_controls_style('banner_btn_1', 'Button Style 1', '.ele-btn-1');
    }

	/**
	 * Render the widget ouRRut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *Video Youtube link

	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

<?php if ( $settings['rr_design_style']  == 'layout-2' ): ?>



<?php else: 
?>
<!-- hreo area start -->
<section class="rr-hero-2-area p-relative fix ele-section">
    <div class="swiper main-slider-active">
        <div class="swiper-wrapper">
            <?php foreach ($settings['slider_list'] as $key => $item) : 
                $this->add_render_attribute('title_args', 'class', 'rr-hero-title2 ele-heading');

                if ( !empty($item['rr_slider_image']['url']) ) {
                    $rr_slider_image = !empty($item['rr_slider_image']['id']) ? wp_get_attachment_image_url( $item['rr_slider_image']['id'], $settings['thumbnail_size']) : $item['rr_slider_image']['url'];
                    $rr_slider_image_alt = get_post_meta($item["rr_slider_image"]["id"], "_wp_attachment_image_alt", true);
                }

                  // btn Link
                    if ('2' == $item['rr_btn_link_type']) {
                        $link = get_permalink($item['rr_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['rr_btn_link']['url']) ? $item['rr_btn_link']['url'] : '';
                        $target = !empty($item['rr_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['rr_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
            <div class="swiper-slide  rr-hero-space" data-background="<?php echo esc_url($rr_slider_image); ?>">
                <div class="container">
                    <div class="row"> 
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="rr-hero-2-content text-center p-relative">
                                <div class="rr-hero-shape">
                                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/vector.png"
                                        alt="img">
                                </div>
                                <div class="rr-hero-shape2">
                                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/vector-02.png"
                                        alt="img">
                                </div>
                                <?php if (!empty($item['rr_slider_sub_title'])) : ?>
                                <h4 class="ele-sub-heading"><?php echo rr_kses( $item['rr_slider_sub_title'] ); ?></h4>
                                <?php endif; ?>
                                <?php
                                    if ($item['rr_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['rr_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            rr_kses($item['rr_slider_title'])
                                        );
                                    endif; ?>
                                <div class="rr-hero-btn">
                                    <a class="rr-btn ele-btn-1"
                                        href="<?php echo esc_url($link); ?>"><span><?php echo rr_kses($item['rr_btn_btn_text']);?></span>
                                        <i class="fa-sharp fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                </div>
                <?php if( !empty($item['show_social'] ) ) : ?>
                <div class="rr-hero-social">
                    <ul>
                        <li> <?php if( !empty($item['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['facebook_title'] ); ?>">
                                <svg width="11" height="18" viewBox="0 0 11 18" fill="none"
                                    xmlns="htRR://www.w3.org/2000/svg">
                                    <path
                                        d="M10 1H7.54545C6.46048 1 5.41994 1.42143 4.65274 2.17157C3.88555 2.92172 3.45455 3.93913 3.45455 5V7.4H1V10.6H3.45455V17H6.72727V10.6H9.18182L10 7.4H6.72727V5C6.72727 4.78783 6.81347 4.58434 6.96691 4.43431C7.12035 4.28429 7.32846 4.2 7.54545 4.2H10V1Z"
                                        stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                            <?php endif; ?>
                        </li>
                        <li> <?php  if( !empty($item['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['twitter_title'] ); ?>">
                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                    xmlns="htRR://www.w3.org/2000/svg">
                                    <path
                                        d="M19 1.00897C18.2165 1.61128 17.349 2.07195 16.4309 2.37324C15.9382 1.75576 15.2833 1.3181 14.5548 1.11947C13.8264 0.920833 13.0596 0.970799 12.3581 1.26261C11.6565 1.55442 11.0542 2.07399 10.6324 2.75105C10.2107 3.42812 9.98993 4.23001 10 5.04827V5.93995C8.56215 5.98058 7.13741 5.63305 5.85264 4.92829C4.56788 4.22354 3.46299 3.18345 2.63636 1.90065C2.63636 1.90065 -0.636364 9.92575 6.72727 13.4925C5.04225 14.739 3.03495 15.364 1 15.2758C8.36364 19.7342 17.3636 15.2758 17.3636 5.02152C17.3629 4.77315 17.341 4.52539 17.2982 4.28143C18.1332 3.38395 18.7225 2.25082 19 1.00897Z"
                                        stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                            <?php endif; ?>
                        </li>
                        <li> <?php if( !empty($item['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="htRR://www.w3.org/2000/svg">
                                    <path
                                        d="M12.1999 6.05264C13.4729 6.05264 14.6938 6.58497 15.594 7.53252C16.4942 8.48008 16.9999 9.76523 16.9999 11.1053V17H13.7999V11.1053C13.7999 10.6586 13.6313 10.2302 13.3313 9.91436C13.0312 9.59851 12.6242 9.42106 12.1999 9.42106C11.7756 9.42106 11.3686 9.59851 11.0685 9.91436C10.7685 10.2302 10.5999 10.6586 10.5999 11.1053V17H7.3999V11.1053C7.3999 9.76523 7.90562 8.48008 8.80579 7.53252C9.70596 6.58497 10.9269 6.05264 12.1999 6.05264Z"
                                        stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M4.2 6.89474H1V17H4.2V6.89474Z" stroke="#051145" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M2.6 4.36842C3.48366 4.36842 4.2 3.61437 4.2 2.68421C4.2 1.75405 3.48366 1 2.6 1C1.71634 1 1 1.75405 1 2.68421C1 3.61437 1.71634 4.36842 2.6 4.36842Z"
                                        stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg></a>
                            <?php endif; ?>
                        </li>
                        <li> <?php if( !empty($item['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['instagram_title'] ); ?>">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="htRR://www.w3.org/2000/svg">
                                    <path
                                        d="M13 1H5C2.79086 1 1 2.79086 1 5V13C1 15.2091 2.79086 17 5 17H13C15.2091 17 17 15.2091 17 13V5C17 2.79086 15.2091 1 13 1Z"
                                        stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.1999 8.496C12.2986 9.16179 12.1849 9.84177 11.8749 10.4392C11.5649 11.0366 11.0744 11.5211 10.4732 11.8237C9.87195 12.1263 9.19062 12.2317 8.52609 12.1247C7.86156 12.0178 7.24767 11.7041 6.77173 11.2281C6.2958 10.7522 5.98205 10.1383 5.87512 9.47377C5.76819 8.80924 5.87352 8.12791 6.17612 7.5267C6.47873 6.92548 6.96321 6.43499 7.56065 6.12499C8.15809 5.81499 8.83807 5.70127 9.50386 5.8C10.183 5.9007 10.8117 6.21717 11.2972 6.70264C11.7827 7.18812 12.0992 7.81686 12.1999 8.496Z"
                                        stroke="#051145" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M13.3999 4.60001H13.4079" stroke="#051145" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="rr-hero-counter">
                    <span>0<?php echo ($key+1); ?>/03</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="rr-hero-arrow-box">
            <button class="swiper-button-next">
                <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/arrow-top.png" alt="">
            </button>
            <button class="swiper-button-prev">
                <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/hero/arrow-bottom.png" alt="">
            </button>
        </div>
        <div class="swiper-pagination">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

</section>
<!-- hero area end -->


<?php endif; 
		
	}

}

$widgets_manager->register( new rr_Slider() );