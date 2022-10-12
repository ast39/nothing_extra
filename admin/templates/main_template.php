<?php use framework\classes\{Url, Buffer}; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= config('options.charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?= str_replace(config('options.admin_partition'), 'admin/', SITE);?>favicon.ico" />

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?= Url::js('script') ?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?= Url::js('jquery.gritter') ?>" type="text/javascript" charset="utf-8"></script>
    <link type="text/css" href="<?= Url::css('jquery.gritter') ?>" rel="stylesheet" />

    <title><?= Buffer::instance()->extra_title ?? $this->pageTitle() ?></title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?= SITE ?>">
            <img src="<?= Url::img('system/i_settings.png') ?>" width="36" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent2">
            <ul class="navbar-nav mr-auto">
                <?php if ($this->isRootAuth() || $this->isAdminAuth()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= PAGE == 'license' ? 'active' : '' ?>" href="<?= SITE ?>license"><?= $this->langLine('menu_lic') ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array(PAGE, ['errorlog', 'visitlog']) ? 'active' : '' ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->langLine('menu_logs') ?></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= SITE ?>log/error"><?= $this->langLine('menu_logs_errors') ?></a>
                            <a class="dropdown-item" href="<?= SITE ?>log/visit"><?= $this->langLine('menu_logs_visits') ?></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= PAGE == 'management' ? 'active' : '' ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->langLine('menu_manage') ?></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= SITE ?>management/robots"><?= $this->langLine('menu_manage_robots') ?></a>
                            <a class="dropdown-item" href="<?= SITE ?>management/sitemap"><?= $this->langLine('menu_manage_sitemap') ?></a>
                            <?php if ($this->isRootAuth()): ?>
                                <a class="dropdown-item" href="<?= SITE ?>management/htaccess"><?= $this->langLine('menu_manage_htaccess') ?></a>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php if ($this->isRootAuth()): ?>
                        <li class="nav-item <?= PAGE == 'redactor' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= SITE ?>explorer/scan/:"><?= $this->langLine('menu_redactor') ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item <?= PAGE == 'images' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= SITE ?>upload/image"><?= $this->langLine('menu_image') ?></a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="<?= str_ireplace('/'. config('options.admin_partition'), '', SITE) ?>"><?= $this->langLine('menu_project') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= str_ireplace('/'. config('options.admin_partition'), '', SITE_FOR_STATIC) . 'manual' ?>"><?= $this->langLine('menu_manual') ?></a>
                </li>
                <?php if ($this->isRootAuth() || $this->isAdminAuth()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE ?>logout"><?= $this->langLine('menu_logout') ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if (PAGE == 'redactor' && in_array(PAGE_METHOD, ['newdir', 'newfile', 'editfile'])): ?>
            <?php $this->loadTemplate('components/' . PAGE_METHOD, false); ?>
        <?php else: ?>
            <?php $this->loadTemplate(PAGE, false); ?>
        <?php endif; ?>
    </div>

</body>
</html>