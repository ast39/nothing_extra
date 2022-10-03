<?php

namespace framework\traits;


/**
 * Singleton Collection
 */
trait SingletonCollection {

    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * Get instance
     *
     * @return mixed|static
     */
    public static function getInstance()
    {
        return self::$instances[static::class] ?? (self::$instances[static::class] = new static());
    }

    /**
     * Initialization of class instance
     *
     * @return static
     */
    private static function initInstance()
    {
        return new static();
    }

    /**
     * Reset instance
     *
     * @return void
     */
    public static function resetInstance(): void
    {
        static::$instances[static::class] = null;
    }

    /**
     * Disabled by access level
     */
    private function __construct() {}

    /**
     * Disabled by access level
     */
    private function __clone() {}

}
