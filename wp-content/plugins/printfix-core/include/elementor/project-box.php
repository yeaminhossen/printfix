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
class rr_Project_Box extends Widget_Base {

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
		return 'rr-project-box';
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
		return __( 'Peoject Box', 'rr-core' );
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

        // Review group
        $this->start_controls_section(
            'rr_project',
            [
                'label' => esc_html__( 'Project', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'rr_project_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'rr-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_project_title_url', [
                'label' => esc_html__('Title url', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'rr-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_project_desc', [
                'label' => esc_html__('Dese', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_image',
            [
                'label' => esc_html__( 'Choose Image', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
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

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('testimonial_section', 'Section Style', '.ele-section');
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


<!--	testimonial style 2 -->
<?php if ( $settings['rr_design_style']  == 'layout-2' ):
    $this->add_render_attribute('title_args', 'class', 'rr-section-title');   
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>
<div class="rr-project-item-3 text-center mb-30 ">
    <div class="rr-project-thumb-3">
        <?php if(!empty($rr_image)) : ?>
        <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
        <?php endif; ?>
    </div>
    <div class="rr-project-content-3">
        <?php if(!empty($settings['rr_project_desc'])) : ?>
        <span><?php echo rr_kses( $settings['rr_project_desc'] ); ?></span>
        <?php endif; ?>
        <?php if(!empty($settings['rr_project_title'])) : ?>
        <h4 class="rr-project-title-3"><a
                href="<?php echo rr_kses( $settings['rr_project_title_url'] ); ?>"><?php echo rr_kses($settings['rr_project_title']); ?></a>
        </h4>
        <?php endif; ?>
    </div>
</div>



<!-- default style -->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'rr-section-title');   
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>
<div class="rr-project-thumb">
    <?php if(!empty($rr_image)) : ?>
    <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
    <?php endif; ?>
    <div class="rr-project-thumb-info">

        <?php if(!empty($settings['rr_project_desc'])) : ?>
        <p><?php echo rr_kses( $settings['rr_project_desc'] ); ?></p>
        <?php endif; ?>

        <?php if(!empty($settings['rr_project_title'])) : ?>
        <h4 class="rr-project-thumb-title"><a
                href="<?php echo rr_kses( $settings['rr_project_title_url'] ); ?>"><?php echo rr_kses($settings['rr_project_title']); ?></a>
        </h4>
        <?php endif; ?>
 
    </div>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new rr_Project_Box() );