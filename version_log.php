<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>NothingExtra</title>
</head>
<body>
<div class="container">

    <div class="card mt-3">
        <div class="card-header bg-primary text-white text-center">
            <span>Лог изменений по версиям
                [ <span onclick="window.location.href='../'" style="cursor:pointer;" />Назад</span> ]
            </span>
        </div>
        <div class="card-body">
            <h5 class="text-success">SC Версия 0.8.1</h5>
            <ul class="mt-3">
                <li>Полностю изменен роутинга</li>
                <li>Добавлен модуль для работы с хранилищем <code>modules\storage</code></li>
                <li>Добавлен модуль для работы с телеграм ботом <code>modules\telegram</code></li>
                <li>Добавлен модуль для создания DI контейнеров <code>php-di/php-di</code></li>
                <li>Добавлен модуль для логирования <code>monolog/monolog</code></li>
                <li>Изменена работа с логированием системных ошибок и визитов</li>
                <li>Общие правки по движку и улучшение</li>
            </ul>
        </div>
        <div class="card-footer text-muted text-center">
            <p class="card-text"><small class="text-muted">&copy;ASt39 2014-<?= date('Y', time()) ?></small></p>
        </div>
    </div>

</div>