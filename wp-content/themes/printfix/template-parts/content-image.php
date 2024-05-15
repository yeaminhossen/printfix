<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
 */
$categories = get_the_terms( $post->ID, 'category' );
$printfix_blog_cat = get_theme_mod( 'printfix_blog_cat', false );
$printfix_singleblog_social = get_theme_mod( 'printfix_singleblog_social', false );
  
$social_shear_col= $printfix_singleblog_social ? "col-xl-6 col-lg-6 col-md-6 col-12" : "col-xl-12 col-md-12 col-lg-12";
if ( is_single() ) : ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item tp-postbox-item-wrapper format-image' );?>>
     <?php if ( has_post_thumbnail() ): ?>
     <div class="tp-postbox-item-thumb p-relative mb-25">
         <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>

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
     <div class="tp-postbox-share-wrapper">
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
     <?php post_class( 'postbox__item format-image transition-3 format-standard mb-60' );?>>
     <?php if ( has_post_thumbnail() ): ?>
     <div class="blog__details-thumb mb-30">
         <a href="<?php the_permalink();?>">
             <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
         </a>
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

<?php endif;?>