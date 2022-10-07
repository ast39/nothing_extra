<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 13:19
 */

namespace admin\controllers;

use framework\classes\Controller;


class Home extends Controller {

    public function __construct()
    {
        parent::__construct();

        redirect(SITE . 'license');
    }

    public function index()
    {
        $this->loadTemplate();
    }
}