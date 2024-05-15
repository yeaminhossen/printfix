<?php 
 
	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package printfix
	*/

	// info
    $header_topbar_switch = get_theme_mod( 'header_topbar_switch', false );

  // Button Text
  $header_top_button_switch = get_theme_mod( 'header_top_button_switch', false);
  $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Book Now', 'printfix' ) );

   // header right
   $printfix_header_right = get_theme_mod( 'header_right_switch', false );

   // header search btn 
   $header_search_switch = get_theme_mod( 'header_search_switch', true );
    $header_lang_switch = get_theme_mod( 'header_lang_switch', true );
    
?>
<header>
    <div id="header-sticky" class="header__area header-1 white-bg">
        <?php if(!empty($header_topbar_switch)) : ?>
        <div class="header-top inner-page d-none d-md-block">
            <div class="container">
                <div class="top-header__menu-wrapper d-flex justify-content-between align-items-center">
                    <div class="header-top-socail-menu d-flex">
                        <?php  if ( !empty( $header_lang_switch ) ): ?>
                        <div class="lan-select lan-select-2 header-select">
                            <form>
                                <select id="nice">
                                    <option>English</option>
                                    <option>China</option>
                                    <option>Bangla</option>
                                    <option>Hindi</option>
                                </select>
                            </form>
                        </div>
                        <?php endif; ?>
                        <div class="header-top-menu">
                            <?php printfix_header_top_menu(); ?>
                        </div>
                    </div>
                    <div class="header-top-social d-flex">
                        <?php printfix_header_social_profiles(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="header-bottom">
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
                                <div class="main-menu">
                                    <div id="mobile-menu" class="mobile-menu">
                                        <?php printfix_header_menu(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($printfix_header_right)) : ?>
                        <div class="header__right">
                            <div class="header__action d-flex align-items-center">
                                <div class="search-icon dl-search-icon gray-color">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.7">
                                            <path
                                                d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z"
                                                stroke="#001D08" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M18.9999 18.9999L14.6499 14.6499" stroke="#001D08"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </div>
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
    </div>
</header>

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>