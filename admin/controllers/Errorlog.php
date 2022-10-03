<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 15:31
 */


namespace admin\controllers;

use framework\classes\Controller;
use framework\modules\storage\Storage;


class Errorlog extends Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->isRootAuth()) {
            $this->url::redirect(SITE . 'login');
        }
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

        $this->buffer->logs = $logs;

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