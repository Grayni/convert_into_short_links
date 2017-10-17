<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Сервис создания коротких ссылок</title>
		<link rel="stylesheet" type="text/css" href="css/style.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col card bg-light mb-3">
					<div class="card-header">Используйте оба поля вместе, если хотите создать оригинальную ссылку</div>
					<div class="card-body">

						<form>

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
									<input type="button" class="btn btn-success" name="enter"  value='Генерировать' />
								</div>

								<div class="col"></div>
							</div>

						</form>


						</br>


						<div class="row " id="block">

							<div class="col-auto" id="responce">
							</div>

							<div class="col">
								<button id='copy-click' type='button' class='btn btn-info icon-docs' data-clipboard-target="#new-link" data-toggle="tooltip" data-placement='top' data-html="true" title='<b style="font-size:16px">Скопировать в буфер</b>'></button>
							</div>
						</div>

					</div>
					<img src="img/ajax-loader.gif" height="11" width="43" class="ajax-loader">
				</div>
			</div>
		</div>
		<script src="js/main.min.js"></script>
	</body>
</html>