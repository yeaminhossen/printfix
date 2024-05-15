<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package printfix
	*/
	// info
   $header_topbar_switch = get_theme_mod( 'header_topbar_switch', false );


   // Button Text
   $header_top_button_switch = get_theme_mod( 'header_top_button_switch', false);
   $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Let’s Talk', 'printfix' ) );
   $header_top_button_link = get_theme_mod( 'header_button_link', __( '#', 'printfix' ) );
   $header_cart_link = get_theme_mod( 'header_cart_link', __( '#', 'printfix' ) );
   $header_sing_link = get_theme_mod( 'header_sing_link', __( '#', 'printfix' ) );
   $header_wishlist_link = get_theme_mod( 'header_wishlist_link', __( '#', 'printfix' ) );
   // header right
   $printfix_header_right = get_theme_mod( 'header_right_switch', false );
   $printfix_menu_col = $printfix_header_right ? 'col-xxl-6 col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xxl-9 col-xl-9 col-lg-8 d-none d-lg-block text-end';
   $header_search_switch = get_theme_mod( 'header_search_switch', false );

   //Phone
   $header_top_phone = get_theme_mod( 'header_phone', __( '+880190678956', 'printfix' ) );
   $header_top_Offer = get_theme_mod( 'header_top_Offer', __( 'Offer Text', 'printfix' ) );
   $header_top_button = get_theme_mod( 'header_top_button', __( 'Shop Now', 'printfix' ) );
   $header_top_button_url = get_theme_mod( 'header_top_button_url', __( '#', 'printfix' ) );

   // Header Address Link
   $header_address_link = get_theme_mod( 'header_address_link', __( '#', 'printfix' ) );

   $header_language_switch = get_theme_mod( 'header_language_switch', false );

   // Header charity Text
   $header_top_charity_text = get_theme_mod( 'header_top_charity_text', __( 'Free Metro Delivery* Sign Up For $30 Off Your Order!', 'printfix' ) );
   $header_sing_switch = get_theme_mod( 'header_sing_switch', true );
   $header_wishlist_switch = get_theme_mod( 'header_wishlist_switch', true );
   $header_card_switch = get_theme_mod( 'header_card_switch', true );
   $header_lang_switch = get_theme_mod( 'header_lang_switch', true );

?>
<header>
    <div id="header-sticky" class="header__area box-shadow-3 header-1 bg-headr-3">
    <?php if(!empty($header_topbar_switch)) : ?>
        <div class="header-top-3  d-none d-md-block">
            <div class="container-fluid container-width">
                <div class="top-header__menu-wrapper d-flex justify-content-between align-items-center">
                    <div class="header-top-socail-menu d-flex">
                    <?php  if ( !empty( $header_lang_switch ) ): ?>
                        <div class="lan-select lan-select-2">
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

                    <ul class="header-top-menu d-flex">
                        <li><?php echo esc_html($header_top_Offer); ?><a href="<?php echo esc_url( $header_top_button_url ); ?>"><?php echo esc_html($header_top_button); ?></a>
                        </li>
                    </ul>
                    
                    <div class="header-top-social d-flex">
                    <?php printfix_header_social_profiles(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div class="container-fluid home3-container-width">
            <div class="mega__menu-wrapper p-relative">
                <div class="header__main">
                    <div class="header__left">
                        <div class="header__logo header__logo-3">
                            <div class="header__hamburger">
                                <div class="sidebar__toggle">
                                    <button class="bar-icon bar-icon-3">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                            <a href="index.html">
                                <div class="logo logo-3">
                                <?php printfix_header_logo(); ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="header__middle">
                        <div class="mean__menu-wrapper d-none d-lg-block">
                            <div class="main-menu">
                                <nav id="mobile-menu" class="mobile-menu">
                                <?php printfix_header_menu(); ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header__right">
                        <div class="header__action d-flex align-items-center">
                            <div class="header__social d-none d-sm-inline-flex">
                            <?php if(!empty($header_sing_switch)) : ?>
                                <a href="<?php echo esc_url( $header_sing_link ); ?>"><svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 19V17C17 15.9391 16.5786 14.9217 15.8284 14.1716C15.0783 13.4214 14.0609 13 13 13H5C3.93913 13 2.92172 13.4214 2.17157 14.1716C1.42143 14.9217 1 15.9391 1 17V19" stroke="#001D08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke="#001D08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <?php if(!empty($header_wishlist_switch)) : ?>
                                <a href="<?php echo esc_url( $header_wishlist_link ); ?>"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.4578 2.59133C18.9691 2.08683 18.3889 1.68663 17.7503 1.41358C17.1117 1.14054 16.4272 1 15.7359 1C15.0446 1 14.3601 1.14054 13.7215 1.41358C13.0829 1.68663 12.5026 2.08683 12.0139 2.59133L10.9997 3.63785L9.98554 2.59133C8.99842 1.57276 7.6596 1.00053 6.26361 1.00053C4.86761 1.00053 3.52879 1.57276 2.54168 2.59133C1.55456 3.6099 1 4.99139 1 6.43187C1 7.87235 1.55456 9.25383 2.54168 10.2724L3.55588 11.3189L10.9997 19L18.4436 11.3189L19.4578 10.2724C19.9467 9.76814 20.3346 9.16942 20.5992 8.51045C20.8638 7.85148 21 7.14517 21 6.43187C21 5.71857 20.8638 5.01225 20.5992 4.35328C20.3346 3.69431 19.9467 3.09559 19.4578 2.59133Z" stroke="#001D08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="icon-wrapper">
                                        <span>0</span>
                                    </div>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($header_card_switch)) : ?>
                                <a href="<?php echo esc_url( $header_cart_link ); ?>"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.54572 18.9999C7.99759 18.9999 8.3639 18.6162 8.3639 18.1428C8.3639 17.6694 7.99759 17.2856 7.54572 17.2856C7.09385 17.2856 6.72754 17.6694 6.72754 18.1428C6.72754 18.6162 7.09385 18.9999 7.54572 18.9999Z" stroke="#001D08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.5447 18.9999C16.9966 18.9999 17.3629 18.6162 17.3629 18.1428C17.3629 17.6694 16.9966 17.2856 16.5447 17.2856C16.0929 17.2856 15.7266 17.6694 15.7266 18.1428C15.7266 18.6162 16.0929 18.9999 16.5447 18.9999Z" stroke="#001D08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 1H4.27273L6.46545 12.4771C6.54027 12.8718 6.7452 13.2263 7.04436 13.4785C7.34351 13.7308 7.71784 13.8649 8.10182 13.8571H16.0545C16.4385 13.8649 16.8129 13.7308 17.112 13.4785C17.4112 13.2263 17.6161 12.8718 17.6909 12.4771L19 5.28571H5.09091" stroke="#001D08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="icon-wrapper">
                                        <span><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                    </div>
                                </a>
                                <?php endif; ?>
                            </div>
                            <?php  if ( !empty( $header_top_button_text ) ): ?>
                            <div class="header__message d-flex align-items-center">
                                <h6><a href="<?php echo esc_url( $header_top_button_link ); ?>"><?php echo esc_html( $header_top_button_text ); ?></a></h6>
                                <a class="circle-message" href="<?php echo esc_url( $header_top_button_link ); ?>"><svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25.3152 18.0662C27.9243 14.3639 27.5255 9.29168 23.9618 5.98763C22.3335 4.47803 20.2577 3.53824 18.0154 3.27579C18.0015 3.2584 17.9872 3.24117 17.9715 3.22469C16.0208 1.17536 13.2183 0 10.2826 0C4.69594 0 0 4.20976 0 9.6C0 11.4899 0.580447 13.3015 1.68307 14.8662L0.142752 19.7572C0.0459316 20.0646 0.14117 20.4006 0.384223 20.6095C0.627697 20.8188 0.971156 20.859 1.25492 20.7131L5.93916 18.3042C6.90114 18.7231 7.92123 18.998 8.9776 19.123C11.0154 21.2903 13.833 22.4 16.7157 22.4C18.2142 22.4 19.7073 22.0911 21.0589 21.5041L25.7434 23.9131C25.8568 23.9715 25.9796 24 26.1017 24C26.6355 24 27.0182 23.4739 26.8556 22.9572L25.3152 18.0662ZM6.25841 16.6945C6.03687 16.5881 5.77916 16.5916 5.56058 16.704L2.22423 18.4197L3.31372 14.9602C3.39303 14.7083 3.34426 14.4331 3.18331 14.2249C2.13569 12.8686 1.58193 11.2694 1.58193 9.6C1.58193 5.1888 5.48501 1.6 10.2826 1.6C12.2145 1.6 14.0744 2.19195 15.5831 3.25792C10.5023 3.77461 6.43317 7.78816 6.43317 12.8C6.43317 14.3588 6.82826 15.8595 7.57313 17.2041C7.12214 17.0682 6.68292 16.8983 6.25841 16.6945ZM21.4377 19.9039C21.2223 19.7932 20.9644 19.7865 20.7399 19.8945C19.5067 20.4869 18.1152 20.8 16.7157 20.8C11.9182 20.8 8.0151 17.2112 8.0151 12.8C8.0151 8.3888 11.9182 4.8 16.7157 4.8C21.5133 4.8 25.4164 8.3888 25.4164 12.8C25.4164 14.4694 24.8626 16.0686 23.8149 17.4248C23.6541 17.6331 23.6053 17.9083 23.6845 18.1602L24.774 21.6197L21.4377 19.9039Z" fill="white"/>
                                    <path d="M13.499 13.6C13.9359 13.6 14.29 13.2418 14.29 12.8C14.29 12.3582 13.9359 12 13.499 12C13.0622 12 12.708 12.3582 12.708 12.8C12.708 13.2418 13.0622 13.6 13.499 13.6Z" fill="white"/>
                                    <path d="M16.6621 13.6C17.099 13.6 17.4531 13.2418 17.4531 12.8C17.4531 12.3582 17.099 12 16.6621 12C16.2252 12 15.8711 12.3582 15.8711 12.8C15.8711 13.2418 16.2252 13.6 16.6621 13.6Z" fill="white"/>
                                    <path d="M19.8271 13.6C20.264 13.6 20.6182 13.2418 20.6182 12.8C20.6182 12.3582 20.264 12 19.8271 12C19.3903 12 19.0361 12.3582 19.0361 12.8C19.0361 13.2418 19.3903 13.6 19.8271 13.6Z" fill="white"/>
                                    </svg>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>