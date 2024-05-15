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
 * RR Core
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
        return 'rr-team-details';
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
        return __( 'RR Team Details', 'rr-core' );
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
             '500px' => esc_html__('500px', 'rr-core'),
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

        $this->rr_section_title_render_controls('team', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


        $this->start_controls_section(
         'rr_image_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'rr-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'rr_image',
         [
           'label'   => esc_html__( 'Upload Image', 'rr-core' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'rr-post-thumb',
            ]
        );
        
        $this->end_controls_section();

        // Fact group
        $this->start_controls_section(
            'rr_fact',
            [
                'label' => esc_html__('Contact', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'rr_contact_title',
            [
                'label' => esc_html__('Contact Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Responsibility', 'rr-core'),
                'placeholder' => esc_html__('Contact Title Text', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_contact_des',
            [
                'label' => esc_html__('Contact Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Development', 'rr-core'),
                'placeholder' => esc_html__('Contact Description Text', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
           'rr_contact_list',
           [
             'label'       => esc_html__( 'Contact List', 'rr-core' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
               [
                'rr_contact_title'   => esc_html__( 'Responsibilites', 'rr-core' ),
                'rr_contact_des'   => esc_html__( 'Development', 'rr-core' ),
               ],
               [
                'rr_contact_title'   => esc_html__( 'Email Address', 'rr-core' ),
                'rr_contact_des'   => esc_html__( 'portxinfo@gmail.com', 'rr-core' ),
               ]
             ],
             'title_field' => '{{{ rr_contact_title }}}',
           ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'rr-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'rr-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rr-core'),
                'label_off' => esc_html__('Hide', 'rr-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'rr-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'rr-core'),
                'placeholder' => esc_html__('Add your profile link', 'rr-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'htRRs://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'htRRs://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'htRRs://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function style_tab_content(){
        $this->rr_section_style_controls('about_me_section', 'Section Style', '.ele-section');
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


<?php if ( $settings['rr_design_style']  == 'layout-2' ) : ?>

<?php else:
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image_url = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['thumbnail_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'rr-team-details-name');
?>
<section class="rr-team-details-breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
            <?php if(!empty($rr_image_url)) : ?>
                <div class="rr-team-details-thumb mb-85">
                <img src="<?php echo esc_url($rr_image_url); ?>"
                            alt="<?php echo esc_attr($rr_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-7">
                <div class="rr-team-details-wrapper mb-85">
                    <?php
                        if ( !empty($settings['rr_team_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['rr_team_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                rr_kses( $settings['rr_team_title' ] )
                                );
                        endif;
                    ?>
                        <?php if ( !empty($settings['rr_team_sub_title']) ) : ?>
                        <span class="rr-team-details-description"><?php echo rr_kses( $settings['rr_team_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php if(!empty($settings['rr_team_description' ])) : ?>
                        <p><?php echo rr_kses($settings['rr_team_description']); ?></p>
                        <?php endif; ?>
                    <div class="rr-team-details-information">
                    <?php foreach ($settings['rr_contact_list'] as $key => $item) : ?>
                        <h4>
                            <span><?php echo $item['rr_contact_title'] ? rr_kses($item['rr_contact_title']) : NULL; ?>:</span> <a href="tel:5550115"> <?php echo $item['rr_contact_des'] ? rr_kses($item['rr_contact_des']) : NULL; ?></a>
                        </h4>
                        <?php endforeach; ?>                               
                    </div>
                    <?php if(!empty($settings['show_profiles'])) : ?>
                        <div class="rr-team-details-social">
                            <ul>
                                <?php
                                foreach ($settings['profiles'] as $profile) :
                                    $icon = $profile['name'];
                                    $url = esc_url($profile['link']['url']);
                                    
                                    printf('<li><a target="_blank" rel="noopener"  href="%s" ><i class="fa-brands fa-%s"></i></a></li>',
                                        $url,
                                        esc_attr($icon)
                                    );
                                endforeach; 
                            ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php endif;
    }
}

$widgets_manager->register( new rr_Team_Details() );