<?php use system\core\SystemMessage; ?>

<h4 class="mt-3 pl-3">Редактировать новость</h4>
<hr />

<?php SystemMessage::showMsg('news_action', MSG_SUCCESS, true); ?>
<?php SystemMessage::showMsg('news_action', MSG_ERROR, true); ?>

<form method="post" enctype="multipart/form-data">

    <h4>Основное</h4>

    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $this->buffer->news['title'] ?>" required>
        <small id="title_help" class="form-text text-muted">Будет использоваться в качестве заголовка</small>
    </div>

    <div class="form-group">
        <label for="slug">Слаг</label>
        <input type="text" class="form-control" id="slug" name="slug" value="<?= $this->buffer->news['slug'] ?>" required>
        <small id="slug_help" class="form-text text-muted">Будет использоваться в качестве слага</small>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="status" id="status" <?= $this->buffer->news['status'] > 0 ? 'checked' : '' ?> />
        <label class="form-check-label" for="status">Опубликовать?</label>
    </div>

    <hr />
    <h4>Контент</h4>

    <div class="form-group">
        <label for="content">Основной контент</label>
        <textarea class="form-control" id="content" name="content" rows="8" required><?= $this->buffer->news['content'] ?></textarea>
        <small id="content_help" class="form-text text-muted">Отметьте окончание превью статьи тегом [CUT]</small>
    </div>

    <div class="form-group">
        <label for="path_img">Каталог для хранения изображения</label>
        <select id="path_img" class="form-control" name="path_img">
            <option value="news" <?= $this->buffer->news['img_path'] == 'news' ? 'selected' : '' ?>>Новости</option>
            <option value="project" <?= $this->buffer->news['img_path'] == 'project' ? 'selected' : '' ?>><?= $this->langLine('images_d_project') ?></option>
            <option value="ico" <?= $this->buffer->news['img_path'] == 'ico' ? 'selected' : '' ?>><?= $this->langLine('images_d_ico') ?></option>
            <option value="gallery" <?= $this->buffer->news['img_path'] == 'gallery' ? 'selected' : '' ?>><?= $this->langLine('images_d_gallery') ?></option>
        </select>
        <small id="path_img_help" class="form-text text-muted">Куда сохранить изображение (для обновления установите галочку ниже "заменить изображение")</small>
    </div>

    <div class="form-group">
        <label for="img">Выбрать файл</label>
        <input type="file" class="form-control-file" id="img" name="img">
        <small id="file_help" class="form-text text-muted">Выбрать файл изображения (для обновления установите галочку ниже "заменить изображение")</small>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="change_img" id="change_img" />
        <label class="form-check-label" for="change_img">Заменить изображение</label>
    </div>

    <hr />
    <h4>SEO</h4>

    <div class="form-group">
        <label for="title_seo">Заголовок Браузера (title)</label>
        <input type="text" class="form-control" id="title_seo" name="title_seo" placeholder="SEO title" value="<?= $this->buffer->news['title_seo'] ?>" required>
        <small id="title_seo_help" class="form-text text-muted">Будет использоваться в качестве SEO заголовка</small>
    </div>

    <div class="form-group">
        <label for="desc_seo">Описание (description)</label>
        <input type="text" class="form-control" id="desc_seo" name="desc_seo" placeholder="SEO description" value="<?= $this->buffer->news['desc_seo'] ?>" required>
        <small id="desc_seo_help" class="form-text text-muted">Будет использоваться в качестве SEO описания</small>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="edit">Сохранить изменения</button>
    </div>

</form>