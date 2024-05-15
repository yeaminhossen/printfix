<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
 */

 $printfix_video_url = function_exists('tpmeta_field')? tpmeta_field('printfix_post_video') : '';
 $categories = get_the_terms( $post->ID, 'category' );
$printfix_blog_cat = get_theme_mod( 'printfix_blog_cat', false );
$printfix_singleblog_social = get_theme_mod( 'printfix_singleblog_social', false );
$social_shear_col= $printfix_singleblog_social ? "col-xl-6 col-lg-6 col-md-6 col-12" : "col-xl-12 col-md-12 col-lg-12";

if ( is_single() ): 
?>
<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item tp-postbox-item-wrapper format-video' );?>>
    <?php if ( has_post_thumbnail() ): ?>
    <div class="tp-postbox-item-thumb p-relative mb-25">
        <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        <?php if ( !empty($printfix_video_url) ): ?>
        <div class="postbox__play-btn">
            <a class="popup-video pulse-btn" href="<?php echo esc_url($printfix_video_url); ?>"><i
                    class="fa-light fa-play"></i></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <!-- blog meta -->
    <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

    <h3 class="postbox__title mb-10"><?php the_title();?></h3>
    <?php the_content();?>
    <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'printfix' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
    <div class="rr-postbox-share-wrapper">
        <div class="row">
            <div class=" <?php echo esc_attr($social_shear_col); ?>">
                <?php echo printfix_get_tag(); ?>
            </div>
            <?php printfix_blog_social_share() ?>
        </div>
    </div>
</article>

<?php else: ?>
<article id="post-<?php the_ID();?>"
    <?php post_class( 'postbox__item format-image transition-3 format-video mb-60' );?>>

    <?php if ( has_post_thumbnail() ): ?>
    <div class="tp-postbox-item-thumb p-relative mb-25">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if ( !empty($printfix_video_url) ): ?>
        <div class="postbox__play-btn">
            <a class="popup-video pulse-btn" href="<?php echo esc_url($printfix_video_url); ?>"><i
                    class="fa-light fa-play"></i></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="blog__details-content">
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
        <h3 class="postbox__title mb-10">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
        </h3>
        <div class="postbox__text pb-10">
            <?php the_excerpt();?>
        </div>

        <!-- blog btn -->
        <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
    </div>
</article>
<?php
endif;?>