<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Utils;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Pricing extends Widget_Base {

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
		return 'rr-pricing';
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
		return __( 'Pricing', 'rr-core' );
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


        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'rr-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
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

        $this->add_control(
            'active_price',
            [
                'label' => __('Active Price', 'rr-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rr-core'),
                'label_off' => __('Hide', 'rr-core'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Header
        $this->start_controls_section(
            '_section_header',
            [
                'label' => __('Header', 'rr-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Basic', 'rr-core'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Sub Title', 'rr-core'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'rr_design_style' => ['layout-10'],
                ]
            ]
        );

        $this->add_control(
            'cat_description',
            [
                'label' => __('Cat Description', 'rr-core'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('/ Popular', 'rr-core'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => __('Pricing', 'rr-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __('Currency', 'rr-core'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'rr-core'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'rr-core'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'rr-core'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'rr-core'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'rr-core'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'rr-core'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'rr-core'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'rr-core'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'rr-core'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'rr-core'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'rr-core'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'rr-core'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'rr-core'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'rr-core'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'rr-core'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'rr-core'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'rr-core'),
                    'custom' => __('Custom', 'rr-core'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $this->add_control(
            'duration',
            [
                'label' => __('Duration', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('/Per Month', 'rr-core'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_features',
            [
                'label' => __('Features', 'rr-core'),
            ]
        );

        $this->add_control(
            'show_features',
            [
                'label' => __('Show', 'rr-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'rr-core'),
                'label_off' => __('Hide', 'rr-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );


        $repeater = new Repeater();


        $repeater->add_control(
            'rr_features_title',
            [
                'label' => __('Feature Title', 'rr-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature', 'rr-core'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'rr_features_title' => __('Standard Feature', 'rr-core'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'rr_features_title' => __('Another Great Feature', 'rr-core'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'rr_features_title' => __('Obsolete Feature', 'rr-core'),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'rr_features_title' => __('Exciting Feature', 'rr-core'),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print((rr_features_title)); #>',
            ]
        );

        $this->end_controls_section();


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
        $this->rr_section_style_controls('pricing_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('pricing_ammount', 'Price - Ammount', '.rr-el-box-ammount');
        $this->rr_basic_style_controls('pricing_period', 'Price - Period', '.rr-el-box-period');
        $this->rr_basic_style_controls('features_title', 'Features - Title', '.rr-el-feature-title');
        $this->rr_basic_style_controls('pricing_list', 'Price - List', '.rr-el-box-list');
        $this->rr_link_controls_style('pricing_btn', 'Price - Button', '.rr-el-box-btn'); 
    }

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    private static function get_currency_symbol_text($symbol_text)
    {
        $symbols =[
            'baht' => 'THB',
            'bdt' => 'BDT',
            'dollar' => 'USD',
            'euro' => 'EUR',
            'franc' => 'EUR',
            'guilder' => 'GLD',
            'indian_rupee' => 'INR',
            'pound' => 'GBP',
            'peso' => 'MXN',
            'lira' => 'TRY',
            'ruble' => 'RUB',
            'shekel' => 'ILS',
            'real' => 'BRL',
            'krona' => 'KR',
            'won' => 'KRW',
            'yen' => 'JPY',
        ];

        return isset($symbols[$symbol_text]) ? $symbols[$symbol_text] : '';
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
    $this->add_render_attribute('title_args', 'class', 'rr-title');

?>


<!-- default style -->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'rr-title');

    // Link
    if ('2' == $settings['rr_btn_link_type']) {
        $this->add_render_attribute('rr-button-arg', 'href', get_permalink($settings['rr_btn_page_link']));
        $this->add_render_attribute('rr-button-arg', 'target', '_self');
        $this->add_render_attribute('rr-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-box-btn');
    } else {
        if ( ! empty( $settings['rr_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'rr-button-arg', $settings['rr_btn_link'] );
            $this->add_render_attribute('rr-button-arg', 'class', 'rr-btn rr-el-box-btn');
        }
    }

    if ($settings['currency'] === 'custom') {
        $currency = $settings['currency_custom'];
    } else {
        $currency = self::get_currency_symbol($settings['currency']);
    }

    $active_price = $settings['active_price'] ? 'active' : '';
?>
<div class="rr-pricing-item rr-pricing-item-medial p-relative <?php echo esc_attr($active_price); ?> mb-30 wow fadeInUp text-center rr-el-section"
    data-wow-duration="1s" data-wow-delay=".5s">
    <?php if(!empty($settings['title'])) :?>
    <div class="rr-pricing-head">
        <h4 class="rr-pricing-tag rr-el-feature-title"><?php echo esc_html($settings['title']); ?>
            <span><?php echo esc_html( $settings['cat_description']); ?></span></h4>
    </div>
    <?php endif; ?>
    <h3 class="rr-pricing-price rr-el-box-ammount">
        <?php echo esc_html($currency); ?><?php echo rr_kses($settings['price']); ?><span class="rr-el-box-period">
            /<?php echo rr_kses($settings['duration']); ?></span></h3>
    <div class="rr-pricing-list">
        <ul>
            <?php if ( !empty($settings['show_features']) ) : 
            foreach ($settings['features_list'] as $index => $item) :
            ?>
            <li class="rr-el-box-list"><?php echo rr_kses($item['rr_features_title']); ?></li>
            <?php endforeach; endif; ?>
        </ul>
    </div>
    <div class="rr-pricing-btn">
        <?php if (!empty($settings['rr_btn_button_show'])) : ?>
        <a <?php echo $this->get_render_attribute_string( 'rr-button-arg' ); ?>><span><?php echo $settings['rr_btn_text']; ?> </span> <i class="fa-solid fa-arrow-right"></i></a>
        <?php endif; ?>
    </div>
</div>

<?php endif;
    }
}

$widgets_manager->register( new rr_Pricing() );