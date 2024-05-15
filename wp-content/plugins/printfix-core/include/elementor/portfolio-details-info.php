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
use RRCore\Elementor\Controls\Group_Control_RRGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Portfolio_Details_Info extends Widget_Base {

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
		return 'rr-portfolio-details-info';
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
		return __( 'Portfolio Details Info', 'rr-core' );
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


        // title/content section
        $this->start_controls_section(
            'rr_portfolio_sec',
                [
                'label' => esc_html__( 'Portfolio Content Section', 'rr-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();

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
            'rr_features_sub_title', [
                'label' => esc_html__('Sub Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Client', 'rr-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rr_features_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Portfolio Features Title', 'rr-core'),
                'label_block' => true,
            ]
        );

        
       
        $this->add_control(
            'rr_features_list',
            [
                'label' => esc_html__('Features - List', 'rr-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_features_title' => esc_html__('Client name', 'rr-core'),
                    ],
                    [
                        'rr_features_title' => esc_html__('Catagories', 'rr-core')
                    ],
                    [
                        'rr_features_title' => esc_html__('Project Name', 'rr-core')
                    ]
                ],
                'title_field' => '{{{ rr_features_title }}}',
            ]
        );

        $this->end_controls_section();

       $this->rr_button_render('banner', 'Button');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('portfolio_section', 'Section - Style', '.rr-el-section'); 
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


<?php else : 
    // Link
    if ('2' == $settings['rr_banner_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_banner_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-green wow RRfadeUp');
    } else {
        if ( ! empty( $settings['rr_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_banner_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-green wow RRfadeUp');
        }
    }
    ?>

    <div class="row">
               <div class="col-lg-12">
                  <div class="rr-portfolio-details-wrapper">
                    
                     <div class="rr-portfolio-details-meta d-flex flex-wrap justify-content-between">
                        <div class="rr-portfolio-details-meta-left d-flex flex-wrap">
                        <?php foreach ($settings['rr_features_list'] as $key => $item) : ?>
                           <div class="rr-portfolio-details-meta-item d-flex align-items-center">
                              <div class="rr-portfolio-details-meta-icon">
                                    <?php if($item['rr_social_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['rr_social_icon']) || !empty($item['rr_social_selected_icon']['value'])) : ?>
                                        <?php rr_render_icon($item, 'rr_social_icon', 'rr_social_selected_icon'); ?>
                                        <?php endif; ?>
                                        <?php elseif( $item['rr_social_icon_type'] == 'image' ) : ?>
                                        <?php if (!empty($item['rr_social_image']['url'])): ?>
                                        <img src="<?php echo $item['rr_social_image']['url']; ?>"
                                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_social_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                        <?php else : ?>
                                        <?php if (!empty($item['rr_social_icon_svg'])): ?>
                                        <?php echo $item['rr_social_icon_svg']; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                              </div>
                              <div class="rr-portfolio-details-meta-content">
                              <?php if (!empty($item['rr_features_title'])): ?>
                                 <h4 class="rr-portfolio-details-meta-title"><?php echo rr_kses($item['rr_features_title']); ?></h4>
                                 <?php endif; ?>
                                 <?php if (!empty($item['rr_features_sub_title'])): ?>
                                 <p><?php echo rr_kses($item['rr_features_sub_title']); ?></p>
                                 <?php endif; ?>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                        <div class="rr-portfolio-details-right">
                        <?php if ( !empty($settings['rr_banner_btn_text']) ) : ?>
                            <div class="rr-portfolio-details-btn">
                                <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?> data-wow-duration=".9s"
                                    data-wow-delay=".5s"><?php echo rr_kses($settings['rr_banner_btn_text']); ?></a>
                            </div>
                            <?php endif; ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

<?php endif; 
	}
}

$widgets_manager->register( new rr_Portfolio_Details_Info() );
