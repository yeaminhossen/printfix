<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  rr-core
 */
get_header();

$service_column = is_active_sidebar( 'rr-services-sidebar' ) ? 'col-lg-8' : 'col-lg-12';

?>

<section class="rr-service-details-area pt-120 pb-100 fix">
    <div class="container">
        <div class="row gx-30">

            <?php 
               if( have_posts() ) : 
               while( have_posts() ) : 
               the_post();
            ?>
            <div class="<?php echo esc_attr($service_column); ?>">
                <div class="rr-service-details">
                    <?php the_content(); ?>
                </div>
            </div>

            <?php
               endwhile;   
               wp_reset_query();
               endif;
            ?>
            <?php if ( is_active_sidebar( 'rr-services-sidebar' ) ): ?>
            <div class="col-lg-4">
                <div class="service-details-wrapper mb-40">
                    <?php dynamic_sidebar( 'rr-services-sidebar' ); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer();  ?>