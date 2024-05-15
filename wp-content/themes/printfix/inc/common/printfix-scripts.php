<?php

/**
 * printfix_scripts description
 * @return [type] [description]
 */
function printfix_scripts() {

    /**
     * all css files
    */ 

    wp_enqueue_style( 'animate-min', PRINTFIX_THEME_CSS_DIR . 'animate.min.css', [] );
    wp_enqueue_style( 'bootstrap-min', PRINTFIX_THEME_CSS_DIR.'bootstrap.min.css', array() );
    wp_enqueue_style( 'custom-font', PRINTFIX_THEME_CSS_DIR . 'custom-font.css', [] );
    wp_enqueue_style( 'font-awesome-pro', PRINTFIX_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'magnific-popup', PRINTFIX_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'slick', PRINTFIX_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'spacing', PRINTFIX_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'swiper-min', PRINTFIX_THEME_CSS_DIR . 'swiper.min.css', [] );
    wp_enqueue_style( 'woocommerce-shop', PRINTFIX_THEME_CSS_DIR . 'woocommerce-shop.css', [], time() );
    wp_enqueue_style( 'printfix-unit', PRINTFIX_THEME_CSS_DIR . 'printfix-unit.css', [], time() );
    wp_enqueue_style( 'printfix-custom', PRINTFIX_THEME_CSS_DIR . 'printfix-custom.css', [] );
    wp_enqueue_style( 'printfix-core', PRINTFIX_THEME_CSS_DIR . 'printfix-core.css', [], time() );
    wp_enqueue_style( 'printfix-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'bootstrap-bundle-min', PRINTFIX_THEME_JS_DIR . 'bootstrap.bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'counterup', PRINTFIX_THEME_JS_DIR . 'counterup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'isotope-docs', PRINTFIX_THEME_JS_DIR . 'isotope-docs.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-ui-min', PRINTFIX_THEME_JS_DIR . 'jquery-ui.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-appear', PRINTFIX_THEME_JS_DIR . 'jquery.appear.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-countdown-min', PRINTFIX_THEME_JS_DIR . 'jquery.countdown.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'magnific-popup-js', PRINTFIX_THEME_JS_DIR . 'magnific-popup.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'meanmenu-min', PRINTFIX_THEME_JS_DIR . 'meanmenu.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', PRINTFIX_THEME_JS_DIR . 'nice-select.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax-scroll', PRINTFIX_THEME_JS_DIR . 'parallax-scroll.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax-min', PRINTFIX_THEME_JS_DIR . 'parallax.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'slick-min', PRINTFIX_THEME_JS_DIR . 'swiper.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'swiper-min', PRINTFIX_THEME_JS_DIR . 'swiper-min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'type', PRINTFIX_THEME_JS_DIR . 'type.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'waypoints', PRINTFIX_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', PRINTFIX_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    // wp_enqueue_script( 'smooth-scroll', PRINTFIX_THEME_JS_DIR . 'smooth-scroll.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'printfix-main', PRINTFIX_THEME_JS_DIR . 'main.js', [ 'jquery' ], time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'printfix_scripts' );
/*
Register Fonts
 */
function printfix_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Poppins:wght@200;300;400;500;600;700;800&family=Rubik:wght@300;400;500;600;700;800&family=Sofia&display=swap');
    return $font_url;
}

