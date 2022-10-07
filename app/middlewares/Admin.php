<?php

namespace app\middlewares;

use framework\classes\Controller;


class Admin extends Controller {

    public function handle()
    {
        if (!$this->isAdminAuth() && !$this->isRootAuth()) {
            redirect(SITE . 'login');
        }
    }
}
