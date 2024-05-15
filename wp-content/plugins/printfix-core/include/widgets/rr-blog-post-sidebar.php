<?php
	/**
	 * RRCore Sidebar Posts Image
	 *
	 *
	 * @author 		Theme_Pure
	 * @category 	Widgets
	 * @package 	RRCore/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	*/

Class RR_Post_Sidebar_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('RR-latest-posts', 'RR Sidebar Posts Image', array(
			'description'	=> 'Latest Blog Post Widget by Theme_Pure'
		));
	}

	public function widget($args, $instance){
		extract($args);
		extract($instance);

	 echo $before_widget; 
		 if($instance['title']):
		 echo $before_title; ?>
<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
<?php echo $after_title; ?>
<?php endif; ?>

<div class="sidebar__widget-content">

    <?php 
			$q = new WP_Query( array(
				'post_type'     => 'post',
				'posts_per_page'=> ($instance['count']) ? $instance['count'] : '3',
				'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
				'orderby' => 'comment_count'
			));

			if( $q->have_posts() ):
			while( $q->have_posts() ):$q->the_post();
			?>
    <div class="rc__post d-flex align-items-center">
	<?php if ( has_post_thumbnail() ): ?>
        <div class="rc__post-thumb mr-20">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
        </div>
		<?php endif; ?>
        <div class="rc__post-content">
            <div class="rc__meta">
                <span>
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 8C15 11.864 11.864 15 8 15C4.136 15 1 11.864 1 8C1 4.136 4.136 1 8 1C11.864 1 15 4.136 15 8Z" stroke="#FF3D00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M10.5962 10.2259L8.42623 8.93093C8.04823 8.70693 7.74023 8.16793 7.74023 7.72693V4.85693" stroke="#FF3D00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
				<?php the_time( get_option('date_format') ); ?></span>
            </div>
            <h3 class="rc__post-title">
			<a href="<?php the_permalink(); ?>"><?php print wp_trim_words(get_the_title(), 7, ''); ?></a>
            </h3>
        </div>
    </div>
    <?php endwhile;            
			 endif; ?>
</div>


<?php echo $after_widget; ?>

<?php
}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'rr-core' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'rr-core' );
		$choose_style = ! empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'rr-core' );
	?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
    <input type="text" name="<?php echo $this->get_field_name('title'); ?>"
        id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
    <input type="number" name="<?php echo $this->get_field_name('count'); ?>"
        id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
    <select name="<?php echo $this->get_field_name('posts_order'); ?>"
        id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
        <option value="" disabled="disabled">Select Post Order</option>
        <option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
        <option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
    </select>
</p>

<?php }


}

add_action('widgets_init', function(){
	register_widget('RR_Post_Sidebar_Widget');
});