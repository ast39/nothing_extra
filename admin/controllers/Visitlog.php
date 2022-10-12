<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 23.09.2019
 * Time: 12:40
 */


namespace admin\controllers;

use framework\classes\{Controller, Buffer};
use framework\modules\storage\Storage;


class Visitlog extends Controller {

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

        foreach ($files as $k) {

            $_fname = explode(DIRECTORY_SEPARATOR, $k);
            $fname  = substr(end($_fname), 0, strpos(end($_fname), '.'));

            $logs[$fname] = $this->getDayLog($k);
        }

        Buffer::instance()->set('logs', $logs);

        $this->loadTemplate();
    }

    private function getDayLog($log_file)
    {
        $log = [];

        if (Storage::disk('visits')->exists($log_file)) {
            $log = Storage::disk('visits')->get($log_file)->toArray();
        }

        return $log;
    }
}