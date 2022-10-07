<?php use framework\classes\Buffer; ?>

<div class="col-6 offset-3 mt-5">
    <?php if (Buffer::getInstance()->attention): ?>
        <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::getInstance()->attention ?></div>
    <?php else: ?>

        <form method="post">
            <?php $this->csrfHtml() ?>
            <div class="form-group">
                <label for="admin_login"><?= $this->langLine('login_name') ?></label>
                <input type="text" class="form-control" id="admin_login" name="admin_login" placeholder="login">
            </div>
            <div class="form-group">
                <label for="admin_pass"><?= $this->langLine('login_pass') ?></label>
                <input type="password" class="form-control" id="admin_pass" name="admin_pass" placeholder="password">
            </div>
            <button type="submit" name="try_auth" class="btn btn-primary"><?= $this->langLine('login_auth') ?></button>
        </form>

        <?php if (Buffer::getInstance()->error): ?>
            <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= Buffer::getInstance()->error ?></div>
        <?php endif; ?>

    <?php endif; ?>
</div>