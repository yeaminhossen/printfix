<?php get_header();
    global $post;
    use \Etn\Utils\Helper;
    $single_event_id = get_the_id();
    $categories = get_the_terms($single_event_id, 'etn_category');
    $etn_terms = get_the_terms($single_event_id, 'etn_tags');
    $event_options  = get_option("etn_event_options");
    $data = Helper::single_template_options( $single_event_id );
    $start_date         = get_post_meta( $single_event_id, 'etn_start_date', true );
    $start_date_year_month = date("F d, Y", strtotime($start_date));
    $start_date_day_month = date("d M", strtotime($start_date));


?>
    <!-- event details area start -->
    <section class="rr-event-details__area pt-120 pb-65">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="rr-event-details__left-box">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="rr-event-details__thumb p-relative pb-25">                   
                            <?php the_post_thumbnail(); ?>
                            <div class="rr-event-details__thumb-text d-none d-md-block">
                                <span><?php echo esc_html($start_date_day_month); ?></span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <h4 class="rr-event-details__title"><?php the_title(); ?></h4>
                        <div class="postbox__meta">

                        <?php if(!isset($event_options["etn_hide_date_from_details"]) && !empty($data['event_start_date'])): ?>
                            <span> 
                                <i class="flaticon-calendar"></i>                                                                            
                                <?php echo $data['event_start_date']; ?>
                            </span>
                        <?php endif; ?>
                        <?php 
                            if ( !isset($event_options["etn_hide_time_from_details"]) && ( !empty( $data['event_start_time'] ) || !empty( $data['event_end_time'] ) )) :
                                $separate = !empty($data['event_end_time']) ? ' - ' : '';
                            ?>
                            <span>
                            <i class="fa-thin fa-clock"></i>                                        
                                <?php echo esc_html($data['event_start_time'] . $separate . $data['event_end_time']); ?>
                            </span>
                        <?php endif; ?>
                          
                        <?php if(!empty($data['etn_event_location'])) : ?>
                                <span>
                                <i class="flaticon-location"></i>                                                                                                                         
                                    <?php echo esc_html($data['etn_event_location']); ?>
                                </span>
                                <?php endif; ?>
                        </div>

                        <div class="rr-event-details__text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <?php do_action("etn_before_single_event_meta", $single_event_id); ?>
                    <!-- event schedule meta end -->
                    <?php do_action("etn_single_event_meta", $single_event_id); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- event details area end -->


<?php get_footer();