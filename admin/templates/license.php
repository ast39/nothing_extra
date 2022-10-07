<?php use framework\classes\Buffer; ?>

<h4 class="mt-3 pl-3"><?= $this->langLine('lic_head_1') ?></h4>
<hr />
<div class="card border-primary mb-3 mt-3">
    <h5 class="card-header text-white bg-primary"><?= $this->langLine('lic_head_2') ?></h5>
    <div class="card-body">
        <p class="card-text"><?= Buffer::getInstance()->license ?></p>
    </div>
</div>
