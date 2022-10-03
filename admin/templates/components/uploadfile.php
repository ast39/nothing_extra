<h4 class="mt-3 pl-3">Загрузка файлов</h4>
<hr />

<div class="col-12 mt-3 mb-3">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="folder">Каталог для сохранения</label>
            <input type="text" class="form-control" id="folder" name="folder" readonly value="<?= $this->buffer->url_legend ?>">
        </div>
        <div class="form-group">
            <label for="save_name">Имя файла на сервере</label>
            <input type="text" class="form-control" id="save_name" name="save_name">
        </div>
        <div class="form-group">
            <label class="form-check-label" for="new_file">Файл для загрузки</label>
            <input type="file" class="form-control-file" id="new_file" name="new_file">
        </div>
        <div class="form-group">
            <input type="hidden" name="url" value="<?= $this->buffer->url?>" />
            <button type="submit" class="btn btn-primary" name="upload">Загрузить</button>
            <button type="button" class="btn btn-danger" name="cancel" onclick="window.location.href='<?= SITE ?>home/back'">Отмена</button>
        </div>
    </form>
</div>