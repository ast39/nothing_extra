<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 15:31
 */


namespace admin\controllers;

use framework\classes\{Controller, Buffer};
use framework\modules\storage\Storage;


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
            $logs[$file] = $this->getDayLog($file);
        }

        Buffer::getInstance()->set('logs', $logs);

        $this->loadTemplate();
    }

    private function getDayLog($log_file)
    {
        $log = [];

        if (Storage::disk('logs')->exists($log_file)) {
            $log = Storage::disk('logs')->get($log_file)->toArray();
        }

        return $log;
    }
}