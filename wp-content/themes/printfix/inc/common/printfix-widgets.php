<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function printfix_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_layout_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_layout_2_switch', true );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'printfix' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="sidebar__widget-title">',
        'after_title'   => '</h5>',
    ] );

    /**
     * Services sidebar
     */
    if(class_exists("TP_Core")) :
    register_sidebar( [
        'name'          => esc_html__( 'Services Sidebar', 'printfix' ),
        'id'            => 'rr-services-sidebar',
        'before_widget' => '<div id="%1$s" class="service-details-service mb-30 p-relative %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="service-details-title">',
        'after_title'   => '</h3>',
    ] );
    endif;

    
    /**
     * Services sidebar
     */
    if(class_exists("TP_Core")) :
    register_sidebar( [
        'name'          => esc_html__( 'Project Sidebar', 'printfix' ),
        'id'            => 'rr-project-sidebar',
        'before_widget' => '<div id="%1$s" class="project-sidebar-service %2$s mb-30">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="project-sidebar-title">',
        'after_title'   => '</h3>',
    ] );
    endif; 
    
    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'printfix' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer Column %1$s', 'printfix' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-item-'.$num.' %2$s"><div class="footer__link"> ',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="footer__widget-title"><h4>',
            'after_title'   => '</h4></div>',
        ] );
    }

    // footer 2 
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'printfix' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'printfix' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-item-2-'.$num.' %2$s"><div class="footer__link">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<div class="footer__widget-title"><h4>',
                'after_title'   => '</h4></div>',
            ] );
        }
    }        
}
add_action( 'widgets_init', 'printfix_widgets_init' );