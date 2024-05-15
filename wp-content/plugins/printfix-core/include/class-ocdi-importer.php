<?php
/**
 * 
 * Demo Imports
 */

function RR_ocdi_import_files() {
    
    return array(
      array(
        'import_file_name'           => 'Home 1',
        // 'categories'                 => array( 'Business' ),
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-1.jpg', dirname(__FILE__) ),
        'preview_url'                => 'htRRs://rrdevs.net/demos/wp/mekina/',
      ),
      array(
        'import_file_name'           => 'Home 2',
        // 'categories'                 => array( 'Lawyer' ),
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-2.jpg', dirname(__FILE__) ),
        'preview_url'                => 'htRRs://rrdevs.net/demos/wp/mekina/home-02/',
      ),
      array(
        'import_file_name'           => 'Home 3',
        // 'categories'                 => array( 'Portfolio' ),
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-3.jpg', dirname(__FILE__) ),
        'preview_url'                => 'htRRs://rrdevs.net/demos/wp/mekina/home-03/',
      ),
    );
}
add_filter( 'ocdi/import_files', 'RR_ocdi_import_files' );


function RR_ocdi_page($RR_page_name = 'Home'){
    $posts = get_posts(
        array(
            'post_type'              => 'page',
            'title'                  => $RR_page_name,
            'post_status'            => 'all',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'orderby'                => 'post_date ID',
            'order'                  => 'ASC',
        )
    );

    if ( ! empty( $posts ) ) {
        $page_got_by_title = $posts[0];
    } else {
        $page_got_by_title = null;
    }

    return $page_got_by_title;

}


// after demo imports
function RR_ocdi_after_import_setup( $demo ) {
    $front_page_id = "";
    $blog_page_id = "";
    if( "Home 1" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = RR_ocdi_page( 'Home' );
        $blog_page_id  = RR_ocdi_page( 'Blog' );
    }else if( "Home 2" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = RR_ocdi_page( 'Home 02' );
        $blog_page_id  = RR_ocdi_page( 'Blog' );
    }
    else if( "Home 3" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = RR_ocdi_page( 'Home 03' );
        $blog_page_id  = RR_ocdi_page( 'Blog' );
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );


    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
        ]
    );
 
    // woocommerce default settings reset
    if ( class_exists( 'woocommerce' ) ) {
        update_option( 'woocommerce_shop_page_id', '13' );
        update_option( 'woocommerce_cart_page_id', '14' );
        update_option( 'woocommerce_checkout_page_id', '15' );
        update_option( 'woocommerce_myaccount_page_id', '16' );
    }
 
}
add_action( 'ocdi/after_import', 'RR_ocdi_after_import_setup' );



function RR_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Theme Demos' , 'one-click-demo-import' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'RR_ocdi_plugin_page_setup' );