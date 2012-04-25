<?php

/*
	Plugin Name: Page Navigation
	Plugin URI: http://pepelsbey.net/
	Description: Advanced paging for archive pages
	Version: 1.0
	Author: pepelsbey
	Author URI: http://pepelsbey.net/
*/

	function wst_paging() {

		global $wpdb, $wp_query;

		if (!is_single()) {

			$request = $wp_query->request;
			$posts_per_page = intval(get_query_var('posts_per_page'));
			$paged = intval(get_query_var('paged'));

			$numposts = $wp_query->found_posts;
			$max_page = $wp_query->max_num_pages;

			if(empty($paged) || $paged == 0) {
				$paged = 1;
			}

			$pages_to_show = 5;
			$pages_to_show_minus_1 = $pages_to_show-1;
			$half_page_start = floor($pages_to_show_minus_1/2);
			$half_page_end = ceil($pages_to_show_minus_1/2);
			$start_page = $paged - $half_page_start;

			if($start_page <= 0) {
				$start_page = 1;
			}

			$end_page = $paged + $half_page_end;

			if(($end_page - $start_page) != $pages_to_show_minus_1) {
				$end_page = $start_page + $pages_to_show_minus_1;
			}

			if($end_page > $max_page) {
				$start_page = $max_page - $pages_to_show_minus_1;
				$end_page = $max_page;
			}

			if($start_page <= 0) {
				$start_page = 1;
			}

			if($max_page > 1) {

				echo '<ul class="paging">';

				// First Page

				// if ($start_page >= 2 && $pages_to_show < $max_page) {
				// 	echo '<li><a href="'.clean_url(get_pagenum_link()).'">'.str_replace("%TOTAL_PAGES%", $max_page, '&bull;').'</a></li>';
				// }

				$prev_link = get_previous_posts_link('&larr;');
				if($prev_link) echo '<li>'.$prev_link.'</li>';

				for($i = $start_page; $i <= $end_page; $i++) {						
					if($i == $paged) {
						echo '<li class="current">'.str_replace("%PAGE_NUMBER%", $i, '%PAGE_NUMBER%').'</li>';
					} else {
						echo '<li><a href="'.clean_url(get_pagenum_link($i)).'">'.str_replace("%PAGE_NUMBER%", $i, '%PAGE_NUMBER%').'</a></li>';
					}
				}

				$next_link = get_next_posts_link('&rarr;', $max_page);
				if($next_link) echo '<li>'.$next_link.'</li>';

				// Last Page

				// if ($end_page < $max_page) {
				// 	echo '<li><a href="'.clean_url(get_pagenum_link($max_page)).'">'.str_replace("%TOTAL_PAGES%", $max_page, '&bull;').'</a></li>';
				// }

				echo '</ul>';
			}
		}
	}

?>
