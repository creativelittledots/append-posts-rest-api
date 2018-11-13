<?php
/**
 * Plugin Name: Append Posts REST API
 * Description: Appends to to Terms and Parent Posts in WP REST API
 * Author: Creative Little Dots
 * Version: 1.0.0
 */
 
function append_posts_rest_api_prepare_term( $data, $item, $request ) {
	if($append = $request->get_param('append')) {
		global $wp_taxonomies;
		$append = array_map('trim', explode(',', $append));
	    $types = array_intersect($append, ( isset( $wp_taxonomies[$item->taxonomy] ) ) ? $wp_taxonomies[$item->taxonomy]->object_type : array());
	    foreach($types as $type) {
			$args = array(
				'post_type' => $type,
				'tax_query' => array(
					array(
						'taxonomy' => $item->taxonomy,
						'field' => 'slug',
						'terms' => $item->slug
					)
				),
				'posts_per_page' => -1
			);
			$posts = get_posts( $args );
			$posts_arr = array();
			foreach ( $posts as $p ) {
				$api = new WP_REST_Posts_Controller($p->post_type);
		        $response = $api->prepare_item_for_response($p, $request);
				$posts_arr[] = $response->data;
			}
			if($posts_arr)
				$data->data[$type] = $posts_arr;
		}
	}
	return $data;
}
function append_posts_rest_api_prepare_post( $data, $item, $request ) {
	if($append = $request->get_param('append')) {
		$append = array_map('trim', explode(',', $append));
		if(in_array('children', $append)) {
			$args = array(
				'post_parent' => $item->ID,
				'post_type' => $item->post_type,
				'orderby' => $request->get_param('orderby'),
				'order' => $request->get_param('order'),
				'posts_per_page' => -1
			);
			$posts = get_posts( $args );
			$posts_arr = array();
			if(count($posts)) {
				foreach ( $posts as $p ) {
					$api = new WP_REST_Posts_Controller($p->post_type);
			        $response = $api->prepare_item_for_response($p, $request);
					$posts_arr[] = $response->data;
				}
			}
			if($posts_arr)
				$data->data['children'] = $posts_arr;
		}
		if(in_array('revisions', $append)) {
			$args = array(
				'post_parent' => $item->ID,
				'post_type' => 'revision',
				'posts_per_page' => -1
			);
			$posts = get_posts( $args );
			$posts_arr = array();
			if(count($posts)) {
				foreach ( $posts as $p ) {
					$api = new WP_REST_Posts_Controller($p->post_type);
			        $response = $api->prepare_item_for_response($p, $request);
					$posts_arr[] = $response->data;
				}
			}
			if($posts_arr)
				$data->data['revisions'] = $posts_arr;
		}
	}
	return $data;
}
add_action('init', function() {
	$taxonomies = get_taxonomies(array('show_in_rest' => true));
	foreach($taxonomies as $taxonomy) {
		add_filter( 'rest_prepare_' . $taxonomy, 'append_posts_rest_api_prepare_term', 10, 3 );
	}
	$types = get_post_types(array('show_in_rest' => true));
	foreach($types as $type) {
		add_filter( 'rest_prepare_' . $type, 'append_posts_rest_api_prepare_post', 10, 3 );
	}
}, 999);
