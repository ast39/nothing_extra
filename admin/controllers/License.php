<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 15:09
 */

namespace admin\controllers;

use framework\classes\{Controller, Buffer};


class License extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $lic_en
            = $lic_ru
            = [];

        $lic    = file(BASE_DIR . 'License.txt');
        $mark   = 'en';

        foreach ($lic as $line) {

            if (strpos($line, '===RU===') !== false) {
                $mark = 'ru';

                continue;
            }

            $lic_name = 'lic_' . $mark;
            array_push($$lic_name, $line);
        }

        Buffer::instance()->set('license', config('sys.def_lang') == 'ru'
            ? implode('<br />', $lic_ru)
            : implode('<br />', $lic_en));

        $this->loadTemplate();
    }
}