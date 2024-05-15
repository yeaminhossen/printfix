<?php 

  get_header();
	$cuases_color = function_exists('get_field') ? get_field('cuases_color') : '';
    $campaign_id = get_the_id();
    $campaign_info = charitable_get_campaign( $campaign_id );
    $campaign_title      	  = $campaign_info->post_title; // title
    $campaign_content      	  = $campaign_info->post_content; // content
    $campaign_description     = $campaign_info->description; // description
    $campaign_post_page_link  = get_post_permalink( $campaign_info->ID ); // url
    $campaign_image_url       = get_the_post_thumbnail_url( $campaign_info->ID, 'loveicon-chariti-single-2' ); // thumbnail
    $campaign_currency_helper = charitable_get_currency_helper();
    $campaign_donated_amount  = $campaign_currency_helper->get_monetary_amount( $campaign_info->get_donated_amount() );
    $campaign_goal	          = $campaign_currency_helper->get_monetary_amount( $campaign_info->get_goal() );
    $campaign_due = $campaign_currency_helper->get_monetary_amount($campaign_info->get_goal() - $campaign_info->get_donated_amount());
    $campaign_percent_unround         = $campaign_info->get_percent_donated_raw();
    $campaign_percent         = round($campaign_percent_unround);
    $campaign_categories      = $campaign_info->get( 'categories', true );
    $campaign_single_cat = explode(',', $campaign_categories);
    $campaign_suggested_donations = $campaign_info->get_suggested_donations();

    $categories = get_the_terms( get_the_id(), 'campaign_category' );


    function ed_remove_phone_field_from_donation_form12( $fields ) {
        // unset( $fields['phone'] );
        unset( $fields['address'] );
        unset( $fields['address_2'] );
        // unset( $fields['city'] );
        // unset( $fields['state'] );
        unset( $fields['country'] );
        unset( $fields['postcode'] );
        return $fields;
    }
    add_filter( 'charitable_donation_form_user_fields', 'ed_remove_phone_field_from_donation_form12' );

    $post_column = is_active_sidebar( 'campaigns-sidebar' ) ? 8 : 10;
    $post_column_center = is_active_sidebar( 'campaigns-sidebar' ) ? '' : 'justify-content-center';
    
?>


  <div class="rr-event-details__area pt-120 pb-120">
      <div class="container">
          <div class="row">
              <div class="col-xl-8 col-lg-8">
                  <div class="rr-event-details__left-side">
                      <div class="rr-event-details__thumb p-relative ">
                      <?php the_post_thumbnail(); ?>
                          <div class="rr-event-details__thumb-text">
                              <span><?php echo esc_html($campaign_single_cat[0]); ?></span>
                          </div>
                      </div>
                      <div class="rr-donation-details__progress-box grey-bg mb-30">
                          <div class="rr-donation-details__progress w-100">
                              <div class="rr-donation-details__progress-item fix">
                                  <span class="progress-count"><?php echo $campaign_percent; ?>%</span>
                                  <div class="progress">
                                      <div class="progress-bar wow slideInLeft" data-wow-duration="1s"
                                          data-wow-delay=".3s" role="progressbar" data-width="<?php echo $campaign_percent; ?>%"
                                          aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                          style="width: <?php echo $campaign_percent; ?>%; visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: slideInLeft;">
                                      </div>
                                  </div>
                                  <div class="progress-goals">
                                      <span><?php echo esc_html__('Raised','rr-core'); ?> <b> <?php echo $campaign_donated_amount; ?></b></span>
                                      <span><?php echo esc_html__('Goal','rr-core'); ?> <b> <?php echo $campaign_goal; ?></b></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="rr-donation-content">
                        <?php the_content(); ?>
                      </div>
                      <h4 class="rr-event-details__title mb-45"><?php echo esc_html__('Donation Form','rr-core'); ?></h4>
                      <div class="rr-donation-details__form-box">
                          <?php charitable_get_current_donation_form()->render(); ?>
                      </div>
                  </div>
              </div>
              <?php if ( is_active_sidebar('campaigns-sidebar') ): ?>  
                  <div class="col-lg-4 col-xl-4 mb-30">
                    <div class="rr-event-details__right-box">
                      <?php dynamic_sidebar( 'campaigns-sidebar' ); ?>
                    </div>
                  </div>
                <?php endif; ?>
          </div>
      </div>
  </div>





<?php get_footer();