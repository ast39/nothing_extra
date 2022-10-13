<?php
    use framework\classes\{Url};
    header('Content-type: text/html; charset=' . config('sys.charset'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Site under construction</title>
    <meta charset="<?= config('sys.charset') ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?= Url::siteRootForStatic() ?>favicon.ico" />
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-xl-6 col-lg-12 col-sm-12 col-md-12">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Сайт временно недоступен</h5>
                </div>
                <img class="card-img-top" src="<?= Url::Img('system/site_stop.jpg') ?>" alt="Card image cap">
                <div class="card-body">
                    Приносим свои извинения, но в данный момент на сайте ведутся технические работы.
                    Попробуйте зайти к нам через 15 минут или свяжитесь с администрацией сайта.
                </div>
                <div class="card-footer text-muted">
                    Почта для экстренной связи: <code><?= config('sys.public_mail') ?></code>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>