<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use RRCore\Elementor\Controls\Group_Control_RRBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Browser_Link extends Widget_Base {

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
		return 'rr-browser-link';
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
		return __( 'Browser Link', 'rr-core' );
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


	// controls file 
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

        // rr_section_title
        $this->start_controls_section(
            'rr_section_title',
            [
                'label' => esc_html__('Title & Content', 'rr-core'),
            ]
        );

        $this->add_control(
            'rr_sub_title',
            [
                'label' => esc_html__('Sub Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('RR Sub Title Here', 'rr-core'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'rr_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'rr_title',
            [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('RR Title Here', 'rr-core'),
                'placeholder' => esc_html__('Type Heading Text', 'rr-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rr_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'rr-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'rr-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'rr-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'rr-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'rr-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'rr-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'rr-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'rr_des',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('RR Description Here.', 'rr-core'),
                'placeholder' => esc_html__('write description', 'rr-core'),
                'label_block' => true,
            ]
        );


        $this->add_responsive_control(
            'rr_align',
            [
                'label' => esc_html__('Alignment', 'rr-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'rr-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'rr-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'rr-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        
        $this->rr_button_render('browser', 'Button', ['layout-1', 'layout-2']);  

        // social links
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'rr-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'rr_social_icon_type',
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
            'rr_social_image',
            [
                'label' => esc_html__('Upload Icon Image', 'rr-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_social_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'rr_social_icon_svg',
            [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'rr-core'),
                    'condition' => [
                        'rr_social_icon_type' => 'svg'
                    ]
            ]
        );

        if (rr_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'rr_social_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fas fa-facebook-f',
                    'condition' => [
                        'rr_social_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'rr_social_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'rr_social_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
			'rr_social_link',
			[
				'label' => esc_html__( 'Social Profile Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'htRRs://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $repeater->add_control(
            'rr_social_title',
            [
                'label' => esc_html__('Social Profile Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('RR Profile Title', 'rr-core'),
                'placeholder' => esc_html__('Type Heading Text', 'rr-core'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ rr_social_title }}}',
                'default' => [
                    [
                        'rr_social_link' => ['url' => 'htRRs://facebook.com/'],
                        'rr_social_title' => 'facebook',
                        'rr_social_selected_icon' => ['value' => 'fab fa-facebook-f']
                    ],
                    [
                        'rr_social_link' => ['url' => 'htRRs://linkedin.com/'],
                        'rr_social_title' => 'linkedin',
                        'rr_social_selected_icon' => ['value' => 'fab fa-linkedin-in']
                    ],
                    [
                        'rr_social_link' => ['url' => 'htRRs://twitter.com/'],
                        'rr_social_title' => 'twitter',
                        'rr_social_selected_icon' => ['value' => 'fab fa-twitter']
                    ]
                ],
            ]
        );

        $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->rr_section_style_controls('browser_section', 'Section Style', '.ele-section'); 
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
    $this->add_render_attribute('title_args', 'class', 'rr-section-title-lg text-white');

    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }    
    
    // Link
    if ('2' == $settings['rr_browser_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_browser_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-green');
    } else {
        if ( ! empty( $settings['rr_browser_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_browser_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-green');
        }
    }
?>

<?php else:
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['rr_browser_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_browser_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-blue-lg rr-btn-hover');
    } else {
        if ( ! empty( $settings['rr_browser_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_browser_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-blue-lg rr-btn-hover');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'rr-section-title-3');
?>

<div class="rr-browser-details-area pt-10 pb-10 p-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-9 col-lg-9">
                <div class="rr-browser-section-box d-flex justify-content-between align-items-center mb-30">
                    <?php
                    if ( !empty($settings['rr_title']) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['rr_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_title'] )
                        );
                    endif;
                    ?>
                </div>
                <?php if(!empty($settings['rr_des'])) : ?>
                <p><?php echo rr_kses($settings['rr_des']); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="rr-browser-btn text-lg-end text-start mb-40">

                    <?php if ( !empty($settings['rr_browser_btn_text']) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>>
                        <span><?php echo rr_kses($settings['rr_browser_btn_text']); ?></span>
                        <b></b>
                    </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="rr-hero-browser-wrapper footer-browser-item d-flex align-items-center">
                    <?php foreach ($settings['profiles'] as $key => $item) : ?>
                    <div class="rr-hero-browser-item">
                        <?php if(!empty($item['rr_social_link']['url'])) : ?>
                            <a href="<?php echo esc_url($item['rr_social_link']['url']); ?>">
                                <?php if($item['rr_social_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['rr_social_icon']) || !empty($item['rr_social_selected_icon']['value'])) : ?>
                                    <?php rr_render_icon($item, 'rr_social_icon', 'rr_social_selected_icon'); ?>
                                <?php endif; ?>
                                <?php elseif( $item['rr_social_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['rr_social_image']['url'])): ?>
                                    <img src="<?php echo $item['rr_social_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_social_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($item['rr_social_icon_svg'])): ?>
                                    <?php echo $item['rr_social_icon_svg']; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </a>
                        <?php else : ?>
                            <?php if($item['rr_social_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['rr_social_icon']) || !empty($item['rr_social_selected_icon']['value'])) : ?>
                                <?php rr_render_icon($item, 'rr_social_icon', 'rr_social_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif( $item['rr_social_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['rr_social_image']['url'])): ?>
                                <img src="<?php echo $item['rr_social_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_social_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['rr_social_icon_svg'])): ?>
                                <?php echo $item['rr_social_icon_svg']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(!empty($item['rr_social_title'])) : ?>
                        <p><?php echo rr_kses($item['rr_social_title']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach;   ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new rr_Browser_Link() );