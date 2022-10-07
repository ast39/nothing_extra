<?php use framework\classes\Buffer; ?>

<h4 class="mt-3 pl-3"><?= $this->langLine('redactor_edit_file') ?></h4>
<hr />

<div class="col-12 mt-3 mb-3">
    <form method="post">
        <div class="form-group">
            <label for="title"><?= $this->langLine('redactor_file_name') ?></label>
            <input type="text" class="form-control" value="<?= Buffer::getInstance()->name ?>" id="title" name="title" placeholder="new">
        </div>
        <div class="form-group">
            <label for="code"><?= $this->langLine('redactor_edit_form') ?></label>
            <textarea id="code" name="code" class="form-control" rows="16"><?= Buffer::getInstance()->code ?></textarea>
        </div>
        <input type="hidden" name="url" value="<?= Buffer::getInstance()->url ?>:" />
        <button type="submit" id="edit" name="edit" class="btn btn-success"><?= $this->langLine('redactor_save') ?></button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='<?= SITE ?>explorer/back/0'"><?= $this->langLine('redactor_cancel') ?></button>
    </form>

    <?php if (Buffer::getInstance()->error): ?>
        <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::getInstance()->error ?></div>
    <?php endif; ?>
</div>