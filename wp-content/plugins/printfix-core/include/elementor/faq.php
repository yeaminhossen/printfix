<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_FAQ extends Widget_Base {

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
		return 'rr-faq';
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
		return __( 'FAQ', 'rr-core' );
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

        $this->start_controls_section(
            '_accordion_thumb',
            [
                'label' => esc_html__( 'Image', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'rr_thumb_img',
            [
                'label' => esc_html__( 'Choose Small Thumbnail', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'rr_thumb_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );

        $this->end_controls_section();

		 // rr_section_title
		$this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1']);


		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'rr-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'accordion_extra_shape',
            [
                'label' => esc_html__( 'Shap Active', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
                'label_off' => esc_html__( 'No', 'rr-core   ' ),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'rr_accordion_active_switch',
            [
                'label' => esc_html__( 'Show', 'rr-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rr-core' ),
                'label_off' => esc_html__( 'Hide', 'rr-core' ),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'rr-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'rr-core'),
                'description' => rr_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #1', 'rr-core' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #2', 'rr-core' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #3', 'rr-core' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #4', 'rr-core' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

	

	}

	protected function style_tab_content(){
		$this->rr_section_style_controls('faq_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('faq_title', 'faq Title', '.rr-el-re-Title');
        $this->rr_basic_style_controls('faq_desc', 'faq Description', '.rr-el-re-dec');
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
    $this->add_render_attribute('title_args', 'class', 'rr-section-title');  

?>


<?php else : 
	$this->add_render_attribute('title_args', 'class', 'title mb-40 wow fadeInLeft animated rr-el-title');  
    if ( !empty($settings['rr_thumb_img']['url']) ) {
        $rr_thumb_img = !empty($settings['rr_thumb_img']['id']) ? wp_get_attachment_image_url( $settings['rr_thumb_img']['id'], $settings['thumbnail_size_size']) : $settings['rr_thumb_img']['url'];
        $rr_thumb_size_size = get_post_meta($settings["rr_thumb_img"]["id"], "_wp_attachment_image_alt", true);
    } 
?>
<!-- Faq area start -->
<section class="question__area overflow-hidden section-space question-bg rr-el-section">
    <div id="primary" class="shape-wrapper">
        <div class="container p-relative">
        <?php if ( !empty($settings['accordion_extra_shape']) ) : ?>
            <div class="question__all-shape">
                <div class="bg-shape">
                    <img class="upDown" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/faq/faq-bg-shape.svg" alt="img not found">
                </div>
                <div class="bulet-shape">
                    <img class="upDown-top" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/faq/faq-bulet_shape.svg" alt="img not found">
                </div>
                <div class="close-shape">
                    <img class="zooming" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/faq/cross.svg" alt="img not found">
                </div>
            </div>
        <?php endif; ?>
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-6 col-md-6">
                    <div class="content-area">
                        <div class="faq">
                            <div id="faq" class="accordion">
                            <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                                <h6 class="subtitle wow fadeInLeft animated rr-el-sub-titl" data-wow-delay=".6s"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
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
                                <?php foreach ( $settings['accordions'] as $index => $item) : 
                                    $collapsed = ($index == '0' ) ? '' : 'collapsed';
                                    $show = ($index == '0' ) ? "show" : "";
                                ?>
                                <div class="card wow fadeInLeft animated" data-wow-delay="1s">
                                    <div class="card-header">
                                        <button class="card-link rr-el-re-Title" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo esc_attr($index); ?>">
                                        <?php echo esc_html($item['accordion_title']); ?>
                                        </button>
                                    </div>
                                    <div id="faq-<?php echo esc_attr($index); ?>" class="collapse <?php echo esc_attr($show); ?>" data-bs-parent="#faq">
                                        <div class="card-body">
                                            <p class="rr-el-re-dec"><?php echo rr_kses($item['accordion_description']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6">
                    <div class="media">
                    <?php if(!empty($rr_thumb_img)) : ?>
                        <img src="<?php echo esc_url($rr_thumb_img); ?>" alt="<?php echo esc_attr($rr_thumb_size_size); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faq area end -->
<!-- faq area start -->
<section class="rr-faq-area p-relative pt-120 pb-120 rr-el-section d-none"
    style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/faq/bg-shape.png)">
    <div class="rr-faq-bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5"> 
                <div class="rr-faq-wrapper">
                    <div class="rr-faq-title-wrapper">
                        <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                        <span
                            class="rr-section-title-pre"><?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></span>
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
                        <p><?php echo rr_kses( $settings['rr_section_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="rr-faq-counter-wrapper d-flex">
                        <?php foreach ( $settings['rr_counter_fact_title_2_list'] as $index => $item) :?>
                        <div class="rr-faq-counter d-flex align-items-center mr-20 mb-30">
                            <div class="rr-faq-counter-icon">
                                <span>
                                    <?php if($item['rr_service_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['rr_service_icon']) || !empty($item['rr_service_selected_icon']['value'])) : ?>
                                    <div class="rr-about-item-thumb">
                                        <?php rr_render_icon($item, 'rr_service_icon', 'rr_service_selected_icon'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php elseif( $item['rr_service_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['rr_service_image']['url'])): ?>
                                    <div class="rr-about-item-thumb">
                                        <img src="<?php echo $item['rr_service_image']['url']; ?>"
                                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['rr_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    </div>
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['rr_service_icon_svg'])): ?>
                                    <div class="rr-about-item-thumb">
                                        <?php echo $item['rr_service_icon_svg']; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="rr-faq-counter-content">
                                <h4 class="rr-faq-counter-title"><span class="purecounter" data-purecounter-duration="3"
                                        data-purecounter-end="<?php echo rr_kses($item['rr_counter_fact_number']); ?>"></span>+
                                </h4>
                                <?php if ( !empty($item['rr_counter_fact_title']) ) : ?>
                                <p><?php echo rr_kses($item['rr_counter_fact_title']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="rr-faq-tab-content rr-accordion wow fadeInRight" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="accordion" id="general_accordion">
                        <?php foreach ( $settings['accordions'] as $index => $item) : 
		                $collapsed = ($index == '0' ) ? '' : 'collapsed';
		                $show = ($index == '0' ) ? "show" : "";
		            ?>
                        <div class="accordion-item rr-faq-active">
                            <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true"
                                    aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                    <?php echo esc_html($item['accordion_title']); ?>
                                </button>
                            </h2>
                            <div id="collapseOne-<?php echo esc_attr($index); ?>"
                                class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                                aria-labelledby="headingOne-<?php echo esc_attr($index); ?>"
                                data-bs-parent="#general_accordion">
                                <div class="accordion-body">
                                    <p><?php echo rr_kses($item['accordion_description']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq area end -->

<?php endif;
	}

}

$widgets_manager->register( new rr_FAQ() );