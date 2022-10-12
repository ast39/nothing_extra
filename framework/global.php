<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 25.09.2019
 * Time: 10:23
 */


use framework\classes\{NE, Buffer, SystemMessage};


function xmp($data): void
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function printSession(): void
{
    xmp($_SESSION);
}

function printPost(): void
{
    xmp($_POST);
}

function printClassMethods($class): void
{
    xmp(get_class_methods($class));
}

function printMethodParams(): void
{
    xmp(func_get_args());
}

function requestType(): string
{
    return $_SERVER['REQUEST_METHOD'] ?? 'GET';
}

function isAjax(): bool
{
    return
        isset ($_SERVER['HTTP_X_REQUESTED_WITH'])
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function isJson($string): bool
{
    return is_string($string) &&
        (is_object(json_decode($string)) ||
            is_array(json_decode($string)));
}

function objectToArray($data): array
{
    return json_decode(json_encode($data), true);
}

function xmlToArray($xml_string): array
{
    $xml   = simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
    $json  = json_encode($xml);

    return json_decode($json,TRUE);
}

function config($key = null, $default = null)
{
    if ($key == null) {
        return Buffer::instance()->framework_cfg ?? $default;
    }

    $keys    = explode('.', $key);
    $global  = count($keys) <= 1;
    $cfg_key = array_shift($keys);

    $cfg_storage = Buffer::instance()->framework_cfg;

    return $global
        ? $cfg_storage[$cfg_key] ?? $default
        : $cfg_storage[$cfg_key][implode('.', $keys)] ?? $default;
}

function publicPath(): string
{
    return ROOT . 'public' . DIRECTORY_SEPARATOR;
}

function frameworkPath(): string
{
    return ROOT . 'framework' . DIRECTORY_SEPARATOR;
}

function redirect(string $url, int $code = 302): void
{
    SystemMessage::saveMessages();

    header("Location: " . $url, true,
        in_array($code, [300,301,302,303,304,305,306,307,308])
            ? $code : 302);
    exit();
}

function goTo404()
{
    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
    include_once publicPath() . '404.php';
    exit;
}
