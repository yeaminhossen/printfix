<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_List extends Widget_Base {

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
		return 'rr-list';
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
		return __( 'List', 'rr-core' );
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
                    'layout-2' => esc_html__('Layout 2', 'rr-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'rr_list_sec',
			 [
			   'label' => esc_html__( 'Info List', 'rr-core' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);

		$this->add_control(
			'rr_text_title',
			 [
				'label'       => esc_html__( 'Title', 'rr-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'RR Heading Control', 'rr-core' ),
				'placeholder' => esc_html__( 'Your Title', 'rr-core' ),
				'label_block' => true
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
		$repeater->add_control(
		'rr_text_list_des',
		  [
			'label'   => esc_html__( 'Des', 'rr-core' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Default-value', 'rr-core' ),
			'label_block' => true,
		  ]
		);
		$repeater->add_control(
			'rr_box_icon_type',
			[
				'label' => esc_html__('Select Icon Type', 'rr-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
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

    protected function style_tab_content(){
		$this->rr_basic_style_controls('history_title', 'Title', '.rr-el-box-title');
		$this->rr_basic_style_controls('history_list', 'List', '.rr-el-box-list');
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

<?php if ( $settings['rr_design_style']  == 'layout-2' ): ?>

<?php else: ?>
<div class="rr-service-details-box d-flex mb-60 rr-el-box-title">
    <?php foreach ($settings['rr_text_list_list'] as $key => $item) :?>
    <div class="rr-service-details-item d-flex mr-30">
        <div class="rr-service-details-icon">
            <?php if($item['rr_box_icon_type'] == 'icon') : ?>
            <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
            <span><?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?></span>
            <?php endif; ?>
            <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
            <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
            <span><img src="<?php echo $item['rr_box_icon_image']['url']; ?>"
                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
            <?php endif; ?>
            <?php else : ?>
            <?php if (!empty($item['rr_box_icon_svg'])): ?>
            <span><?php echo $item['rr_box_icon_svg']; ?></span>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="rr-service-details-content">
            <?php if(!empty($settings['rr_text_title'])): ?>
            <h3 class="rr-service-details-subtitle"><?php echo rr_kses($item['rr_text_list_title']); ?></h3>
            <?php endif; ?>
            <p><?php echo rr_kses($item['rr_text_list_des']); ?></p>

        </div>
    </div>
    <?php endforeach; ?>
</div>


<?php endif; 
	}
}

$widgets_manager->register( new rr_List() ); 