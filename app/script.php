<?php

	//if (!defined('SCRIPT')) exit;

	// Defence data from html tags 
	$long_link = htmlspecialchars($_POST["long-link"]);
	$fantasy = htmlspecialchars($_POST["fantasy-link"]);

	// connect convert Russian domains
	require_once('class/idna_convert.class.php'); 
	$IDN = new idna_convert();
	$long_link = $IDN->encode($long_link);

// parse response server URL
	function get_http_response_code($theURL) {
		$headers = get_headers($theURL);
		return substr($headers[0], 9, 3);
	}

	// error validation
	function span_error($error_type){
		return "<span class='sh-link' style='color:#e33333;'>".$error_type."</span>";
	}

	// for sql encoder
	// function http_encode($url) {
	// 		$url = urlencode($url));
	// 		return $url;
	// }

	// validation input 1
	if (!isset($long_link) || empty($long_link)) {
		echo span_error("Поле 1 обязательно для заполнения. Вставьте URL");
		exit;
	}
	else if (!preg_match("/^https?:\/\//i", $long_link)) {
		echo span_error("Ссылка в Поле 1 должна начинаться с http:// или https://");
		exit;
	}
	else if (strlen($long_link)<11) {
		echo span_error("Минимальная длина длинной ссылки 11 символов");
		exit;
	}
	if(!get_headers($long_link, 1) || get_http_response_code($long_link) == '404'){
		echo span_error("URL не существует или ошибка 404. Введите действующую ссылку");
	}

	// common validation
	else if (!isset($fantasy) || !is_string($fantasy) || !is_string($long_link) ) {
		echo span_error("fatal error");
		exit;
	}

	// validation input 2
	else if (strlen($fantasy)>0 && strlen($fantasy)<3|| strlen($fantasy)>30) {
		echo span_error("Неверная длина ссылки. Длина должна составлять от 3 до 30 символов.");
		exit;
	}
	else if (!preg_match("/^([a-z\d][a-z\d-_]{1,30}[a-z\d])$/i", $fantasy) && strlen($fantasy)>0) {
		echo span_error("Поле 2. Разрешено: латинские буквы, цифры и СОЕДИНИТЕЛЬНЫЕ знаки «-», «_».");
		exit;
	}

	// result
	else {
		// unique data (use data-base)
		// if (unique) {}
		// else {return old data without data-base}

		echo "<span>Ваша ссылка:
				<a href='#' class='sh-link' id='new-link'>$long_link</a><br>
				<a href='#' class='sh-link' id='new-link'>$fantasy</a>
			</span>";
	}

	//echo "Придуманная ссылка: $fantasy<br>";

	// adter connect with mysql
	// mysql_query('SET NAMES utf8')
	//define('SCRIPT', 1);
	//include_once 'script.php';

