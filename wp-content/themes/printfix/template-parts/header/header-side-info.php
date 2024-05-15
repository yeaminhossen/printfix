<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package printfix
   */

    $header_side_logo = get_theme_mod( 'header_side_logo', get_template_directory_uri() . '/assets/imgs/logo/offcanvas-logo.png' );

    // Contacts Text 
    $header_side_contacts_text = get_theme_mod( 'header_side_contacts_text', __( 'CONTACT US', 'printfix' ) );

    // footer area links  switch
    $header_side_info_switch = get_theme_mod( 'header_side_info_switch', false );

?>
<!-- Offcanvas area start -->
<div class="fix">
    <div class="offcanvas__area">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php echo esc_url( $header_side_logo ); ?>"
                                alt="<?php print esc_attr__( 'logo', 'printfix' );?>">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button class="offcanvas-close-icon animation--flip">
                            <span class="offcanvas-m-lines">
                                <span class="offcanvas-m-line line--1"></span><span
                                    class="offcanvas-m-line line--2"></span><span
                                    class="offcanvas-m-line line--3"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="mobile-menu fix"></div>
                <div class="offcanvas__social">
                <?php  if ( !empty( $header_side_contacts_text ) ): ?>
                    <h3 class="offcanvas__title mb-20"><?php echo esc_html( $header_side_contacts_text ); ?></h3>
                <?php endif; ?>
                    <?php printfix_header_side_info_social_profiles(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas__overlay"></div>
<div class="offcanvas__overlay-white"></div>
<!-- Offcanvas area start -->