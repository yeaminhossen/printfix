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
class rr_Contact_Location extends Widget_Base {

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
		return 'rr-contact-location';
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
		return __( 'Contact Location', 'rr-core' );
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

        // Contact group
        $this->start_controls_section(
            '_rr_contact_info',
            [
                'label' => esc_html__('Contact Location List', 'rr-core'),
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
            'rr_contact_badge',
            [
                'label' => esc_html__('Badge Text', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Main Office', 'rr-core'),
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'rr_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'rr-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'rr-core'),
                    'icon' => esc_html__('Icon', 'rr-core'),
                    'svg' => esc_html__('SVG', 'rr-core'),
                ],

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
                    'rr_box_icon_type' => 'image',
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

        $repeater->add_control(
            'rr_contact_info_title',
            [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title Here', 'rr-core'),
                'label_block' => true,
            ]
        );     
        $repeater->add_control(
            'rr_contact_info',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('201 Stokes New York', 'rr-core'),
                'label_block' => true,
            ]
        );    
        $repeater->add_control(
            'rr_contact_link',
            [
                'label' => esc_html__('Link', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_list',
            [
                'label' => esc_html__('Contact - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_contact_info_title' => esc_html__('united states', 'rr-core'),
                    ],
                    [
                        'rr_contact_info_title' => esc_html__('south Africa', 'rr-core')
                    ],
                    [
                        'rr_contact_info_title' => esc_html__('United Kingdom', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_contact_info_title }}}',
            ]
        );

        $this->end_controls_section();

        
        // section column
        $this->rr_columns('col');

	}

    // TAB_STYLE
    protected function style_tab_content(){
        $this->rr_section_style_controls('section_info', 'Section - Style', '.rr-el-section');
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

<?php else : ?>

<div class="contact-info-area ">
    <div class="container">
        <div class="row">

            <?php foreach ($settings['rr_list'] as $item) : ?>
            <div class="col-xl-<?php echo esc_attr($settings['rr_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['rr_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['rr_col_for_tablet']); ?> col-<?php echo esc_attr($settings['rr_col_for_mobile']); ?> mb-30">
                <div class="contact-info-item p-relative"> 
                    <?php if(!empty($item['rr_contact_badge'])) : ?>
                    <div class="contact-info-badge">
                        <span><?php echo rr_kses($item['rr_contact_badge']); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if($item['rr_box_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
                        <div class="contact-info-img">
                            <?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?>
                        </div>
                        <?php endif; ?>
                    <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
                        <div class="contact-info-img">
                            <img src="<?php echo $item['rr_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['rr_box_icon_svg'])): ?>
                        <div class="contact-info-img">
                            <?php echo $item['rr_box_icon_svg']; ?>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="contact-info-title-box">
                        <?php if(!empty($item['rr_contact_link'])) : ?>
                        <h5 class="contact-info-title-sm"><a href="<?php echo esc_url($item['rr_contact_link']); ?>"><?php echo rr_kses($item['rr_contact_info_title']); ?></a></h5>
                        <?php else : ?>
                        <h5 class="contact-info-title-sm"><?php echo rr_kses($item['rr_contact_info_title']); ?></h5>
                        <?php endif; ?>
                        <?php if(!empty($item['rr_contact_info'])) : ?>
                        <p><?php echo rr_kses($item['rr_contact_info']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php endif;
	}
}

$widgets_manager->register( new rr_Contact_Location() );
