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
class rr_Contact_Info extends Widget_Base {

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
		return 'rr-contact-info';
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
		return __( 'Contact Info', 'rr-core' );
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

        $this->rr_section_title_render_controls('contact', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            '_rr_contact_info',
            [
                'label' => esc_html__('Contact  List', 'rr-core'),
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

        $repeater->add_control(
            'rr_contact_info_title',
            [
                'label' => esc_html__('Title', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Title Here',
                'label_block' => true,
            ]
        );  


        $repeater->add_control(
            'link_type',
            [
                'label' => __( 'Link Type', 'rr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text', 'rr-core' ),
                    'url' => __( 'URL', 'rr-core' ),
                    'tell' => __( 'Phone Number', 'rr-core' ),
                    'email' => __( 'Email', 'rr-core' ),
                ],
                'default' => '',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        // url
        $repeater->add_control(
            'rr_contact_url',
            [
                'label' => esc_html__('URL', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#',
                'label_block' => true,
                'condition' => [
                    'link_type' => 'url'
                ]
            ]
        );  

        // tell
        $repeater->add_control(
            'rr_contact_tell',
            [
                'label' => esc_html__('Phone Number', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '012345',
                'label_block' => true,
                'condition' => [
                    'link_type' => 'tell'
                ]
            ]
        );  

        // email
        $repeater->add_control(
            'rr_contact_email',
            [
                'label' => esc_html__('Email Address', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('technix@gmail.com', 'rr-core'),
                'label_block' => true,
                'condition' => [
                    'link_type' => 'email'
                ]
            ]
        );  
        // email
        $repeater->add_control(
            'rr_contact_text_label',
            [
                'label' => esc_html__('Label Text', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Label Text', 'rr-core'),
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
	}

    // TAB_STYLE
    protected function style_tab_content(){
        $this->rr_section_style_controls('section_info', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('contact_subtitle', 'contact - Sub Title', '.rr-el-subtitle');
        $this->rr_basic_style_controls('contact_repeter_title', 'contact Repeter Title', '.rr-el-re-Title');
        $this->rr_basic_style_controls('contact_repeter_info_title', 'contact Repeter Info Title', '.rr-el-info-Title');
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

<?php else:
    $this->add_render_attribute('title_args', 'class', 'rr-contact__title wow rrfadeUp rr-el-title');
?>
<div class="rr-contact-info rr-el-section">
    <?php if ( !empty($settings['rr_contact_section_title_show']) ) : ?>
    <div class="rr-contact__comment-form-box2 mb-30">
        <?php
            if ( !empty($settings['rr_contact_title' ]) ) :
                printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['rr_contact_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    rr_kses( $settings['rr_contact_title' ] )
                    );
            endif;
        ?>
        <?php if ( !empty($settings['rr_contact_description']) ) : ?>
        <p class="rr-el-subtitle"><?php echo rr_kses( $settings['rr_contact_description'] ); ?></p>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="rr-contact-info-text">
        <?php foreach ($settings['rr_list'] as $key => $item) :
        $key = $key+1;

        $link_type = $item['link_type'];
        $url = $item['rr_contact_url'];
        $tell = $item['rr_contact_tell'];
        $email = $item['rr_contact_email'];

        $contact_link;

        if($link_type == 'url'){ 
            $contact_link = $url;
        } elseif($link_type == 'tell'){
            $contact_link = 'tel:'.$tell;
        } elseif($link_type == 'email'){
            $contact_link = 'mailto:'.$email;
        }

        ?>
        <div class="rr-contact-item d-flex">
            <div class="rr-contact-item-icon">
           
                    <?php if($item['rr_box_icon_type'] == 'icon') : ?>
                    <?php if (!empty($item['rr_box_icon']) || !empty($item['rr_box_selected_icon']['value'])) : ?>
                    <span>
                        <?php rr_render_icon($item, 'rr_box_icon', 'rr_box_selected_icon'); ?>
                    </span>
                    <?php endif; ?>
                    <?php elseif( $item['rr_box_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($item['rr_box_icon_image']['url'])): ?>
                    <span>
                        <img src="<?php echo $item['rr_box_icon_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    </span>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($item['rr_box_icon_svg'])): ?>
                    <div class="contact-inner-img contact-img-<?php echo esc_attr($key); ?>">
                        <?php echo $item['rr_box_icon_svg']; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
             
            </div>
            <div class="rr-contact-item-content">
                <?php if ( !empty($item['rr_contact_text_label']) ) : ?>
                <h3 class="rr-contact-item-title rr-el-re-Title"><?php echo rr_kses($item['rr_contact_text_label']);?></h3>
                <?php endif; ?>
                <?php if(!empty($item['link_type'])) : ?>
                <a href="<?php echo esc_url($contact_link); ?>"><?php echo rr_kses($item['rr_contact_info_title']); ?></a>
                <?php else : ?>
                <?php echo rr_kses($item['rr_contact_info_title']); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif;
	}
}

$widgets_manager->register( new rr_Contact_Info() );