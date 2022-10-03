<?php use system\core\SystemMessage; ?>

<h4 class="mt-3 pl-3">Список новостей</h4>
<hr />

<div class="row justify-content-between">
    <div class="mt-1 mb-3 ml-3">
        <a href="<?= SITE ?>news/add" class="btn btn-primary">Добавить запись</a>
    </div>
</div>

<?php SystemMessage::showMsg('news_action', MSG_SUCCESS, true); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col">Статья</th>
            <th scope="col" class="text-center">Дата</th>
            <th scope="col" class="text-center">Статус</th>
            <th scope="col" class="text-right">Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($this->buffer->news): ?>
            <?php $key = 1; ?>
            <?php foreach ($this->buffer->news as $item): ?>
                <tr>
                    <td class="text-center"><?= $key ?></td>
                    <td class="text-left"><?= $item['title'] ?></td>
                    <td class="text-center"><?= date("d-m-Y" , $item['add_time']) ?></td>
                    <td class="text-center"><img alt="status" src="<?= SITE_IMG ?>system/<?= $item['status'] == 1 ? 'i_success.png' : 'i_locked.png' ?>"  width="32" /></td>
                    <td class="text-right">
                        <a href="<?= SITE ?>news/read/<?= $item['id'] ?>"><img class="img-thumbnail" style="cursor: pointer" alt="open" src="<?= PROJECT_URL ?>i/img/system/i_show.png" width="32" ></a>
                        <a target="_blank" href="<?= PROJECT_URL ?>news/<?= $item['slug'] ?>"><img class="img-thumbnail" style="cursor: pointer" alt="open" src="<?= PROJECT_URL ?>i/img/system/i_goto.png" width="32" ></a>
                        <a href="<?= SITE ?>news/edit/<?= $item['id'] ?>"><img class="img-thumbnail" style="cursor: pointer" alt="edit" src="<?= PROJECT_URL ?>i/img/system/i_edit.png" width="32"></a>
                        <a href="<?= SITE ?>news/delete/<?= $item['id'] ?>"><img class="img-thumbnail" style="cursor: pointer" alt="delete" src="<?= PROJECT_URL ?>i/img/system/i_delete.png" width="32" onClick="return confirm('Are you absolutely sure you want to delete?')"></a>
                    </td>
                </tr>
                <?php $key++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">
                    <div class="mt-3 p-2 bg-danger text-white text-center rounded">Пока в базе нет статей</div>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>