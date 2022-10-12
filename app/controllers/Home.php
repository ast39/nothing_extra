<?php

namespace app\controllers;


use framework\classes\Controller;

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
