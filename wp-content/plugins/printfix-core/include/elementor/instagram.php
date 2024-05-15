<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use RRCore\Elementor\Controls\Group_Control_RRBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_instagram extends Widget_Base {

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
		return 'instagram-bar';
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
		return __( 'instagram', 'rr-core' );
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


        // instagram
        $this->start_controls_section(
            'rr_progress_bar',
            [
                'label' => esc_html__('Instagram', 'rr-core', ['layout-1', 'layout-2']),
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'rr_security_image',
            [
                'label' => esc_html__( 'Choose Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );


        $this->add_control(
            'rr_security_list',
            [
                'label' => esc_html__('Portfolios - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_security_title' => esc_html__('Discover', 'rr-core'),
                    ],
                    [
                        'rr_security_title' => esc_html__('Define', 'rr-core')
                    ],
                    [
                        'rr_security_title' => esc_html__('Develop', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_security_title }}}',

            ]
        );
        $this->end_controls_section();
	}


    protected function style_tab_content(){
        $this->rr_section_style_controls('instagram_section', 'Section - Style', '.rr-el-section');
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
        $this->add_render_attribute('title_args', 'class', 'rr-team-details-title');    
    ?>

<?php else:

        $this->add_render_attribute('title_args', 'class', 'rr-section__title mb-50');
    ?>
<!-- instagrem area start -->
<section class="rr-instagrem-area fix">
    <div class="container-fluid gx-0">
        <div class="swiper-container rr-instagram-active gx-0">
            <div class="swiper-wrapper">
            <?php foreach ($settings['rr_security_list'] as $key => $item) :
                    
                    if ( !empty($item['rr_security_image']['url']) ) {
                        $rr_image = !empty($item['rr_security_image']['id']) ? wp_get_attachment_image_url( $item['rr_security_image']['id'], $item['rr_image_size_size']) : $item['rr_security_image']['url'];
                        $rr_image_alt = get_post_meta($item["rr_security_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                <?php if(!empty($item['rr_instagram_box_title'])) : ?>
                <span><?php echo rr_kses($item['rr_instagram_box_title']); ?></span>
                <?php endif; ?>
                <div class="swiper-slide">
                    <div class="rr-instagrem-widget-gallery p-relative">
                        <a href="<?php echo esc_url($rr_image); ?>"
                            class="rr-instagrem-main-item popup-image">
                            <?php if(!empty($rr_image)) : ?>
                            <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                            <?php endif; ?>
                            <span><i class="fa-solid fa-plus"></i></span>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- instagrem area end -->


<?php endif; 
	}

}

$widgets_manager->register( new rr_instagram() );