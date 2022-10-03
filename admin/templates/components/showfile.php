<h4 class="mt-3 pl-3">Просмотр файла</h4>
<hr />

<div class="row">
    <div class="col-12 mt-3">
        <img class="img-responsive img-rounded" width="24" src="<?= \framework\classes\Route::siteRootForStatic() ?>i/img/system/i_return.png" /> <a href="<?= SITE ?>redactor/back">.. / На уровень выше /</a>
    </div>
    <div class="col-12 mt-3">
        <?php if ($this->buffer->is_image === true): ?>
            <img width="100%" class="img-thumbnail" alt="image" style="cursor: pointer" src="<?= $this->buffer->file ?>" />
        <?php else: ?>
            <div class="form-group">
                <textarea id="code" name="code" readonly class="form-control" rows="16"><?= implode('', file($this->buffer->file)) ?></textarea>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-12 mt-3 mb-3 text-center">
        <button type="button" class="btn btn-danger" onclick="window.location.href='<?= SITE ?>redactor/back'">Закрыть</button>
    </div>

    <?php if ($this->buffer->error): ?>
        <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= $this->buffer->error ?></div>
    <?php endif; ?>
</div>