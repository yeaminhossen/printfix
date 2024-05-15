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
class rr_Info_Banner extends Widget_Base {

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
		return 'info-banner';
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
		return __( 'Info Banner', 'rr-core' );
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

        $this->rr_section_title_render_controls('info_banner', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // button
        $this->rr_button_render('info_banner', 'Button', ['layout-3', 'layout-4']);        

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
        $this->add_control(
            'rr_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'rr-core' ),
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

        // shape section
        $this->start_controls_section(
            'rr_info_banner_shape',
            [
                'label' => esc_html__( 'Shape', 'rr-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'rr_design_style' => ['layout-1', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'rr_info_banner_shape_switch',
            [
            'label'        => esc_html__( 'Shape On/Off', 'rr-core' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'rr-core' ),
            'label_off'    => esc_html__( 'Hide', 'rr-core' ),
            'return_value' => 'yes',
            'default'      => '0',
            ]
        );

        $this->add_control(
            'rr_shape_image_1',
            [
                'label' => esc_html__( 'Choose Shape Image 1', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_info_banner_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'rr_shape_image_2',
            [
                'label' => esc_html__( 'Choose Shape Image 2', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_info_banner_shape_switch' => 'yes',
                    'rr_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'rr_shape_image_3',
            [
                'label' => esc_html__( 'Choose Shape Image 3     ', 'rr-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'rr_info_banner_shape_switch' => 'yes',
                    'rr_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'rr_info_banner_shape_switch' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();

        // animation section
        $this->start_controls_section(
            'rr_section_animation',
                [
                'label' => esc_html__( 'Section Animation', 'rr-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );
        // creative animation
        $this->add_control(
			'rr_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'rr-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rr-core   ' ),
				'label_off' => esc_html__( 'No', 'rr-core   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
			]
		);

        $this->add_control(
            'rr_anima_type',
            [
                'label' => __( 'Animation Type', 'rr-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeInUp' => __( 'fadeInUp', 'rr-core' ),
                    'fadeInDown' => __( 'fadeInDown', 'rr-core' ),
                    'fadeInLeft' => __( 'fadeInLeft', 'rr-core' ),
                    'fadeInRight' => __( 'fadeInRight', 'rr-core' ),
                ],
                'default' => 'fadeInUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'rr_anima_dura', [
                'label' => esc_html__('Animation Duration', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'rr-core'),
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'rr_anima_delay', [
                'label' => esc_html__('Animation Delay', 'rr-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'rr-core'),
                'condition' => [
                    'rr_creative_anima_switcher' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

	}

    

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('info_banner_section', 'Section - Style', '.rr-el-section'); 
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
    $bloginfo = get_bloginfo( 'name' );
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'rr-payment__title');
?>

<?php if(!empty($settings['rr_creative_anima_switcher'])) : ?>
<div class="rr-payment__item rr-payment__bg-color-3 p-relative rr-el-section z-index wow <?php echo esc_attr($settings['rr_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['rr_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['rr_anima_delay']); ?>">
<?php else : ?>
<div class="rr-payment__item rr-payment__bg-color-3 p-relative z-index rr-el-section">
<?php endif; ?>
    <?php if(!empty($rr_image)) : ?>
    <div class="rr-payment__shape-9">
        <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($rr_image_2)) : ?>
    <div class="rr-payment__shape-11">
        <img src="<?php echo esc_url($rr_image_2); ?>" alt="<?php echo esc_attr($rr_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="rr-payment__content">

        <?php if ( !empty($settings['rr_info_banner_sub_title']) ) : ?>
        <h4 class="rr-section-subtitle-2"><?php echo rr_kses( $settings['rr_info_banner_sub_title'] ); ?></h4>
        <?php endif; ?>
        <?php
        if ( !empty($settings['rr_info_banner_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
            tag_escape( $settings['rr_info_banner_title_tag'] ),
            $this->get_render_attribute_string( 'title_args' ),
            rr_kses( $settings['rr_info_banner_title' ] )
            );
        endif;
        ?>
        <?php if ( !empty($settings['rr_info_banner_description']) ) : ?>
        <p><?php echo rr_kses( $settings['rr_info_banner_description'] ); ?></p>
        <?php endif; ?>

    </div>
</div>

<?php elseif ( $settings['rr_design_style']  == 'layout-3' ):
    $bloginfo = get_bloginfo( 'name' );
    // thumbnail image
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    // shape image
    if ( !empty($settings['rr_shape_image_1']['url']) ) {
        $rr_shape_image = !empty($settings['rr_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['rr_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['rr_shape_image_1']['url'];
        $rr_shape_image_alt = get_post_meta($settings["rr_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['rr_info_banner_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_info_banner_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-el-btn');
    } else {
        if ( ! empty( $settings['rr_info_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_info_banner_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-el-btn');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'rr-payment__title');
?>

<?php if(!empty($settings['rr_creative_anima_switcher'])) : ?>
<div class="rr-payment__item p-relative z-index wow rr-el-section <?php echo esc_attr($settings['rr_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['rr_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['rr_anima_delay']); ?>">
<?php else : ?>
<div class="rr-payment__item p-relative z-index rr-el-section">
<?php endif; ?>
    <?php if(!empty($rr_shape_image)) : ?>
    <div class="rr-payment__shape-1">
        <img src="<?php echo esc_url($rr_shape_image); ?>" alt="<?php echo esc_attr($rr_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="rr-payment__content rr-payment__content-space">
                <?php if ( !empty($settings['rr_info_banner_sub_title']) ) : ?>
                <h4 class="rr-section-subtitle-2"><?php echo rr_kses( $settings['rr_info_banner_sub_title'] ); ?></h4>
                <?php endif; ?>
                <?php
                if ( !empty($settings['rr_info_banner_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['rr_info_banner_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    rr_kses( $settings['rr_info_banner_title' ] )
                    );
                endif;
                ?>
                <?php if ( !empty($settings['rr_info_banner_description']) ) : ?>
                <p><?php echo rr_kses( $settings['rr_info_banner_description'] ); ?></p>
                <?php endif; ?>
                <?php if ( !empty($settings['rr_info_banner_btn_text']) ) : ?>
                <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?> ><?php echo rr_kses($settings['rr_info_banner_btn_text']); ?><i class="far fa-arrow-right"></i></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <?php if(!empty($rr_image)) : ?>
            <div class="rr-payment__shape-2">
                <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
            </div>
            <?php endif; ?>
            <?php if(!empty($rr_image_2)) : ?>
            <div class="rr-payment__shape-3 d-none d-sm-block">
                <img src="<?php echo esc_url($rr_image_2); ?>" alt="<?php echo esc_attr($rr_image_alt_2); ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php elseif ( $settings['rr_design_style']  == 'layout-4' ):
    // thumbnail image
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['rr_info_banner_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_info_banner_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-white-solid');
    } else {
        if ( ! empty( $settings['rr_info_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_info_banner_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn-white-solid');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'rr-service-3-title-sm');
?>

<div class="wow RRfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
    <?php if(!empty($settings['rr_creative_anima_switcher'])) : ?>
    <div class="wow <?php echo esc_attr($settings['rr_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['rr_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['rr_anima_delay']); ?>">
    <?php else : ?>
    <div>
    <?php endif; ?>
        <div class="rr-service-3-item mb-30 p-relative z-index rr-el-section theme-bg-3" >
            <?php if(!empty($rr_image)) : ?>
            <div class="rr-service-3-icon">
                <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
            </div>
            <?php endif; ?>
            <div class="rr-service-3-content">
                <?php if ( !empty($settings['rr_info_banner_sub_title']) ) : ?>
                <span><?php echo rr_kses($settings['rr_info_banner_sub_title']); ?></span>
                <?php endif; ?>
                <?php
                if ( !empty($settings['rr_info_banner_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['rr_info_banner_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    rr_kses( $settings['rr_info_banner_title' ] )
                    );
                endif;
                ?>
                <?php if ( !empty($settings['rr_info_banner_description']) ) : ?>
                <p class="rr-text-white"><?php echo rr_kses( $settings['rr_info_banner_description'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($settings['rr_info_banner_btn_text'])) : ?>
            <div class="rr-service-3-btn">
                <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><?php echo rr_kses($settings['rr_info_banner_btn_text']); ?></a>
            </div>
            <?php endif; ?>
            <?php if(!empty($rr_image_2)) : ?>
            <div class="rr-service-3-shape">
                <img src="<?php echo esc_url($rr_image_2); ?>" alt="<?php echo esc_attr($rr_image_alt_2); ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php else:

    $bloginfo = get_bloginfo( 'name' );
    if ( !empty($settings['rr_image']['url']) ) {
        $rr_image = !empty($settings['rr_image']['id']) ? wp_get_attachment_image_url( $settings['rr_image']['id'], $settings['rr_image_size_size']) : $settings['rr_image']['url'];
        $rr_image_alt = get_post_meta($settings["rr_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_image_2']['url']) ) {
        $rr_image_2 = !empty($settings['rr_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_image_2']['id'], $settings['rr_image_size_size']) : $settings['rr_image_2']['url'];
        $rr_image_alt_2 = get_post_meta($settings["rr_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    // shape image
    if ( !empty($settings['rr_shape_image_1']['url']) ) {
        $rr_shape_image = !empty($settings['rr_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['rr_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['rr_shape_image_1']['url'];
        $rr_shape_image_alt = get_post_meta($settings["rr_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_shape_image_2']['url']) ) {
        $rr_shape_image_2 = !empty($settings['rr_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['rr_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['rr_shape_image_2']['url'];
        $rr_shape_image_alt_2 = get_post_meta($settings["rr_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['rr_shape_image_3']['url']) ) {
        $rr_shape_image_3 = !empty($settings['rr_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['rr_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['rr_shape_image_3']['url'];
        $rr_shape_image_alt_3 = get_post_meta($settings["rr_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'rr-payment__title');
?>

<?php if(!empty($settings['rr_creative_anima_switcher'])) : ?>
<div class="rr-payment__item rr-payment__bg-color-2 p-relative rr-el-section z-index wow <?php echo esc_attr($settings['rr_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['rr_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['rr_anima_delay']); ?>">
<?php else : ?>
<div class="rr-payment__item rr-payment__bg-color-2 p-relative rr-el-section z-index ">
<?php endif; ?>
    <?php if(!empty($rr_image)) : ?>
    <div class="rr-payment__shape-4">
        <img src="<?php echo esc_url($rr_image); ?>" alt="<?php echo esc_attr($rr_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($rr_image_2)) : ?>
    <div class="rr-payment__shape-5">
        <img src="<?php echo esc_url($rr_image_2); ?>" alt="<?php echo esc_attr($rr_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($rr_shape_image)) : ?>
    <div class="rr-payment__shape-6">
        <img src="<?php echo esc_url($rr_shape_image); ?>" alt="<?php echo esc_attr($rr_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($rr_shape_image_2)) : ?>
    <div class="rr-payment__shape-7">
        <img src="<?php echo esc_url($rr_shape_image_2); ?>" alt="<?php echo esc_attr($rr_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($rr_shape_image_3)) : ?>
    <div class="rr-payment__shape-8">
        <img src="<?php echo esc_url($rr_shape_image_3); ?>" alt="<?php echo esc_attr($rr_shape_image_alt_3); ?>">
    </div>
    <?php endif; ?>
    <div class="rr-payment__content">
        <?php if ( !empty($settings['rr_info_banner_sub_title']) ) : ?>
        <h4 class="rr-section-subtitle-2"><?php echo rr_kses( $settings['rr_info_banner_sub_title'] ); ?></h4>
        <?php endif; ?>
        <?php
        if ( !empty($settings['rr_info_banner_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
            tag_escape( $settings['rr_info_banner_title_tag'] ),
            $this->get_render_attribute_string( 'title_args' ),
            rr_kses( $settings['rr_info_banner_title' ] )
            );
        endif;
        ?>
        <?php if ( !empty($settings['rr_info_banner_description']) ) : ?>
        <p><?php echo rr_kses( $settings['rr_info_banner_description'] ); ?></p>
        <?php endif; ?>
    </div>
</div>



<?php endif; 
	}
}

$widgets_manager->register( new rr_Info_Banner() );
