<?php
	/**
	 * Medodove Social Widget
	 *
	 *
	 * @author 		basictheme
	 * @category 	Widgets
	 * @package 	Medodove/Widgets
	 * @version 	1.0.1
	 * @extends 	WP_Widget
	 */
	add_action('widgets_init', 'RR_service_sidebar_widget');
	function RR_service_sidebar_widget() {
		register_widget('RR_service_sidebar_widget');
	}
	
	
	class RR_service_sidebar_widget  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('RR_service_sidebar_widget',esc_html__('Harry Service Sidebar Contact','tocore'),array(
				'description' => esc_html__('Harry Sidebar Widget','tocore'),
			));
		}
		
		public function widget($args,$instance){
			extract($args);
			extract($instance);
		 	print $before_widget; 

		 // 	if ( ! empty( $title ) ) {
			// 	print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
			// }
		?>
          
 
            <div class="services__widget-item-2 mb-30">
                <div class="services__contact">
                    <?php if( !empty($instance['title']) ): ?>
                    <h4 class="services__contact-title"><?php echo apply_filters( 'widget_title', $instance['title'] ); ?></h4>
                    <?php endif; ?>

                    <?php if( !empty($mailchimp_shortcode) ): ?>
                        <?php print do_shortcode($mailchimp_shortcode); ?>
                    <?php endif; ?>
                </div>
            </div>

	    	<?php print $after_widget; ?>  

		<?php
		}
		

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $instance
		 * @return void
		 */
		public function form($instance){
			$title  = isset($instance['title'])? $instance['title']:'';
			$mailchimp_shortcode  = isset($instance['mailchimp_shortcode'])? $instance['mailchimp_shortcode']:'';

			$mailchimp_text  = isset($instance['mailchimp_text'])? $instance['mailchimp_text']:'';
			$social_heading  = isset($instance['social_heading'])? $instance['social_heading']:'';
			$twitter  = isset($instance['twitter'])? $instance['twitter']:'';
			$facebook  = isset($instance['facebook'])? $instance['facebook']:'';
			$instagram  = isset($instance['instagram'])? $instance['instagram']:'';
			$youtube  = isset($instance['youtube'])? $instance['youtube']:'';
			$linkedin  = isset($instance['linkedin'])? $instance['linkedin']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','tocore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  class="widefat" name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Mailchimp Shortcode:','tocore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('mailchimp_shortcode')); ?>" class="widefat" name="<?php print esc_attr($this->get_field_name('mailchimp_shortcode')); ?>" value="<?php print esc_attr($mailchimp_shortcode); ?>">

			<p>
				<label for="title"><?php esc_html_e('Mailchimp text','tocore'); ?></label>
			</p>
			<textarea class="widefat" rows="5" cols="15" id="<?php print esc_attr($this->get_field_id('mailchimp_text')); ?>" value="<?php print esc_attr($mailchimp_text); ?>" name="<?php print esc_attr($this->get_field_name('mailchimp_text')); ?>"><?php print esc_attr($mailchimp_text); ?></textarea>
						
			
			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['subscribe_style'] = ( ! empty( $new_instance['subscribe_style'] ) ) ? strip_tags( $new_instance['subscribe_style'] ) : '';
			$instance['mailchimp_shortcode'] = ( ! empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';
			$instance['mailchimp_text'] = ( ! empty( $new_instance['mailchimp_text'] ) ) ? strip_tags( $new_instance['mailchimp_text'] ) : '';


			$instance['social_heading'] = ( ! empty( $new_instance['social_heading'] ) ) ? strip_tags( $new_instance['social_heading'] ) : '';
			$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
			$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
			$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
			$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
			$instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
			return $instance;
		}
	}