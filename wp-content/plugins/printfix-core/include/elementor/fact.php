<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use RRCore\Elementor\Controls\Group_Control_RRBGGradient;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Fact extends Widget_Base {

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
		return 'rr-fact';
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
		return __( 'Fact', 'rr-core' );
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
                    'layout-3' => esc_html__('Layout 3', 'rr-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->rr_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-2']);

        // fact group
        $this->start_controls_section(
            'rr_fact',
            [
                'label' => esc_html__('Fact List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'RRcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'RRcore' ),
                    'style_2' => __( 'Style 2', 'RRcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'rr_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'RRcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'RRcore'),
                    'icon' => esc_html__('Icon', 'RRcore'),
                    'svg' => esc_html__('SVG', 'RRcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'rr_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'RRcore'),
                'condition' => [
                    'rr_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'rr_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'RRcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_box_icon_type' => 'image',
                    'repeater_condition' => ['style_2']
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
                        'rr_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_2']
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
                        'rr_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_2']
                    ]
                ]
            );
        }

        $repeater->add_control(
            'rr_fact_number', [
                'label' => esc_html__('Number', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_fact_number_unit', [
                'label' => esc_html__('Number Unit', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_fact_title',
            [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_fact_des',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Average time to resolve.', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );    

        // creative animation
        $repeater->add_control(
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
                    'repeater_condition' => ['style_2']
                ]
			]
		);

        $repeater->add_control(
            'rr_anima_type',
            [
                'label' => __( 'Animation Type', 'rr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeUp' => __( 'fadeUp', 'rr-core' ),
                    'fadeDown' => __( 'fadeDown', 'rr-core' ),
                    'fadeLeft' => __( 'fadeLeft', 'rr-core' ),
                    'fadeRight' => __( 'fadeRight', 'rr-core' ),
                ],
                'default' => 'fadeUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'rr_fact_list',
            [
                'label' => esc_html__('Fact - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_fact_number' => esc_html__('23', 'rr-core'),
                        'rr_fact_title' => esc_html__('Business', 'rr-core'),
                    ],
                    [
                        'rr_fact_number' => esc_html__('45', 'rr-core'),
                        'rr_fact_title' => esc_html__('Website', 'rr-core')
                    ],
                    [
                        'rr_fact_number' => esc_html__('129', 'rr-core'),
                        'rr_fact_title' => esc_html__('Marketing', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_fact_title }}}',
            ]
        );
        $this->end_controls_section();

        
        // _rr_image
		$this->start_controls_section(
            '_rr_image',
            [
                'label' => esc_html__('Thumbnail', 'rr-core'),
                'condition' => [
                    'rr_design_style' => 'layout-5'
                ]
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


        // title/content
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-5'] );

        // list
        $this->start_controls_section(
        'rr_list_sec',
            [
                'label' => esc_html__( 'Info List', 'rr-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => 'layout-5'
                ]
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
        'rr_text_list_title',
            [
            'label'   => esc_html__( 'Title', 'rr-core' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Default-value', 'rr-core' ),
            'label_block' => true,
            ]
        );
        
        $this->add_control(
            'rr_text_list_list',
            [
            'label'       => esc_html__( 'Features List', 'rr-core' ),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [
                'rr_text_list_title'   => esc_html__( 'Neque sodales', 'rr-core' ),
                ],
                [
                'rr_text_list_title'   => esc_html__( 'Adipiscing elit', 'rr-core' ),
                ],
                [
                'rr_text_list_title'   => esc_html__( 'Mauris commodo', 'rr-core' ),
                ],
            ],
            'title_field' => '{{{ rr_text_list_title }}}',
            ]
        );
        $this->end_controls_section();
      
	}
 
    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('fact_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('fact_title', 'Fact Title', '.rr-el-re-Title');
        $this->rr_basic_style_controls('fact_number', 'Fact Number', '.rr-el-re-number');
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
        if ( !empty($settings['rr_bg_image']['url']) ) {
            $rr_bg_image = !empty($settings['rr_bg_image']['id']) ? wp_get_attachment_image_url( $settings['rr_bg_image']['id'], $settings['shape_image_size_size']) : $settings['rr_bg_image']['url'];
            $rr_bg_image_alt = get_post_meta($settings["rr_bg_image"]["id"], "_wp_attachment_image_alt", true);
        }
		?>

<?php if ( $settings['rr_design_style']  == 'layout-2' ): ?>


<?php else: 
     if ( !empty($settings['rr_bg_image']['url']) ) {
        $rr_bg_image = !empty($settings['rr_bg_image']['id']) ? wp_get_attachment_image_url( $settings['rr_bg_image']['id'], $settings['shape_image_size_size']) : $settings['rr_bg_image']['url'];
        $rr_bg_image_alt = get_post_meta($settings["rr_bg_image"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'rr-section-title pb-15');
?>
<!-- latest-counter area end -->
<section class="latest-counter__area pt-75 pb-75 pt-xs-30 pb-xs-60   latest-counter-bg rr-el-section">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['rr_fact_list'] as $key => $item) :
                    $arrCount = count($settings['rr_fact_list']) - 1 ;
                    $border = $key == $arrCount ? '' : 'rr-counter-border';
                ?>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="latest-counter__counter-box wow fadeInLeft animated" data-wow-delay="1s">
                    <div class="latest-counter__content text-center">
                        <div class="latest-counter__content__counter-img mt-40">
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
                        </div>
                        <h5 class="rr-el-re-number"><span class="count"><?php echo esc_attr($item['rr_fact_number' ]); ?></span ><?php echo esc_attr($item['rr_fact_number_unit' ]); ?>
                        </h5>
                        <?php if(!empty($item['rr_fact_title'])) : ?>
                        <span class="rr-el-re-Title"><?php echo rr_kses($item['rr_fact_title']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- latest-counter area start -->
<?php endif; 
	}
}

$widgets_manager->register( new rr_Fact() );