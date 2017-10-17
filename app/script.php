<?php

	// Defence data from html tags 
	$long_link = strip_tags(trim($_POST["long-link"]));
	$fantasy   = strip_tags(trim($_POST["fantasy-link"]));

	// connect convert Russian domains
	include_once('class/idna_convert.class.php');

	$IDN = new idna_convert();
	$long_link = $IDN->encode($long_link);

	// parse response server URL
	function get_http_response_code($theURL) {
		$headers = get_headers($theURL);
		return substr($headers[0], 9, 3);
	}

	// error validation
	function span_error($error_type, $style_border = "red") {
		return "<span class='sh-link {$style_border}' style='color:#e33333;'>".$error_type."</span>";
	}


	/*
	 * 
	 * For check forms with all elements logical of expression (php)
	 * OFF in custom.js functions => testedFirst, testedSecond
	 *
	 */

	//validation input 1
	if ( !isset($long_link) || empty($long_link) )
		echo span_error("Поле 1 обязательно для заполнения. Вставьте URL");

	else if ( !filter_var($long_link, FILTER_VALIDATE_URL) )
		echo span_error("Не действительный URL");

	else if ( !preg_match("/^https?:\/\//i", $long_link) )
		echo span_error("Ссылка в Поле 1 должна начинаться с http:// или https://");

	else if ( strlen($long_link)<11 )
		echo span_error("Минимальная длина длинной ссылки 11 символов.");

	else if( !get_headers($long_link, 1) || get_http_response_code($long_link) == '404' )
		echo span_error("URL не существует или ошибка 404. Введите действующую ссылку.", "inp-invalid");

	// common validation
	else if ( !isset($fantasy) || !is_string($fantasy) || !is_string($long_link) )
		echo span_error("fatal error");

	// validation input 2
	else if ( strlen($fantasy)>0 && strlen($fantasy)<3|| strlen($fantasy)>30 )
		echo span_error("Неверная длина ссылки. Длина должна составлять от 3 до 30 символов.");

	else if (!preg_match("/^([a-z\d][\w-]{1,29}[a-z\d])$/i", $fantasy) && strlen($fantasy)>0)
		echo span_error("Поле 2. Доступные символы: латинские буквы, цифры и СОЕДИНИТЕЛЬНЫЕ знаки «-», «_».");

	// result
	else include_once('database.php');


