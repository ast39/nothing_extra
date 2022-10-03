<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 13:58
 */


namespace admin\controllers;

use framework\classes\{Controller, NE, Request};


class Login extends Controller {

    public function __construct()
    {
        parent::__construct();

        if ($this->isRootAuth() || $this->isAdminAuth()) {
            $this->url::redirect(SITE);
        }
    }

    public function index()
    {
        if (!LOCAL && (in_array(config('options.admin_login'), ['admin', 'root']) || !NE::strongPassword(config('options.admin_password')))) {
            $this->buffer->attention = $this->langLine('login_default_data');
        }

        if (!LOCAL && (in_array(config('options.root_login'), ['admin', 'root']) || !NE::strongPassword(config('options.root_password')))) {
            $this->buffer->attention = $this->langLine('login_default_data');
        }

        if (Request::issetAnyWhere('try_auth') != false) {

            $this->csrfCheck();

            $admin_login = Request::post('admin_login');
            $admin_pass  = Request::post('admin_pass');

            if (config('options.admin_login') == $admin_login && config('options.admin_password') == $admin_pass) {

                $this->authAdmin();
                $this->url::redirect(SITE);
            } elseif (config('options.root_login') == $admin_login && config('options.root_password') == $admin_pass) {
                
                $this->authRoot();
                $this->url::redirect(SITE);
            } else {

                $this->buffer->error = $this->langLine('login_wrong_data');
                NE::logSystemError('Failed admin auth [' . $admin_login . ']:[' . $admin_pass . ']');
            }
        }

        $this->loadTemplate();
    }
}