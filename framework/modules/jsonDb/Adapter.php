<?php

namespace modules\jsonDb;


/**
 * Adapter class
 */
class Adapter {

    /**
     * Path to tables folder
     */
    const DB_PATH = __DIR__ . '\db\\';

    /**
     * Images of tables
     *
     * @var array
     */
    private static $instances = [];

    /**
     * Connect to table
     *
     * @param string $table
     * @return TableData|null
     */
    public static function connect(string $table):? TableData
    {
        if (!isset(self::$instances[$table])) {

            if (file_exists($path = self::path($table))) {
                self::$instances[$table] = new TableData($table, $path, file_get_contents($path));
            } else {
                return null;
            }
        }

        return self::$instances[$table];
    }

    /**
     * Create table
     *
     * @param string $table
     * @return bool
     */
    public static function create(string $table): bool
    {
        if (!file_exists($path = self::path($table))) {
            file_put_contents($path, null);

            return true;
        }

        return false;
    }

    /**
     * Connect (create if not exist)
     *
     * @param string $table
     * @return TableData|null
     */
    public static function connectOrCreate(string $table):? TableData
    {
       self::create($table);

       return self::connect($table);
    }

    /**
     * Clear table
     *
     * @param string $table
     * @return bool
     */
    public static function delete(string $table): bool
    {
        if (file_exists($data = self::path($table))) {
            unlink($data);

            return true;
        }

        return false;
    }

    /**
     * Delete table
     *
     * @param string $table
     * @return bool
     */
    public static function clear(string $table): bool
    {
        if (file_exists($data = self::path($table))) {
            file_put_contents($data, null);

            return true;
        }

        return false;
    }

    /**
     * Get path to table file
     *
     * @param string $name
     * @return string
     */
    private static function path(string $name)
    {
        return (Config::$db_path[$name] ?? self::DB_PATH) . $name . '.json';
    }

}
