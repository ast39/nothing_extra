<?php use framework\classes\{Url, Buffer}; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= config('options.charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?= Url::css('style') ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?= Url::js('script') ?>"></script>

    <title><?= Buffer::getInstance()->extra_title ?? $this->pageTitle() ?></title>
    <meta name="description" content="<?= Buffer::getInstance()->extra_description ?? $this->pageDescription() ?>">
</head>
<body>
    <div class="container">
        <?php $this->loadTemplate(PAGE); ?>
    </div>
</body>
</html>