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
class rr_Text_Slider extends Widget_Base {

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
		return 'rr-text-slider';
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
		return __( 'Text', 'rr-core' );
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
			'about_team_list_sec',
				[
				  'label' => esc_html__( 'Features List', 'rr-core' ),
				  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				  'condition' => [
					   'rr_design_style' => ['layout-1', 'layout-2']
				  ]
				]
		   );
		   $this->add_control(
            'team_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'titile', 'rr-core' ),
                'placeholder' => __( 'titile', 'rr-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );         
	
		   // repeater for about features list with text , testarea and icon
		   $repeater = new Repeater();
		   
		   $repeater->add_control(
			   'rr_about_features_list_title',
			   [
				   'label' => esc_html__('Title', 'rr-core'),
				   'type' => Controls_Manager::TEXT,
				   'default' => esc_html__('Title', 'rr-core'),
				   'title' => esc_html__('Enter title', 'rr-core'),
				   'label_block' => true
				   
			   ]
		   );
		   $repeater->add_control(
			'rr_about_features_list_des',
			[
				'label' => esc_html__('des', 'rr-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__(' RR des', 'rr-core'),
				'title' => esc_html__('Enter des', 'rr-core'),
				'label_block' => true
				
			]
		);
		   $this->add_control(
			   'rr_about_features_list',
			   [
				   'label' => esc_html__('Features List', 'rr-core'),
				   'type' => Controls_Manager::REPEATER,
				   'fields' => $repeater->get_controls(),
				   'default' => [
					   [
						   'rr_about_features_list_title' => esc_html__('Custom shortcodes', 'rr-core'),
					   ]
				   ],
				   'title_field' => '{{{ rr_about_features_list_title }}}',
			   ]
		   );
   
		   $this->end_controls_section();
		   
   
    }

    protected function style_tab_content(){
		$this->rr_basic_style_controls('history_title', 'Title', '.rr-el-box-title');
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
<div class="rr-team-details-value">
    <?php 
		if ( !empty($settings['rr_about_features_list']) ) :
			foreach ( $settings['rr_about_features_list'] as $item ) :
			$title = $item['rr_about_features_list_title'];
	?>
    <ul>
        <?php  if ( !empty('rr_about_features_list_title') ) : ?>
        <li class="txt"><i class="fa-solid fa-check"></i><?php echo rr_kses( $item['rr_about_features_list_title'] ); ?>
        </li>
        <?php endif; ?>
		<p><?php echo rr_kses( $item['rr_about_features_list_des'] ); ?></p>
    </ul>
    <?php endforeach; endif; ?>
</div>

<?php else: ?>

<div class="rr-team-details-value">
	
	<?php  if ( !empty('team_title') ) : ?>
	<h3 class="rr-team-details-title"><?php echo rr_kses( $settings['team_title'] ); ?></h3>
	<?php endif; ?>
    <ul>
	    <?php 
			if ( !empty($settings['rr_about_features_list']) ) :
				foreach ( $settings['rr_about_features_list'] as $item ) :
				$title = $item['rr_about_features_list_title'];
		?>
        <?php  if ( !empty('rr_about_features_list_title') ) : ?>
        <li><i class="fa-solid fa-check"></i><?php echo rr_kses( $item['rr_about_features_list_title'] ); ?></li>
        <?php endif; ?>
        <?php endforeach; endif; ?>
    </ul>
    
</div>
<?php endif; 
	}
}

$widgets_manager->register( new rr_Text_Slider() );