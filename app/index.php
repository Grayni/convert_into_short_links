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

                        <?php
                            require_once '../../connect.php';

                            // Определим собственный класс исключений для ошибок MySQL
                            class MySQL_Exception extends Exception {
                                public function __construct($message) {
                                    parent::__construct($message);
                                }
                            }

                            try {
                                // Запрос к базе данных
                                $result = mysqli_query($link, "SHOW TABLES");
                                
                                // В случае неудачного запроса генерируем исключение
                                if (!$result) throw new MySQL_Exception(mysqli_error($link));
                                $row = mysqli_fetch_row($result);
                        ?>

                        <form action="" method="POST">
                            <input type="text" name="link" class="form-control form-control-lg" placeholder="Вставьте вашу ссылку">
                            <br>
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <div class="input-group-addon">http://grayni.ru/</div>
                                    <input type="text" name="link" class="form-control form-control-lg" id="inlineFormInputGroup" placeholder="ваше_предпочтение">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col"></div>
                                <div class="col-auto">
                                    <input type="button" class="btn btn-success" value='Генерировать'></input>
                                </div>
                                <div class="col"></div>
                            </div>
                        </form></br>

                        <div class="row copy">
                            <div class="col-auto">
                                <span>Ваша ссылка:
                                    <a href='#' class='sh-link' id='sh-link'><?php echo "{$row[0]}"?></a>
                                </span>
                            </div>

                            <div class="col">
                                <button id='copy-click' type='button' class='btn btn-info icon-docs' data-clipboard-target="#sh-link" data-toggle="tooltip" data-placement='top' data-html="true" title='<b style="font-size:16px">Скопировать в буфер</b>'></button>
                            </div>
                        </div>

                        <?php
                            }
                            catch (Exception $ex) {
                                echo 'Ошибка при работе с MySQL: <b style="color:red;">'.$ex->getMessage().'</b>';
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>