<?php
/*
	Plugin Name: Custom Slug
	Plugin URI: http://wordpress.org/#
	Description: From any permalink structure to /category/id/
	Author: jahson
	Version: 1.2.0
*/

// NOTE: HIGHLY EXPERIMENTAL
function news_permalink( $permalink, $post ) {
	$categories = get_the_category( $post->ID );
	// Let's assume that news always have only one category
	if ( 1 === count( $categories ) ) {
		// Rewrite permalink for news and leave unchanged for others
		// NOTE: hardcoded news slug and permalink
		if ( 'news' === $categories[0]->slug ) {
			return get_bloginfo( 'url' ) . "/news/{$post->ID}/";
		} else {
			return $permalink;
		}
	}
}

add_filter( 'post_link', 'news_permalink', 10, 2 );

function add_custom_rewrite_rules() {
	add_permastruct( 'news', 'news/%post_id%', false );
	flush_rewrite_rules();
}

function remove_custom_rewrite_rules() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'add_custom_rewrite_rules' );
register_deactivation_hook( __FILE__, 'remove_custom_rewrite_rules' );

function insert_custom_rewrite_rules( $rules ) {
	global $wp_rewrite;

	return $wp_rewrite->generate_rewrite_rule( "{$wp_rewrite->root}news/%post_id%/" )
		+ $rules;
};

add_filter( 'rewrite_rules_array', 'insert_custom_rewrite_rules' );

?>
