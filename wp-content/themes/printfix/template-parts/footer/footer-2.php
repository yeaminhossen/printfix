<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
*/

$footer_bg_img = get_theme_mod( 'printfix_footer_bg' );
$printfix_footer_logo = get_theme_mod( 'printfix_footer_logo' );
$printfix_footer_top_space = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'printfix_footer_top_space' ) : '0';

$printfix_copyright_text = get_theme_mod( 'printfix_copyright_text', __( 'Privacy & Terms Condition', 'printfix' ) );
$printfix_copyright_left_text = get_theme_mod( 'printfix_copyright_left_text', __( 'CopyRight Text', 'printfix' ) );

$printfix_footer_payment = get_theme_mod( 'footer_payment_img' );
$printfix_footer_payment_url_from_page = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'printfix_footer_payment' ) : '';
$printfix_footer_payment = !empty( $printfix_footer_payment_url_from_page['url'] ) ? $printfix_footer_payment_url_from_page['url'] : $printfix_footer_payment;

$printfix_copyright_center = $printfix_footer_payment ? 'col-sm-6' : 'col-sm-12 text-center';
$printfix_footer_bg_url_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'printfix_footer_bg' ) : '';
$printfix_footer_bg_color_1_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'printfix_footer_bg_color_1' ) : '';
$printfix_copyright_bg_color_1_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'printfix_copyright_bg_color_1' ) : '';
$footer_bg_color = get_theme_mod( 'printfix_footer_bg_color_1', '#fff');
$copyright_bg_color = get_theme_mod( 'printfix_copyright_bg_color_1', '#fff');
// bg image
$bg_img = !empty( $printfix_footer_bg_url_from_page['url'] ) ? $printfix_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty( $printfix_footer_bg_color_1_from_page ) ? $printfix_footer_bg_color_1_from_page : $footer_bg_color;
$copyright_bg_color = !empty( $printfix_copyright_bg_color_1_from_page ) ? $printfix_copyright_bg_color_1_from_page : $copyright_bg_color;
// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-2-' . $num ) ) { 
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1': 
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-lg-4';
    $footer_class[2] = 'col-lg-2 col-md-3 col-sm-6';
    $footer_class[3] = 'col-lg-3 col-md-3 col-sm-6';
    $footer_class[4] = 'col-lg-3 col-md-6';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-50';
    break;
}

?>
<!-- Footer area start -->
<footer>
    <section class="footer__area-common overflow-hidden position-relative z-1">
        <?php if ( is_active_sidebar( 'footer-2-1' ) OR is_active_sidebar( 'footer-2-2' ) OR is_active_sidebar( 'footer-2-3' ) OR is_active_sidebar( 'footer-2-4' ) ): ?>
        <div class="container">
            <div class="row mb-minus-40 footer-wrap">
                <?php
                        if ( $footer_columns < 5 ) {
                        print '<div class="col-lg-4">';
                        dynamic_sidebar( 'footer-2-1' );
                        print '</div>';

                        print '<div class="col-lg-2 col-md-3 col-sm-6">';
                        dynamic_sidebar( 'footer-2-2' );
                        print '</div>';

                        print '<div class="col-lg-3 col-md-3 col-sm-6">';
                        dynamic_sidebar( 'footer-2-3' );
                        print '</div>';

                        print '<div class="col-lg-3 col-md-6">';
                        dynamic_sidebar( 'footer-2-4' );
                        print '</div>';
                        } else {
                            for ( $num = 1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-2-' . $num ) ) {
                                    continue;
                                }
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-2-' . $num );
                                print '</div>';
                            }
                        }
                    ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="footer__bottom-wrapper footer-bottom-border">
            <div class="container">
                <div class="footer__bottom">
                    <div class="footer__copyright">
                    <p><?php print printfix_copyright_text(); ?></p>
                    </div>

                    <div class="footer__copyright-menu">
                    <?php printfix_footer_bottom_menu(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
<!-- Footer area end --> 