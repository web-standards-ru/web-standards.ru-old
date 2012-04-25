<?

/*
	Plugin Name: Yandex Search
	Plugin URI: http://pepelsbey.net/
	Version: 1.0
	Description: Redirects search form queries to Yandex Site Search
	Author: pepelsbey
	Author URI: http://pepelsbey.net/
*/

	function yandex() {
		if ( is_search() ) {

			$sid = '97396';
			$url = 'http://yandex.ru/sitesearch?searchid=' . $sid . '&text=' . urlencode( get_query_var( 's' ) );
		
			if ( !empty( $_GET['s'] ) ) {
				wp_redirect( $url );
			}
		}
	}

	add_action( 'template_redirect', 'yandex' );

?>