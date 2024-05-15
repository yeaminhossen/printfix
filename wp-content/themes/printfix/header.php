<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package printfix
 */
?>

<!doctype html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>

    <?php
        $printfix_preloader = get_theme_mod( 'header_preloader_switch', false );
        $printfix_backtotop = get_theme_mod( 'header_backtotop_switch', true );

        $printfix_preloader_logo = get_template_directory_uri() . '/assets/img/logo/preloder.png';

        $printfix_preloader_logo_url = get_theme_mod('preloader_logo', $printfix_preloader_logo);

    ?>

    <?php if ( !empty( $printfix_backtotop ) ): ?>
    <!-- back to top start -->
    <div class="backtotop-wrap cursor-pointer">
    <svg class="backtotop-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
    <!-- back to top end -->
    <?php endif;?>

    <?php if ( !empty( $printfix_preloader ) ): ?>
    <!-- preloader area start -->
    <div id="preloader">
    <div class="preloader-close">x</div>
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
    <!-- pre loader area end -->
    <?php endif;?>

    <!-- header start -->
    <?php do_action( 'printfix_header_style' );?>
    <!-- header end -->

    <!-- wrapper-box start -->
    <?php do_action( 'printfix_before_main_content' );?>
