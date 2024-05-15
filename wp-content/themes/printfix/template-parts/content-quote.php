<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
 */
?>

<article id="post-<?php the_ID();?>"
    <?php post_class( 'postbox__blockquote p-relative postbox_quote__item format-quote mb-50' );?>>
    <div class="post__text">
        <?php the_content();?>
    </div>
</article>