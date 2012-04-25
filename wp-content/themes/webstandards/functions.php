<?php

// Page Type
function get_page_type()
{
	$type = '';

	if( is_home() ) {
		$type = 'index';
	} else {
		$type = is_page('editors') ? 'editors' : 'article';
	}

	echo $type;
}

// Current Page
function get_current_url()
{
	return 'http'.((!empty($_SERVER['HTTPS']))?'s':'').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

// Page ID
function get_page_id( $page_name )
{
	global $wpdb;
	$page_name_id = $wpdb->get_var(
		"SELECT ID FROM $wpdb->posts WHERE post_name = '{$page_name}'"
	);

	return $page_name_id;
}

// Category ID
function get_category_id( $category_name )
{
	$category_name_id = get_category_by_slug( $category_name )->term_id;
	return $category_name_id;
}

/**
 * Check if current page is root page
 * @return TRUE if current page is a root page, FALSE otherwise.
 */
function is_root_page()
{
	// NOTE: get_current_url ends with "/" so we must append "/" to return of
	// get_bloginfo
	return get_current_url() === get_bloginfo( 'url' ) . '/';
}

/**
 * Check if $url is current url
 * @param $url Url to check.
 * @return TRUE if $url is a current url, FALSE otherwise.
 */
function is_current_url( $url )
{
	return $url === get_current_url();
}

// Menu
function wst_menu()
{
	$current_category = get_the_category();
	$current_category = $current_category[0]->cat_ID;

	// List news, articles, events and about page
	// NOTE: order of elements is important!
	$list = wp_list_categories(
		'echo=0&include=' .
		get_category_id( 'news' ).',' .
		get_category_id( 'articles' ).','.
		get_category_id( 'events' ).','.
		'&hierarchical=0&title_li=&use_desc_for_title=0'.
		"&current_category={$current_category}"
	) .
	wp_list_pages(
		'echo=0&include=' . get_page_id('about') .
		'&title_li=&sort_column=menu_order'
	);

	// Parse wp_list_* result
	preg_match_all(
		'/<li class="(.*?)">\s*<a href="(.*?)".*?>(.*?)<\/a>/',
		$list,
		$matches,
		PREG_SET_ORDER
	);

	$last_index = count( $matches ) - 1;
	// Nothing is in menu
	if ( -1 === $last_index ) {
		return;
	}

	// NOTE: hard-coded wp name of 'about' page
	$current_post_id = get_the_ID();
	$current_post = get_post( $current_post_id );
	$is_page_about = 'about' === $current_post->post_name;

	$menu_body = '';
	foreach ( $matches as $key => $match ) {
		list( $full_match, $class, $url, $text ) = $match;
		$li_class = "";

		if ( is_root_page() ) {
			// Don't mark any link as current
		} else {
			// It is current element?
			// NOTE: hard-coded wp classes for current page and category
			if ( $is_page_about ) {
				$li_class .= (FALSE !== strpos( $class, 'current_page_item' ))
					? 'current'
					: '';
			} else {
				$li_class .= (FALSE !== strpos( $class, 'current-cat' ))
					? 'current'
					: '';
			}
		}

		// It is first or last element of list?
		// NOTE: must be with space as first character to prevent concatenation
		if ( 0 === $key ) {
			$li_class .= ' first';
		} else if ( $last_index === $key ) {
			$li_class .= ' last';
		} else {
			// Do nothing
		}

		// Complete li class
		$li_class = ' class="' . trim( $li_class ) . '"';

		// If this is current item and current url matches item url - we don't
		// display anchor, we use span instead.
		if ( false !== strpos( $li_class, ' class="current' ) && is_current_url( $url ) ) {
			$menu_body .= "<li{$li_class}><span>{$text}</span></li>";
		} else {
			$menu_body .= "<li{$li_class}><a href=\"{$url}\">{$text}</a></li>";
		}
	}

	echo "<ul id=\"menu\">{$menu_body}</ul>";
}

// Editors
function in_editor( $user )
{
	$user = new WP_User( $user );

	if ( empty( $user ) ) {
		return false;
	}

	$args = array_slice( func_get_args(), 2);
	$args = array_merge( array( 'publish_posts' ), $args );

	return call_user_func_array( array( &$user, 'has_cap' ), $args );
}
function is_editor()
{
	return current_user_can( 'publish_posts' );
}

// Custom Tags
$allowedtags = array(
	'a' => array( 'href' => array() ),
	'blockquote' => array(),
	'code' => array(),
	'del' => array(),
	'i' => array(),
	'em' => array(),
	'b' => array(),
	'strong' => array(),
	'pre' => array() // NOTE: MUST be here or it will be filtered out of any text
);
define( 'CUSTOM_TAGS', true );

// Feed
function rss_description() {
	return the_content();
}
add_filter( 'the_excerpt_rss','rss_description' );

// Unformatted
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'comment_text', 'wptexturize' );

// Admin Feeds Killer
function remove_dashboard_feeds() {
	remove_action( 'admin_head', 'index_js' );
}
add_action( 'admin_head', 'remove_dashboard_feeds', 1);

// Human Comments
function human_number($num, $one, $two, $more) {
	$temp = strval($num);
	$temp = $temp[strlen($temp)-1];
	return (($temp>1 and $temp <5 and (intval($num%100)>19 or intval($num%100)<10))?$two:($temp==1&&intval($num!=11)?$one:$more));
}
function comments_human ($zero, $one, $two, $more) {
	$num = get_comments_number();
	if (!$num) {
		echo $zero;
	}
	else {
		echo '<span class="comments-count">'.$num.'</span> '.human_number($num, $one, $two, $more);
	}
}

// Popular Posts
function popular_posts($cat_id) {
	$args = array(
		'numberposts' => 5,
		'category' => $cat_id,
		'orderby' => 'comment_count'
	);
	$popular_posts = get_posts( $args );
	echo '<ul>';
	foreach ( $popular_posts as $post ) {
		echo '<li><a href="'. get_permalink( $post->ID ) .'">'. $post->post_title .'</a></li>';
	}
	echo '</ul>';
}

// Custom Fields values from “Static” page
function get_static( $key ) {
	$static = get_post_custom_values( $key, get_page_id( 'static' ) );
	echo $static[0];
}

// Tag Cloud Cleanup
function wst_tag_cloud() {
	$tags_list = wp_tag_cloud('format=array&number=0');
	$tags_out = '<ul>';
	foreach ( $tags_list as $value ) {
		$value = preg_replace('!(<a href=)\'(http://.*?)\'(.*?)>(.*?)</a>!is', "$1\"$2\" rel=\"tag\">$4</a>", $value);
		$tags_out .= "<li>$value</li>\n";
	}
	$tags_out .= '</ul>';
	echo $tags_out;
}

?>