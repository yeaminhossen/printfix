<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package printfix
 */
$printfix_error_404 = get_theme_mod('printfix_error_404', __("404 ", 'printfix'));
$printfix_error_title = get_theme_mod('printfix_error_title', __("Sorry We Can't Find That Page! ", 'printfix'));
$printfix_error_text = get_theme_mod('printfix_error_text', __("Oops! The page you are looking for does not exist. It might have been moved or deleted. ", 'printfix'));
$printfix_error_link_text = get_theme_mod('printfix_error_link_text', __('Back To Home', 'printfix'));
$printfix_error_img = get_theme_mod( 'printfix_error_img', get_template_directory_uri() . '/assets/imgs/404/404.png' );

get_header();
?>

<section class="error section-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="error__content">

                    <div class="error__content-media mb-40 mb-sm-35 mb-xs-30">
                        <img class="upDown-bottom" src="<?php echo esc_html( $printfix_error_img ); ?>" alt="image not found">
                    </div>

                    <div class="section__title-wrapper text-center">
                        <h3 class="section__title mb-15 mb-xs-10 wow fadeIn animated" data-wow-delay=".3s"><?php print esc_html($printfix_error_title);?></h3>
                        <p class="mb-40 mb-sm-25 mb-xs-20 wow fadeIn animated" data-wow-delay=".5s"><?php print esc_html($printfix_error_text);?></p>

                        <div class="error-btn-wrap">
                            <a href="<?php print esc_url(home_url('/'));?>" class="error-btn wow fadeIn animated" data-wow-delay=".7s"><?php print esc_html($printfix_error_link_text);?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();