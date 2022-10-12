<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 13:58
 */


namespace admin\controllers;

use framework\classes\{Controller, Buffer, NE, Request};


class Login extends Controller {

    public function __construct()
    {
        parent::__construct();

        if ($this->isRootAuth() || $this->isAdminAuth()) {
            redirect(SITE);
        }
    }

    public function index()
    {
        if (!LOCAL && (in_array(config('options.admin_login'), ['admin', 'root']) || !NE::strongPassword(config('options.admin_password')))) {
            Buffer::instance()->set('attention', $this->langLine('login_default_data'));
        }

        if (!LOCAL && (in_array(config('options.root_login'), ['admin', 'root']) || !NE::strongPassword(config('options.root_password')))) {
            Buffer::instance()->set('attention', $this->langLine('login_default_data'));
        }

        if (Request::issetAnyWhere('try_auth') != false) {

            $this->csrfCheck();

            $admin_login = Request::post('admin_login');
            $admin_pass  = Request::post('admin_pass');

            if (config('options.admin_login') == $admin_login && config('options.admin_password') == $admin_pass) {

                $this->authAdmin();
                redirect(SITE . config('options.def_page'));
            } elseif (config('options.root_login') == $admin_login && config('options.root_password') == $admin_pass) {

                $this->authRoot();
                redirect(SITE . config('options.def_page'));
            } else {

                Buffer::instance()->set('error', $this->langLine('login_wrong_data'));
            }
        }

        $this->loadTemplate();
    }
}