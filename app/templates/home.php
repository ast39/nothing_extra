<?php use framework\classes\Url; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= config('sys.charset') ?>">
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
                <img class="card-img-top" src="<?= Url::img('system/install.png') ?>" alt="Card image cap">
                <div class="card-header text-center border-top">
                    <h5>Добро пожаровать в NothingExtra</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td class="text-left">Версия фрэймворка</td>
                            <td class="text-right text-success"><?= VERSION ?></td>
                        </tr>
                        <tr>
                            <td class="text-left">Версия PHP</td>
                            <td class="text-right text-success"><?= PHP_VERSION ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Это дефолтная страница <code><?= config('sys.def_page') ?>/<?= config('sys.def_method') ?></code>, которую вы можете изменить в файле <code>\config\options</code></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Рекомендуем ознакомиться с <a href="<?= SITE_FOR_STATIC ?>manual/">руководством</a> к фрэймворку</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Так же Вы можете перейти в <a href="<?= SITE_FOR_STATIC . config('sys.admin_partition') ?>">админку</a> фрэймворка</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-muted text-center">
                   &copy;ASt39 2014-<?= date('Y', time()); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
</body>
</html>