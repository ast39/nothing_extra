<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Admin
 * Date: 20.03.13
 * Time: 3:17
 * To change this template use File | Settings | File Templates.
 */

if (!isset($_GET['part'])) {
    $_GET['part'] = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>NothingExtra Manual</title>

    <style>
        .code-text {
            font-size: 13px;
        }
        .code_block {
            padding: 8px 16px;
            background-color: #fff;
            border: 0.5px solid #ddd;
            box-shadow: inset 47px 0 0 #fbfbfc, inset 48px 0 0 #ececf0;
            font-family: "Consolas","Bitstream Vera Sans Mono","Courier New",Courier,monospace!important;
            color: #333;
            font-size: 13px;
            display: block;
            line-height: 16px;
        }
        .code_block ol {
            margin: 0 0 0 -8px;
        }
        .code_block ol li {
            padding-left: 12px;
            color: #afafaf;
            line-height: 1.8em;
            list-style: decimal;
        }
        .code_block ol li .line_code {
            color: #212529 !important;
        }
        .code_block .comment {
            font-style: italic;
            color: #afafaf;
        }
        .code_block .keywords {
            font-weight: bold;
            color: #069;
        }
        .code_block .class {
            color: #008200;
        }
        .code_block .method {
            color: #ff1493;
        }
        .code_block .variable {
            color: #a70;
        }
        .code_block .data {
            color: blue;
        }
        .code_block li.tab1 {
            padding-left: 3em !important;
        }
        .code_block li.tab2 {
            padding-left: 6em !important;
        }
        .code_block li.tab3 {
            padding-left: 9em !important;
        }
        .code_block li.tab4 {
            padding-left: 12em !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="padding-right: 15px !important;">
            <div class="row">
                <div class="p-3 mb-3 mt-3 bg-primary text-white col-md-12 text-center"><strong>Краткое руководство по NothingExtra</strong></div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 list-group">
                <div class="text-center">
                    <div class="p-3 mb-2 bg-primary text-white">Меню</div>
                    <a href="index.php?part=1" class="list-group-item list-group-item-action <?= $_GET['part'] == 1 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">О движке</a>
                    <a href="index.php?part=2" class="list-group-item list-group-item-action <?= $_GET['part'] == 2 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Структура</a>
                    <a href="index.php?part=3" class="list-group-item list-group-item-action <?= $_GET['part'] == 3 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Настройка</a>
                    <a href="index.php?part=4" class="list-group-item list-group-item-action <?= $_GET['part'] == 4 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Константы</a>
                    <a href="index.php?part=5" class="list-group-item list-group-item-action <?= $_GET['part'] == 5 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Новая страница</a>
                    <a href="index.php?part=15" class="list-group-item list-group-item-action <?= $_GET['part'] == 15 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Компонент</a>
                    <a href="index.php?part=16" class="list-group-item list-group-item-action <?= $_GET['part'] == 16 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Роутинги</a>
                    <a href="index.php?part=6" class="list-group-item list-group-item-action <?= $_GET['part'] == 6 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с БД</a>
                    <a href="index.php?part=7" class="list-group-item list-group-item-action <?= $_GET['part'] == 7 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с почтой</a>
                    <a href="index.php?part=8" class="list-group-item list-group-item-action <?= $_GET['part'] == 8 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с логами</a>
                    <a href="index.php?part=9" class="list-group-item list-group-item-action <?= $_GET['part'] == 9 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с буффером</a>
                    <a href="index.php?part=17" class="list-group-item list-group-item-action <?= $_GET['part'] == 17 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с хранилищем</a>
                    <a href="index.php?part=10" class="list-group-item list-group-item-action <?= $_GET['part'] == 10 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с Soap Client</a>
                    <a href="index.php?part=11" class="list-group-item list-group-item-action <?= $_GET['part'] == 11 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Работа с бэнчмарком</a>
                    <a href="index.php?part=12" class="list-group-item list-group-item-action <?= $_GET['part'] == 12 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Системные классы</a>
                    <a href="index.php?part=14" class="list-group-item list-group-item-action <?= $_GET['part'] == 14 ? 'active' : false;?>" style="border-left: none !important; border-right: none !important">Глобальные функции</a>
                    <div class="card-footer text-muted">
                        <a href="../" class="list-group-item list-group-item-action">К проекту</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9 list-group">
                <?php include_once "main/part" . $_GET['part'] . ".php";?>
            </div>
        </div>
    </div>
</body>
</html>