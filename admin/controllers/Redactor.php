<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 19.09.2019
 * Time: 10:20
 */

namespace admin\controllers;

use framework\classes\{Controller, NE, Buffer, Cloud, Session, Request};


class Redactor extends Controller {

    private $cloud;

    public function __construct()
    {
        parent::__construct();

        $this->cloud = new Cloud();
    }

    public function index()
    {
        $this->scan();
    }

    public function scan($url = ':')
    {
        if (!$this->cloud->checkAccess($url)) {

            Session::set('Доступ запрещен к выбранной директории', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        $dir_data = $this->cloud->scan($url);
        Buffer::instance()->set('list',       $dir_data);
        Buffer::instance()->set('url_legend', $this->cloud->currentUrl(Session::get('conductor_url')));

        $this->loadTemplate();
    }

    public function back($steps = 0)
    {
        $url = Session::get('conductor_url');

        if ($url == '') {
            $this->scan();

            exit;
        }

        $newUrl = $this->cloud->backSteps(Session::get('conductor_url'), $steps);

        if (!$this->cloud->checkAccess($url)) {

            Session::set('Доступ запрещен к выбранной директории', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        redirect(SITE . 'explorer/scan/' . $newUrl);
    }

    public function showFile($url)
    {
        if (!$this->cloud->checkAccess($url)) {

            Session::set('Ошибка! Запрещено просматривать данный файл', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        $file     = NE::separator($this->cloud->userCloudRoot() . $this->cloud->decodeUrl($url), '/');
        $file_url = NE::separator($this->cloud->decodeUrl($url), '/');
        $file = substr($file, 0, -1);

        if (is_file($file)) {

            $url = $this->cloud->decodeUrl(Request::post('url'));
            $url = NE::separator($this->cloud->userCloudRoot() . $url, '/');

            $_file     = explode('.', $file_url);
            $file_type = str_ireplace(['/', '\\'], '', end($_file));

            Buffer::instance()->set('file', $file);
            Buffer::instance()->set('url',  $url);
            Buffer::instance()->set('file_url', str_replace(config('sys.admin_partition') . '/', '', SITE) . substr($file_url, 0, -1));
            Buffer::instance()->set('file_type', in_array(strtolower($file_type), ['jpeg', 'jpg', 'png', 'gif']) ? 'img' : (strtolower($file_type) == 'pdf' ? 'pdf' : 'other'));

            $this->loadTemplate();
        } else {

            Session::set('Ошибка! Невозможно открыть данный файл', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }
    }

    public function newDir($url)
    {
        if (!$this->cloud->checkAccess($url)) {

            Session::set('Запрещено создавать каталоги в данной директории', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        if (Request::issetPost('add')) {

            $url = $this->cloud->decodeUrl(Request::post('url'));
            $fileName = Request::post('title', 's');

            if (empty($fileName)) {

                Session::set('Вы не указали имя новой директории', 'bad_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            }

            $url = NE::separator($this->cloud->userCloudRoot() . $url . $fileName. '/');
            mkdir($url, config('sys.dir_access'), true);
            //chmod($url, config('sys.dir_access'));
            Session::set('Директория успешно создана: ' . $fileName, 'good_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        } else {

            Buffer::instance()->set('url', $url);
            $this->loadTemplate();
        }
    }

    public function newFile($url)
    {
        if (!$this->cloud->checkAccess($url)) {

            Session::set('Запрещено создавать файлы в данной директории', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        if (Request::issetPost('add')) {

            $url = $this->cloud->decodeUrl(Request::post('url'));
            $fileName = Request::post('title', 's');

            if (empty($fileName)) {

                Session::set('Вы не указали имя нового файла', 'bad_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            }

            if (strpos($fileName, '.') === false) {
                $fileName .= '.php';
            }

            $data = Request::post('code');
            $url = NE::separator($this->cloud->userCloudRoot() . $url . $fileName, '/');
            file_put_contents($url, $data);
            chmod($url, config('sys.dir_access'));
            Session::set('Файл успешно создан: ' . $fileName, 'good_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        } else {

            Buffer::instance()->set('url', $url);
            $this->loadTemplate();
        }
    }

    public function editFile($url)
    {
        if (!$this->cloud->checkAccess($url)) {

            Session::set('Ошибка! Запрещено редактировать данный файл', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        if (Request::issetPost('edit')) {

            $file = NE::separator($this->cloud->userCloudRoot() . $this->cloud->decodeUrl($url), '/');

            if (is_file($file)) {

                $url = $this->cloud->decodeUrl(Request::post('url'));
                $data = Request::post('code');
                $url = NE::separator($this->cloud->userCloudRoot() . $url, '/');
                file_put_contents($url, str_replace('_textarea_', 'textarea', $data));
                Session::set('Файл успешно отредактирован', 'good_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            } else {

                Session::set('Ошибка! Запрещено редактировать данный файл', 'bad_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            }
        } else {

            $file = NE::separator($this->cloud->userCloudRoot() . $this->cloud->decodeUrl($url), '/');
            Buffer::instance()->set('name', $this->cloud->decodeUrl($url));
            Buffer::instance()->set('code', str_replace('textarea', '_textarea_', implode('', file($file))));
            Buffer::instance()->set('url',  $this->cloud->decodeUrl($url));

            $this->loadTemplate();
        }
    }

    public function uploadFile($url)
    {
        if (!$this->cloud->checkAccess($url)) {

            Session::set('Запрещено загружать файлы в текущую директорию', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }

        if (Request::issetPost('upload')) {

            $file = Request::file('new_file');

            if ($file['error'] > 0) {

                Session::set('Ошибка загрузки файла', 'bad_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            }

            if ($file['size'] > (config('sys.max_upload_size') * 1024 * 1024)) {

                Session::set('Файл не должен превышать размер в ' . config('sys.max_upload_size') . ' MB', 'bad_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            }

            $file_type = $this->cloud->getDotType($file);
            $fileName  = empty(Request::post('save_name'))
                ? $file['name']
                : Request::post('save_name');

            $fileName = $this->removeFileType($fileName)  . '.' . $file_type;

            $path = NE::separator($this->cloud->userCloudRoot() . $this->cloud->decodeUrl(Request::post('url')) . $fileName);

            if (is_uploaded_file($file['tmp_name'])) {

                move_uploaded_file($file['tmp_name'], $path);
                Session::set('Файл успешно загружен', 'good_log');
            } else {
                Session::set('К сожалению, файл не удалось загрузить на сервер', 'bad_log');
            }

            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));


        } else {

            Buffer::instance()->set('url_legend', $this->cloud->currentUrl(Session::get('conductor_url'), true));
            Buffer::instance()->set('url', $url);
            $this->loadTemplate();
        }
    }

    public function delete($url)
    {
        $file = NE::separator($this->cloud->userCloudRoot() . $this->cloud->decodeUrl($url), '/');

        if (is_file($file)) {

            unlink($file);
            Session::set('Файл успешно удален', 'good_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        } elseif (is_dir($file)) {

            $filesInDir = scandir($file);
            if (count($filesInDir) > 2) {

                Session::set('Ошибка! В каталоге имеются фалы', 'bad_log');
                redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
            }

            rmdir($file);
            Session::set('Каталог успешно удален', 'good_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        } else {

            Session::set('Ошибка! Удаление не прошло; Код 500', 'bad_log');
            redirect(SITE . 'explorer/scan/' . Session::get('conductor_url'));
        }
    }


    private function removeFileType($fileName)
    {
        $x = explode('.', $fileName);
        if (count($x) > 1) {
            unset($x[count($x) - 1]);
        }

        return implode('.', $x);
    }
}