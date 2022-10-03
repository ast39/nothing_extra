<?php use models\NewsHelper; ?>

<h4 class="mt-3 pl-3"><?= $this->buffer->news['title'] ?></h4>
<hr />

<form method="post" enctype="multipart/form-data">
    <img class="img-thumbnail float-left mr-3" style="max-width: 400px; max-height: 300px;" alt="image" src="<?= NewsHelper::getImageUrl($this->buffer->news['img_path'], $this->buffer->news['img_name']) ?>" />
    <p class="text-justify"><?= NewsHelper::getTextPreview($this->buffer->news['content']) ?></p>
    <p class="text-justify"><?= NewsHelper::getFullText($this->buffer->news['content']) ?></p>
    <small class="form-text text-muted"><?= date('d-m-Y', $this->buffer->news['add_time']) ?></small>
    <div style="clear: both"></div>
</form>