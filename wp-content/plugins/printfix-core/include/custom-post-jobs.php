<?php 
class RRJobsPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'jobs_template_include' ) );
	}
	
	public function jobs_template_include( $template ) {
		if ( is_singular( 'jobs' ) ) {
			return $this->get_template( 'single-jobs.php');
		}
		return $template;
	}
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = RRCORE_ADDONS_DIR . '/include/template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}
	
	
	public function register_custom_post_type() {
		$technix_jobs_slug = get_theme_mod( 'technix_jobs_slug', __( 'jobs', 'rr-core' ) );
		$labels = array(
			'name'                  => esc_html_x( 'Jobs', 'Post Type General Name', 'rr-core' ),
			'singular_name'         => esc_html_x( 'job', 'Post Type Singular Name', 'rr-core' ),
			'menu_name'             => esc_html__( 'Jobs', 'rr-core' ),
			'name_admin_bar'        => esc_html__( 'Jobs', 'rr-core' ),
			'archives'              => esc_html__( 'Item Archives', 'rr-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'rr-core' ),
			'all_items'             => esc_html__( 'All Items', 'rr-core' ),
			'add_new_item'          => esc_html__( 'Add New job', 'rr-core' ),
			'add_new'               => esc_html__( 'Add New', 'rr-core' ),
			'new_item'              => esc_html__( 'New Item', 'rr-core' ),
			'edit_item'             => esc_html__( 'Edit Item', 'rr-core' ),
			'update_item'           => esc_html__( 'Update Item', 'rr-core' ),
			'view_item'             => esc_html__( 'View Item', 'rr-core' ),
			'search_items'          => esc_html__( 'Search Item', 'rr-core' ),
			'not_found'             => esc_html__( 'Not found', 'rr-core' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'rr-core' ),
			'featured_image'        => esc_html__( 'Featured Image', 'rr-core' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'rr-core' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'rr-core' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'rr-core' ),
			'inserbt_into_item'     => esc_html__( 'Insert into item', 'rr-core' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'rr-core' ),
			'items_list'            => esc_html__( 'Items list', 'rr-core' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'rr-core' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'rr-core' ),
		);

		$args   = array(
			'label'                 => esc_html__( 'job', 'rr-core' ),
			'labels'                => $labels,
			'supports'              => ['title', 'editor', 'thumbnail', 'elementor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-clipboard',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $technix_jobs_slug,
				'with_front' => false
			),
		);

		register_post_type( 'jobs', $args );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Job Categories', 'Taxonomy General Name', 'rr-core' ),
			'singular_name'              => esc_html_x( 'Job Categories', 'Taxonomy Singular Name', 'rr-core' ),
			'menu_name'                  => esc_html__( 'Job Categories', 'rr-core' ),
			'all_items'                  => esc_html__( 'All job Category', 'rr-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'rr-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'rr-core' ),
			'new_item_name'              => esc_html__( 'New job Category Name', 'rr-core' ),
			'add_new_item'               => esc_html__( 'Add New job Category', 'rr-core' ),
			'edit_item'                  => esc_html__( 'Edit job Category', 'rr-core' ),
			'update_item'                => esc_html__( 'Update job Category', 'rr-core' ),
			'view_item'                  => esc_html__( 'View job Category', 'rr-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'rr-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'rr-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'rr-core' ),
			'popular_items'              => esc_html__( 'Popular job Category', 'rr-core' ),
			'search_items'               => esc_html__( 'Search job Category', 'rr-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'rr-core' ),
			'no_terms'                   => esc_html__( 'No job Category', 'rr-core' ),
			'items_list'                 => esc_html__( 'job Category list', 'rr-core' ),
			'items_list_navigation'      => esc_html__( 'job Category list navigation', 'rr-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('jobs-cat','jobs', $args );
	}

}

new RRJobsPost();

// custom metaboxs for jobs post-type
function custom_metaboxs_jobs() {
	add_meta_box(
		'rr-jobs', // Unique ID
		'Jobs Additional Information',      // Box title
		'custom_jobs_func',  // Content callback, must be of type callable
		'jobs'  // Post type
	);
}
add_action( 'add_meta_boxes', 'custom_metaboxs_jobs' );

function custom_jobs_func( $post ) {
	$meta_id = get_post_meta($post->ID);
	?>
	<div class="job-additional-info">
		<div class="job-type">
			<h4>Job Type</h4>
			<input class="widefat" type="text" name="rr-job-type" placeholder="add job type" value="<?php if(isset($meta_id['rr-job-type'])) echo $meta_id['rr-job-type'][0]; ?>" >
		</div>
		<div class="job-location">
			<h4>Job Location</h4>
			<input class="widefat" type="text" name="rr-job-location" placeholder="add job location" value="<?php if(isset($meta_id['rr-job-location'])) echo $meta_id['rr-job-location'][0]; ?>" >
		</div>
	</div>
	<?php
}

add_action('save_post', function($post_id){
	if(isset($_POST['rr-job-type'])){
		update_post_meta($post_id, 'rr-job-type', $_POST['rr-job-type']);
	};
	if(isset($_POST['rr-job-location'])){
		update_post_meta($post_id, 'rr-job-location', $_POST['rr-job-location']);
	};
});


// css add for job post type metaboxs
add_action('admin_head', 'custom_css_jobs_metaboxs');

function custom_css_jobs_metaboxs() {
  echo '<style>
	.job-additional-info{
		display: flex;
		
	}
	.job-type{
		width: 50%;
		padding-right: 30px;
		border-right: 1px solid rgba(8, 8, 41, 0.08);
	}
	.job-location {
		width: 50%;
		padding-left: 30px;

    } 
  </style>';
}