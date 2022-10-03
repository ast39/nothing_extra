<?php use system\core\SystemMessage; ?>

<h4 class="mt-3 pl-3">Добавить новость</h4>
<hr />

<?php SystemMessage::showMsg('news_action', MSG_SUCCESS, true); ?>
<?php SystemMessage::showMsg('news_action', MSG_ERROR, true); ?>

<form method="post" enctype="multipart/form-data">

    <h4>Основное</h4>

    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" required>
        <small id="title_help" class="form-text text-muted">Будет использоваться в качестве заголовка</small>
    </div>

    <div class="form-group">
        <label for="slug">Слаг</label>
        <input type="text" class="form-control" id="slug" name="slug" required>
        <small id="slug_help" class="form-text text-muted">Будет использоваться в качестве слага</small>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="status" id="status" checked>
        <label class="form-check-label" for="status">Опубликовать?</label>
    </div>

    <hr />
    <h4>Контент</h4>

    <div class="form-group">
        <label for="content">Основной контент</label>
        <textarea class="form-control" id="content" name="content" rows="8" required></textarea>
        <small id="content_help" class="form-text text-muted">Отметьте окончание превью статьи тегом [CUT]</small>
    </div>

    <div class="form-group">
        <label for="path_img">Каталог для хранения изображения</label>
        <select id="path_img" class="form-control" name="path_img">
            <option value="news">Новости</option>
            <option value="project">Проект</option>
            <option value="ico">Иконки</option>
            <option value="gallery">Галлерея</option>
        </select>
        <small id="path_img_help" class="form-text text-muted">Куда сохранить изображение</small>
    </div>

    <div class="form-group">
        <label for="img">Выбрать файл </label>
        <input type="file" class="form-control-file" value="45.png" id="img" name="img" required>
        <small id="file_help" class="form-text text-muted">Выбрать файл изображения</small>
    </div>

    <hr />
    <h4>SEO</h4>

    <div class="form-group">
        <label for="title_seo">Заголовок Браузера (title)</label>
        <input type="text" class="form-control" id="title_seo" name="title_seo" aria-describedby="titleHelp" placeholder="Заголовок бразуреа" required>
        <small id="title_seo_help" class="form-text text-muted">Будет использоваться в качестве SEO заголовка</small>
    </div>

    <div class="form-group">
        <label for="desc_seo">Описание (description)</label>
        <input type="text" class="form-control" id="desc_seo" name="desc_seo" aria-describedby="descHelp" placeholder="Описание" required>
        <small id="desc_seo_help" class="form-text text-muted">Будет использоваться в качестве SEO описания</small>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="add">Добавить запись</button>
    </div>

</form>