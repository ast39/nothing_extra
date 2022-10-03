<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 01.12.2021
 * Time: 11:00
 */

spl_autoload_register(function ($class)
{
    $class = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . $class . '.php';

    if (file_exists($path))
        require_once $path;
});

spl_autoload_register(function ($class)
{
    $class = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . DIRECTORY_SEPARATOR
        . 'classes' . DIRECTORY_SEPARATOR
        . $class . '.php';

    if (file_exists($path))
        require_once $path;
});

spl_autoload_register(function ($class)
{
    $class = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . DIRECTORY_SEPARATOR
        . 'modules' . DIRECTORY_SEPARATOR
        . $class . '.php';

    if (file_exists($path))
        require_once $path;
});

spl_autoload_register(function ($class)
{
    $class = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . 'public' . DIRECTORY_SEPARATOR
        . 'classes' . DIRECTORY_SEPARATOR
        . $class . '.php';

    if (file_exists($path))
        require_once $path;
});
