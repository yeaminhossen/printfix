<?php
/**
 * Breadcrumbs for printfix theme.
 *
 * @package     printfix
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://www.weblearnbd.net
 * @since       printfix 1.0.0
 */



function printfix_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','printfix'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','printfix'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'printfix' ) );
    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'printfix' );
    } 
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'printfix' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'printfix' );
    } 
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 


    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists('tpmeta_field')? tpmeta_field('printfix_check_bredcrumb') : 'on';

    $con1 = $is_breadcrumb && ($is_breadcrumb== 'on') && $breadcrumb_show == 1;

    $con_main = is_404() ? is_404() : $con1;
    
      if (  $con_main ) {
        $bg_img_from_page = function_exists('tm_image_field')? tm_image_field('printfix_breadcrumb_bg') : '';

        $hide_bg_img = function_exists('tpmeta_field')? tpmeta_field('printfix_check_bredcrumb_img') : 'on';
        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_image' );
        $breadcrumb_padding = get_theme_mod( 'breadcrumb_padding' );
        $breadcrumb_bg_color = get_theme_mod( 'breadcrumb_bg_color', '#16243E' );
        $breadcrumb_shape_switch = get_theme_mod( 'breadcrumb_shape_switch', 'on' );
        if ( $hide_bg_img == 'off' ) {
            $bg_main_img = '';
        }else{  
            $bg_main_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }
        
        ?>
<div class="breadcrumb__area breadcrumb-space overflow-hidden banner-home-bg ">
    <div class="banner-home__middel-shape inner-top-shape"></div>
    <div class="container">
        <div class="banner-all-shape-wrapper">
            <div class="banner-home__banner-shape-1 first-shape">
                <img class="upDown-top" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/banner-1/banner-shape-1.svg" alt="img not found">
            </div>
            <div class="banner-home__banner-shape-2 second-shape">
                <img class="upDown-bottom" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/banner-1/banner-shape-2.svg" alt="img not found">
            </div>
            <div class="right-shape">
                <img class="zooming" src="<?php echo get_template_directory_uri(  ); ?>/assets/imgs/inner-img/inner-right-shape.svg" alt="img not found">
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-12">
                <div class="breadcrumb__content text-center">
                    <div class="breadcrumb__title-wrapper mb-15 mb-sm-10 mb-xs-5">
                        <h1 class="breadcrumb__title color-white wow fadeIn animated" data-wow-delay=".1s"><?php echo printfix_kses( $title ); ?></h1>
                    </div>
                    <?php if(function_exists('bcn_display')) : ?>
                    <div class="breadcrumb__menu wow fadeIn animated" data-wow-delay=".5s">
                        <?php bcn_display(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
      }
}

add_action( 'printfix_before_main_content', 'printfix_breadcrumb_func' );

// printfix_search_form
function printfix_search_form() {
    ?>
    <div id="popup-search-box">
    <div class="box-inner-wrap d-flex align-items-center">
        <form id="form" action="<?php print esc_url( home_url( '/' ) );?>" method="get" role="search">
            <input id="popup-search" type="text" value="<?php print esc_attr( get_search_query() )?>" name="s" placeholder="<?php print esc_attr__( 'Type keywords here...', 'printfix' );?>">
        </form>
        <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
    </div>
</div>
<?php
}
add_action( 'printfix_before_main_content', 'printfix_search_form' );