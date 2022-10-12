<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 01.12.2021
 * Time: 11:00
 */

/*
+----------------------------------------------------------------------------------------------------
| Platform version ( Not change! Setting by author )
+----------------------------------------------------------------------------------------------------
*/
const VERSION = 'NothingExtra v.0.8.1';

/*
+----------------------------------------------------------------------------------------------------
| Site root ( in file system )
+----------------------------------------------------------------------------------------------------
*/
const ROOT = __DIR__ . DIRECTORY_SEPARATOR;

define('BASE_DIR', dirname(realpath(__FILE__)) . DIRECTORY_SEPARATOR);
define('APP_BASE_PATH', '/' . basename(__DIR__) . '/');

require BASE_DIR . 'framework/global.php';
require BASE_DIR . 'bootstrap/app.php';
