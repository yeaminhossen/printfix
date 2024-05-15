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
class rr_Main_Brand extends Widget_Base {

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
		return 'rr-brand';
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
		return __( 'Brand', 'rr-core' );
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

    $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-1', 'layout-2']);

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

        // brand section
		$this->start_controls_section( 
            'rr_brand_section',
            [
                'label' => __( 'Brand Item', 'rr-core' ),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        
        $repeater->add_control(
            'rr_brand_image',
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

        $this->add_control(
            'rr_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'rr-core' ),
                'default' => [
                    [
                        'rr_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'rr_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
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

        $this->end_controls_section();

    
	}


    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('section_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('heading_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('heading_desc', 'Section - Description', '.rr-el-content');
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
        $this->add_render_attribute('title_args', 'class', 'partners__title-wrapper-title rr-section-title');
    ?>
<!--partners-area start -->
<section class="partners__area section-space position-relative">
    <div class="container-fluid overflow-hidden">
        <div class="row">
            <div class="col-12">
                <div class="partners__title-wrapper text-center">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <h6 class="partners__title-wrapper-subtitle rr-el-subtitle" data-wow-duration=".9s"
                        data-wow-delay=".5s"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
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
        <div class="row">
            <div class="col-12">
                <div class="slick marquee mt-40">
                    <?php foreach ($settings['rr_brand_slides'] as $item) :
                                if ( !empty($item['rr_brand_image']['url']) ) {
                                    $rr_brand_image_url = !empty($item['rr_brand_image']['id']) ? wp_get_attachment_image_url( $item['rr_brand_image']['id'], $settings['thumbnail_size']) : $item['rr_brand_image']['url'];
                                    $rr_brand_image_alt = get_post_meta($item["rr_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                    <div class="slick-slide">
                        <div class="inner">
                            <img src="<?php echo esc_url($rr_brand_image_url); ?>"
                                alt="<?php echo esc_attr($rr_brand_image_alt); ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div dir="rtl">
                    <div class="slick marquee_rtl mt-30">
                        <?php foreach ($settings['rr_brand_slides'] as $item) :
                                if ( !empty($item['rr_brand_image']['url']) ) {
                                    $rr_brand_image_url = !empty($item['rr_brand_image']['id']) ? wp_get_attachment_image_url( $item['rr_brand_image']['id'], $settings['thumbnail_size']) : $item['rr_brand_image']['url'];
                                    $rr_brand_image_alt = get_post_meta($item["rr_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                        <div class="slick-slide">
                            <div class="inner">
                                <img src="<?php echo esc_url($rr_brand_image_url); ?>"
                                    alt="<?php echo esc_attr($rr_brand_image_alt); ?>">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--partners-area end -->


<?php else :
if ( !empty($settings['rr_brand_bg_image']['url']) ) {
    $rr_brand_bg_image_url = !empty($settings['rr_brand_bg_image']['id']) ? wp_get_attachment_image_url( $settings['rr_brand_bg_image']['id'], $settings['thumbnail_size']) : $settings['rr_brand_bg_image']['url'];
    $rr_brand_bg_image_alt = get_post_meta($settings["rr_brand_bg_image"]["id"], "_wp_attachment_image_alt", true);
}
$this->add_render_attribute('title_args', 'class', 'main-brand__tittle-wrapper-title rr-el-title');
?>
<!-- Brand area start -->
<section class="main-brand__area rr-el-section">
    <div class="brand__area section-space">
        <div class="container">
            <div class="row">
                <div class="main-brand__tittle-wrapper text-center mb-40">
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
                    <p class="main-brand__tittle-wrapper-subtitle rr-el-content">
                        <?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper brand__active wow fadeIn" data-wow-delay=".3s">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['rr_brand_slides'] as $item) :
                                if ( !empty($item['rr_brand_image']['url']) ) {
                                    $rr_brand_image_url = !empty($item['rr_brand_image']['id']) ? wp_get_attachment_image_url( $item['rr_brand_image']['id'], $settings['thumbnail_size']) : $item['rr_brand_image']['url'];
                                    $rr_brand_image_alt = get_post_meta($item["rr_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="brand__item text-center  wow fadeIn animated" data-wow-delay=".1s">
                                    <div class="brand__thumb">
                                        <img src="<?php echo esc_url($rr_brand_image_url); ?>"
                                            alt="<?php echo esc_attr($rr_brand_image_alt); ?>">
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
<!-- Brand area end -->
<?php endif;  
	}
}

$widgets_manager->register( new rr_Main_Brand() );