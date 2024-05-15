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
class rr_Portfolio_Grid extends Widget_Base {

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
		return 'rr-portfolio-grid';
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
		return __( 'Portfolio Grid', 'rr-core' );
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

        // Security group
        $this->start_controls_section(
            'rr_security',
            [
                'label' => esc_html__('Portfolio List', 'rr-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'rr_security_title', [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Portfolio Title', 'rr-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'rr_security_subtitle',
            [
                'label' => esc_html__('Subtitle', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        

        $repeater->add_control(
            'rr_security_link_switcher',
            [
                'label' => esc_html__( 'Add Portfolio link', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rr-core' ),
                'label_off' => esc_html__( 'No', 'rr-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $repeater->add_control(
            'rr_security_link_type',
            [
                'label' => esc_html__( 'Portfolio Link Type', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'rr_security_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'rr_security_link',
            [
                'label' => esc_html__( 'Portfolio Link link', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'htRRs://your-link.com', 'rr-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'rr_security_link_type' => '1',
                    'rr_security_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'rr_security_button_text',
            [
                'label' => esc_html__('Button Text', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'rr_security_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'rr_security_page_link',
            [
                'label' => esc_html__( 'Select Portfolio Link Page', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => rr_get_all_pages(),
                'condition' => [
                    'rr_security_link_type' => '2',
                    'rr_security_link_switcher' => 'yes',
                ]
            ]
        );

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
     // title/content
     $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2'] );

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('security_section', 'Section - Style', '.rr-el-section'); 
        $this->rr_section_style_controls('cta_section', 'CTA Section - Style', '.rr-el-section-cta'); 
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
    $this->add_render_attribute('title_cta_args', 'class', 'rr-portfolio__title-white');
?>


<?php else: 
	$this->add_render_attribute('title_args', 'class', 'title wow fadeInLeft animated');
    
?>
<!-- latest-project area start -->
<section class="project-area pt-120 overflow-hidden latest-project-bg rr-el-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
            <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
                <div class="project__title text-center">
                    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                    <h6 class="subtitle wow fadeInLeft animated" data-wow-delay=".6s">
                        <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
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
        </div>
        <div class="project-row-custom">
            <?php foreach ($settings['rr_security_list'] as $key => $item) :
                    
                    if ('2' == $item['rr_security_link_type']) {
                        $link = get_permalink($item['rr_security_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['rr_security_link']['url']) ? $item['rr_security_link']['url'] : '';
                        $target = !empty($item['rr_security_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['rr_security_link']['nofollow']) ? 'nofollow' : '';
                    }
                    if ( !empty($item['rr_security_image']['url']) ) {
                        $rr_image = !empty($item['rr_security_image']['id']) ? wp_get_attachment_image_url( $item['rr_security_image']['id'], $item['rr_image_size_size']) : $item['rr_security_image']['url'];
                        $rr_image_alt = get_post_meta($item["rr_security_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
            <div class="col-custom p-relative item1 wow fadeInLeft animated" data-wow-delay=".6s">
                <div class="project-item p-relative ">
                    <div class="project-thumb">
                        <?php if(!empty($rr_image)) : ?>
                        <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
                        <?php endif; ?>
                        <h3 class="project-title"><a
                                href="<?php echo esc_url($link); ?>"><?php echo rr_kses($item['rr_security_title' ]); ?></a>
                        </h3>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- latest-project area end -->
<?php endif;
	}
}

$widgets_manager->register( new rr_Portfolio_Grid() );