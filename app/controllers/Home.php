<?php

namespace app\controllers;

use framework\classes\Controller;
use Dotenv\Dotenv;


class Home extends Controller {

    public function __construct()
    {
        //$this->auth = true;

        parent::__construct();
    }

    public function index()
    {
        $this->loadTemplate();
    }
}
