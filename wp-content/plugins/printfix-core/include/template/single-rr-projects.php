<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  rr-core
 */
get_header();

$project_column = is_active_sidebar( 'rr-project-sidebar' ) ? 'col-lg-8' : 'col-lg-12';

?>

<section class="rr-project-sidebar-area pt-120 pb-80 fix">
    <div class="container">
        <div class="row gx-30">
            <?php 
               if( have_posts() ) :  
               while( have_posts() ) : 
               the_post();
            ?>
            <div class="<?php echo esc_attr($project_column); ?>">
                <div class="rr-service-details">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
               endwhile;  
                 // Pagination
                $pagination_args = array(
                    'total' => $projects->max_num_pages,
                    'prev_text' => __( '&laquo; Previous', 'rr-core' ),
                    'next_text' => __( 'Next &raquo;', 'rr-core' ),
                );
                echo paginate_links( $pagination_args );

               wp_reset_query();
               endif;
            ?>
            <?php if ( is_active_sidebar( 'rr-project-sidebar' ) ): ?>
            <div class="col-xl-4 col-lg-4 col-12">
                <div class="project-sidebar-wrap mb-40">
                    <?php dynamic_sidebar( 'rr-project-sidebar' ); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer();  ?>