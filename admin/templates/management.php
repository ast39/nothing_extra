<?php if (file_exists(\framework\classes\NE::separator(ROOT . 'admin/templates/components/' . 'm_' . PAGE_METHOD . EXT))): ?>
    <?php include_once 'components' . DIRECTORY_SEPARATOR . 'm_' . PAGE_METHOD . EXT; ?>
<?php else: ?>
    <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= $this->langLine('manage_err_3') ?><?= PAGE_METHOD ?></div>
<?php endif; ?>
