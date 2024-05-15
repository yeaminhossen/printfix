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
   // header right
   $printfix_header_right = get_theme_mod( 'header_right_switch', false );
   $header_top_charity_text = get_theme_mod( 'header_top_charity_text', __( 'Mon - Sat: 8 am - 5 pm, Sunday: CLOSED', 'printfix' ) );
   //Phone
   $header_top_phone = get_theme_mod( 'header_phone', __( '+880190678956', 'printfix' ) );
   $header_lang_switch = get_theme_mod( 'header_lang_switch', true );

?>  
<header> 
    <div id="header-sticky" class="header__area header-2 header-1">
    <?php if(!empty($header_topbar_switch)) : ?> 
        <div class="header-top d-none d-md-block">
            <div class="container">
                <div class="top-header__menu-wrapper d-flex justify-content-between align-items-center">
                    <ul class="header-top-menu d-flex">
                    <?php if(!empty($header_top_charity_text)) : ?> 
                        <li><svg width="14" height="12" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.4 1H13.6C14.37 1 15 1.675 15 2.5V11.5C15 12.325 14.37 13 13.6 13H2.4C1.63 13 1 12.325 1 11.5V2.5C1 1.675 1.63 1 2.4 1Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 2.5L8 7.75L1 2.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg><?php echo esc_html( $header_top_charity_text ); ?>
                        </li>
                        <?php endif; ?>
                        <?php  if ( !empty( $header_top_phone ) ): ?>
                        <li><svg width="14" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.67161 3.67583C10.3263 3.80331 10.9279 4.12286 11.3995 4.59359C11.8712 5.06432 12.1913 5.66481 12.319 6.3182M9.67161 1C11.0317 1.15081 12.3 1.75871 13.2683 2.72391C14.2365 3.6891 14.8472 4.95421 15 6.31151M14.3298 11.6498V13.6567C14.3305 13.843 14.2923 14.0274 14.2175 14.1981C14.1427 14.3688 14.033 14.522 13.8955 14.648C13.758 14.7739 13.5956 14.8698 13.4187 14.9295C13.2419 14.9892 13.0546 15.0113 12.8686 14.9946C10.8062 14.7709 8.8251 14.0675 7.08449 12.9409C5.46509 11.9138 4.09211 10.5434 3.06307 8.92713C1.93035 7.18196 1.22544 5.19502 1.00544 3.12728C0.988691 2.94229 1.01072 2.75585 1.07012 2.57982C1.12952 2.4038 1.22499 2.24204 1.35046 2.10486C1.47592 1.96768 1.62863 1.85808 1.79886 1.78303C1.96909 1.70798 2.15312 1.66913 2.33921 1.66896H4.34993C4.6752 1.66576 4.99053 1.78072 5.23716 1.99242C5.48379 2.20411 5.64488 2.49809 5.6904 2.81956C5.77527 3.4618 5.93266 4.0924 6.15957 4.69933C6.24974 4.93876 6.26926 5.19898 6.2158 5.44915C6.16235 5.69932 6.03816 5.92895 5.85796 6.11083L5.00676 6.9604C5.96088 8.63517 7.35021 10.0218 9.02818 10.9741L9.87939 10.1246C10.0616 9.94471 10.2917 9.82076 10.5423 9.76741C10.793 9.71405 11.0537 9.73353 11.2936 9.82354C11.9017 10.05 12.5335 10.2071 13.177 10.2918C13.5025 10.3376 13.7999 10.5013 14.0124 10.7517C14.225 11.0021 14.3379 11.3217 14.3298 11.6498Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg><a href="tel:<?php echo esc_attr( $header_top_phone );?>"><?php echo esc_html( $header_top_phone );?></a>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <div class="header-top-socail-menu d-flex">
                    <?php  if ( !empty( $header_lang_switch ) ): ?>
                        <div class="lan-select lan-select-2 ml-30">
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
                </div>
            </div>
        </div>
    <?php endif; ?>
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
                            <div class="main-menu main-menu-2">
                                <div id="mobile-menu" class="mobile-menu">
                                <?php printfix_header_menu(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($printfix_header_right)) : ?>
                    <div class="header__right">
                        <div class="header__action d-flex align-items-center">
                            <div class="search-icon search-icon-2 dl-search-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.7">
                                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.0004 18.9999L14.6504 14.6499" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                </svg>
                            </div>
                            <?php  if ( !empty( $header_top_button_text ) ): ?>
                            <div class="header__btn-wrap d-none d-sm-inline-flex">
                                <a href="<?php echo esc_url( $header_top_button_link ); ?>" class="rr-btn btn-hover-white"><?php echo esc_html( $header_top_button_text ); ?></a>
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