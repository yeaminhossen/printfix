 <?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
 */

$gallery_images = function_exists('tpmeta_gallery_field')? tpmeta_gallery_field('printfix_post_gallery') : '';
$printfix_singleblog_social = get_theme_mod( 'printfix_singleblog_social', false );
  
$social_shear_col= $printfix_singleblog_social ? "col-xl-6 col-lg-6 col-md-6 col-12" : "col-xl-12 col-md-12 col-lg-12";
if ( is_single() ): ?>
<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item tp-postbox-item-wrapper format-gallery' );?>>
<?php if ( !empty( $gallery_images ) ): ?>
     <div class="postbox__thumb-slider p-relative">
         <div class="swiper-container postbox__thumb-slider-active">
             <div class="swiper-wrapper">
             <?php foreach ( $gallery_images as $key => $image ): ?>
                 <div class="swiper-slide">
                 <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                 </div>
                 <?php endforeach;?>
             </div>
         </div>
         <div class="postbox__slider-arrow-wrap d-none d-sm-block">
             <button class="postbox-arrow-prev">
                 <i class="fa-sharp fa-regular fa-arrow-left"></i>
             </button>
             <button class="postbox-arrow-next">
                 <i class="fa-sharp fa-regular fa-arrow-right"></i>
             </button>
         </div>
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


 <?php else: 
    $categories = get_the_terms( $post->ID, 'category' );    
    $printfix_blog_cat = get_theme_mod( 'printfix_blog_cat', false );
?>
 <article id="post-<?php the_ID();?>"
     <?php post_class( 'postbox__item format-image transition-3 format-gallery mb-60' );?>>
     <?php if ( !empty( $gallery_images ) ): ?>
     <div class="postbox__thumb-slider p-relative">
         <div class="swiper-container postbox__thumb-slider-active">
             <div class="swiper-wrapper">
             <?php foreach ( $gallery_images as $key => $image ): ?>
                 <div class="swiper-slide">
                 <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                 </div>
                 <?php endforeach;?>
             </div>
         </div>
         <div class="postbox__slider-arrow-wrap d-none d-sm-block">
             <button class="postbox-arrow-prev">
                 <i class="fa-sharp fa-regular fa-arrow-left"></i>
             </button>
             <button class="postbox-arrow-next">
                 <i class="fa-sharp fa-regular fa-arrow-right"></i>
             </button>
         </div>
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