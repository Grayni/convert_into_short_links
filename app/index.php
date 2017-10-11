
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Сервис создания коротких ссылок</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col card bg-light mb-3">
					<div class="card-header">Используйте оба поля вместе, если хотите создать оригинальную ссылку</div>
					<div class="card-body">

						<form action="/" method="POST" id="formLinks">

							<input id="long-link" type="text" name="long-link" class="form-control form-control-lg" placeholder="Вставьте вашу ссылку" name="long" />

							<br>

							<div class="input-group">

								<div class="input-group-addon">http://links.grayni.ru/</div>
									<input id="link-default" type="text" name="fantasy-link" class="form-control form-control-lg" placeholder="ваше_предпочтение"/>
							</div>

							<br>

							<div class="row">
								<div class="col"></div>
								<div class="col-auto">
									<input type="submit" class="btn btn-success" name="enter" value='Генерировать' />
								</div>

								<div class="col"></div>
							</div>

						</form>

						</br>

						<div class="row copy">
							<div class="col-auto">
								<span>Ваша ссылка:
									<a href='#' class='sh-link' id='sh-link'>Тестовая ссылка</a>
								</span>
							</div>

							<div class="col">
								<button id='copy-click' type='button' class='btn btn-info icon-docs' data-clipboard-target="#sh-link" data-toggle="tooltip" data-placement='top' data-html="true" title='<b style="font-size:16px">Скопировать в буфер</b>'></button>
							</div>
						</div>

					</div>
					<div id="result_form" style="background:#ffffff;padding: 10px;">
						<?php include_once 'script.php'; ?>
					<div> 
				</div>

				<br>

			</div>
		</div>
		<script src="js/main.js"></script>
	</body>
</html>