<?php 
class RRProjecRRost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'projects_template_include' ) );
	}
	
	public function projects_template_include( $template ) {
		if ( is_singular( 'rr-projects' ) ) {
			return $this->get_template( 'single-rr-projects.php');
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
		$mekina_project_slug = get_theme_mod( 'mekina_project_slug', __( 'Projects', 'rr-core' ) );
		$labels = array(
			'name'                  => esc_html_x( 'Projects', 'Post Type General Name', 'rr-core' ),
			'singular_name'         => esc_html_x( 'Project', 'Post Type Singular Name', 'rr-core' ),
			'menu_name'             => esc_html__( 'Projects', 'rr-core' ),
			'name_admin_bar'        => esc_html__( 'Projects', 'rr-core' ),
			'archives'              => esc_html__( 'Item Archives', 'rr-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'rr-core' ),
			'all_items'             => esc_html__( 'All Items', 'rr-core' ),
			'add_new_item'          => esc_html__( 'Add New project', 'rr-core' ),
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
			'label'                 => esc_html__( 'project', 'rr-core' ),
			'labels'                => $labels,
			'supports'              => ['title', 'editor', 'thumbnail', 'elementor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-shield',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $mekina_project_slug,
				'with_front' => false
			),
		);

		register_post_type( 'rr-projects', $args );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Project Categories', 'Taxonomy General Name', 'rr-core' ),
			'singular_name'              => esc_html_x( 'project Categories', 'Taxonomy Singular Name', 'rr-core' ),
			'menu_name'                  => esc_html__( 'Project Categories', 'rr-core' ),
			'all_items'                  => esc_html__( 'All project Category', 'rr-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'rr-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'rr-core' ),
			'new_item_name'              => esc_html__( 'New project Category Name', 'rr-core' ),
			'add_new_item'               => esc_html__( 'Add New project Category', 'rr-core' ),
			'edit_item'                  => esc_html__( 'Edit project Category', 'rr-core' ),
			'update_item'                => esc_html__( 'Update project Category', 'rr-core' ),
			'view_item'                  => esc_html__( 'View project Category', 'rr-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'rr-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'rr-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'rr-core' ),
			'popular_items'              => esc_html__( 'Popular project Category', 'rr-core' ),
			'search_items'               => esc_html__( 'Search project Category', 'rr-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'rr-core' ),
			'no_terms'                   => esc_html__( 'No project Category', 'rr-core' ),
			'items_list'                 => esc_html__( 'project Category list', 'rr-core' ),
			'items_list_navigation'      => esc_html__( 'project Category list navigation', 'rr-core' ),
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

		register_taxonomy('projects-cat','rr-projects', $args );
	}

}

new RRProjecRRost();