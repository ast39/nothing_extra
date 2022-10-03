<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 26.07.2019
 * Time: 11:21
 */

namespace framework\classes;


class Validator {

    public static function inPost(string ...$keys):? array
    {
        $not_found = [];

        foreach (func_get_args() as $key) {
            if (!Request::issetPost($key)) {
                $not_found[] = $key;
            }
        }

        return
            count($not_found) > 0
                ? $not_found
                : null;
    }

    public static function isInt($data, $min = false, $max = false): float
    {
        $property = [];

        if ($min !== false) {
            $property['options']['min_range'] = $min;
        }

        if ($max !== false) {
            $property['options']['max_range'] = $max;
        }

        return isset($property['options'])
            ? filter_var($data, FILTER_VALIDATE_INT, $property)
            : filter_var($data, FILTER_VALIDATE_INT);
    }

    public static function isFloat($data): float
    {
        return filter_var($data, FILTER_VALIDATE_FLOAT);
    }

    public static function isBool($data): float
    {
        return filter_var($data, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null;
    }

    public static function isIP($data, $ipv6=false): float
    {
        return ($ipv6 == true)
            ? filter_var($data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
            : filter_var($data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    public static function isMac($data): float
    {
        return filter_var($data, FILTER_VALIDATE_MAC);
    }

    public static function isEmail($data): float
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    public static function isUrl($data, $path=false): float
    {
        return ($path == true)
            ? filter_var($data, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)
            : filter_var($data, FILTER_VALIDATE_URL);
    }

    public static function isLikePattern($data, $pattern): float
    {
        return filter_var($data, FILTER_VALIDATE_REGEXP, [
            'options' => ['regexp' => $pattern]
        ]);
    }

    public static function cleanInt($data)
    {
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function cleanFloat($data)
    {
        return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function cleanString($data, $notQuores = false)
    {
        return ($notQuores == true)
            ? filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)
            : filter_var($data, FILTER_SANITIZE_STRING);
    }

    public static function getInt($data)
    {
        return static::isInt($data)
            ? $data
            : (int) static::cleanInt($data);
    }

    public static function getFloat($data)
    {
        return static::isFloat($data)
            ? $data
            : (float) static::cleanFloat($data);
    }

    public static function getBool($data)
    {
        return static::isBool($data)
            ? $data
            : (bool) $data;
    }

    public static function screeningString($data)
    {
        return filter_var($data, FILTER_SANITIZE_MAGIC_QUOTES);
    }

    public static function encodeUrl($data)
    {
        return filter_var($data, FILTER_SANITIZE_ENCODED);
    }
}
