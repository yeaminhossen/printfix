<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
 */

$printfix_blog_btn = get_theme_mod( 'printfix_blog_btn', 'Read More' );
$printfix_blog_btn_switch = get_theme_mod( 'printfix_blog_btn_switch', true );

?>
<?php if ( !empty( $printfix_blog_btn_switch ) ): ?>
    <div class="postbox__read-more">
    <a href="<?php the_permalink();?>" class="rr-btn"><span><?php print esc_html( $printfix_blog_btn );?> <i class="fa-solid fa-arrow-right"></i></span></a>
</div>
<?php endif;?>