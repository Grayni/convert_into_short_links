<?php

	//if (!defined('SCRIPT')) exit;

	// Defence data from html tags 
	$long_link = htmlspecialchars(trim($_POST["long-link"]));
	$fantasy = htmlspecialchars(trim($_POST["fantasy-link"]));

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
	function span_error($error_type, $styleBorder){
		return "<span class='sh-link {$styleBorder}' style='color:#e33333;'>".$error_type."</span>";
	}

	/* 
	 * validation input 1
	 * For test validation forms with all logical expressions (php)
	 * OFF in custom.js functions => testedFirst, testedSecond
	 */
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
	else if(!get_headers($long_link, 1) || get_http_response_code($long_link) == '404'){
		echo span_error("URL не существует или ошибка 404. Введите действующую ссылку", "inp-invalid");
		exit;
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
	else if (!preg_match("/^([a-z][\w-]{1,29}[a-z\d])$/", $fantasy) && strlen($fantasy)>0) {
		echo span_error("Поле 2. Разрешено: латинские буквы в нижнем регистре, цифры и СОЕДИНИТЕЛЬНЫЕ знаки «-», «_». Первый знак буква.");
		exit;
	}

	// result
	
	else {
		include_once('database.php');
	}

