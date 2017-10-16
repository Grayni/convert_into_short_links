<?php

	include_once('../../admin.php');

	$domain            = 'http://mysite/'; //http://links.grayni.ru/
	$fantasy_full_link = $domain . $fantasy;

	function copy_box($title,$need_link) {
		echo "<span>
				$title
				<a href='{$need_link}' class='sh-link' id='new-link' rel='noopener' target='_blank'>
					{$need_link}
				</a><br>
			</span>";
	}

	$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_LINK);

	if (mysqli_connect_error()) {

		die("Fatal connect: " . 
			mysqli_connect_error() . 
			"(" . mysqli_connect_errno() . ")"
		);

	}
	// if connect win
	else {
		// test unique long link
		$unique_link  = "SELECT ";
		$unique_link .= "long_link, generate, fantasy ";
		$unique_link .= "FROM auto_links WHERE long_link = '{$long_link}'";

		$result_unique_link = mysqli_query($mysqli, $unique_link);

		// error unique link
		if (!$result_unique_link) {
			die("Fatal unique link!");
		}

		$exist_link_test = mysqli_fetch_row($result_unique_link);

		//reset query
		mysqli_free_result($result_unique_link);

		// if long-link alredy exist in database
		if ($exist_link_test[0]) {
			$message = "Эта ссылка уже была сгенерирована: ";

			// show exist link
			echo ($exist_link_test[1]) ?
				copy_box($message, $exist_link_test[1]):
				copy_box($message, $exist_link_test[2]);
		}

		// if a not exist link -> will work
		else {
			// check fantasy on uniqueness
			if ($fantasy) {
				// check link on uniqueness in database in column -> fantasy and generate
				$exist_fantasy_link   = "SELECT fantasy ";
				$exist_fantasy_link  .= "FROM auto_links ";
				$exist_fantasy_link  .= "WHERE fantasy = '{$fantasy_full_link}' OR generate = '{$fantasy_full_link}'";

				$result_exist_fantasy = mysqli_query($mysqli, $exist_fantasy_link);

				// error fantasy link
				if (!$result_exist_fantasy) {
					die("Fatal fantasy exist link!");
				}

				$fantasy_exist = mysqli_fetch_row($result_exist_fantasy);

				//reset query
				mysqli_free_result($result_exist_fantasy);

				if ($fantasy_exist[0]) {
					echo span_error("Название такой ссылки занято, придумайте другое...");
				}
				// if free name fantasy
				else {

					$write_long_link  = "INSERT INTO auto_links (";
					$write_long_link .= "long_link, fantasy";
					$write_long_link .= ") VALUES (";
					$write_long_link .= "'{$long_link}', '{$fantasy_full_link}'";
					$write_long_link .= ")";

					// write long link
					$result_write_link = mysqli_query($mysqli , $write_long_link);

					// error write link
					if (!$result_write_link) {
						die("Fatal write link!");
					}

					// reset query
					mysqli_free_result($result_write_link);

					echo copy_box("Ваша новая ссылка: ",$fantasy_full_link);
				}
			}
			// otherwise will create generate-link
			else {
				// write long link in database

				$write_long_link  = "INSERT INTO auto_links (long_link) ";
				$write_long_link .= "VALUES ('{$long_link}')";

				// write long link
				$result_write_link = mysqli_query($mysqli , $write_long_link);

				// error write link
				if (!$result_write_link) {
					die("Fatal write link!");
				}


				// add generate link in database

				// ID last writen row
				$id_link = mysqli_insert_id($mysqli);

				$update_generate  = "UPDATE auto_links ";
				$update_generate .= "SET generate = concat('http://links.grayni.ru/', conv('{$id_link}', 10, 36)) ";
				$update_generate .= "WHERE id='{$id_link}'";

				$result_write_link = mysqli_query($mysqli, $update_generate);

				// error update generate
				if (!$result_write_link) {
					die("Fatal update generate!");
				}


				$generate_complete  = "SELECT generate FROM auto_links WHERE id='{$id_link}'";

				$result_write_link = mysqli_query($mysqli, $generate_complete);

				// error select generate
				if (!$result_write_link) {
					die("Fatal select generate!");
				}

				$and_link = mysqli_fetch_assoc($result_write_link)['generate'];

				// reset query write
				mysqli_free_result($result_write_link);

				copy_box("Ваша ссылка: ", $and_link);

			}
		}
	}
	mysqli_close($mysqli);
?>
