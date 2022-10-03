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
            <h5>Лог изменений по версиям
                <img src="/i/img/system/i_return.png" width="20px" onclick="window.location.href='../'" style="cursor:pointer;" /></h5>
        </div>
        <div class="card-body">
            <h5 class="text-success">SC Версия 3.4.1</h5>
            <ul class="mt-3">
                <li>Добавлен модуль для работы с хранилищем <code>modules\storage</code></li>
                <li>Добавлен модуль для работы с телеграм ботом <code>modules\telegram</code></li>
                <li>Изменена работа с логированием системных ошибок и визитов</li>
                <li>Убрана константа <code>ERRORS</code> - теперь добавлена константа <code>PROD</code> отвечающая за продакшн версию проекта</li>
                <li>Убран параметр <code>Settings::$errors</code> - теперь добавлен парамтер <code>Settings::$production</code> формирующий константу <code>PROD</code></li>
                <li>Общие правки по движку и улучшение</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.3.2</h5>
            <ul class="mt-3">
                <li>Исправлены некоторые ошибки и увеличина стабильность библиотеки <code>helper\DataManager</code></li>
                <li>Добавлены 2 метода в библиотеке <code>core\SystemMessages</code></li>
                <li>Доработана библиотека <code>core\SystemMessages</code> - теперь она не теряет базу уведомлений при редиректе</li>
                <li>Добавлена константа <code>PROJECT_URL</code>, отвечающая за корень проекта</li>
                <li>Общие правки по движку и улучшение</li>
                <li>Обновлено руководство</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.3.1</h5>
            <ul class="mt-3">
                <li>Добавлена новая библиотека для обработки правил роутинга <code>core\RouteRule</code></li>
                <li>Сильно доработана система роутинга, которая работает в штатном режиме, но ее можно переопределять в <code>cfg\routing</code></li>
                <li>Добавлена возможность передачи <code>{prefix}</code> и <code>{data}</code> в <code>action</code> правила роутинга</li>
                <li>Исправлены мелкие ошибки</li>
                <li>Обновлено руководство</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.2.5</h5>
            <ul class="mt-3">
                <li>Добавлена переменная конфига <code>max_upload_size</code>, отвечающая за максимальный обьем загружаемых данных</li>
                <li>Добавлена новая бибилотека для работы файлового менеджера <code>\core\Cloud</code></li>
                <li>Переработана система файлового менеджера в админке</li>
                <li>Добавлена библиотека системных иконок</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.2.4</h5>
            <ul class="mt-3">
                <li>Добавлена защита от CSRF атак. Если вы хотите защитить форму, то вызовите внутри нее <code>$this->csrfHtml()</code>, а в коде обработчике вызовите <code>$this->csrfCheck()</code></li>
                <li>В ядре <code>core\controller</code> добавлены 4 метода для CSRF-защиты</li>
                <li>Обновлено руководство</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.2.3</h5>
            <ul class="mt-3">
                <li>Устранены ошибки с правами при создании файлов и каталогов</li>
                <li>Переменная конфига <code>database_off</code> depracated</li>
                <li>Добавлена система <code>AUTH</code> для контроля доступа к страницам, требующих авторизации</li>
                <li>Введена новая переменная конфига <code>login_page</code> в рамках системы <code>AUTH</code></li>
                <li>Обновлен вид главной страницы</li>
                <li>Обновлено руководство</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.2.2</h5>
            <ul class="mt-3">
                <li>Добавлена системная библиотека <code>SystemMessages</code> включенная в автолоадэр</li>
                <li>Добавлено изменение в интерпретатор <code>main_template</code> для вывода имеющихся системных сообщений</li>
                <li>Добавлены новые системные иконки</li>
                <li>Обновлено руководство</li>
            </ul>
        </div>
        <div class="card-body border-top">
            <h5 class="text-success">SC Версия 3.2.1</h5>
            <ul class="mt-3">
                <li>Кардинально переработана система роутинга. Теперь поверх стандартной работы роутинга можно задавать правила, переопределящие целевое расположение контроллеров</li>
                <li>Добавлен новый конфиг <code>cfg\routing</code> для написаний правил роутинга</li>
                <li>Добавлено понятие префикса для правил роутинга</li>
                <li>Обновлено руководство</li>
            </ul>
        </div>
        <div class="card-footer text-muted text-center">
            <p class="card-text"><small class="text-muted">&copy;ASt39 2014-<?= date('Y', time()) ?></small></p>
        </div>
    </div>

</div>