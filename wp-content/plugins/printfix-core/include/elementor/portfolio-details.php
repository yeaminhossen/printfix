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
class rr_Project_Deatils extends Widget_Base {

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
		return 'rr-portfolio-details';
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
		return __( 'Portfolio Details', 'rr-core' );
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


        $this->rr_section_title_render_controls('project', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4','layout-5']);

   
        $this->start_controls_section(
         'about_features_list_sec',
             [
               'label' => esc_html__( 'Features List', 'rr-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'rr_design_style' => ['layout-1', 'layout-2']
               ]
             ]
        );
        
        // repeater for about features list with text , testarea and icon
        $repeater = new Repeater();

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
                ]
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
                    'rr_box_icon_type' => 'image'
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
            'rr_project_features_list_title',
            [
                'label' => esc_html__('Title', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'rr-core'),
                'title' => esc_html__('Enter title', 'rr-core'),
                'label_block' => true
                
            ]
        );
        $repeater->add_control(
            'rr_project_features_list_description',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'rr-core'),
                'title' => esc_html__('Enter description', 'rr-core'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'rr_project_features_list',
            [
                'label' => esc_html__('Features List', 'rr-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'rr_project_features_list_title' => esc_html__('Title 01', 'rr-core'),
                        'rr_project_features_list_description' => esc_html__('Sub Content', 'rr-core'),
                    ],
                    [
                        'rr_project_features_list_title' => esc_html__('Title 02', 'rr-core'),
                        'rr_project_features_list_description' => esc_html__('Sub Content', 'rr-core'),
                    ]
                ],
                'title_field' => '{{{ rr_project_features_list_title }}}',
            ]
        );

        $this->end_controls_section();

        // _rr_image
		$this->start_controls_section(
            '_rr_image',
            [
                'label' => esc_html__('Thumbnail', 'rr-core'),
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
        $this->rr_section_style_controls('about_section', 'Section - Style', '.rr-el-section'); 
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_link_controls_style('about_btn', 'About - Button', '.rr-el-btn');
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
     if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'rr-project-details-subtitle');
?>
 <section class="rr-el-section">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
             <div class="rr-project-details-subtitle-wrapper">
                <?php if ( !empty($settings['rr_project_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['rr_project_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    rr_kses( $settings['rr_project_title' ] )
                    );
                endif; ?>
               <?php if ( !empty($settings['rr_project_description']) ) : ?>
                <p><?php echo rr_kses( $settings['rr_project_description'] ); ?></p>
                <?php endif; ?>
             </div>
          </div>
       </div> 
       
       <div class="row">
          <div class="col-lg-8">
             <div class="rr-project-details-list border-0">
                <div class="row">
                    <?php 
                    if ( !empty($settings['rr_project_features_list']) ) :
                        foreach ( $settings['rr_project_features_list'] as $item ) :
                            $title = $item['rr_project_features_list_title'];
                            $description = $item['rr_project_features_list_description']; 
                    ?>
                   <div class="col-md-6">
                      <span class="rr-project-details-list-title"><i class="fa-solid fa-check"></i> <?php echo rr_kses( $item['rr_project_features_list_title'] ); ?></span>
                      <p><?php echo rr_kses( $item['rr_project_features_list_description'] ); ?></p>
                   </div>
                   <?php endforeach; endif; ?>
                </div>
             </div>
          </div>
          <?php if(!empty($rr_image)) : ?>
          <div class="col-lg-4">
             <div class="rr-project-details-list-thumb">
                <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
             </div>
          </div>
          <?php endif; ?>
       </div>
    </div>
 </section>

<?php else:

    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'rr-project-details-title');
?>


 <section class="rr-el-section">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
            <?php if(!empty($rr_image)) : ?>
             <div class="rr-project-details-thumb">
                <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
             </div>
             <?php endif; ?>
             <div class="rr-project-details-title-wrapper p-relative">
                <?php if ( !empty($settings['rr_project_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['rr_project_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    rr_kses( $settings['rr_project_title' ] )
                    );
                endif; ?>
                <?php if ( !empty($settings['rr_project_description']) ) : ?>
                <p><?php echo rr_kses( $settings['rr_project_description'] ); ?></p>
                <?php endif; ?>

                <div class="rr-project-details-box">
                    <?php 
                    if ( !empty($settings['rr_project_features_list']) ) :
                        foreach ( $settings['rr_project_features_list'] as $item ) :
                            $title = $item['rr_project_features_list_title'];
                            $description = $item['rr_project_features_list_description']; 
                    ?>
                   <div class="rr-project-details-box-1 m-0">
                      <h4 class="rr-project-details-box-title"><?php echo rr_kses( $item['rr_project_features_list_title'] ); ?></h4>
                      <p><?php echo rr_kses( $item['rr_project_features_list_description'] ); ?></p>
                   </div>
                   <?php endforeach; endif; ?>
                </div>
             </div>
          </div>
       </div> 
    </div>
 </section>

<?php endif; 
	}
}

$widgets_manager->register( new rr_Project_Deatils() );