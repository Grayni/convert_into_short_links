<?php
	$long_link = $_POST["long-link"];
	$fantasy = $_POST["fantasy-link"];

	// $ch = curl_init($long_link);

	// curl_exec($ch);


	// if (!curl_errno($ch)) {
	//   $info = curl_getinfo($ch);
	//   echo 'Прошло ', $info['total_time'], ' секунд во время запроса к ', $info['url'], "\n";
	// }

	// curl_close($ch);

	if ($_POST["enter"]) {
		echo "Длинная ссылка: $long_link<br>";
		echo "Придуманная ссылка: $fantasy<br>";
		echo "test string";
	}
?>
