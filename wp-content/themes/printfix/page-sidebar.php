<?php

/**
 * Template Name: Page Sidebar
 * @package printfix
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<div class="rr-blog-area  postbox__area pt-120 pb-120">
    <div class="container">
        <div class="row gx-30">
            <div class="col-lg-<?php print esc_attr( $blog_column );?>">
                <div class="printfix-page-content">
                    <?php
						if ( have_posts() ):
							while ( have_posts() ): the_post();
								get_template_part( 'template-parts/content', 'page' );
							endwhile;
						else:
						get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
                </div>
            </div>
            <?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="sidebar__wrapper">
                        <?php get_sidebar();?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php
get_footer();