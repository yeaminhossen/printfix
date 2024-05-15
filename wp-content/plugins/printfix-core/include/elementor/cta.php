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
class rr_CTA extends Widget_Base {

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
		return 'rr-cta';
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
		return __( 'CTA', 'rr-core' );
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
         * contact form 7 setup.
         *
         * Adds different input fields to allow the user to change and customize the widget settings.
         *
         * @since 1.0.0
         *
         * @access protected
         */

    public function get_rr_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $rr_cfa         = array();
        $rr_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $rr_forms       = get_posts( $rr_cf_args );
        $rr_cfa         = ['0' => esc_html__( 'Select Form', 'rr-core' ) ];
        if( $rr_forms ){
            foreach ( $rr_forms as $rr_form ){
                $rr_cfa[$rr_form->ID] = $rr_form->post_title;
            }
        }else{
            $rr_cfa[ esc_html__( 'No contact form found', 'rr-core' ) ] = 0;
        }
        return $rr_cfa;
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
                    'layout-3' => esc_html__('Layout 3', 'rr-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
          // rr_section_title
          $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2','layout-3']);

        
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
    
    $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->rr_section_style_controls('cta_section', 'Section Style', '.ele-section'); 
        $this->rr_basic_style_controls('cta_title', 'Cta Title', '.rr-el-re-Title');
        $this->rr_link_controls_style('repiter_btn', 'Cta - Button', '.rr-el-btn');
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
    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-white rr-el-btn");
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-white rr-el-btn");

        }
    }
    $this->add_render_attribute('title_args', 'class', 'rr-cta-2-title-left rr-el-re-Title');
?>

      <!-- cta area start -->
      <section class="rr-cta-2-area p-relative rr-cta-2-before-color fix ele-section">
         <div class="rr-cta-2-bg-img">
         </div>
         <div class="container">
            <div class="row">
               <div class="col-xl-9 col-lg-8 col-md-8 col-12 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                  <div class="rr-cta-2-info">
                     <?php if ( !empty($settings['rr_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['rr_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_section_title' ] )
                        ); endif;  ?>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-4 col-md-4 col-12 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                  <div class="rr-cta-2-btns text-end mt-10">
                     <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?> <i
                                class="fa-sharp fa-solid fa-arrow-right"></i></span></a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- cta area end -->
      <?php elseif ( $settings['rr_design_style']  == 'layout-3' ):
    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-white rr-el-btn");
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-white rr-el-btn");

        }
    }
    $this->add_render_attribute('title_args', 'class', 'rr-cta-title-2 mb-40 wow rrfadeRight rr-el-re-Title');
?>
     <!-- cta area start -->
     <section class="rr-cta-area pt-125 pb-120 p-relative rr-cta-before-color fix ele-section">
         <div class="rr-cta-bg-img">
         </div>
         <div class="container">
            <div class="row">
               <div class="col-xl-12">
                  <div class="rr-cta-info text-center">
                        <?php if ( !empty($settings['rr_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['rr_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_section_title' ] )
                        ); endif;  ?>
                     <div class="rr-cta-btn wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                              <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?> <i
                                class="fa-sharp fa-solid fa-arrow-right"></i></span></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- cta area end -->
<?php else: 


    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-2 rr-el-btn");
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', "rr-btn-2 rr-el-btn");

        }
    }
    $this->add_render_attribute('title_args', 'class', 'rr-cta-title rr-el-re-Title');   
?>
<!-- cta area start -->
<section class="rr-cta-wrapper rr-cta-bg-color pt-85 pb-85 fix ele-section">
    <div class="container">
        <div class="row gx-30">
            <div class="col-xl-8 col-lg-9 col-12 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                <div class="rr-cta-content">
                    <?php if ( !empty($settings['rr_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['rr_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_section_title' ] )
                        ); endif;  ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-3 col-12 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                <div class="rr-cta-btn mt-20 text-end">
                    <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo rr_kses($settings['rr_btn_text']); ?> <i
                                class="fa-sharp fa-solid fa-arrow-right"></i></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cta area end -->

<?php endif; 
	}
}

$widgets_manager->register( new rr_CTA() );