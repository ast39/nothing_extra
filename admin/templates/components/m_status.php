<h4 class="mt-3 pl-3"><?= $this->langLine('manage_status_head') ?></h4>
<hr />

<form role="form" method="post">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="site_status" id="open" value="1" <?= $this->buffer->site_status == 1 ? 'checked' : false;?>>
        <label class="form-check-label" for="open">
            <?= $this->langLine('manage_for_all') ?>
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="site_status" id="close" value="0" <?= $this->buffer->site_status == 0 ? 'checked' : false;?>>
        <label class="form-check-label" for="close">
            <?= $this->langLine('manage_for_admin') ?>
        </label>
    </div>
    <button type="submit" id="sitestatus" class="btn btn-success mt-3" name="change_status"><?= $this->langLine('manage_save') ?></button>
</form>

<?php if ($this->buffer->good_log): ?>
    <div class="mt-3 p-2 bg-success text-white text-center rounded"><?= $this->buffer->good_log ?></div>
<?php endif; ?>