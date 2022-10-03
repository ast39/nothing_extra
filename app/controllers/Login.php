<?php

namespace app\controllers;

use system\core\Controller;


class Login extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadTemplate();
    }

    public function auth()
    {
        die('POST request detected');
    }
}
