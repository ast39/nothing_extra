<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 19:28
 */

namespace framework\classes;


use framework\modules\storage\Storage;
use Monolog\Logger;

class Log extends Logger {

    protected static $instance;

    public static function instance()
    {
        return static::$instance ?? (static::$instance = static::initInstance());
    }

    private static function initInstance()
    {
        return new Logger('logger');
    }

    public static function resetInstance(): void
    {
        static::$instance = null;
    }

    public static function readLog(string $file, string $error_type = 'warning'): array
    {
        if (!Storage::disk('log_' . $error_type)->exists($file)) {
            return [];
        }

        $data   = Storage::disk('log_' . $error_type)->get($file)->toArray();
        $result = [];

        foreach ($data as $line) {

            $line = trim(substr($line, strpos($line, '{')));
            $line = json_decode(substr($line, 0, strlen($line) - 3), true);

            $result[] = $line;
        }

        return $result;
    }

    private function __clone() {}

}