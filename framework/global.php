<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 25.09.2019
 * Time: 10:23
 */


use framework\classes\{NE, Buffer};


function xmp($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function printSession()
{
    xmp($_SESSION);
}

function printPost()
{
    xmp($_POST);
}

function printClassMethods($class)
{
    xmp(get_class_methods($class));
}

function printMethodParams()
{
    xmp(func_get_args());
}

function requestType()
{
    return $_SERVER['REQUEST_METHOD'] ?? 'GET';
}

function isAjax()
{
    return
        isset ($_SERVER['HTTP_X_REQUESTED_WITH'])
        && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function isJson($string)
{
    return is_string($string) &&
        (is_object(json_decode($string)) ||
            is_array(json_decode($string)));
}

function objectToArray($data)
{
    return json_decode(json_encode($data), true);
}

function xmlToArray($xml_string)
{
    $xml   = simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
    $json  = json_encode($xml);

    return json_decode($json,TRUE);
}

function noController($page_class)
{
    if  ($page_class != 'i' && stripos($page_class, 'apple-touch-icon') === false) {
        NE::logSystemError('Controller not found: ' . $page_class);
    }

    NE::goTo404();
}

function noMethod($page_method)
{
    NE::logSystemError('Method not found: ' . $page_method);
    NE::goTo404();
}

function config($key = null, $default = null)
{
    if ($key == null) {
        return Buffer::getInstance()->framework_cfg ?? $default;
    }

    $keys    = explode('.', $key);
    $global  = count($keys) <= 1;
    $cfg_key = array_shift($keys);

    $cfg_storage = \framework\classes\Buffer::getInstance()->framework_cfg;

    return $global
        ? $cfg_storage[$cfg_key] ?? $default
        : $cfg_storage[$cfg_key][implode('.', $keys)] ?? $default;
}

function publicPath()
{
    return ROOT . 'public' . DIRECTORY_SEPARATOR;
}

function frameworkPath()
{
    return ROOT . 'framework' . DIRECTORY_SEPARATOR;
}
