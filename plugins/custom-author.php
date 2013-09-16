<?php

/*
	Plugin Name: Custom Author
	Plugin URI: http://pepelsbey.net
	Description: Replacing real author from fake one base on custom fields
	Version: 1.0
	Author: pepelsey
	Author URI: http://pepelsbey.net
*/

	function custom_author() {
		$custom = get_post_custom_values('Author');
		if( $custom ) {
			list( $custom_name, $custom_url ) = explode( "\n", trim( $custom[0] ), 2 );
			$custom_name = explode( ' ', trim( $custom_name ), 2 );
			$author_first_name = $custom_name[0];
			$author_last_name = $custom_name[1];
			$author_url = $custom_url;
		} else {
			$author_first_name = get_the_author_meta('first_name');
			$author_last_name = get_the_author_meta('last_name');
			$author_url = get_the_author_meta('url');
		}
		if( is_feed() ) {
			$output = $author_first_name .' '. $author_last_name;
		} else {
			$output = '<span class="vcard"><a href="'. $author_url .'" class="user fn n url author"><span class="first-name">'.
				$author_first_name. '</span> <span class="last-name">'.
				$author_last_name. '</span></a></span>';
		}
		return $output;
	}

	add_filter('the_author', 'custom_author');

?>