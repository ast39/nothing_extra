<?php if (file_exists(\framework\classes\NE::separator(BASE_DIR . 'admin/templates/components/' . 'm_' . PAGE_METHOD . '.php'))): ?>
    <?php include_once 'components' . DIRECTORY_SEPARATOR . 'm_' . PAGE_METHOD . '.php'; ?>
<?php else: ?>
    <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= $this->langLine('manage_err_3') ?><?= PAGE_METHOD ?></div>
<?php endif; ?>
