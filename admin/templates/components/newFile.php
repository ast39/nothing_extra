<?php use framework\classes\Buffer; ?>

<h4 class="mt-3 pl-3"><?= $this->langLine('redactor_add_file') ?></h4>
<hr />

<div class="col-12 mt-3 mb-3">
    <form method="post">
        <div class="form-group">
            <label for="title"><?= $this->langLine('redactor_file_name') ?></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="new">
        </div>
        <div class="form-group">
            <label for="code"><?= $this->langLine('redactor_edit_form') ?></label>
            <textarea id="code" name="code" class="form-control" rows="16"></textarea>
        </div>
        <input type="hidden" name="url" value="<?= Buffer::getInstance()->url?>" />
        <button type="submit" id="add" name="add" class="btn btn-success"><?= $this->langLine('redactor_add') ?></button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='<?= SITE ?>explorer/back/0'"><?= $this->langLine('redactor_cancel') ?></button>
    </form>
    <?php if (Buffer::getInstance()->error): ?>
        <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::getInstance()->error ?></div>
    <?php endif; ?>
</div>