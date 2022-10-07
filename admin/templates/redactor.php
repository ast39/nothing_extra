<?php use framework\classes\{Session, Buffer, Url}; ?>
<br />
<?php if (!in_array(PAGE_METHOD, ['newDir', 'newFile', 'editFile', 'uploadFile', 'showFile'])): ?>
    <h4 class="mt-3 pl-3"><?= $this->langLine('redactor_head') ?></h4>
    <hr />
<?php endif; ?>

<?php if (Buffer::getInstance()->bad_log): ?>
    <div class="row"><div class="mt-3 mb-3 p-2 bg-danger text-white text-center rounded col-12"><?= Buffer::getInstance()->bad_log ?></div></div>
<?php endif; ?>

<?php if (Buffer::getInstance()->good_log): ?>
    <div class="row"><div class="mt-3 mb-3 p-2 bg-success text-white text-center rounded col-12"><?= Buffer::getInstance()->good_log ?></div></div>
<?php endif; ?>

<?php if (in_array(PAGE_METHOD, ['newDir', 'newFile', 'editFile', 'uploadFile', 'showFile'])): ?>
    <?php $this->loadComponent(PAGE_METHOD); ?>
<?php else: ?>

    <div class="d-none d-lg-block">
        <table class="table table-striped col-12">
            <thead>
            <tr class="row">
                <th scope="col" colspan="3" class="bg-primary text-white col-sm-12">Текущий каталог: <?= Buffer::getInstance()->url_legend ?></th>
            </tr>
            </thead>
            <tbody>

            <tr class="row">
                <td class="text-center col-sm-1">
                    <?php if (Session::get('conductor_url') != ':'): ?>
                        <img class="img-responsive img-rounded" alt="На уровень выше" width="28" style="cursor:pointer;" src="<?= Url::img('system/i_return.png') ?>"
                             onclick="window.location.href='<?= SITE ?>explorer/back/1'" />
                    <?php endif; ?>
                </td>
                <td colspan="2" class="col-sm-11 text-right">
                    <img class="img-responsive img-rounded ml-3" alt="Создать каталог" title="Создать каталог" width="28" style="cursor:pointer;" src="<?= Url::img('system/folder_add.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/new/dir/<?= Session::get('conductor_url')?>'" />
                    <img class="img-responsive img-rounded ml-3" alt="Создать файл" title="Создать файл" width="28" style="cursor:pointer;" src="<?= Url::img('system/file_add.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/new/file/<?= Session::get('conductor_url')?>'" />
                    <img class="img-responsive img-rounded ml-3" alt="Загрузить изображение" title="Загрузить изображение" width="28" style="cursor:pointer;" src="<?= Url::img('system/image_add.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/upload/<?= Session::get('conductor_url')?>'" />
                    <img class="img-responsive img-rounded ml-3" alt="Загрузить файл" title="Загрузить файл" width="28" style="cursor:pointer;" src="<?= Url::img('system/file_upload.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/upload/<?= Session::get('conductor_url')?>'" />
                </td>
            </tr>

            <tr class="row"><td colspan="3" class="col-sm-12"></td></tr>

            <?php if (empty(Buffer::getInstance()->list['dirs']) && empty(Buffer::getInstance()->list['files'])): ?>
                <tr class="row">
                    <td colspan="3" class="col-12 text-center bg-secondary text-white">Каталог пуст</td>
                </tr>
            <?php endif; ?>

            <?php if (!empty(Buffer::getInstance()->list['dirs'])):?>
                <?php foreach (Buffer::getInstance()->list['dirs'] as $k => $v):?>
                    <tr class="row">
                        <td class="text-center col-sm-1"><img class="img-responsive img-rounded" alt="folder" width="32" src="<?= Url::img('system/folder.png') ?>" /></td>
                        <td class="text-left col-sm-9"><a href="<?= SITE ?>explorer/scan/<?= Session::get('conductor_url') . $v . ':'?>"><?= $v ?>/</a></td>
                        <td class="text-right col-sm-2">
                            <img class="img-thumbnail" style="cursor: pointer" alt="open" src="<?= Url::img('system/i_goto.png') ?>" width="32"
                                 onclick="window.location.href='<?= SITE ?>explorer/scan/<?= Session::get('conductor_url') . $v . ':'?>'" />
                            <img class="img-thumbnail" style="cursor: pointer" alt="delete" src="<?= Url::img('system/i_delete.png') ?>" width="32"
                                 onclick="if(confirm('Вы хотите удалить директорию безвовратно?')) {window.location.href='<?= SITE ?>explorer/delete/<?= Session::get('conductor_url') . $v?>'}" />
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty(Buffer::getInstance()->list['files'])):?>
                <?php foreach (Buffer::getInstance()->list['files'] as $k => $v):?>
                    <tr class="row">
                        <td class="text-center col-sm-1"><img class="img-responsive img-rounded" alt="file" width="32" src="<?= Url::img('system/'. ($v['type'] == 'img' ? 'image' : 'file') . '.png') ?>" /></td>
                        <td class="text-left col-sm-9"><?= $v['name'] ?></td>
                        <td class="text-right col-sm-2">
                            <img class="img-thumbnail" style="cursor: pointer" alt="open" src="<?= Url::img('system/i_goto.png') ?>" width="32"
                                 onclick="window.location.href='<?= SITE ?>explorer/show/<?= Session::get('conductor_url') . $v['name'] . ':'?>'" />
                            <?php if ($v['type'] != 'img'): ?>
                                <img class="img-thumbnail" style="cursor: pointer" alt="edit" src="<?= Url::img('system/i_edit.png') ?>" width="32" onclick="window.location.href='<?= SITE ?>explorer/edit/<?= Session::get('conductor_url') . $v['name'] ?>'" />
                            <?php endif; ?>
                            <img class="img-thumbnail" style="cursor: pointer" alt="delete" src="<?= Url::img('system/i_delete.png') ?>" width="32"
                                 onclick="if(confirm('Вы хотите удалить файл безвовратно?')) {window.location.href='<?= SITE ?>explorer/delete/<?= Session::get('conductor_url') . $v['name'] ?>'}" />
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            </tbody>
        </table>
    </div>

    <div class="d-lg-none">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" colspan="3" class="bg-primary text-white">
                    <div class="row pl-2 pr-2">
                        Текущий каталог: <?= Buffer::getInstance()->url_legend ?>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="3" class="text-right">
                    <?php if (Session::get('conductor_url') != ':'): ?>
                        <img class="img-responsive img-rounded" alt="На уровень выше" width="28" style="cursor:pointer; float: left;" src="<?= Url::img('system/i_return.png') ?>"
                             onclick="window.location.href='<?= SITE ?>explorer/back/1'" />
                    <?php endif; ?>
                    <img class="img-responsive img-rounded ml-3" alt="Создать каталог" width="28" style="cursor:pointer;" src="<?= Url::img('system/folder_add.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/new/dir/<?= Session::get('conductor_url')?>'" />
                    <img class="img-responsive img-rounded ml-3" alt="Создать файл" width="28" style="cursor:pointer;" src="<?= Url::img('system/file_add.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/new/file/<?= Session::get('conductor_url')?>'" />
                    <img class="img-responsive img-rounded ml-3" alt="Загрузить изображение" width="28" style="cursor:pointer;" src="<?= Url::img('system/image_add.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/upload/<?= Session::get('conductor_url')?>'" />
                    <img class="img-responsive img-rounded ml-3" alt="Загрузить файл" width="28" style="cursor:pointer;" src="<?= Url::img('system/file_upload.png') ?>"
                         onclick="window.location.href='<?= SITE ?>explorer/upload/<?= Session::get('conductor_url')?>'" />
                </td>
            </tr>

            <tr><td colspan="3"></td></tr>

            <?php if (!empty(Buffer::getInstance()->list['dirs'])):?>
                <?php foreach (Buffer::getInstance()->list['dirs'] as $k => $v):?>
                    <tr>
                        <td class="text-left" colspan="2">
                            <img class="img-responsive img-rounded" alt="folder" width="32" src="<?= Url::img('system/folder.png') ?>" />
                            <a href="<?= SITE ?>explorer/scan/<?= Session::get('conductor_url') . $v . ':'?>"><?= $v ?>/</a>
                        </td>
                        <td class="text-right">
                            <img class="img-thumbnail" style="cursor: pointer" alt="open" src="<?= Url::img('system/i_goto.png') ?>" width="32"
                                 onclick="window.location.href='<?= SITE ?>explorer/scan/<?= Session::get('conductor_url') . $v . ':'?>'" />
                            <img class="img-thumbnail" style="cursor: pointer" alt="delete" src="<?= Url::img('system/i_delete.png') ?>" width="32"
                                 onclick="if(confirm('Вы хотите удалить директорию безвовратно?')) {window.location.href='<?= SITE ?>explorer/delete/<?= Session::get('conductor_url') . $v?>'}" />
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty(Buffer::getInstance()->list['files'])):?>
                <?php foreach (Buffer::getInstance()->list['files'] as $k => $v):?>
                    <tr>
                        <td class="text-left" colspan="2">
                            <img class="img-responsive img-rounded" alt="file" width="32" src="<?= Url::img('system/' . ($v['type'] == 'img' ? 'image' : 'file') . '.png') ?>" />
                            <?= $v['name'] ?>
                        </td>
                        <td class="text-right">
                            <img class="img-thumbnail" style="cursor: pointer" alt="open" src="<?= Url::img('system/i_goto.png') ?>" width="32"
                                 onclick="window.location.href='<?= SITE ?>explorer/show/<?= Session::get('conductor_url') . $v['name'] . ':'?>'" />
                            <?php if ($v['type'] != 'img'): ?>
                                <img class="img-thumbnail" style="cursor: pointer" alt="edit" src="<?= Url::img('system/i_edit.png') ?>" width="32" onclick="window.location.href='<?= SITE ?>explorer/edit/<?= Session::get('conductor_url') . $v['name'] ?>'" />
                            <?php endif; ?>
                            <img class="img-thumbnail" style="cursor: pointer" alt="delete" src="<?= Url::img('system/i_delete.png') ?>" width="32"
                                 onclick="if(confirm('Вы хотите удалить файл безвовратно?')) {window.location.href='<?= SITE ?>explorer/delete/<?= Session::get('conductor_url') . $v['name'] ?>'}" />
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>