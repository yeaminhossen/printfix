<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package printfix
 */

function get_header_style($style){
    if ( $style == 'header_2'  ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    elseif ( $style == 'header_3'  ) {
        get_template_part( 'template-parts/header/header-3' );
    }
    elseif ( $style == 'header_4'  ) {
        get_template_part( 'template-parts/header/header-4' );
    }

    else{
        get_template_part( 'template-parts/header/header-1');
    }
}

function printfix_check_header() {
    $tp_header_tabs = function_exists('tpmeta_field')? tpmeta_field('printfix_header_tabs') : false;
    $tp_header_style_meta = function_exists('tpmeta_field')? tpmeta_field('printfix_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field')? tpmeta_field('printfix_header_templates') : false;

    $printfix_header_option_switch = get_theme_mod('printfix_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'printfix_header_templates' );
    
    if($tp_header_tabs == 'default'){
        if($printfix_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            if($header_default_style_kirki){
                get_header_style($header_default_style_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }
    }elseif($tp_header_tabs == 'custom'){
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        }else{
            get_header_style($header_default_style_kirki);
        }  
    }elseif($tp_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($printfix_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_header_style($header_default_style_kirki);

        }
        
    }

}
add_action( 'printfix_header_style', 'printfix_check_header', 10 );



/**
 * [printfix_header_lang description]
 * @return [type] [description]
 */

function printfix_header_lang_defualt() {
    $printfix_header_lang = get_theme_mod( 'printfix_header_lang', true );
    if ( $printfix_header_lang ): ?>

<span class="tp-header-lang-selected-lang tp-lang-toggle"
    id="tp-header-lang-toggle"><?php print esc_html__( 'English', 'printfix' );?></span>

<?php do_action( 'printfix_language' );?>

<?php endif;?>
<?php
}

/**
 * [printfix_language_list description]
 * @return [type] [description]
 */
function _printfix_language( $mar ) {
    return $mar;
}
function printfix_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="tp-header-lang-list tp-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="tp-header-lang-list tp-lang-list tp-header-lan-list-area">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'printfix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'printfix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'printfix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Hindi', 'printfix' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _printfix_language( $mar );
}
add_action( 'printfix_language', 'printfix_language_list' );


// header logo
function printfix_header_logo() { ?>
<?php 
        $printfix_logo_on = function_exists('tpmeta_field')? tpmeta_field('printfix_en_secondary_logo') : '';
        $printfix_logo = get_template_directory_uri() . '/assets/imgs/logo/logo.png';
        $printfix_logo_white = get_template_directory_uri() . '/assets/imgs/logo/offcanvas-logo.png';

        $printfix_site_logo = get_theme_mod( 'header_logo', $printfix_logo );
        $printfix_secondary_logo = get_theme_mod( 'header_secondary_logo', $printfix_logo_white );
      ?>

<?php if ( $printfix_logo_on == 'on' ) : ?>
<a class="main-logo" href="<?php print esc_url( home_url( '/' ) );?>">
    <img src="<?php print esc_url( $printfix_secondary_logo );?>"
        alt="<?php print esc_attr__( 'logo', 'printfix' );?>" />
</a>
<?php else : ?>
<a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
    <img src="<?php print esc_url( $printfix_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'printfix' );?>" />
</a>
<?php endif; ?>
<?php
}


// header logo
function printfix_header_black_logo() { ?>
<?php 
        $printfix_logo = get_template_directory_uri() . '/assets/img/logo/logo-black.png';

        $printfix_black_logo = get_theme_mod( 'header_logo', $printfix_logo );
    ?>

<a href="<?php print esc_url( home_url( '/' ) );?>">
    <img src="<?php print esc_url( $printfix_black_logo );?>" alt="<?php print esc_attr__( 'logo', 'printfix' );?>" />
</a>
<?php
}

/**
 * [printfix_header_social_profiles description]
 * @return [type] [description]
 */
function printfix_header_social_profiles() {
    $printfix_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'printfix' ) );
    $printfix_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'printfix' ) );
    $printfix_topbar_pinterest_url = get_theme_mod( 'header_pinterest_link', __( '#', 'printfix' ) );
    $printfix_topbar_vimeo_url = get_theme_mod( 'header_vimeo_link', __( '#', 'printfix' ) );
    ?>
    
<?php if ( !empty( $printfix_topbar_fb_url ) ): ?>
<a href="<?php print esc_url( $printfix_topbar_fb_url );?>">
<i class="fa-brands fa-facebook-f"></i>
</a>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_twitter_url ) ): ?>
<a href="<?php print esc_url( $printfix_topbar_twitter_url );?>">
<i class="fa-brands fa-twitter"></i>
</a>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_pinterest_url ) ): ?>
<a href="<?php echo esc_url( $printfix_topbar_pinterest_url ) ?>">
<i class="fa-brands fa-pinterest-p"></i>
</a>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_vimeo_url ) ): ?>
<a href="<?php echo esc_url( $printfix_topbar_vimeo_url ) ?>">
<i class="fa-brands fa-vimeo-v"></i>
</a>
<?php endif;?>

<?php 
}

/**
 * [printfix_header_social_profiles description]
 * @return [type] [description]
 */
function printfix_header_social_main_profiles() {
    $printfix_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'printfix' ) );
    $printfix_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'printfix' ) );
    $printfix_topbar_instagram_url = get_theme_mod( 'header_instagram_link', __( '#', 'printfix' ) );
    $printfix_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', __( '#', 'printfix' ) );
    ?>

<?php if ( !empty( $printfix_topbar_fb_url ) ): ?>
<a href="<?php print esc_url( $printfix_topbar_fb_url );?>">
    <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M8 1H6.09091C5.24704 1 4.43773 1.36875 3.84102 2.02513C3.24432 2.6815 2.90909 3.57174 2.90909 4.5V6.6H1V9.4H2.90909V15H5.45455V9.4H7.36364L8 6.6H5.45455V4.5C5.45455 4.31435 5.52159 4.1363 5.64093 4.00503C5.76027 3.87375 5.92213 3.8 6.09091 3.8H8V1Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</a>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_twitter_url ) ): ?>
<a href="<?php print esc_url( $printfix_topbar_twitter_url );?>">
    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M16 1.00785C15.3471 1.53487 14.6242 1.93795 13.8591 2.20158C13.4485 1.66129 12.9027 1.27834 12.2957 1.10454C11.6887 0.930729 11.0497 0.974449 10.4651 1.22978C9.88045 1.48511 9.37848 1.93974 9.02703 2.53217C8.67558 3.1246 8.49161 3.82626 8.5 4.54224V5.32246C7.3018 5.35801 6.11451 5.05391 5.04387 4.43726C3.97323 3.8206 3.05249 2.91052 2.36364 1.78806C2.36364 1.78806 -0.363636 8.81003 5.77273 11.9309C4.36854 13.0216 2.69579 13.5685 1 13.4913C7.13636 17.3924 14.6364 13.4913 14.6364 4.51883C14.6357 4.3015 14.6175 4.08471 14.5818 3.87125C15.2777 3.08595 15.7687 2.09447 16 1.00785Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</a>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_instagram_url ) ): ?>
<a href="<?php echo esc_url( $printfix_topbar_instagram_url ) ?>">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M11.5 1H4.5C2.567 1 1 2.567 1 4.5V11.5C1 13.433 2.567 15 4.5 15H11.5C13.433 15 15 13.433 15 11.5V4.5C15 2.567 13.433 1 11.5 1Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M10.7997 7.55897C10.8861 8.14154 10.7866 8.73652 10.5153 9.25928C10.2441 9.78204 9.8149 10.206 9.28884 10.4707C8.76277 10.7355 8.16661 10.8277 7.58515 10.7341C7.00368 10.6406 6.46653 10.366 6.05008 9.94958C5.63364 9.53313 5.35911 8.99598 5.26554 8.41452C5.17198 7.83305 5.26414 7.23689 5.52893 6.71083C5.79371 6.18476 6.21763 5.75559 6.74039 5.48434C7.26315 5.21309 7.85813 5.11358 8.4407 5.19997C9.03494 5.28809 9.58509 5.56499 10.0099 5.98978C10.4347 6.41457 10.7116 6.96472 10.7997 7.55897Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M11.8501 4.14996H11.8571" stroke="white" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</a>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_linkedin_url ) ): ?>
<a href="<?php echo esc_url( $printfix_topbar_linkedin_url ) ?>">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M10.8001 5.42102C11.914 5.42102 12.9823 5.88681 13.7699 6.71592C14.5576 7.54503 15.0001 8.66954 15.0001 9.84207V15H12.2001V9.84207C12.2001 9.45123 12.0526 9.07639 11.79 8.80002C11.5275 8.52365 11.1714 8.36839 10.8001 8.36839C10.4288 8.36839 10.0727 8.52365 9.81015 8.80002C9.5476 9.07639 9.4001 9.45123 9.4001 9.84207V15H6.6001V9.84207C6.6001 8.66954 7.0426 7.54503 7.83025 6.71592C8.6179 5.88681 9.68619 5.42102 10.8001 5.42102Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M3.8 6.1579H1V15H3.8V6.1579Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
        <path
            d="M2.4 3.94737C3.1732 3.94737 3.8 3.28758 3.8 2.47368C3.8 1.65979 3.1732 1 2.4 1C1.6268 1 1 1.65979 1 2.47368C1 3.28758 1.6268 3.94737 2.4 3.94737Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</a>
<?php endif;?>

<?php
}

/**
 * [printfix_header_side_info_social_profiles description]
 * @return [type] [description]
 */
function printfix_header_side_info_social_profiles() {
    $printfix_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'printfix' ) );
    $printfix_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'printfix' ) );
    $printfix_topbar_youtube_url = get_theme_mod( 'header_youtube_link', __( '#', 'printfix' ) );
    $printfix_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', __( '#', 'printfix' ) );
    ?>

<ul>
<?php if ( !empty( $printfix_topbar_fb_url ) ): ?>
    <li><a class="icon facebook" href="<?php print esc_url( $printfix_topbar_fb_url );?>"><i class="fab fa-facebook-f"></i>
</a></li>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_twitter_url ) ): ?>
    <li><a class="icon twitter" href="<?php print esc_url( $printfix_topbar_twitter_url );?>"><i class="fab fa-twitter"></i></a></li>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_instagram_url ) ): ?>
    <li><a class="icon linkedin" href="<?php echo esc_url( $printfix_topbar_instagram_url ) ?>"><i class="fab fa-youtube"></i></a></li>
<?php endif;?>

<?php if ( !empty( $printfix_topbar_linkedin_url ) ): ?>
    <li><a class="icon linkedin" href="<?php echo esc_url( $printfix_topbar_linkedin_url ) ?>"><i
        class="fab fa-linkedin"></i></a></li>
<?php endif;?>
</ul>



<?php
}
function printfix_footer_social_profiles() {
    $header_facebook_link = get_theme_mod( 'header_facebook_link', __( '#', 'printfix' ) );
    $header_twitter_link = get_theme_mod( 'header_twitter_link', __( '#', 'printfix' ) );
    $header_instagram_link = get_theme_mod( 'header_instagram_link', __( '#', 'printfix' ) );
    $header_linkedin_link = get_theme_mod( 'header_linkedin_link', __( '#', 'printfix' ) );
    ?>

<ul>
    <?php if ( !empty( $header_facebook_link ) ): ?>
    <li><a href="<?php print esc_url( $header_facebook_link );?>">
            <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 1H7.54545C6.46048 1 5.41994 1.42143 4.65274 2.17157C3.88555 2.92172 3.45455 3.93913 3.45455 5V7.4H1V10.6H3.45455V17H6.72727V10.6H9.18182L10 7.4H6.72727V5C6.72727 4.78783 6.81347 4.58434 6.96691 4.43431C7.12035 4.28429 7.32846 4.2 7.54545 4.2H10V1Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a></li>
    <?php endif;?>

    <?php if ( !empty( $header_twitter_link ) ): ?>
    <li><a href="<?php print esc_url( $header_twitter_link );?>">
            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 1.00897C18.2165 1.61128 17.349 2.07195 16.4309 2.37324C15.9382 1.75576 15.2833 1.3181 14.5548 1.11947C13.8264 0.920833 13.0596 0.970799 12.3581 1.26261C11.6565 1.55442 11.0542 2.07399 10.6324 2.75105C10.2107 3.42812 9.98993 4.23001 10 5.04827V5.93995C8.56215 5.98058 7.13741 5.63305 5.85264 4.92829C4.56788 4.22354 3.46299 3.18345 2.63636 1.90065C2.63636 1.90065 -0.636364 9.92575 6.72727 13.4925C5.04225 14.739 3.03495 15.364 1 15.2758C8.36364 19.7342 17.3636 15.2758 17.3636 5.02152C17.3629 4.77315 17.341 4.52539 17.2982 4.28143C18.1332 3.38395 18.7225 2.25082 19 1.00897Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a></li>
    <?php endif;?>

    <?php if ( !empty( $header_instagram_link ) ): ?>
    <li><a href="<?php print esc_url( $header_instagram_link );?>">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13 1H5C2.79086 1 1 2.79086 1 5V13C1 15.2091 2.79086 17 5 17H13C15.2091 17 17 15.2091 17 13V5C17 2.79086 15.2091 1 13 1Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M12.1999 8.49624C12.2986 9.16204 12.1849 9.84201 11.8749 10.4395C11.5649 11.0369 11.0744 11.5214 10.4732 11.824C9.87195 12.1266 9.19062 12.2319 8.52609 12.125C7.86156 12.0181 7.24767 11.7043 6.77173 11.2284C6.2958 10.7524 5.98205 10.1385 5.87512 9.47401C5.76819 8.80948 5.87352 8.12816 6.17612 7.52694C6.47873 6.92572 6.96321 6.43523 7.56065 6.12523C8.15809 5.81523 8.83807 5.70151 9.50386 5.80024C10.183 5.90095 10.8117 6.21741 11.2972 6.70289C11.7827 7.18836 12.0992 7.8171 12.1999 8.49624Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M13.3999 4.6001H13.4079" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a></li>
    <?php endif;?>

    <?php if ( !empty( $header_linkedin_link ) ): ?>
    <li><a href="<?php print esc_url( $header_linkedin_link );?>"><svg width="18" height="18" viewBox="0 0 18 18"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.1999 6.05273C13.4729 6.05273 14.6938 6.58506 15.594 7.53262C16.4942 8.48017 16.9999 9.76532 16.9999 11.1054V17.0001H13.7999V11.1054C13.7999 10.6587 13.6313 10.2303 13.3313 9.91445C13.0312 9.5986 12.6242 9.42116 12.1999 9.42116C11.7756 9.42116 11.3686 9.5986 11.0685 9.91445C10.7685 10.2303 10.5999 10.6587 10.5999 11.1054V17.0001H7.3999V11.1054C7.3999 9.76532 7.90562 8.48017 8.80579 7.53262C9.70596 6.58506 10.9269 6.05273 12.1999 6.05273Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.2 6.89453H1V16.9998H4.2V6.89453Z" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M2.6 4.36842C3.48366 4.36842 4.2 3.61437 4.2 2.68421C4.2 1.75405 3.48366 1 2.6 1C1.71634 1 1 1.75405 1 2.68421C1 3.61437 1.71634 4.36842 2.6 4.36842Z"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg></a></li>
    <?php endif;?>
</ul>
<?php
}

/** 
 * [printfix_header_menu description]
 * @return [type] [description]
 */
function printfix_header_menu() {
    ?>
<?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'printfix_Navwalker_Class::fallback',
            'walker'         => new \TPCore\Widgets\printfix_Navwalker_Class,
        ] );
    ?>
<?php
}


/**
 * [printfix_footer_menu description]
 * @return [type] [description]
 */
function printfix_header_top_menu() {
    wp_nav_menu( [
        'theme_location' => 'header-top-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'printfix_Navwalker_Class::fallback',
        'walker'         =>  new \TPCore\Widgets\printfix_Navwalker_Class,
    ] );
}
/**
 * [printfix_footer_menu description]
 * @return [type] [description]
 */
function printfix_footer_bottom_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-bottom-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'printfix_Navwalker_Class::fallback',
        'walker'         =>  new \TPCore\Widgets\printfix_Navwalker_Class,
    ] );
}


 /*
 * printfix footer
 */
add_action( 'printfix_footer_style', 'printfix_check_footer', 10 );


function get_footer_style($style){
    if( $style == 'footer_2'  ) {
        get_template_part( 'template-parts/footer/footer-2' );
    
    }else{
        get_template_part( 'template-parts/footer/footer-1');
    }
}

function printfix_check_footer() {
    $tp_footer_tabs = function_exists('tpmeta_field')? tpmeta_field('printfix_footer_tabs') : '';
    $printfix_footer_style = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'printfix_footer_style' ) : NULL;
    $footer_template = function_exists('tpmeta_field')? tpmeta_field('printfix_footer_template') : false;

    $printfix_footer_option_switch = get_theme_mod( 'printfix_footer_elementor_switch', false );
    $elementor_footer_template = get_theme_mod( 'printfix_footer_templates');
    $printfix_default_footer_style = get_theme_mod( 'footer_layout', 'footer_1' );

    if($tp_footer_tabs == 'default'){
        if($printfix_footer_option_switch){
            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }
        }else{ 
            if($printfix_default_footer_style){
                get_footer_style($printfix_default_footer_style);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }
    }elseif($tp_footer_tabs == 'custom'){
        if ($printfix_footer_style) {
            get_footer_style($printfix_footer_style);
        }else{
            get_footer_style($printfix_default_footer_style);
        }  
    }elseif($tp_footer_tabs == 'elementor'){
        if($footer_template){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_template);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
        }

    }else{
        if($printfix_footer_option_switch){

            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }else{
            get_footer_style($printfix_default_footer_style);

        }
    }
}

// printfix_copyright_text
function printfix_copyright_text() {
   print get_theme_mod( 'footer_copyright', esc_html__( '© 2024 printfix, All Rights Reserved. Design By RRDevs', 'printfix' ) );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'printfix_pagination' ) ) {

    function _printfix_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function printfix_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _printfix_pagi_callback( $pagi );
    }
}

// theme color
function printfix_custom_color() {
    $printfix_color_1 = get_theme_mod( 'printfix_color_1', '#1e3737' );
    $printfix_color_2 = get_theme_mod( 'printfix_color_2', '#07847f' );
    $printfix_color_3 = get_theme_mod( 'printfix_color_3', '#8fe1de' );
    $printfix_color_4 = get_theme_mod( 'printfix_color_4', '#fe7f4c' );

    wp_enqueue_style( 'printfix-custom', PRINTFIX_THEME_CSS_DIR . 'printfix-custom.css', [] );
    
    if ( !empty($printfix_color_1 || $printfix_color_2 || $printfix_color_3 || $printfix_color_4)) {
        $custom_css = '';
        $custom_css .= "html:root{
            --tp-theme-1: " . $printfix_color_1 . ";
            --tp-theme-2: " . $printfix_color_2 . ";
            --tp-theme-3: " . $printfix_color_3 . ";
            --tp-common-orange: " . $printfix_color_4 . ";
        }";

        wp_add_inline_style( 'printfix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'printfix_custom_color' );

// printfix_kses_intermediate
function printfix_kses_intermediate( $string = '' ) {
    return wp_kses( $string, printfix_get_allowed_html_tags( 'intermediate' ) );
}

function printfix_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function printfix_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed; 
}
// blog single social share
function printfix_blog_social_share(){

    $printfix_singleblog_social = get_theme_mod( 'printfix_singleblog_social', false );
    $post_url = get_the_permalink();
    $end_class = has_tag() ? 'text-lg-end' : 'text-lg-start';

    if(!empty($printfix_singleblog_social)) : ?>
<div class="col-xl-6 col-lg-6 col-md-6 col-12">
    <div class="postbox-social text-end">
        <span><?php echo esc_attr__( 'Share:', 'printfix' )?></span>
        <a class="social-tw" href="<?php echo esc_url($post_url);?>"><i class="fa-brands fa-twitter"></i></a>
        <a class="social-fb" href="<?php echo esc_url($post_url);?>"><i class="fa-brands fa-facebook-f"></i></a>
        <a class="social-pin" href="<?php echo esc_url($post_url);?>"><i class="fa-brands fa-pinterest-p"></i></a>
        <a class="social-link" href="<?php echo esc_url($post_url);?>"><i class="fa-brands fa-linkedin-in"></i></a>
    </div>
</div>
<?php endif ; 

}

// product single social share
function printfix_product_social_share(){
    $post_url = get_the_permalink();
    ?>
<div class="tp-shop-details__social">
    <span><?php echo esc_html__('Share:', 'printfix');?></span>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-linkedin-in"></i></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-facebook"></i></a>
    <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-twitter"></i></a>
    <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-pinterest-p"></i></a>
</div>
<?php
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'printfix_archive_count_span' );
function printfix_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'printfix_cat_count_span');
function printfix_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}