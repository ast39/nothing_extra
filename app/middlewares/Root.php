<?php

namespace app\middlewares;

use framework\classes\Controller;


class Root extends Controller {

    public function handle()
    {
        if (!$this->isRootAuth()) {
            redirect(SITE . 'login');
        }
    }
}
