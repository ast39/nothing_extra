<?php use framework\classes\Buffer; ?>

<h4 class="mt-3 pl-3"><?= $this->langLine('images_head') ?></h4>
<hr />

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="folder"><?= $this->langLine('images_path') ?></label>
        <select id="folder" class="form-control" name="folder">
            <option value="img"><?= $this->langLine('images_d_general') ?></option>
            <option value="project"><?= $this->langLine('images_d_project') ?></option>
            <option value="ico"><?= $this->langLine('images_d_ico') ?></option>
            <option value="gallery"><?= $this->langLine('images_d_gallery') ?></option>
        </select>
    </div>
    <div class="form-group">
        <label for="save_name"><?= $this->langLine('images_filename') ?></label>
        <input type="text" class="form-control" id="save_name" name="save_name">
    </div>
    <div class="form-group">
        <label class="form-check-label" for="new_file"><?= $this->langLine('images_uploadfile') ?></label>
        <input type="file" class="form-control-file" id="new_file" name="new_file">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="upload"><?= $this->langLine('images_upload') ?></button>
    </div>
</form>

<?php if (Buffer::getInstance()->bad_log): ?>
    <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::getInstance()->bad_log ?></div>
<?php endif; ?>

<?php if (Buffer::getInstance()->good_log): ?>
    <div class="mt-3 p-2 bg-success text-white text-center rounded"><?= Buffer::getInstance()->good_log ?></div>
<?php endif; ?>