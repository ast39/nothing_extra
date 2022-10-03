<?php if (PAGE_METHOD == 'add'): ?>
    <?php $this->loadComponent('news/add') ?>
<?php elseif (PAGE_METHOD == 'edit'): ?>
    <?php $this->loadComponent('news/edit') ?>
<?php elseif (PAGE_METHOD == 'read'): ?>
    <?php $this->loadComponent('news/read') ?>
<?php else: ?>
    <?php $this->loadComponent('news/list') ?>
<?php endif; ?>