<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package printfix
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<div class="rr-blog-area  postbox__area pt-120 pb-120">
    <div class="container custom-container-3">
        <div class="row gx-30">
            <div class="col-lg-<?php print esc_attr( $blog_column );?> blog-post-items">
                <div class="postbox__wrapper tp-blog__wrapper mb-50">
                    <?php
						if ( have_posts() ):
					?>
                    <div class="result-bar page-header d-none">
                        <h1 class="page-title"><?php esc_html_e( 'Search Results For:', 'printfix' );?>
                            <?php print get_search_query();?></h1>
                    </div>
                    <?php
						while ( have_posts() ): the_post();
							get_template_part( 'template-parts/content', 'search' );
						endwhile;
					?>
              <div class="basic-pagination bg-color">
              <?php printfix_pagination( '<i class="fa-regular fa-angles-left"></i>', '<i class="fa-regular fa-angles-right"></i>', '', ['class' => ''] );?>
                    </div>
                    <?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
                </div>
            </div>
            <?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?> 
                <div class="col-xl-4">
                    <div class="sidebar">
                    <?php get_sidebar();?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php
get_footer();