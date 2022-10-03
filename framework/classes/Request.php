<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 26.08.2019
 * Time: 14:57
 */

namespace framework\classes;


class Request {

    /**
     * Существует ли ключ в REQUEST
     *
     * @param $index
     * @return bool
     */
    public static function issetAnyWhere($index): bool
    {
        return isset($_REQUEST[$index]);
    }

    /**
     * Существует ли ключ в POST
     *
     * @param $index
     * @return bool
     */
    public static function issetPost($index): bool
    {
        return isset($_POST[$index]);
    }

    /**
     * Существует ли ключ в GET
     *
     * @param $index
     * @return bool
     */
    public static function issetGet($index): bool
    {
        return isset($_GET[$index]);
    }

    /**
     * Существует ли ключ в FILES
     *
     * @param $index
     * @return bool
     */
    public static function issetFile($index): bool
    {
        return isset($_FILES[$index]);
    }



    /**
     * Получить данные по ключу из REQUEST, если их нет, то дефолтное значение
     *
     * @param $index
     * @param string $type
     * @param false $default
     * @return array|bool|float|int|object|string
     */
    public static function request($index, $type = 's', $default = false)
    {
        return self::getFormat(($_REQUEST[$index] ?? $default), $type);
    }

    /**
     * Получить данные по ключу из $_POST, если их нет, то дефолтное значение
     *
     * @param $index
     * @param string $type
     * @param false $default
     * @return array|bool|float|int|object|string
     */
    public static function post($index, $type = 's', $default = false)
    {
        return self::getFormat(($_POST[$index] ?? $default), $type);
    }

    /**
     * Получить данные по ключу из $_GET, если их нет, то дефолтное значение
     *
     * @param $index
     * @param string $type
     * @param false $default
     * @return array|bool|float|int|object|string
     */
    public static function get($index, $type = 's', $default = false)
    {
        return self::getFormat(($_GET[$index] ?? $default), $type);
    }

    /**
     * Получить данные по ключу из $_FILES
     *
     * @param $index
     * @return false|mixed
     */
    public static function file($index)
    {
        return $_FILES[$index] ?? false;
    }

    /**
     * Получить данные по ключу из QUERY (FrameWork URL)
     *
     * @param false $part
     * @return array|bool|float|int|mixed|object|string
     */
    public static function q($part = false)
    {
        $q = static::get('q');
        if ($part == false) {
            return $q;
        }

        $q = explode('/', $q);
        $q = array_filter($q, function($element) {
            return !empty($element);
        });

        return $q[$part-1] ?? false;
    }


    /**
     * Очистка данных от иньккций и XSS
     *
     * @param $str
     * @param string $type
     * @param false $xss
     * @return array|bool|float|int|object|string
     */
    public static function clean($str, $type = 's', $xss = false)
    {
        return self::cleanInjection($str, $type, $xss);
    }



    protected static function getFormat($data, $type)
    {
        if (empty($data)) {
            return false;
        }

        switch ($type) {

            case 'a' :
                return (array) $data;
            case 'o' :
                return (object) $data;
            case 'b' :
                return (bool) $data;
            case 'd' :
                return (double) str_replace(' ', '', $data);
            case 'f' :
                return (float) str_replace(' ', '', $data);
            case 'i' :
                return (int) str_replace(' ', '', $data);
            default :
                return (string) $data;
        }
    }

    protected static function cleanInjection($query, $type = 's', $xss = false)
    {
        if (is_array($query)) {

            $new_query = [];

            foreach ($query as $k => $v) {
                $new_query[$k] = self::cleanInjection($v, $type, $xss);
            }

            return $new_query;
        } else {

            if (empty($query)) {
                return false;
            }

            if (stripos($query, '/')) {

                $new_query = explode('/', $query);
                $new_query = self::cleanInjection($new_query, $type, $xss);

                return implode('/', $new_query);
            }

            if ($type == 's') {
                return self::cleanData((string)$query, $xss);
            }

            return self::getFormat($query, $type);
        }
    }

    protected static function cleanData($query, $xss = false)
    {
        $bad_words = ['select', 'union', 'insert', 'update', 'drop', 'delete'];
        for ($i = 0; $i < count($bad_words); $i++) {

            if (stripos($query, $bad_words[$i])) {
                $query = str_ireplace($bad_words[$i], '', $query);
            };
        }

        if ($xss == true) {
            $query = self::cleanXss($query);
        }

        $bad_symbols = ['../', './', '<!--', '-->', '<', '>', '\'', '"', '&', '$', '#', '{', '}', '[', ']', ';', '?',
            '%20', '%22', '%3c', '%253c', '%3e', '%0e', '%28', '%29', '%2528', '%26', '%24', '%3f', '%3b', '%3d',  '*',
            'window.location', 'document.cookie', 'document.write', '.innerHTML', '.parentNode'
        ];

        return stripslashes(str_replace($bad_symbols, '', $query));
    }

    protected static function cleanXss($string)
    {
        return preg_replace('~<(.*?)>~is', '', $string);
    }
}