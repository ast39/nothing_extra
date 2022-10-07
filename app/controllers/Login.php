<?php

namespace app\controllers;

use framework\classes\Controller;


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
