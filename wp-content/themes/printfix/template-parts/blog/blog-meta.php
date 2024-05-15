<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printfix
 */

$categories = get_the_terms( $post->ID, 'category' );
$printfix_blog_date = get_theme_mod( 'printfix_blog_date', true );
$printfix_blog_comments = get_theme_mod( 'printfix_blog_comments', true );
$printfix_blog_author = get_theme_mod( 'printfix_blog_author', true );
$printfix_blog_cat = get_theme_mod( 'printfix_blog_cat', false );

?>
<ul class="blog__details-meta mb-25">
    <?php if ( !empty($printfix_blog_author) ): ?>
    <li>
        <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                <path
                    d="M15.2222 17V15.2222C15.2222 14.2792 14.8476 13.3748 14.1808 12.708C13.514 12.0412 12.6097 11.6666 11.6667 11.6666H4.55556C3.61256 11.6666 2.70819 12.0412 2.0414 12.708C1.3746 13.3748 1 14.2792 1 15.2222V17"
                    stroke="#4A5764" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M8.11024 8.11111C10.0739 8.11111 11.6658 6.51923 11.6658 4.55556C11.6658 2.59188 10.0739 1 8.11024 1C6.14656 1 4.55469 2.59188 4.55469 4.55556C4.55469 6.51923 6.14656 8.11111 8.11024 8.11111Z"
                    stroke="#4A5764" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <?php print get_the_author();?>
        </a>
    </li>
    <?php endif;?>

    <?php if ( !empty($printfix_blog_cat) ): ?>
    <?php if ( !empty( $categories[0]->name ) ): ?>
    <li> <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"> <i
                class="fa-regular fa-folder-open"></i>
            <?php echo esc_html($categories[0]->name); ?>
        </a>
    </li>
    <?php endif;?>
    <?php endif;?>

    <?php if ( !empty($printfix_blog_date) ): ?>
    <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
            <path
                d="M13 2.50012H2.5C1.67157 2.50012 1 3.17169 1 4.00012V14.5001C1 15.3285 1.67157 16.0001 2.5 16.0001H13C13.8284 16.0001 14.5 15.3285 14.5 14.5001V4.00012C14.5 3.17169 13.8284 2.50012 13 2.50012Z"
                stroke="#4A5764" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M10.752 1V4" stroke="#4A5764" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M4.75 1V4" stroke="#4A5764" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M1 6.99988H14.5" stroke="#4A5764" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
        <?php the_time( get_option('date_format') ); ?>
    </li>
    <?php endif;?>

    <?php if ( !empty($printfix_blog_comments) ): ?>
    <li>
        <a href="<?php comments_link();?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path
                    d="M14.9423 7.61112C14.9449 8.63769 14.7061 9.65036 14.2452 10.5667C13.6986 11.6647 12.8585 12.5882 11.8188 13.2339C10.7791 13.8795 9.58088 14.2217 8.35842 14.2222C7.33609 14.2249 6.32758 13.9851 5.41505 13.5222L1 15L2.47168 10.5667C2.01076 9.65036 1.7719 8.63769 1.77457 7.61112C1.77504 6.3836 2.11586 5.18046 2.75883 4.13644C3.40181 3.09243 4.32156 2.24879 5.41505 1.70002C6.32758 1.23719 7.33609 0.997346 8.35842 1.00002H8.7457C10.3602 1.08946 11.8851 1.77372 13.0284 2.9218C14.1718 4.06987 14.8532 5.60108 14.9423 7.22223V7.61112Z"
                    stroke="#4A5764" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <?php comments_number();?>
        </a>
    </li>
    <?php endif;?>
    </ul>