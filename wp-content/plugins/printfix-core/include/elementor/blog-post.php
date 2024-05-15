<?php
namespace RRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RR Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class rr_Blog_Post extends Widget_Base {

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
		return 'rr-blog-post';
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
		return __( 'Blog Post', 'rr-core' );
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
        $this->rr_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-1','layout-2']);

      // Blog Query
      $this->rr_query_controls('blog', 'Blog', ['layout-1', 'layout-2', 'layout-3']);


        // section column
        $this->rr_columns('col', ['layout-1', 'layout-2', 'layout-3']);
        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->rr_section_style_controls('blog_section', 'Section - Style', '.rr-el-section');
        $this->rr_basic_style_controls('section_sub_title', 'Section - Sub Title', '.rr-el-sub-title');
        $this->rr_basic_style_controls('section_title', 'Section - Title', '.rr-el-title');
        $this->rr_basic_style_controls('blog_meta', 'Blog Meta', '.rr-el-blog-meta');
        $this->rr_basic_style_controls('blog_title', 'Blog Title', '.rr-el-re-Title');
        $this->rr_link_controls_style('repiter_btn', 'Blog - Button', '.rr-el-btn');
        $this->rr_section_style_controls('date_box', 'Date Box', '.date-box');

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
        $query_args = RR_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);

        $filter_list = $settings['category'];

        ?>

<?php if ( $settings['rr_design_style']  == 'layout-2' ): 
	$this->add_render_attribute('title_args', 'class', 'latest-blog2__title-wrapper-title rr-el-title');
?>
<!-- blog-news area start -->
<section class="latest-blog2__area section-space latest-blog2-bg rr-el-section">
    <div class="container">
        <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
        <div class="blog2-top heading-space2">
            <div class="latest-blog2__title-wrapper">
                <?php if ( !empty($settings['rr_section_sub_title']) ) : ?>
                <h6 class="latest-blog2__title-wrapper-subtitle rr-el-sub-title">
                    <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
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
            </div>
            <div class="latest-blog2__button-right">
                <a href="blog-details.html" class="rr-btn">View All </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row mb-minus-30">
            <?php if ($query->have_posts()) :
                $i = 0.0;
                while ($query->have_posts()) : 
                $query->the_post();
                global $post;
                $categories = get_the_category($post->ID);
                $i+=0.3;
            ?>
            <div class="col-12 mb-30">
                <div class="latest-blog2__item-wrapper white-bg">
                    <div class="latest-blog2__item-wrapper-item">
                        <div class="latest-blog2__item-wrapper-item-img">
                            <?php if(has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="latest-blog2__item-wrapper-body">
                        <div class="post-content">
                            <span><?php echo esc_attr__( 'Print Shop | ', 'rr-core' ) ?><?php the_time( 'F j, Y' ); ?></span>
                            <a href="<?php the_permalink( ); ?>">
                                <h5 class="rr-el-re-Title"><?php echo wp_trim_words(get_the_title(), $settings['rr_blog_title_word'], ''); ?>
                                </h5>
                            </a>
                            <p>
                                <?php
                                $excerpt = wp_trim_words( get_the_excerpt(), 33, '...' ); // Limit to 5 words
                                echo $excerpt;	
                            ?>
                            </p>
                            <h6 class="rr-el-blog-meta"><?php echo esc_attr__( 'Author : ', 'rr-core' )?><span><?php the_author(); ?></span>
                            </h6>
                        </div>

                        <div class="latest-blog2__item-wrapper-button">
                            <a href="<?php the_permalink( ); ?>"
                                class="rr-btn btn-transparent rr-el-btn"><?php echo rr_kses($settings['rr_post_button']); ?></a>
                        </div>
                    </div>

                </div>
            </div>
            <?php endwhile; wp_reset_query(); endif; ?>
        </div>
    </div>
</section>
<!-- blog-news area end -->
<?php elseif ( $settings['rr_design_style']  == 'layout-3' ): 
	$this->add_render_attribute('title_args', 'class', 'latest-blog2__title-wrapper-title rr-el-title');
?>
<!-- blog-news area start -->
<section class="latest-blog__area section-space pb-90 overflow-hidden latest-blog-bg rr-el-section">
    <div class="container">
        <div class="row mb-minus-30">
            <?php if ($query->have_posts()) :
                    $i = 0.0;
                    while ($query->have_posts()) : 
                    $query->the_post();
                    global $post;
                    $categories = get_the_category($post->ID);
                    $i+=0.3;
                ?>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="swiper-slide latest-blog__item-slide">
                    <div class="latest-blog__item-slide-inner">
                        <div class="latest-blog__item-media">
                            <?php if(has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="latest-blog__item-text">
                            <div class="latest-blog__item-text-meta d-flex">
                                <div class="latest-blog__item-text-meta-calender">
                                    <h4><?php echo the_time("j")?></h4>
                                    <p><?php echo the_time("F")?></p>
                                </div>
                                <span><a class="rr-el-blog-meta"  href="<?php the_permalink(); ?>"><i class="fa-regular fa-user"></i>
                                        <?php the_author(); ?></a></span>
                                <span class="meta-comment "><a class="rr-el-blog-meta" href="<?php the_permalink(); ?>"><i
                                            class="fa-regular fa-comment"></i> <?php comments_number();?></a></span>
                            </div>

                            <div class="latest-blog__item-text-bottom">
                                <a href="<?php the_permalink(); ?>">
                                    <h4 class="rr-el-title">
                                        <?php echo wp_trim_words(get_the_title(), $settings['rr_blog_title_word'], ''); ?>
                                    </h4>
                                </a>
                                <a href="<?php the_permalink(); ?>"
                                    class="readmore d-flex align-items-center rr-el-btn"><?php echo rr_kses($settings['rr_post_button']); ?>
                                    <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); endif; ?>


            <div class="basic-pagination bg-color mt-30 text-center">
                <?php
                    $big = 999999999;
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $post->max_num_pages,
                        'prev_text' => '<i class="fa-solid fa-chevrons-left"></i>',
                        'next_text' => '<i class="fa-solid fa-chevrons-right"></i>'
                    ) );
                ?>
            </div>
        </div>
    </div>
</section>
<!-- blog-news area end -->
<?php else : 
	$this->add_render_attribute('title_args', 'class', 'title wow fadeInLeft animated rr-el-title');	
?>
<!-- blog-news area start -->
<section class="latest-blog__area pb-60 overflow-hidden latest-blog-bg rr-el-section">
    <div class="container">
        <div class="blog-top heading-space2">
            <?php if ( !empty($settings['rr_section_section_title_show']) ) : ?>
            <div class="latest-blog__title-wrapper">

                <h6 class="subtitle wow fadeInLeft animated rr-el-sub-title" data-wow-delay=".2s">
                    <?php echo rr_kses( $settings['rr_section_sub_title'] ); ?></h6>
                <?php
                    if ( !empty($settings['rr_section_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['rr_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        rr_kses( $settings['rr_section_title' ] )
                        );
                    endif;
                ?>
            </div>
            <?php endif; ?>
            <div class="latest-blog__button-right fadeInRight animated" data-wow-delay=".3s">
                <button class="small-btn small-btn-transparent blog__slider-button-prev">
                    <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17L1 9L9 1" stroke="#001D08" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="small-btn small-btn-transparent blog__slider-button-next">
                    <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 17L9 9L1 1" stroke="#001D08" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="latest-blog__item mb-30 wow fadeInLeft animated" data-wow-delay=".8s">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php if ($query->have_posts()) :
                                $i = 0.0;
                                while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;
                                $categories = get_the_category($post->ID);
                                $i+=0.3;
                            ?>
                            <div class="swiper-slide latest-blog__item-slide pb-30 ">
                                <div class="latest-blog__item-slide-inner date-box">
                                    <div class="latest-blog__item-media">
                                        <?php if(has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail(); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="latest-blog__item-text">
                                        <div class="latest-blog__item-text-meta d-flex">
                                            <div class="latest-blog__item-text-meta-calender">
                                                <h4><?php echo the_time("j")?></h4>
                                                <p><?php echo the_time("F")?></p>
                                            </div>
                                            <span><a class="rr-el-blog-meta " href="<?php the_permalink(); ?>"><i
                                                        class="fa-regular fa-user"></i>
                                                    <?php the_author(); ?></a></span>
                                            <span class="meta-comment"><a class="rr-el-blog-meta"
                                                    href="<?php the_permalink(); ?>"><i
                                                        class="fa-regular fa-comment"></i>
                                                    <?php comments_number();?></a></span>
                                        </div>

                                        <div class="latest-blog__item-text-bottom">
                                            <a href="<?php the_permalink(); ?>">
                                                <h4 class="rr-el-title">
                                                    <?php echo wp_trim_words(get_the_title(), $settings['rr_blog_title_word'], ''); ?>
                                                </h4>
                                            </a>
                                            <a href="<?php the_permalink(); ?>"
                                                class="readmore d-flex align-items-center rr-el-btn"><?php echo rr_kses($settings['rr_post_button']); ?>
                                                <i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; wp_reset_query(); endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog-news area end -->
<?php endif;
	}

}

$widgets_manager->register( new rr_Blog_Post() );