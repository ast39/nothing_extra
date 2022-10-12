<?php use framework\classes\Buffer; ?>

<h4 class="mt-3 pl-3"><?= $this->langLine('redactor_add_dir') ?></h4>
<hr />

<div class="col-12 mt-3 mb-3">
    <form method="post">
        <div class="form-group">
            <label for="title"><?= $this->langLine('redactor_dir_name') ?></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="new">
        </div>
        <input type="hidden" name="url" value="<?= Buffer::instance()->url?>" />
        <button type="submit" id="add" name="add" class="btn btn-success"><?= $this->langLine('redactor_add') ?></button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='<?= SITE ?>explorer/back/0'"><?= $this->langLine('redactor_cancel') ?></button>
    </form>
    <?php if (Buffer::instance()->error): ?>
        <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::instance()->error ?></div>
    <?php endif; ?>
</div>