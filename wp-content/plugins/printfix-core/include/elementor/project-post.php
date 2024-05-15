<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class RR_Project_Post extends Widget_Base {

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
		return 'rr-project-post';
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
		return __( 'Project Post', 'rr-core' );
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

        // title/content
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-3']);
        
        // Product Query
        $this->rr_query_controls('rr-projects-id', 'Project', 'rr-projects', 'projects-cat', '6', '10', );

        // $this->rr_query_controls('blog', 'Blog');


        // rr_post__columns_section
        $this->rr_columns('col', ['layout-1','layout-2','layout-3']);

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('project_section', 'Section - Style', '.rr-el-section');

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

        /**
         * Setup the post arguments.
        */
        $query_args = rr_Helper::get_query_args('rr-projects', 'rr-projects', $this->get_settings());

       // The Query
       $query = new \WP_Query($query_args);

       $filter_list = $settings['category'];


        ?>

<?php if ( $settings['rr_design_style']  == 'layout-2' ): ?>



<?php else: 

$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '5';
$order = (!empty($settings['order'])) ? $settings['order'] : 'desc';

$paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;

$projects = new \WP_Query( [
	'post_type'      => 'rr-projects',
	'post_status'    => 'publish',
	'posts_per_page' => $posts_per_page,
	'order'          => $order,
	'paged' => $paged, 
] );

	?>

<div class="row gx-30">
    <?php while ( $projects->have_posts() ) {
		$projects->the_post();
		$image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' )
	?>

    <div
        class="col-xl-<?php echo esc_attr($settings['rr_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['rr_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['rr_col_for_tablet']); ?> col-<?php echo esc_attr($settings['rr_col_for_mobile']); ?>">
        <div class="rr-project-slider-item mb-30">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="rr-project-slider-thumb">
                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>">
            </div>
            <?php endif; ?>
            <div class="rr-project-slider-content text-center">
                <h3 class="rr-project-slider-title"><a href="<?php the_permalink( ); ?>"><?php the_title(); ?></a></h3>
                <span>
                    <?php
				$excerpt = wp_trim_words( get_the_excerpt(), 5, '...' ); // Limit to 5 words
        		echo $excerpt;	?>
                </span>
            </div>
        </div>
    </div>

    <?php }?>
</div>
<div class="basic-pagination bg-color mt-30 text-center">
    <?php
		$big = 999999999;
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $projects->max_num_pages,
			'prev_text' => '<i class="fa-solid fa-chevrons-left"></i>',
			'next_text' => '<i class="fa-solid fa-chevrons-right"></i>'
		) );
	?>
</div>
<?php wp_reset_query();?>
<?php endif;
	}
    function get_portfolio_tags( $post_id ) {
        $tags = get_the_terms( $post_id, 'projects-cat' );

        $_tags = [];

        if ( !empty( $tags ) ) {

            foreach ( $tags as $tag ) {
                $_tags[$tag->term_id] = $tag->slug;
            }
        }

        return join( ' ', $_tags );
    }
}

$widgets_manager->register( new RR_Project_Post() );