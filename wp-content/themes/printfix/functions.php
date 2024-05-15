<?php

/**
 * printfix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package printfix
 */

if ( !function_exists( 'printfix_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function printfix_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on printfix, use a find and replace
         * to change 'printfix' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'printfix', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'printfix' ),
            'header-top-menu' => esc_html__( 'Header Top Menu', 'printfix' ),
            'footer-bottom-menu' => esc_html__( 'Footer Bottom Menu', 'printfix' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'printfix_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        remove_theme_support( 'widgets-block-editor' );
        

        // Add support for woocommerce.
        add_theme_support('woocommerce');

        // Remove woocommerce defauly styles
        add_filter('woocommerce_enqueue_styles', '__return_false');

        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        

    }
endif;
add_action( 'after_setup_theme', 'printfix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function printfix_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'printfix_content_width', 640 );
}
add_action( 'after_setup_theme', 'printfix_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */

define( 'PRINTFIX_THEME_DIR', get_template_directory() );
define( 'PRINTFIX_THEME_URI', get_template_directory_uri() );
define( 'PRINTFIX_THEME_CSS_DIR', PRINTFIX_THEME_URI . '/assets/css/' );
define( 'PRINTFIX_THEME_JS_DIR', PRINTFIX_THEME_URI . '/assets/js/' );
define( 'PRINTFIX_THEME_INC', PRINTFIX_THEME_DIR . '/inc/' );



// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require PRINTFIX_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require PRINTFIX_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require PRINTFIX_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */
if ( class_exists( 'Kirki' ) ) {
    include_once PRINTFIX_THEME_INC . 'kirki-customizer.php';
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require PRINTFIX_THEME_INC . 'jetpack.php';
}

/**
 * include printfix functions file
 */
require_once PRINTFIX_THEME_INC . 'class-navwalker.php';
require_once PRINTFIX_THEME_INC . 'class-tgm-plugin-activation.php';
require_once PRINTFIX_THEME_INC . 'add_plugin.php';
require_once PRINTFIX_THEME_INC . '/common/printfix-breadcrumb.php';
require_once PRINTFIX_THEME_INC . '/common/printfix-scripts.php';
require_once PRINTFIX_THEME_INC . '/common/printfix-widgets.php';

require_once PRINTFIX_THEME_INC . 'rr-metabox.php';

if (class_exists('WooCommerce')) {
    require_once PRINTFIX_THEME_INC . '/woocommerce/woo-hooks-functions.php';
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function printfix_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'printfix_pingback_header' );

// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function printfix_move_comment_textarea_to_bottom( $fields ) {
    $comment_field       = $fields[ 'comment' ];
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'printfix_move_comment_textarea_to_bottom' );


// printfix_comment 
if ( !function_exists( 'printfix_comment' ) ) {
    function printfix_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = '<div class="postbox__comment-reply"><span>Reply</span>
    </div>';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>


<li id="comment-<?php comment_ID();?>" class="comment-list">
    <div class="postbox__comment-box border-mr p-relative">
        <div class="postbox__comment-box-inner d-flex">
            <div class="postbox__comment-avater">
            <?php print get_avatar( $comment, 102, null, null, [ 'class' => [] ] );?>
            </div>
            <div class="postbox__comment-content">
                <div class="postbox__comment-name p-relative">
                    <h5 class="postbox__comment-name"><?php print get_comment_author_link();?></h5>
                    <p class="postbox__comment-date"><?php the_time( get_option('date_format') ); ?></p>
                </div>
                <?php comment_text();?>
                <?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) );?>
            </div>
        </div>
    </div>



    <?php
    }
}



/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'printfix_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function printfix_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// printfix_search_filter_form
if ( !function_exists( 'printfix_search_filter_form' ) ) {
    function printfix_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="blog-sidebar__search p-relative"><div class="search-px"><form action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"> <i class="fa-light fa-magnifying-glass"></i>  </button>
		</form></div></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'printfix' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'printfix_search_filter_form' );
}

add_action( 'admin_enqueue_scripts', 'printfix_admin_custom_scripts' );


// printfix_admin_custom_scripts
function printfix_admin_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css',array());
    wp_enqueue_script( 'printfix-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'printfix-admin-custom' );
}