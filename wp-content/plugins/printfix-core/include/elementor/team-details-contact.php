<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * rr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Team_Details extends Widget_Base {

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
        return 'rr-team-details-contact';
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
        return __( 'Team Details Contact', 'rr-core' );
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
            'facebook-f' => esc_html__('Facebook', 'rr-core'),
            'flickr' => esc_html__('Flicker', 'rr-core'),
            'foursquare' => esc_html__('FourSquare', 'rr-core'),
            'github' => esc_html__('Github', 'rr-core'),
            'houzz' => esc_html__('Houzz', 'rr-core'),
            'instagram' => esc_html__('Instagram', 'rr-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'rr-core'),
            'linkedin-in' => esc_html__('LinkedIn', 'rr-core'),
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

        // rr_section_title
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2']);



        // Team Extra Info
        $this->start_controls_section(
            'rr_info_sec',
            [
                'label' => esc_html__('Team Extra Info', 'rr-core'),
            ]
        );
        $this->add_control(
            'rr_team_bio',
            [
                'label' => esc_html__('Bio', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('bio', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Member Image', 'rr-core' ),
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

        $this->add_control(
            'rr_team_phone',
            [
                'label' => esc_html__('Phone', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+880 17823-63794', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_team_phone_url',
            [
                'label' => esc_html__('Phone Url', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+8801782363794', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_team_email',
            [
                'label' => esc_html__('Email', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('info@themepure.com', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_team_email_url',
            [
                'label' => esc_html__('Email Url', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('info@themepure.com', 'rr-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_team_website',
            [
                'label' => esc_html__('Website', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('rrdevs.net', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_team_website_url',
            [
                'label' => esc_html__('Website Url', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'rr_skill_sec',
            [
                'label' => esc_html__('Team Details Items', 'rr-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

         // icon image svg

         $repeater->add_control(
            'rr_box_icon_type',
            [
                'label' => esc_html__('Select Country Image Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ]
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
                    'rr_box_icon_type' => 'image'
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
            'rr_items_title_list',
            [
                'label' => esc_html__('Items', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_team_items_title' => esc_html__('Research beyond the business plan', 'rr-core'),
                    ],
                    [
                        'rr_team_items_title' => esc_html__('Marketing options and rates', 'rr-core')
                    ],
                    [
                        'rr_team_items_title' => esc_html__('The ability to turnaround consulting', 'rr-core')
                    
                    ]
                ],
                'title_field' => '{{{ rr_team_items_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content(){
        $this->rr_section_style_controls('comint_section', 'Section - Style', '.rr-el-section');
    }

    /**
     * Render the widget ourrut on the frontend.
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


<?php if ( $settings['rr_design_style']  == 'layout-2' ) : ?>



<?php else :
    // thumbnail image
    if ( !empty($settings['rr_thumbnail_image']['url']) ) {
        $rr_thumbnail_image = !empty($settings['rr_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image']['url'];
        $rr_thumbnail_image_alt = get_post_meta($settings["rr_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_thumbnail_image_2']['url']) ) {
        $rr_thumbnail_image_2 = !empty($settings['rr_thumbnail_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image_2']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image_2']['url'];
        $rr_thumbnail_image_2_alt = get_post_meta($settings["rr_thumbnail_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'rr-team-details-title');  
?>
<!-- team details area srat -->
<section class="team-detals-area pt-120 pb-60 fix">
    <div class="container">
        <div class="rr-team-details-head">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                    <div class="rr-team-details-avatar-wrap">
                        <div class="rr-team-details-thumb">
                            <?php  if ( !empty($rr_thumbnail_image) ) : ?>
                            <img src="<?php echo esc_url($rr_thumbnail_image); ?>"
                                alt="<?php echo esc_attr($rr_thumbnail_image_alt); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                    <div class="rr-team-details-avatar">
                        <?php if ( !empty($settings['rr_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['rr_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_section_title' ] )
                        );
                    endif;  ?>
                        <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                        <span class="mb-30"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['rr_team_bio']) ) : ?>
                        <h5><?php echo rr_kses($settings['rr_team_bio']);?></h5>
                        <?php endif; ?>
                        <?php if ( !empty($settings['rr_section_description']) ) : ?>
                        <p><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
                        <?php endif; ?>
                        <div class="rr-team-details-avatar-list mb-35">
                            <ul>
                                <?php  if ( !empty($settings['rr_team_phone']) ) : ?>
                                <li><span>Phone :</span><a class="ml-20"
                                        href="tel:<?php echo esc_attr( $settings['rr_team_phone_url'] ); ?>"><?php echo rr_kses( $settings['rr_team_phone'] ); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php  if ( !empty($settings['rr_team_email']) ) : ?>
                                <li><span>Email :</span><a class="ml-25"
                                        href="mailto:<?php echo esc_attr( $settings['rr_team_email_url'] ); ?>"><?php echo rr_kses( $settings['rr_team_email'] ); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php  if ( !empty($settings['rr_team_email']) ) : ?>
                                <li><span>Website : </span><a
                                        href="<?php echo esc_url($settings['rr_team_website_url']);?>"><?php echo rr_kses($settings['rr_team_website']);?></a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="rr-team-details-avatar-social">
                            <?php if ( !empty($settings['rr_items_title_list']) ) : 
                                foreach ($settings['rr_items_title_list'] as $item) : ?>
                            <a href="#">
                                <?php if($item['rr_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
                                <?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?>
                                <?php endif; ?>
                                <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
                                <img src="<?php echo $item['rr_box_icon_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($item['rr_box_icon_svg'])): ?>
                                <?php echo $item['rr_box_icon_svg']; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </a>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- team details area end -->

<div class="rr-register__area pt-115 pb-120 d-none">
    <div class="container">
        <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="rr-register__section-title pb-25">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <span class="rr-section-subtitle"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php if ( !empty($settings['rr_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['rr_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_section_title' ] )
                        );
                    endif;  ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="rr-register__left-box">
                    <div class="rr-register__thumb pb-25 d-flex justify-content-between">
                        <?php  if ( !empty($rr_thumbnail_image) ) : ?>
                        <img src="<?php echo esc_url($rr_thumbnail_image); ?>"
                            alt="<?php echo esc_attr($rr_thumbnail_image_alt); ?>">
                        <?php endif; ?>
                        <?php  if ( !empty($rr_thumbnail_image_2) ) : ?>
                        <img src="<?php echo esc_url($rr_thumbnail_image_2); ?>"
                            alt="<?php echo esc_attr($rr_thumbnail_image_2_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="rr-register__text">
                        <?php if ( !empty($settings['rr_section_description']) ) : ?>
                        <p class="pb-20"><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
                        <?php endif; ?>
                        <div class="rr-register__list">
                            <ul>
                                <?php if ( !empty($settings['rr_items_title_list']) ) : 
                                foreach ($settings['rr_items_title_list'] as $item) : ?>
                                <li>
                                    <?php if($item['rr_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
                                    <?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['rr_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['rr_box_icon_svg'])): ?>
                                    <?php echo $item['rr_box_icon_svg']; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($item['rr_team_items_title'])): ?>
                                    <?php echo rr_kses( $item['rr_team_items_title'] ); ?>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="rr-register__tel-box d-flex align-items-center">
                        <div class="rr-register__tel-icon">
                            <span>
                                <?php if($settings['rr_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['rr_box_icon']) || !empty($settings['rr_box_selected_icon']['value'])) : ?>
                                <?php rr_render_icon($settings, 'rr_box_icon', 'rr_box_selected_icon'); ?>
                                <?php endif; ?>
                                <?php elseif( $settings['rr_box_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($settings['rr_box_icon_image']['url'])): ?>
                                <img src="<?php echo $settings['rr_box_icon_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($settings['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($settings['rr_box_icon_svg'])): ?>
                                <?php echo $settings['rr_box_icon_svg']; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="rr-register__tel-text">
                            <?php  if ( !empty($settings['rr_team_phone']) ) : ?>
                            <a class="number"
                                href="tel:<?php echo esc_attr( $settings['rr_team_phone_url'] ); ?>"><?php echo rr_kses( $settings['rr_team_phone'] ); ?></a>
                            <?php endif; ?>
                            <?php  if ( !empty($settings['rr_team_email']) ) : ?>
                            <a
                                href="mailto:<?php echo esc_attr( $settings['rr_team_phone_url'] ); ?>"><?php echo rr_kses( $settings['rr_team_email'] ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="rr-register__form-box">
                    <?php if( !empty($settings['rr-core_select_contact_form']) ) : ?>
                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['rr-core_select_contact_form'].'"]' ); ?>
                    <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'rr-core' ). '</p></div>'; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; 
    }
}

$widgets_manager->register( new rr_Team_Details() );