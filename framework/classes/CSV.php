<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 25.07.2019
 * Time: 12:15
 *
 * Установить разделитель
 * CSV::$delimiter = ';';
 *
 * Прочитать файл и получить ассоциативный массив
 * $data = CSV::read('users.csv');
 *
 * Получить ключи таблицы
 * $keys = CSV::keys('users.csv');
 *
 * Дополнить таблицы данными ( только данные, ключи старые )
 * CSV::append('users.csv', []);
 *
 * Создать таблицу CSV из ассоциативного массива
 * CSV::save('users.csv', []);
 *
 * Удалить из таблицы записи, где login = 555
 * CSV::delete('users.csv', 'login', 555);
 */

namespace system\helper;


class CSV {

    /*
     * Public functions ( general methods ) ---------->
     */

    public static $delimiter = ';';

    /**
     * Get keys from CSV table ( 1st row )
     *
     * @param $file
     * @return array|string
     */
    public static function keys($file)
    {
        if (!file_exists($file)) {
            return false;
        }

        $handle = fopen($file, 'r');
        $csv_keys = fgetcsv($handle, 0, static::$delimiter);
        fclose($handle);

        return $csv_keys;
    }

    /**
     * Get data from CSV like array with keys
     *
     * @param $file
     * @return array|string
     */
    public static function read($file)
    {
        if (!file_exists($file)) {
            return false;
        }

        $handle = fopen($file, 'r');
        $csv_keys = $csv_values = [];

        $i=0;
        while (($line = fgetcsv($handle, 0, static::$delimiter)) !== FALSE) {

            $i++;

            if ($i == 1) {
                $csv_keys = $line;
            } else {
                $csv_values[] = $line;
            }
        }

        fclose($handle);

        return static::prepareResponseAfterRead($csv_keys, $csv_values);
    }

    /**
     * Save data to csv ( with keys )
     *
     * @param $file
     * @param array $data
     * @return string
     */
    public static function save($file, array $data)
    {
        if (count($data) < 1) {
            return false;
        }

        $data = static::prepareResponseBeforeSave($data);

        $handle = fopen($file, 'w+');
        @chown($file, 'root');
        @chmod($file, 0777);

        foreach ($data as $val) {
            fputs($handle, $val . PHP_EOL);
        }

        fclose($handle);

        return true;
    }

    /**
     * Append data to csv ( without keys, only values )
     *
     * @param $file
     * @param array $data
     * @return string
     */
    public static function append($file, array $data)
    {
        if (!file_exists($file)) {
            return false;
        }

        if (count($data) < 1) {
            return false;
        }

        $keys = static::keys($file);
        if (count($keys) != count($data[0])) {
            return false;
        }

        $data = static::prepareResponseBeforeAppend($data);

        chmod($file, 0755);
        $handle = fopen($file, "a");

        foreach ($data as $val) {
            fputs($handle, $val . PHP_EOL);
        }

        fclose($handle);

        return true;
    }

    /**
     * Delete data from CSV by key = value
     *
     * @param $file
     * @param $key
     * @param $value
     * @return bool|string
     */
    public static function delete($file, $key, $value)
    {
        if (!file_exists($file)) {
            return false;
        }

        $keys = static::keys($file);
        if (!in_array($key, $keys)) {
            return false;
        }

        $data = static::read($file);
        if (count($data) < 1) {
            return false;
        }

        $new_data = [];
        foreach ($data as $index => $arr) {
            if ($arr[$key] != $value) {
                $new_data[] = $arr;
            }
        }

        static::save($file, $new_data);

        return true;
    }

    /*
     * Private functions ( auxiliary methods ) ---------->
     */

    /**
     * Prepare data from CSV like array
     *
     * @param $csv_keys
     * @param $csv_values
     * @return array|string
     */
    private static function prepareResponseAfterRead($csv_keys, $csv_values)
    {
        $response = [];

        foreach ($csv_values as $index => $data_line)
        {
            if (count($csv_keys) == count($data_line)) {
                $response[] = array_combine($csv_keys, $data_line);
            } else {
                return false;
            }
        }

        return $response;
    }

    /**
     * @param $data
     * @return array
     */
    private static function prepareResponseBeforeSave($data)
    {
        $response = [];
        foreach ($data as $index => $arr) {

            if (is_object($data)) {
                $data = static::objToArr($data);
            }

            if ($index == 0) {
                $response[] = implode(static::$delimiter, array_keys($arr));
            }

            $response[] = implode(static::$delimiter, array_values($arr));
        }

        return $response;
    }

    /**
     * Prepare data from array / object like csv lines
     *
     * @param $data
     * @return array
     */
    private static function prepareResponseBeforeAppend($data)
    {
        $response = [];
        foreach ($data as $index => $arr) {

            if (is_object($data)) {
                $data = static::objToArr($data);
            }

            $response[] = implode(static::$delimiter, array_values($arr));
        }

        return $response;
    }

    /**
     * Convert object to array
     *
     * @param $data
     * @return array
     */
    private static function objToArr($data)
    {
        if (is_array($data) || is_object($data)) {

            $result = [];
            foreach ($data as $key => $value) {
                $result[$key] = static::objToArr($value);
            }

            return $result;
        }

        return $data;
    }
}