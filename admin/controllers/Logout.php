<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 13:58
 */

namespace admin\controllers;

use framework\classes\Controller;


class Logout extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        session_unset();
        session_destroy();

        $this->url::redirect(SITE);
    }
}