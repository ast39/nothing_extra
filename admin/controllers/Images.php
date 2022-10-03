<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 21.09.2019
 * Time: 14:36
 */


namespace admin\controllers;

use framework\classes\{Controller, NE, Request};


class Images extends Controller {

    protected $new_name;
    protected $max_size = 1;
    protected $mime_upload = [

        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif'
    ];

    public function __construct()
    {
        parent::__construct();

        if (!$this->isAdminAuth() && !$this->isRootAuth()) {
            $this->url::redirect(SITE . 'login');
        }
    }

    public function index()
    {
        if (Request::issetPost('upload')) {
            $this->tryUpload();
        }

        $this->loadTemplate();
    }

    private function tryUpload()
    {
        $new_file = Request::file('new_file');
        if ($new_file['error'] > 0) {
            $this->buffer->bad_log = $this->langLine('images_err_1');

            return false;
        }

        if ($new_file['size'] > ($this->max_size * 1024 * 1024)) {
            $this->buffer->bad_log = $this->langLine('images_err_2') . $this->max_size . ' MB';

            return false;
        }

        $info = getimagesize($new_file['tmp_name']);
        if (!in_array($info['mime'], $this->mime_upload)) {
            $this->buffer->bad_log = $this->langLine('images_err_3');

            return false;
        }

        $img_type = explode('/', $new_file['type']);
        $img_type = end($img_type);

        $this->new_name = empty(Request::post('save_name'))
            ? $new_file['name'] . '.' . $img_type
            : Request::post('save_name') . '.' . $img_type;

        $path = ROOT . 'i/' . 'img/';
        $this->new_name = $this->getImgUrl($_POST['folder']);

        $path = NE::separator($path . $this->new_name);

        if(is_uploaded_file($new_file['tmp_name'])) {

            move_uploaded_file($new_file['tmp_name'], $path);
            $this->buffer->good_log = $this->langLine('images_scs') . $this->new_name . '" )';

            return true;
        } else {
            $this->buffer->bad_log = $this->langLine('images_err_4');

            return false;
        }
    }

    private function getImgUrl($post)
    {
        switch ($post) {

            case 'img':
                return $this->new_name;
            case 'project':
                return 'project/' . $this->new_name;
            case 'ico':
                return 'ico/' . $this->new_name;
            case 'gallery':
                return 'gallery/' . $this->new_name;
            default:
                return '';
        }
    }
}