<?php
namespace rr_ELEMENTOR\Templates;

use rr_ELEMENTOR\Templates\rr_Api as Templatesrr_Api;
use \Elementor\TemplateLibrary\Source_Base;
use \Elementor\TemplateLibrary\Source_Remote;
use \Elementor\TemplateLibrary\Classes\Images;
use \Elementor\Api;
use \Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class rr_Api extends Source_Base {

	public function get_id() {
		return 'rr-library';
	}

	public function get_title() {
		return __( 'RR Addons Library', 'rr-core' );
	}

	public function register_data() {}

	public function get_items( $args = [] ) {
		$library_data = self::get_library_data();
		var_dump($library_data);
		$templates = [];
		if ( ! empty( $library_data['templates'] ) ) {
			foreach ( $library_data['templates'] as $template_data ) {
				$templates[] = $this->prepare_template( $template_data );
			}
		}
		return $templates;
	}

	public function get_tags() {
		$library_data = self::get_library_data();
		return ( ! empty( $library_data['tags'] ) ? $library_data['tags'] : [] );
	}

	public function get_type_tags() {
		$library_data = self::get_library_data();
		return ( ! empty( $library_data['type_tags'] ) ? $library_data['type_tags'] : [] );
	}

	
	private function prepare_template( array $template_data ) {
		return [
			'template_id' => $template_data['id'],
			'title'       => $template_data['title'],
			'type'        => $template_data['type'],
			'thumbnail'   => $template_data['thumbnail'],
			'date'        => $template_data['tmpl_created'],
			'tags'        => $template_data['tags'],
			'isPro'       => $template_data['is_pro']?? true,
			'url'         => $template_data['url'],
			'liveurl'     => $template_data['url'],
			'favorite' 	  => ! empty( $template_data['id'] ),
		];
	}

	
	private static function request_library_data( $force_update = false ) {
		$response	=	wp_remote_get(rr_API_URL .'data.json',['timeout'=>60]);
		$info_data	= 	json_decode(wp_remote_retrieve_body($response),true);
		$templates	=	[];
		if(isset($info_data['templates']) && !empty($info_data['templates'])){
			$templates	= $info_data;
		}
		return $templates;
	}

	public static function get_library_data( $force_update = false ) {
		$library_data = self::request_library_data( $force_update );
		
		if ( empty( $library_data ) ) {
			return [];
		}
		return $library_data;
	}

	public function get_item( $template_id ) {
		$templates = $this->get_items();

		return $templates[ $template_id ];
	}
	
	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to a droit elementor addons library' );
	}
	
	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to a droit elementor addons library' );
	}

	
	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from a droit elementor addons library' );
	}

	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from a droit elementor addons library' );
	}
	
	public static function request_template_data( $template_id ) {
		if ( empty( $template_id ) ) {
			return;
		}

		$template_url = sprintf(rr_API_URL . "templates/%s.json", $template_id);

		$response = wp_remote_get(
			$template_url,
			[
				'timeout' => 10
			]
		);

		return wp_remote_retrieve_body( $response );
	}

	public function get_data( array $args, $context = 'display' ) {
		$data = self::request_template_data( $args['template_id'] );

		
		$data = json_decode( $data, true );
		if ( empty( $data ) || empty( $data['content'] ) ) {
			throw new \Exception( __( 'Template does not have any content', 'droit-addons' ) );
		}

		$data['content'] = $this->replace_elements_ids( $data['content'] );
		$data['content'] = $this->process_export_import_content( $data['content'], 'on_import' );

		$post_id = $args['editor_post_id'];
		$document = Plugin::$instance->documents->get( $post_id );
		if ( $document ) {
			$data['content'] = $document->get_elements_raw_data( $data['content'], true );
		}
		return $data;
	}

}