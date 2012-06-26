<?php

/*
	Plugin Name: Russian Date
	Plugin URI: http://pepelsbey.net
	Description: Converting all dates to the Russian date format
	Version: 1.0
	Author: pepelsey
	Author URI: http://pepelsbey.net
*/

	function russian_date($tdate = '') {
		if ( substr_count($tdate , '---') > 0 ) return str_replace('---', '', $tdate);

		$treplace = array (
			"Январь" => "января",
			"Февраль" => "февраля",
			"Март" => "марта",
			"Апрель" => "апреля",
			"Май" => "мая",
			"Июнь" => "июня",
			"Июль" => "июля",
			"Август" => "августа",
			"Сентябрь" => "сентября",
			"Октябрь" => "октября",
			"Ноябрь" => "ноября",
			"Декабрь" => "декабря",
			"th" => "",
			"st" => "",
			"nd" => "",
			"rd" => ""
		);
	   	return strtr($tdate, $treplace);
	}

	add_filter('the_time', 'russian_date');
	add_filter('get_comment_date', 'russian_date');

?>
