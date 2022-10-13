<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 15:31
 */


namespace admin\controllers;

use framework\classes\{Controller, Buffer, Log};
use framework\modules\storage\Storage;
use Monolog\Logger;


class Errorlog extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $files
            = $logs
            = [];

        for ($i = 0; $i < 7; $i++) {
            $files[] = date('Y-m-d', time() - (3600 * 24 * $i));
        }

        foreach ($files as $file) {
            $logs[$file] = Log::readLog($file);
        }

        Buffer::instance()->set('logs', $logs);

        $this->loadTemplate();
    }
}