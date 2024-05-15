<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Printfix Panel', 'printfix' ),
        'description' => esc_html__( 'Printfix Panel Description.', 'printfix' ),
    ]
);

// header_top_section
function header_top_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_top_section',
        [
            'title'       => esc_html__( 'Header Info', 'printfix' ),
            'description' => esc_html__( 'Header Section Information.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );
    // header_top_bar section 


    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__( 'Chose Header Style', 'printfix' ),
            'section'     => 'header_top_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
                'header_2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
                'header_3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
                'header_4'  => get_template_directory_uri() . '/inc/img/header/header-4.png'
            ],
            'default'     => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'printfix_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_posttype = array(
        'post_type'      => 'tp-header'
    );
    $header_posttype_loop = get_posts($header_posttype);
    $header_post_obj_arr = array();
    foreach($header_posttype_loop as $post){
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_topbar_switch',
            'label'       => esc_html__( 'Header Topbar Switch', 'printfix' ),
            'description' => esc_html__( 'Header Topbar switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );    

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Switch', 'printfix' ),
            'description' => esc_html__( 'Header Right switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_preloader_switch',
            'label'       => esc_html__( 'Header Preloader Switch', 'printfix' ),
            'description' => esc_html__( 'Header Preloader switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_search_switch',
            'label'       => esc_html__( 'Header Search Switch', 'printfix' ),
            'description' => esc_html__( 'Header Search switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_card_switch',
            'label'       => esc_html__( 'Header card Switch', 'printfix' ),
            'description' => esc_html__( 'Header card switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_lang_switch',
            'label'       => esc_html__( 'Header lang Switch', 'printfix' ),
            'description' => esc_html__( 'Header lang switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    ); 


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_backtotop_switch',
            'label'       => esc_html__( 'Header Back to Top Switch', 'printfix' ),
            'description' => esc_html__( 'Header Back to Top switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_cart_switch',
            'label'       => esc_html__( 'Header Cart On/Off', 'printfix' ),
            'description' => esc_html__( 'Header Cart switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_wishlist_switch',
            'label'       => esc_html__( 'Header wishlist On/Off', 'printfix' ),
            'description' => esc_html__( 'Header wishlist switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_sing_switch',
            'label'       => esc_html__( 'Header Sing On/Off', 'printfix' ),
            'description' => esc_html__( 'Header Sing switch On/Off', 'printfix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );
    

    new \Kirki\Field\Text(
        [
            'settings' => 'header_button_text',
            'label'    => esc_html__( 'Button Text', 'printfix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( 'Book Now ', 'printfix' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_button_link',
            'label'    => esc_html__( 'Button URL', 'printfix' ),
            'section'  => 'header_top_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_phone',
            'label'    => esc_html__( 'Phone Number', 'printfix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( '8801310069824', 'printfix' ),
            'priority' => 10,
        ]
    );    

    new \Kirki\Field\Text(
        [
            'settings' => 'header_top_charity_text',
            'label'    => esc_html__( 'Header top Text', 'printfix' ),
            'section'  => 'header_top_section',
            'default'  => 'Free Metro Delivery* Sign Up For $30 Off Your Order!',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\URL(
        [
            'settings' => 'header_cart_link',
            'label'    => esc_html__( 'Cart URL', 'printfix' ), 
            'section'  => 'header_top_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\URL(
        [
            'settings' => 'header_wishlist_link',
            'label'    => esc_html__( 'wishlist URL', 'printfix' ),
            'section'  => 'header_top_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\URL(
        [
            'settings' => 'header_sing_link',
            'label'    => esc_html__( 'Sing URL', 'printfix' ),
            'section'  => 'header_top_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'header_top_button',
            'label'    => esc_html__( 'Shop Now', 'printfix' ),
            'section'  => 'header_top_section', 
            'default'  => '#',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'header_top_Offer',
            'label'    => esc_html__( 'Offer', 'printfix' ),
            'section'  => 'header_top_section', 
            'default'  => '#',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\URL(
        [
            'settings' => 'header_top_button_url',
            'label'    => esc_html__( 'Header Top Button Url', 'printfix' ),
            'section'  => 'header_top_section', 
            'default'  => '#',
            'priority' => 10,
        ]
    );

}
header_top_section();

// header_side_section
function header_side_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_side_section',
        [
            'title'       => esc_html__( 'Header Side Info', 'printfix' ),
            'description' => esc_html__( 'Header Side Information.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_side_info_switch',
            'label'       => esc_html__( 'Header Side Info Switch', 'printfix' ),
            'description' => esc_html__( 'Header Side Info switch On/Off', 'printfix' ),
            'section'     => 'header_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );  
    // header_side_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_side_logo',
            'label'       => esc_html__( 'Header Side Logo', 'printfix' ),
            'description' => esc_html__( 'Theme Default/Primary Logo Here', 'printfix' ),
            'section'     => 'header_side_section',
            'default'     => get_template_directory_uri() . '/assets/imgs/logo/offcanvas-logo.png',
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_contacts_text',
            'label'    => esc_html__( 'Contacts Text', 'printfix' ),
            'section'  => 'header_side_section',
            'default'  => esc_html__( 'CONTACT US', 'printfix' ),
            'priority' => 10,
        ]
    );

}
header_side_section();

// header_social_section
function header_social_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_social_section',
        [
            'title'       => esc_html__( 'Social Area', 'printfix' ),
            'description' => esc_html__( 'Social URL.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 120,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_facebook_link',
            'label'    => esc_html__( 'Facebook URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_twitter_link',
            'label'    => esc_html__( 'Twitter URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_linkedin_link',
            'label'    => esc_html__( 'Linkedin URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_instagram_link',
            'label'    => esc_html__( 'Instagram URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  
    new \Kirki\Field\URL(
        [
            'settings' => 'header_pinterest_link',
            'label'    => esc_html__( 'Pinterest URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  
    new \Kirki\Field\URL(
        [
            'settings' => 'header_vimeo_link',
            'label'    => esc_html__( 'Vimeo URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  
    new \Kirki\Field\URL(
        [
            'settings' => 'header_youtube_link',
            'label'    => esc_html__( 'Youtube URL', 'printfix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

}
header_social_section();

// header_logo_section
function header_logo_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__( 'Header Logo', 'printfix' ),
            'description' => esc_html__( 'Header Logo Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 130,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__( 'Header Logo', 'printfix' ),
            'description' => esc_html__( 'Theme Default/Primary Logo Here', 'printfix' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/imgs/logo/logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_secondary_logo',
            'label'       => esc_html__( 'Header Secondary Logo / White', 'printfix' ),
            'description' => esc_html__( 'Theme Secondary Logo Here', 'printfix' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/imgs/logo/offcanvas-logo.png',
        ]
    );
}
header_logo_section();


// header_logo_section
function header_breadcrumb_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__( 'Breadcrumb', 'printfix' ),
            'description' => esc_html__( 'Breadcrumb Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__( 'Breadcrumb Image', 'printfix' ),
            'description' => esc_html__( 'Breadcrumb Image add/remove', 'printfix' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );


    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => __( 'Breadcrumb BG Color', 'printfix' ),
            'description' => esc_html__( 'You can change breadcrumb bg color from here.', 'printfix' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#f3fbfe',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__( 'Dimensions Control', 'printfix' ),
            'description' => esc_html__( 'Description', 'printfix' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '',
                'padding-bottom' => '',
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'breadcrumb_typography',
            'label'       => esc_html__( 'Typography Control', 'printfix' ),
            'description' => esc_html__( 'The full set of options.', 'printfix' ),
            'section'     => 'header_breadcrumb_section',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );


}
header_breadcrumb_section();

// header_logo_section
function full_site_typography(){
    // header_logo_section section 
    new \Kirki\Section(
        'full_site_typography',
        [
            'title'       => esc_html__( 'Typography', 'printfix' ),
            'description' => esc_html__( 'Typography Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'full_site_typography_settings',
            'label'       => esc_html__( 'Typography Control', 'printfix' ),
            'description' => esc_html__( 'The full set of options.', 'printfix' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );
}
full_site_typography();

// header_logo_section
function footer_layout_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__( 'Footer', 'printfix' ),
            'description' => esc_html__( 'Footer Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__( 'Footer Widget Number', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose an option', 'printfix' ),
            'choices'     => [
                '1' => esc_html__( '1', 'printfix' ),
                '2' => esc_html__( '2', 'printfix' ),
                '3' => esc_html__( '3', 'printfix' ),
                '4' => esc_html__( '4', 'printfix' ),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'printfix_footer_elementor_switch',
            'label'       => esc_html__( 'Footer Custom/Elementor Switch', 'printfix' ),
            'description' => esc_html__( 'Footer Custom/Elementor On/Off', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout',
            'label'       => esc_html__( 'Footer Layout Control', 'printfix' ),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
                'footer_2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
                'footer_3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
            ],
            'default'     => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'printfix_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_footer_bg_color',
            'label'       => __( 'Footer BG Color', 'printfix' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '#1B7261',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_copyright_bg_color',
            'label'       => __( 'Copyright BG Color', 'printfix' ),
            'description' => esc_html__( 'You can change Copyright bg color from here.', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '#051145',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_footer_bg_color_1',
            'label'       => __( 'Footer BG Color 01', 'printfix' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '#fff',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_copyright_bg_color_1',
            'label'       => __( 'Copyright BG Color 01', 'printfix' ),
            'description' => esc_html__( 'You can change Copyright bg color from here.', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '#fff',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_footer_bg_color_2',
            'label'       => __( 'Footer BG Color 02', 'printfix' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '#fff',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_copyright_bg_color_2',
            'label'       => __( 'Copyright BG Color 02', 'printfix' ),
            'description' => esc_html__( 'You can change Copyright bg color from here.', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => '#051145',
        ]
    );
    $footer_posttype = array(
        'post_type'      => 'tp-footer'
    );
    $footer_posttype_loop = get_posts($footer_posttype);
    $footer_post_obj_arr = array();
    foreach($footer_posttype_loop as $post){
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_layout_2_switch',
            'label'       => esc_html__( 'Footer Style 2 Switch', 'printfix' ),
            'description' => esc_html__( 'Footer Style 2 On/Off', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );      

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_layout_3_switch',
            'label'       => esc_html__( 'Footer Style 3 Switch', 'printfix' ),
            'description' => esc_html__( 'Footer Style 3 On/Off', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'printfix' ),
                'off' => esc_html__( 'Disable', 'printfix' ),
            ],
        ]
    );      

    new \Kirki\Field\Text(
        [
            'settings' => 'footer_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'printfix' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( 'Copyright &copy; 2024 RRDevs. All Rights Reserved', 'printfix' ),
            'priority' => 10,
        ]
    );  


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_social_switch',
            'label'       => esc_html__( 'Footer Social On / Off', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => false,
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_cta_switch',
            'label'       => esc_html__( 'Footer Cta On / Off', 'printfix' ),
            'section'     => 'footer_layout_section',
            'default'     => false,
            'priority' => 10,
        ]
    ); 
}
footer_layout_section();

// blog_section
function blog_section(){
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title'       => esc_html__( 'Blog Section', 'printfix' ),
            'description' => esc_html__( 'Blog Section Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'printfix_blog_btn_switch',
            'label'       => esc_html__( 'Blog BTN On/Off', 'printfix' ),
            'section'     => 'blog_section',
            'default'     => true,
            'priority' => 10,
        ]
    ); 

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'printfix_blog_cat',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'printfix' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'printfix_blog_author',
            'label'    => esc_html__( 'Blog Author Meta On/Off', 'printfix' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );
    // blog_section Date Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'printfix_blog_date',
            'label'    => esc_html__( 'Blog Date Meta On/Off', 'printfix' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );

    // blog_section Comments Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'printfix_blog_comments',
            'label'    => esc_html__( 'Blog Comments Meta On/Off', 'printfix' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );


    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'printfix_blog_btn',
            'label'    => esc_html__( 'Blog Button Text', 'printfix' ),
            'section'  => 'blog_section',
            'default'  => "Read More",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'printfix_singleblog_social',
            'label'    => esc_html__( 'Single Blog Social Share', 'printfix' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

}
blog_section();


// 404 section
function error_404_section(){
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title'       => esc_html__( '404 Page', 'printfix' ),
            'description' => esc_html__( '404 Page Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );


    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'printfix_error_title',
            'label'    => esc_html__( 'Not Found Title', 'printfix' ),
            'section'  => 'error_404_section',
            'default'  => "Sorry We Can't Find That Page! ",
            'priority' => 10,
        ]
    );

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'printfix_error_404',
            'label'    => esc_html__( 'Not Found 404', 'printfix' ),
            'section'  => 'error_404_section',
            'default'  => "404",
            'priority' => 10,
        ]
    );
    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'printfix_error_text',
            'label'    => esc_html__( 'Not Found 404', 'printfix' ),
            'section'  => 'error_404_section',
            'default'  => "Oops! The page you are looking for does not exist. It might have been moved or deleted.",
            'priority' => 10,
        ]
    );




    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'printfix_error_link_text',
            'label'    => esc_html__( 'Error Link Text', 'printfix' ),
            'section'  => 'error_404_section',
            'default'  => "Back To Home",
            'priority' => 10,
        ]
    );
    // 404_section img
    new \Kirki\Field\Image(
        [
            'settings'    => 'printfix_error_img',
            'label'       => esc_html__( 'Error Image', 'printfix' ),
            'description' => esc_html__( 'Error Bg Image Here', 'printfix' ),
            'section'     => 'error_404_section',
            'default'     => get_template_directory_uri() . '/assets/img/error/thumb-1.png',
        ]
    );


}
error_404_section();

// theme color section
function theme_color_section(){
    new \Kirki\Section(
        'theme_color_section',
        [
            'title'       => esc_html__( 'Theme Color', 'printfix' ),
            'description' => esc_html__( 'Printfix theme color Settings.', 'printfix' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_color_1',
            'label'       => __( 'Theme Color 1', 'printfix' ),
            'description' => esc_html__( 'this is theme color 1 control.', 'printfix' ),
            'section'     => 'theme_color_section',
            'default'     => '#1e3737',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_color_2',
            'label'       => __( 'Theme Color 2', 'printfix' ),
            'description' => esc_html__( 'this is theme color 2 control.', 'printfix' ),
            'section'     => 'theme_color_section',
            'default'     => '#07847f',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_color_3',
            'label'       => __( 'Theme Color 3', 'printfix' ),
            'description' => esc_html__( 'this is theme color 3 control.', 'printfix' ),
            'section'     => 'theme_color_section',
            'default'     => '#8fe1de',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'printfix_color_4',
            'label'       => __( 'Theme Color 4', 'printfix' ),
            'description' => esc_html__( 'this is theme color 4 control.', 'printfix' ),
            'section'     => 'theme_color_section',
            'default'     => '#fe7f4c',
        ]
    );
}
theme_color_section();