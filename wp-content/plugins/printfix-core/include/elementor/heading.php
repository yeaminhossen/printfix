<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Heading extends Widget_Base {

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
		return 'rr-heading';
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
		return __( 'Heading', 'rr-core' );
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
                    'layout-4' => esc_html__('Layout 4', 'rr-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // title/content
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-1','layout-2','layout-3','layout-4']);


	}

    protected function style_tab_content(){
        $this->rr_section_style_controls('heading_section', 'Section - Style', '.rr-el-section');

        $this->rr_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.rr-el-subtitle');
        $this->rr_basic_style_controls('heading_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('heading_desc', 'Section - Description', '.rr-el-content');
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


<?php if($settings['rr_design_style']  == 'layout-2'):
	$this->add_render_attribute('title_args', 'class', 'rr-section-title');
?>



<?php else:
	$this->add_render_attribute('title_args', 'class', 'rr-section-title wow rrfadeUp rr-el-title');
?>
<?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
<div class="rr-section-title-wrapper text-center rr-el-section">
    <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
    <span class="rr-section-subtitle wow rrfadeRight rr-el-subtitle" data-wow-duration=".9s"
        data-wow-delay=".5s"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></span>
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
    <?php if ( !empty($settings['rr_section_description']) ) : ?>
    <p class="rr-el-content"><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php endif;
	}
}

$widgets_manager->register( new rr_Heading() );