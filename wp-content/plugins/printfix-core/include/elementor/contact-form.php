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
class rr_Contact_Form extends Widget_Base {

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
		return 'contact-form';
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
		return __( 'Contact Form', 'rr-core' );
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
         * contact form 7 setup.
         *
         * Adds different input fields to allow the user to change and customize the widget settings.
         *
         * @since 1.0.0
         *
         * @access protected
         */

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
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2', 'layout-3']);

        // social info


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

        $this->start_controls_section(
            'rr-core_contact_thumb',
            [
                'label' => esc_html__('Contact Form Thumb', 'rr-core'),
            ]
        );

        $this->add_control(
            'rr_image_box',
            [
                'label'   => esc_html__( 'Image', 'rr-core' ),
                'type'    => Controls_Manager::MEDIA,
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

        $this->end_controls_section();
        

	}

    protected function style_tab_content(){
        $this->rr_section_style_controls('comint_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('contact_subtitle', 'contact - Sub Title', '.rr-el-subtitle');
        $this->rr_basic_style_controls('contact_desc', 'contact - Description', '.rr-el-desc');
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
    $this->add_render_attribute('title_args', 'class', 'rr-section-title pb-10 rr-el-title');
    if ( !empty($settings['rr_image_box']['url']) ) {
        $rr_image = !empty($settings['rr_image_box']['id']) ? wp_get_attachment_image_url( $settings['rr_image_box']['id'], $settings['rr_image_size_size']) : $settings['rr_image_box']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image_box"]["id"], "_wp_attachment_image_alt", true);
    }
    
    $this->add_render_attribute('title_args', 'class', 'rr-section-title');
?>
<div class="rr-contact__comment-form-box rr-el-section">
    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
    <h3 class="rr-contact__title wow rrfadeUp rr-el-subtitle" data-wow-duration=".9s" data-wow-delay=".3s">
        <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h3>
    <?php endif; ?>

    <?php if ( !empty($settings['rr_section_description']) ) : ?>
    <p class="rr-el-desc"><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
    <?php endif; ?>

    <div class="rr-contact__comment-form wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">

        <?php if( !empty($settings['rr-core_select_contact_form']) ) : ?>
        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['rr-core_select_contact_form'].'"]' ); ?>
        <?php else : ?>
        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'rr-core' ). '</p></div>'; ?>
        <?php endif; ?>
    </div>
</div>
<?php elseif ( $settings['rr_design_style']  == 'layout-3' ):
    $this->add_render_attribute('title_args', 'class', 'rr-section-title pb-10 rr-el-title');
    if ( !empty($settings['rr_image_box']['url']) ) {
        $rr_image = !empty($settings['rr_image_box']['id']) ? wp_get_attachment_image_url( $settings['rr_image_box']['id'], $settings['rr_image_size_size']) : $settings['rr_image_box']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image_box"]["id"], "_wp_attachment_image_alt", true);
    }
    
    $this->add_render_attribute('title_args', 'class', 'rr-register-title rr-el-title');
?>
<div class="rr-register-all-content rr-el-section">
    <div class="rr-register-title-wrapper text-center mb-40">
        <?php if ( !empty($settings['rr_section_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
            tag_escape( $settings['rr_section_title_tag'] ),
            $this->get_render_attribute_string( 'title_args' ),
            rr_kses( $settings['rr_section_title' ] )
            );
                endif;
        ?>
        <?php if ( !empty($settings['rr_section_description']) ) : ?>
        <p class="rr-el-desc"><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
        <?php endif; ?>
    </div>

    <?php if( !empty($settings['rr-core_select_contact_form']) ) : ?>
    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['rr-core_select_contact_form'].'"]' ); ?>
    <?php else : ?>
    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'rr-core' ). '</p></div>'; ?>
    <?php endif; ?>
</div>
<?php else :
    // shape image
    if ( !empty($settings['rr_image_box']['url']) ) {
        $rr_image = !empty($settings['rr_image_box']['id']) ? wp_get_attachment_image_url( $settings['rr_image_box']['id'], $settings['rr_image_size_size']) : $settings['rr_image_box']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image_box"]["id"], "_wp_attachment_image_alt", true);
    }


    $this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeRight rr-el-title');
?>
<!-- Appointment area start -->
<section class="rr-Appointment-area p-relative pb-25 fix rr-el-section">
    <div class="rr-appointment-tyhumb">
        <?php if(!empty($rr_image)) : ?>
        <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-12 "></div>
            <div class="col-xl-6 col-lg-12 col-md-12  mt-80">
                <div class="rr-appointment-info ml-15">
                    <div class="rr-appointment-wrapp">
                        <div class="rr-section-title-wrapper mb-40">
                            <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                            <span class="rr-section-subtitle wow rrfadeLeft rr-el-subtitle" data-wow-duration=".9s"
                                data-wow-delay=".5s"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></span>
                            <?php endif; ?>
                            <?php if ( !empty($settings['rr_section_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['rr_section_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            rr_kses( $settings['rr_section_title' ] )
                            );
                             endif;
                            ?>
                        </div>
                    </div>
                    <div class="rr-contact-2__comment-form-box">
                        <div class="rr-contact-2__comment-form text-center wow rrfadeUp" data-wow-duration=".9s"
                            data-wow-delay=".5s">
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
    </div>
</section>
<!-- Appointment area end -->
<?php endif; 
	}
}

$widgets_manager->register( new rr_Contact_Form() );