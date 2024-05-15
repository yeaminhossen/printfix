<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Button extends Widget_Base {
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
		return 'rr-button';
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
		return __( 'Button', 'rr-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // rr_btn_button_group
        $this->start_controls_section(
            'rr_btn_button_group',
            [
                'label' => esc_html__('Button', 'rr-core'),
            ]
        );

        $this->add_control(
            'rr_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'rr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rr-core' ),
                'label_off' => esc_html__( 'Hide', 'rr-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'rr_title_text',
            [
                'label' => esc_html__('Title Text', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title Text', 'rr-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_btn_text',
            [
                'label' => esc_html__('Button Text', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'rr-core'),
                'title' => esc_html__('Enter button text', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'rr_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'rr-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'rr_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'rr_btn_link',
            [
                'label' => esc_html__('Button link', 'rr-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('htRRs://your-link.com', 'rr-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'rr_btn_link_type' => '1',
                    'rr_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rr_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'rr-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_btn_link_type' => '2',
                    'rr_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'rr_align',
            [
                'label' => esc_html__('Alignment', 'rr-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rr-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rr-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rr-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        
        // creative animation
        $this->add_control(
			'rr_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'rr-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
				'label_off' => esc_html__( 'No', 'rr-core   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'rr_design_style' => 'layout-2',
                ],
			]
		);

        $this->add_control(
            'rr_anima_type',
            [
                'label' => __( 'Animation Type', 'rr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeInUp' => __( 'fadeInUp', 'rr-core' ),
                    'fadeInDown' => __( 'fadeInDown', 'rr-core' ),
                    'fadeInLeft' => __( 'fadeInLeft', 'rr-core' ),
                    'fadeInRight' => __( 'fadeInRight', 'rr-core' ),
                ],
                'default' => 'fadeInUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'rr_anima_dura', [
                'label' => esc_html__('Animation Duration', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'rr-core'),
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'rr_anima_delay', [
                'label' => esc_html__('Animation Delay', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'rr-core'),
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('blog_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_link_controls_style('main_button', 'Button Style', '.rr-el-btn');
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
?>






<?php else: 
    $rr_anima_type = $settings['rr_anima_type']; 
    $rr_anima_dura = $settings['rr_anima_dura']; 
    $rr_anima_delay = $settings['rr_anima_delay']; 
    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-3 rr-el-btn ");
    } else {
        $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-3 rr-el-btn ");
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
        }
    }
?>

<div class="project-sidebar rr-el-section">
    <div class="project-sidebar-wrap">
    <?php if (!empty($settings['rr_title_text'])) : ?>
        <h3 class="rr-el-title"><?php echo rr_kses($settings['rr_title_text']); ?></h3>
    <?php endif; ?>
        <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?></span> <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</div>
<a

<?php endif;
	}
}

$widgets_manager->register( new rr_Button() );