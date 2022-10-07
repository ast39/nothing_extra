<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 21.09.2019
 * Time: 14:36
 */


namespace admin\controllers;

use framework\classes\{Controller, Buffer, NE, Request};


class Images extends Controller {

    protected $new_name;
    protected $max_size = 2;
    protected $mime_upload = [

        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadTemplate();
    }

    public function upload()
    {
        if (Request::issetPost('upload')) {

            $new_file = Request::file('new_file');

            if ($new_file['error'] > 0) {
                Buffer::getInstance()->set('bad_log', $this->langLine('images_err_1'));

                $this->index();
                die;
            }

            if ($new_file['size'] > ($this->max_size * 1024 * 1024)) {
                Buffer::getInstance()->set('bad_log', $this->langLine('images_err_2') . $this->max_size . ' MB');

                $this->index();
                die;
            }

            $info = getimagesize($new_file['tmp_name']);

            if (!in_array($info['mime'], $this->mime_upload)) {
                Buffer::getInstance()->set('bad_log', $this->langLine('images_err_3'));

                $this->index();
                die;
            }

            $img_type = explode('/', $new_file['type']);
            $img_type = end($img_type);

            $this->new_name = empty(Request::post('save_name'))
                ? $new_file['name'] . '.' . $img_type
                : Request::post('save_name') . '.' . $img_type;

            $path = publicPath() . 'img/';
            $this->new_name = $this->getImgUrl($_POST['folder']);

            $path = NE::separator($path . $this->new_name);

            if (is_uploaded_file($new_file['tmp_name'])) {

                move_uploaded_file($new_file['tmp_name'], $path);
                Buffer::getInstance()->set('good_log', $this->langLine('images_scs') . $this->new_name . '" )');

                $this->index();
                die;
            } else {
                Buffer::getInstance()->set('bad_log', $this->langLine('images_err_4'));

                $this->index();
                die;
            }
        }

        $this->index();
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