<?php 

	/**
	 * Template part for displaying header layout two
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package printfix
	*/

    
   // Button Text
   $header_top_button_switch = get_theme_mod( 'header_top_button_switch', false);
   $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Book Now', 'printfix' ) );
   $header_top_button_link = get_theme_mod( 'header_button_link', __( '#', 'printfix' ) );

   // header right
   $printfix_header_right = get_theme_mod( 'header_right_switch', false );

?>
<header>
    <div id="header-sticky" class="header__area header-1">
        <div class="container">
            <div class="mega__menu-wrapper p-relative">
                <div class="header__main">
                    <div class="header__left">
                        <div class="header__logo">
                            <a href="index.html">
                                <div class="logo">
                                <?php printfix_header_logo(); ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="header__middle">
                        <div class="mean__menu-wrapper d-none d-lg-block">
                            <div id="mobile-menu" class="main-menu">
                                <?php printfix_header_menu(); ?>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($printfix_header_right)) : ?>
                    <div class="header__right">
                        <div class="header__action d-flex align-items-center">
                        <?php  if ( !empty( $header_top_button_text ) ): ?>
                            <div class="header__btn-wrap d-none d-sm-inline-flex">
                                <a href="<?php echo esc_url( $header_top_button_link ); ?>" class="rr-btn"><?php echo esc_html( $header_top_button_text ); ?></a>
                            </div>
                        <?php endif; ?>
                            <div class="header__hamburger ml-20 d-lg-none">
                                <div class="sidebar__toggle">
                                    <button class="bar-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>