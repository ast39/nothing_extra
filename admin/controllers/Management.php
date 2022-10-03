<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 21.09.2019
 * Time: 17:14
 */


namespace admin\controllers;

use framework\classes\{Controller, Request};


class Management extends Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->isAdminAuth() && !$this->isRootAuth()) {
            $this->url::redirect(SITE . 'login');
        }
    }

    public function index()
    {
        $this->url::redirect(SITE);
    }

    public function robots()
    {
        if (Request::issetPost('robots')) {

            $text = Request::post('robots');
            if (file_put_contents(ROOT . 'robots.txt', ltrim($text))) {
                $this->buffer->good_log = $this->langLine('manage_scs_1');
            } else {
                $this->buffer->bad_log = $this->langLine('manage_err_1');
            }
        }
        
        $data = file(ROOT . 'robots.txt');
        $this->buffer->data = implode('', $data);

        $this->loadTemplate();
    }

    public function sitemap()
    {
        if (Request::issetPost('sitemap')) {

            $text = Request::post('sitemap');
            if (file_put_contents(ROOT . 'sitemap.xml', ltrim($text))) {
                $this->buffer->good_log = $this->langLine('manage_scs_1');
            } else {
                $this->buffer->bad_log = $this->langLine('manage_err_1');
            }
        }

        if (!file_exists(ROOT . 'sitemap.xml')) {
            $this->buffer->bad_log = 'Файл sitemap.xml не создан';
        } else {

            $data = file(ROOT . 'sitemap.xml');
            $this->buffer->data = implode('', $data);
        }
        
        $this->loadTemplate();
    }

    public function htaccess()
    {
        if (!$this->isRootAuth()) {
            $this->url::redirect(SITE . 'login');
        }

        if (Request::issetPost('htaccess')) {
            $text = Request::post('htaccess');

            if (file_put_contents(ROOT . '.htaccess', ltrim($text))) {
                $this->buffer->good_log = $this->langLine('manage_scs_1');
            } else {
                $this->buffer->bad_log = $this->langLine('manage_err_1');
            }
        }

        $data = file(ROOT . '.htaccess');
        $this->buffer->data = implode('', $data);

        $this->loadTemplate();
    }

    public function status()
    {
        if (Request::issetPost('change_status')) {

            $new_status = Request::post('site_status');
            $lines  = file(ROOT . 'cfg' . DIRECTORY_SEPARATOR . 'SystemSettings' . EXT);

            foreach ($lines as $line_num => $line) {
                
                if (strpos($line, 'site_stop') !== false) {

                    $site_status = trim(strrchr($line, '='));
                    $site_status = strpos($site_status, 'false') !== false ? 1 : 0;

                    if ($site_status == $new_status) {
                        $this->buffer->good_log = $this->langLine('manage_err_2');
                    } else {
                        $site_status == 1
                            ? $lines = str_replace('public static $site_stop = false;', 'public static $site_stop = true;', $lines)
                            : $lines = str_replace('public static $site_stop = true;', 'public static $site_stop = false;', $lines);

                        file_put_contents(ROOT . 'cfg' . DIRECTORY_SEPARATOR . 'SystemSettings' . EXT, $lines);
                        $this->buffer->good_log = $this->langLine('manage_scs_2');
                    }
                }
            }
        }

        $lines  = file(ROOT . 'cfg' . DIRECTORY_SEPARATOR . 'SystemSettings' . EXT);
        foreach ($lines as $line_num => $line) {

            if (strpos($line, 'site_stop') !== false) {

                $status = trim(strrchr($line, '='));
                $this->buffer->site_status = strpos($status, 'false') !== false ? 1 : 0;

                break;
            }

        }

        $this->loadTemplate();
    }
}