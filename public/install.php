<?php

defined('VERSION') or exit('Install tests must be loaded from within index.php!');

$failed = FALSE;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= VERSION ?></title>
</head>
<body>

<div class="container">
    <div class="row mt-3">
        <div class="offset-xl-1 col-xl-10 col-lg-12 col-sm-12 col-md-12">
            <div class="card bg-light mb-3">
                <div class="card-header text-center border-top">
                    <h5>Nothing Extra | Ничего лишнего</h5>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="text-left">Версия фрэймворка</td>
                        <td class="text-right text-success">Актуальная версия: <code><?= VERSION ?></code></td>
                    </tr>
                    <tr>
                        <td class="text-left">Список изменений</td>
                        <td class="text-right text-success"><code><a href="/version_log.php">Посмотреть</a></code></td>
                    </tr>
                    </tbody>
                </table>
                <div class="card-header text-center border-top">
                    <h5>Основной тест</h5>
                </div>
                <div class="card-body">
                    Убедитесь, что Ваша система сконфигурирована правильно и удовлетворяет всем требованиям <code>NothingExtra Framework</code>.
                    После чего можете удалить файл <code>install.php</code> из папки public проекта или переименовать его.
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="text-left">Версия PHP</td>
                        <?php if (version_compare(PHP_VERSION, '7.1.12', '>=')): ?>
                            <td class="text-right text-success"><?= PHP_VERSION ?></td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-danger">Для <code>NothingExtra Framevork</code> требуется версия <code>PHP 7.1.12</code> или выше, текущая версия <code><?= PHP_VERSION ?></code>.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">PCRE UTF-8</td>
                        <?php if ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>
                            <td class="text-right text-danger"><a href="http://php.net/pcre">PCRE</a> не поддерживает UTF-8.</td>
                        <?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
                            <td class="text-right text-danger"><a href="http://php.net/pcre">PCRE</a> не поддерживает Unicode.</td>
                        <?php else: ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">SPL поддержка</td>
                        <?php if (function_exists('spl_autoload_register')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-danger">PHP <a href="http://www.php.net/spl">SPL</a> либо не загружается или не компилируется.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Расширение Iconv</td>
                        <?php if (extension_loaded('iconv')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-danger">Расширение <a href="http://php.net/iconv">iconv</a> не загружено.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">CTYPE расширение</td>
                        <?php if ( ! function_exists('ctype_digit')): $failed = TRUE ?>
                            <td class="text-right text-danger">Расширение <a href="http://php.net/ctype">ctype</a> не включено.</td>
                        <?php else: ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Видимость URL</td>
                        <?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-danger">Ни один <code>$_SERVER['REQUEST_URI']</code>, <code>$_SERVER['PHP_SELF']</code>, or <code>$_SERVER['PATH_INFO']</code> не доступен.</td>
                        <?php endif ?>
                    </tr>
                    </tbody>
                </table>

                <div class="card-header text-center border-top">
                    <h5>Тест на целостность окружения</h5>
                </div>

                <table class="table">
                    <tbody>
                    <tr>
                        <td class="text-left">Autoloader</td>
                        <?php if (file_exists(__DIR__ . '/vendor/autoload.php')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-warning">Система не обнаружила <code>vendor/autoload</code>.</td>
                        <?php endif ?>
                    </tr>
                    </tbody>
                </table>

                <div class="card-header text-center border-top">
                    <h5>Опциональный тест</h5>
                </div>
                <div class="card-body">
                    Следующие расширения не требуются для основной работы <code>NothingExtra Framevork</code>, но они могут обеспечить
                    доступ к дополнительным возможностям.
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="text-left">Поддержка SQLite 3</td>
                        <?php if (extension_loaded('sqlite3')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: ?>
                            <td class="text-right text-warning">Рекомендуем установить <a href="http://php.net/mysql">SQLite 3</a> для расширения возможностей.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Поддержка MySQL</td>
                        <?php if (function_exists('mysqli_connect')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-warning">NothingExtra может использовать <a href="http://php.net/mysql">MySQL</a> для поддержки баз данных MySQL.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Поддержка PDO</td>
                        <?php if (class_exists('PDO')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-warning">NothingExtra может использовать <a href="http://php.net/pdo">PDO</a> для расширенной работы с базами данных.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Поддержка cURL</td>
                        <?php if (extension_loaded('curl')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-warning">NothingExtra может использовать <a href="http://php.net/curl">cURL</a> расширение для класса Request_Client_External.</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Поддержка Soap Client</td>
                        <?php if (extension_loaded('soap')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-warning">У вас отключено <code>Soap</code> расширение</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td class="text-left">Поддержка GD</td>
                        <?php if (function_exists('gd_info')): ?>
                            <td class="text-right text-success">Отлично</td>
                        <?php else: $failed = TRUE ?>
                            <td class="text-right text-warning">NothingExtra требует <a href="http://php.net/gd">GD</a> для работы с изображениями.</td>
                        <?php endif ?>
                    </tr>
                    </tbody>
                </table>

                <ul class="list-group list-group-flush">
                    <?php if ($failed === TRUE): ?>
                        <li class="list-group-item text-danger">✘ NothingExtra не может корректно работать в вашей системе.</li>
                    <?php else: ?>
                        <li class="list-group-item text-success">✔ Ваша система прошла все требования.</li>
                        <li class="list-group-item">Удалите или переименуйте <code>install.php</code> в корне.</span></li>
                    <?php endif; ?>
                </ul>
                <div class="card-footer text-muted text-center">
                    Рекомендуем ознакомиться с <a href="/>manual/">руководством</a> к фрэймворку
                </div>
                <div class="card-footer text-muted text-center">
                    Скачать <a href="/ne.0.8.1.rar" download>архив</a> последней версии NothingExtra
                </div>
            </div>
        </div>
    </div>
</div>
<br />
</body>
</html>