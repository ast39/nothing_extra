<?php use framework\classes\{Url, Buffer}; ?>

<h4 class="mt-3 pl-3">Просмотр файла</h4>
<hr />

<div class="row">
    <div class="col-12 mt-3">
        <img class="img-responsive img-rounded" width="24" src="<?= Url::img('system/i_return.png') ?>" /> <a href="<?= SITE ?>explorer/back/0">.. / На уровень выше /</a>
    </div>

    <div class="col-12 mt-3">
        <?php if (Buffer::instance()->file_type === 'img'): ?>
            <img width="100%" class="img-thumbnail" alt="image" style="cursor: pointer" src="<?= Buffer::instance()->file_url ?>" />
        <?php elseif (Buffer::instance()->file_type === 'pdf'): ?>
            <embed src="<?= Buffer::instance()->file_url ?>" type="application/pdf" width="100%" height="800">
        <?php else: ?>
            <div class="form-group">
                <textarea id="code" name="code" readonly class="form-control" rows="16">
                    <?= implode('', file(Buffer::instance()->file)) ?>
                </textarea>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-12 mt-3 mb-3 text-center">
        <button type="button" class="btn btn-danger" onclick="window.location.href='<?= SITE ?>explorer/back/0'">Закрыть</button>
    </div>

    <?php if (Buffer::instance()->error): ?>
        <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::instance()->error ?></div>
    <?php endif; ?>
</div>