<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 21.09.2019
 * Time: 17:14
 */


namespace admin\controllers;

use framework\classes\{Controller, Buffer, Request};


class Management extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect(SITE);
    }

    public function robots()
    {
        if (Request::issetPost('robots')) {

            $text = Request::post('robots');
            if (file_put_contents(ROOT . 'robots.txt', ltrim($text))) {
                Buffer::getInstance()->set('good_log', $this->langLine('manage_scs_1'));
            } else {
                Buffer::getInstance()->set('bad_log', $this->langLine('manage_err_1'));
            }
        }
        
        $data = file(ROOT . 'robots.txt');
        Buffer::getInstance()->set('data', implode('', $data));

        $this->loadTemplate();
    }

    public function sitemap()
    {
        if (Request::issetPost('sitemap')) {

            $text = Request::post('sitemap');
            if (file_put_contents(ROOT . 'sitemap.xml', ltrim($text))) {
                Buffer::getInstance()->set('good_log', $this->langLine('manage_scs_1'));
            } else {
                Buffer::getInstance()->set('bad_log', $this->langLine('manage_err_1'));
            }
        }

        if (!file_exists(ROOT . 'sitemap.xml')) {
            Buffer::getInstance()->set('bad_log', 'Файл sitemap.xml не создан');
        } else {

            $data = file(ROOT . 'sitemap.xml');
            Buffer::getInstance()->set('data', implode('', $data));
        }
        
        $this->loadTemplate();
    }

    public function htaccess()
    {
        if (!$this->isRootAuth()) {
            redirect(SITE . 'login');
        }

        if (Request::issetPost('htaccess')) {
            $text = Request::post('htaccess');

            if (file_put_contents(ROOT . '.htaccess', ltrim($text))) {
                Buffer::getInstance()->set('good_log', $this->langLine('manage_scs_1'));
            } else {
                Buffer::getInstance()->set('bad_log', $this->langLine('manage_err_1'));
            }
        }

        $data = file(ROOT . '.htaccess');
        Buffer::getInstance()->set('data', implode('', $data));

        $this->loadTemplate();
    }

}
