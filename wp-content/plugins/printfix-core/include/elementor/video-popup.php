<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Video_Popup extends Widget_Base {

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
		return 'rr-video-popup';
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
		return __( 'Video Popup', 'rr-core' );
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
       // rr_section_title
	   $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2', 'layout-3']);

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

        // rr_video
        $this->start_controls_section(
            'rr_video',
            [
                'label' => esc_html__('Video', 'rr-core'),
            ]
        );

        $this->add_control(
            'rr_video_url',
            [
                'label' => esc_html__('Video URL', 'rr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'htRRs://www.youtube.com/watch?v=_RpLvsA1SNM',
                'label_block' => true,
                'description' => __("We recommended to put video url form video website such as 'youtube', 'vimeo'.", 'rr-core')
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
			'rr_shap_switcher',
			[
				'label' => esc_html__( 'Image Shap', 'rr-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
				'label_off' => esc_html__( 'No', 'rr-core   ' ),
				'return_value' => 'yes',
				'default' => '0',
			]
		);
        $this->end_controls_section();  
	}
    
    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('video_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
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
	if ( !empty($settings['rr_thumbnail_image']['url']) ) {
		$rr_thumbnail_image = !empty($settings['rr_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image']['url'];
		$rr_image_alt = get_post_meta($settings["rr_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
	}
	$this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeLeft rr-el-title');
	?>
<!-- video area start -->
<section class="rr-video-area fix p-relative rr-el-section">
    <?php if ( !empty($settings['rr_shap_switcher']) ) : ?>
    <div class="rr-video-shap-wrapp">
        <div class="rr-video-shap-left d-none d-xl-block">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/video/shap.png" alt="">
        </div>
        <div class="rr-video-shap-right d-none d-xl-block">
            <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/video/shap-2.png" alt="">
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row gx-30">
            <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
            <div class="rr-section-title-wrapper mb-40 text-center">
                <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                <span class="rr-section-subtitle wow rrfadeRight rr-el-sub-title" data-wow-duration=".9s"
                    data-wow-delay=".5s"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></span>
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
        <div class="row">
            <div class="offset-xl-1 col-xl-10">
                <div class="rr-video-thumb p-relative">
                    <?php if(!empty($rr_thumbnail_image)) : ?>
                    <img src="<?php echo esc_url($rr_thumbnail_image); ?>" alt="<?php echo esc_attr($rr_thumbnail_image); ?>">
                    <?php endif; ?>
                    <div class="rr-video-play">
                        <?php if ( !empty($settings['rr_video_url']) ) : ?>
                        <span><a class="popup-video" href="<?php echo esc_url($settings['rr_video_url']); ?>"><svg
                                    width="17" height="22" viewBox="0 0 17 22" fill="none"
                                    xmlns="htRR://www.w3.org/2000/svg">
                                    <path d="M1 1L16 11L1 21V1Z" stroke="#1B7262" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- video area end -->


<?php else:
	if ( !empty($settings['rr_thumbnail_image']['url']) ) {
        $rr_thumbnail_image = !empty($settings['rr_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['rr_thumbnail_image']['id'], $settings['rr_thumbnail_size_size']) : $settings['rr_thumbnail_image']['url'];
        $rr_thumbnail_image_alt = get_post_meta($settings["rr_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
	$this->add_render_attribute('title_args', 'class', 'rr-video-title rr-el-title');
?>
<!-- video area start -->
<section class="rr-video-main p-relative fix" style="background-image:url(<?php echo esc_url($rr_thumbnail_image); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="rr-video-wrap">
                    <div class="rr-video-play">
                        <?php if ( !empty($settings['rr_video_url']) ) : ?>
                        <span><a class="popup-video" href="<?php echo esc_url($settings['rr_video_url']); ?>"><svg
                                    width="17" height="22" viewBox="0 0 17 22" fill="none"
                                    xmlns="htRR://www.w3.org/2000/svg">
                                    <path d="M1 1L16 11L1 21V11V1Z" stroke="#1B7262" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- video area end -->

<?php endif;
	}
}

$widgets_manager->register( new rr_Video_Popup() );