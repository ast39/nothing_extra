<?php
/*
+----------------------------------------------------------------------------------------------------
| Объявляем кодировку проекта
| Подключаем конфигурационные файлы
+----------------------------------------------------------------------------------------------------
*/

include_once ROOT . 'framework' . DIRECTORY_SEPARATOR . 'autoloader.php';

use framework\classes\{Route, Url};

header('Content-type: text/html; charset=utf-8' . config('options.charset'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Site under construction</title>
    <meta charset="<?= config('options.charset') ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?= Url::site('favicon.ico') ?>" />
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-xl-6 col-lg-12 col-sm-12 col-md-12">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Страница не найдена</h5>
                </div>
                <img class="card-img-top" src="<?= Url::img('system/404.jpg') ?>" alt="Card image cap">
                <div class="card-body">
                    Приносим свои извинения, но запрашиваемая Вами страница не найдена, тому может быть несколько причин:
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> - Страница могла быть удалена</li>
                    <li class="list-group-item"> - Страница могла быть перемещена</li>
                    <li class="list-group-item"> - Вы могли ошибиться при вводе адреса</li>
                </ul>
                <div class="card-body">
                    <a href="<?= SITE ?>" class="btn btn-primary">Вернуться на главную</a>
                </div>
                <div class="card-footer text-muted">
                    Почта для экстренной связи: <code><?= config('options.public_mail') ?></code>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>