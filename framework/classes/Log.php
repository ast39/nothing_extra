<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 19:28
 */


namespace framework\classes;

use framework\modules\storage\Storage;
use framework\traits\Singleton;


class Log {

    use Singleton;

    private $log_buffer = [];

    public function cleanLog($name)
    {
        if (isset($this->log_buffer[$name])) {
            $this->log_buffer[$name] = '';
        }
    }

    public function appendLog($name, $data)
    {
        isset ($this->log_buffer[$name])
            ? $this->log_buffer[$name] .= $data
            : $this->log_buffer[$name]  = $data;
    }

    public function showLog($name)
    {
        return $this->log_buffer[$name] ?? null;
    }

    public function saveLog($name, $clean_file = false): void
    {

        if (($this->log_buffer[$name] ?? null) !== null) {

            if (Storage::disk('public')->exists($name)) {

                if ($clean_file) {
                    Storage::disk('public')->delete($name);
                } else {
                    Storage::disk('public')->append($name, $this->log_buffer[$name]);
                }
            }

            Storage::disk('public')->put($name, $this->log_buffer[$name]);
        }
    }

    public function readLog($name, $json = false)
    {
        if (Storage::disk('public')->exists($name)) {

            return $json
                ? Storage::disk('public')->get($name)->toJson()
                : Storage::disk('public')->get($name)->toArray();
        }

        return null;
    }

    protected function __clone() {}
}