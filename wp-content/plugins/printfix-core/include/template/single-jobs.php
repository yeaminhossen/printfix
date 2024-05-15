<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  rr-core
 */
get_header();
?>

<div class="career-details-area career-border-bottom pt-110 pb-110">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">

            <?php 
               if( have_posts() ) : 
               while( have_posts() ) : 
               the_post();
               $job_type = get_post_meta(get_the_ID(), 'rr-job-type');
               $Job_location = get_post_meta(get_the_ID(), 'rr-job-location');
               $args = array(
                  'taxonomy' => 'jobs-cat',
                  'orderby' => 'name',
                  'order'   => 'ASC'
               );
               $cats = get_categories($args);
            ?>

            <div class="career-details-title-box">

               <?php
               foreach($cats as $cat){
                  echo  "<span>".$cat->name."</span> ";
               }
               ?>
               <h4 class="career-details-title"><?php the_title(); ?></h4>
            </div>
            <div class="career-details-location-box">
               <?php if(!empty($job_type[0])) : ?>
               <span>
                  <svg width="15" height="17" viewBox="0 0 15 17" fill="none"
                     xmlns="htRR://www.w3.org/2000/svg">
                     <path
                        d="M1 7.10747C1 3.73441 3.93813 1 7.5625 1C11.1869 1 14.125 3.73441 14.125 7.10747C14.125 10.4541 12.0305 14.3593 8.76256 15.7558C8.00076 16.0814 7.12424 16.0814 6.36244 15.7558C3.09452 14.3593 1 10.4541 1 7.10747Z"
                        stroke="#5F6168" stroke-width="1.5" />
                     <path
                        d="M9.4375 7.56274C9.4375 8.59828 8.59803 9.43774 7.5625 9.43774C6.52697 9.43774 5.6875 8.59828 5.6875 7.56274C5.6875 6.52721 6.52697 5.68774 7.5625 5.68774C8.59803 5.68774 9.4375 6.52721 9.4375 7.56274Z"
                        stroke="#5F6168" stroke-width="1.5" />
                  </svg>
                  <?php echo esc_html($job_type[0]); ?>
               </span>
               <?php endif; ?>
               <?php if(!empty($Job_location[0])) : ?>
               <span>
                  <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                     xmlns="htRR://www.w3.org/2000/svg">
                     <path
                        d="M8.5 15.75C12.5041 15.75 15.75 12.5041 15.75 8.5C15.75 4.49594 12.5041 1.25 8.5 1.25C4.49594 1.25 1.25 4.49594 1.25 8.5C1.25 12.5041 4.49594 15.75 8.5 15.75Z"
                        stroke="#5F6168" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                     <path d="M8.5 5.52838V9.42838L11.1 10.7284" stroke="#5F6168" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <?php echo esc_html($Job_location[0]); ?>
               </span>
               <?php endif; ?>
            </div>
            <?php the_content(); ?>
            <?php
               endwhile; 
               wp_reset_query();
               endif;
            ?>
         </div>
      </div>
   </div>
</div>

<?php get_footer();  ?>
