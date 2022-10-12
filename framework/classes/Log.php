<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 19:28
 */

namespace framework\classes;


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

    private function __clone() {}

}