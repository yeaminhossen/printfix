<?php
namespace RRCore;

use RRCore\PageSettings\Page_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class RR_Core_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

    public function RR_core_elementor_category($manager)
    {
        $manager->add_category(
            'rr-core',
            array(
                'title' => esc_html__('Printfix Addons', 'rr-core'),
                'icon' => 'eicon-banner',
            )
        );
    }

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'rr-core', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'rr-core-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * RR_enqueue_editor_scripts
	 */
    function RR_enqueue_editor_scripts()
    {
        wp_enqueue_style('rr-element-addons-editor', RRCORE_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
    }





	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'rr-core-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		foreach($this->rr_core_widget_list() as $widget_file_name){
			require_once( RRCORE_ELEMENTS_PATH . "/{$widget_file_name}.php" );
		}

		// Wpeventin
		if ( class_exists( 'Wpeventin' ) ) {
			foreach($this->rr_core_widget_list_events_etn() as $widget_file_name){
				require_once( RRCORE_ELEMENTS_PATH . "/{$widget_file_name}.php" );
			}
		}

		// give donation
		if ( class_exists( 'Charitable' ) ) {
			foreach($this->rr_core_widget_list_donation() as $widget_file_name){
				require_once( RRCORE_ELEMENTS_PATH . "/{$widget_file_name}.php" );
			}
		}
	}

	public function rr_core_widget_list() {
		return [
			
			'blog-post',
			'services',
			'contact-info',
			'contact-form',
			'team',
			'testimonial',
			'brand',
			'fact',
			'project-slider',
			'faq',
			
			// 'cta',
			// 'video-popup',
			// 'shop',
			// 'hero-banner',
			// 'slider',
			// 'about',
			// 'pricing',
			// 'team-details-contact',
			// 'heading',
			// 'button',
			// 'instagram',
			// 'project-post',
			
			
			// 'project-box',
			// 'portfolio-details',
			// 'features',
			// 'video-popup',
			// 'process',
			// 'portfolio-post',
			// 'advanced-tab',
			// 'skill',
			// 'text',
			// 'list',
			// 'info-card',
			// 'menu-demo',
			// 'gallery',
			// 'providing-tab',
		];
	}

	// etn events
	public function rr_core_widget_list_events_etn() {
		return [
			// 'events',
		];
	}

	// give
	public function rr_core_widget_list_donation() {
		return [
			// 'charity',
		];
	}

	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

    public function register_controls(Controls_Manager $controls_Manager)
    {
        include_once(RRCORE_ADDONS_DIR . '/controls/RRgradient.php');
        $RRgradient = 'RRCore\Elementor\Controls\Group_Control_RRGradient';
        $controls_Manager->add_group_control($RRgradient::get_type(), new $RRgradient());

        include_once(RRCORE_ADDONS_DIR . '/controls/RRbggradient.php');
        $RRbggradient = 'RRCore\Elementor\Controls\Group_Control_RRBGGradient';
        $controls_Manager->add_group_control($RRbggradient::get_type(), new $RRbggradient());
    }

    public function RR_add_custom_icons_tab($tabs = array()){

        // Append new icons
        $feather_icons = array(
            'feather-activity',
            'feather-airplay',
            'feather-alert-circle',
            'feather-alert-octagon',
            'feather-alert-triangle',
            'feather-align-center',
            'feather-align-justify',
            'feather-align-left',
            'feather-align-right',
        );

        $tabs['rr-feather-icons'] = array(
            'name' => 'rr-feather-icons',
            'label' => esc_html__('RR - Feather Icons', 'rr-core'),
            'labelIcon' => 'rr-icon',
            'prefix' => '',
            'displayPrefix' => 'RR',
            'url' => RRCORE_ADDONS_URL . 'assets/css/feather.css',
            'icons' => $feather_icons,
            'ver' => '1.0.0',
        );


        // Append flaticon fonts icons
        $flat_icons = array(
            'flaticon-stethoscope',
            'flaticon-user',
            'flaticon-phone',
            'flaticon-loupe',
            'flaticon-curved-arrow',
            'flaticon-diet',
            'flaticon-handshake',
            'flaticon-play-button',
            'flaticon-arrow-right',
            'flaticon-double-quotes',
            'flaticon-time',
            'flaticon-pin',
            'flaticon-check-mark-black-outline',
            'flaticon-handshake-1',
            'flaticon-tag',
            'flaticon-mail',
            'flaticon-telephone-call',
            'flaticon-book',
            'flaticon-drops',
            'flaticon-healthy-food',
            'flaticon-giving',
            'flaticon-settings',
            'flaticon-volunteer',
            'flaticon-donor',
            'flaticon-handshake-2',
            'flaticon-facebook-logo',
            'flaticon-instagram',
            'flaticon-twitter',
            'flaticon-pinterest',
            'flaticon-agree',
            'flaticon-pray',
            'flaticon-world-blood-donor-day',
			'flaticon-quote',
			'flaticon-map',
			'flaticon-down-arrow',
			'flaticon-open-book',
			'flaticon-warning',
			'flaticon-comment',
			'flaticon-calendar',
			'flaticon-folder',
			'flaticon-home',
			'flaticon-love',
			'flaticon-people',
			'flaticon-shopping-cart',
			'flaticon-heart',
			'flaticon-email',
			'flaticon-mission',
			'flaticon-vision',
			'flaticon-right-arrow',
			'flaticon-up-arrow',
			'flaticon-right-arrow-1',
			'flaticon-down-arrow-1',
			'flaticon-location',
			'flaticon-home-1',
			'flaticon-zakat',
			'flaticon-people-1',
			'flaticon-love-1'
        );

        $tabs['rr-flaticon-icons'] = array(
            'name' => 'rr-flaticon-icons',
            'label' => esc_html__('RR - Flaticons', 'rr-core'),
            'labelIcon' => 'rr-icon',
            'prefix' => '',
            'displayPrefix' => 'RR',
            'url' => RRCORE_ADDONS_URL . 'assets/css/flaticon.css',
            'icons' => $flat_icons,
            'ver' => '1.0.0',
        );

        $fontawesome_icons = array(
	        'angle-up',
	        'check',
	        'times',
	        'calendar',
	        'language',
	        'shopping-cart',
	        'bars',
	        'search',
	        'map-marker',
	        'arrow-right',
	        'arrow-left',
	        'arrow-up',
	        'arrow-down',
	        'angle-right',
	        'angle-left',
	        'angle-up',
	        'angle-down',
	        'phone',
	        'users',
	        'user',
	        'map-marked-alt',
	        'trophy-alt',
	        'envelope',
	        'marker',
	        'globe',
	        'broom',
	        'home',
	        'bed',
	        'chair',
	        'bath',
	        'tree',
	        'laptop-code',
	        'cube',
	        'cog',
	        'play',
	        'trophy-alt',
	        'heart',
	        'truck',
	        'user-circle',
	        'map-marker-alt',
	        'comments',
	         'award',
	        'bell',
	        'book-alt',
	        'book-open',
	        'book-reader',
	        'graduation-cap',
	        'laptop-code',
	        'music',
	        'ruler-triangle',
	        'user-graduate',
	        'microscope',
	        'glasses-alt',
	        'theater-masks',
	        'atom'
        );

        $tabs['rr-fontawesome-icons'] = array(
            'name' => 'rr-fontawesome-icons',
            'label' => esc_html__('RR - Fontawesome Pro Light', 'rr-core'),
            'labelIcon' => 'rr-icon',
            'prefix' => 'fa-',
            'displayPrefix' => 'fal',
            'url' => RRCORE_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
            'icons' => $fontawesome_icons,
            'ver' => '1.0.0',
        );

        return $tabs;
    }


	// campaign_template_fun
	public function campaign_template_fun( $campaign_template ) {

	    if ( ( get_post_type() == 'campaign' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-campaign.php';
	        $campaign_template           = $campaign_template_file_path;
	    }
	    if ( ( get_post_type() == 'tribe_events' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-event.php';
	        $campaign_template           = $campaign_template_file_path;
	    }
	    if ( ( get_post_type() == 'etn' ) && is_single() ) {
	        $campaign_template_file_path = __DIR__ . '/include/template/single-etn.php';
	        $campaign_template           = $campaign_template_file_path;
	    }

	    if ( ! $campaign_template ) {
	        return $campaign_template;
	    }
	    return $campaign_template;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		add_action('elementor/elements/categories_registered', [$this, 'RR_core_elementor_category']);

		// Register custom controls
	    add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
	    add_action('elementor/controls/register_style_controls', [$this, 'register_style_rols']);

	    add_filter('elementor/icons_manager/additional_tabs', [$this, 'RR_add_custom_icons_tab']);

	    // $this->RR_add_custom_icons_tab();

	    add_action('elementor/editor/after_enqueue_scripts', [$this, 'RR_enqueue_editor_scripts'] );

	    add_filter( 'template_include', [ $this, 'campaign_template_fun' ], 99 );

		// $this->add_page_settings_controls();

	}


}

// Instantiate Plugin Class
RR_Core_Plugin::instance();
