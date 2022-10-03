<?php

namespace framework\traits;


/**
 * Registry
 */
trait Registry {

    /**
     * @var array
     */
    protected static $registry_data = [];


    /**
     * Set data
     *
     * @param $key
     * @param $value
     * @return void
     */
    public static function set($key, $value)
    {
        self::$registry_data[$key] = $value;
    }

    /**
     * Get data
     *
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return self::$registry_data[$key] ?? null;
    }

    /**
     * Remove data
     *
     * @param $key
     * @return void
     */
    final public static function removeProduct($key)
    {
        if (array_key_exists($key, self::$registry_data)) {
            unset(self::$registry_data[$key]);
        }
    }
}
