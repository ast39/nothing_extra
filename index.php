<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 01.12.2021
 * Time: 11:00
 */

use framework\classes\{Buffer, NE};
use Illuminate\Database\Capsule\Manager as Capsule;

/*
+----------------------------------------------------------------------------------------------------
| Platform version ( Not change! Setting by author )
+----------------------------------------------------------------------------------------------------
*/
const VERSION = 'NothingExtra v.4.0.0';

/*
+----------------------------------------------------------------------------------------------------
| Site root ( in file system )
+----------------------------------------------------------------------------------------------------
*/
const ROOT = __DIR__ . DIRECTORY_SEPARATOR;

/*
+----------------------------------------------------------------------------------------------------
| Project general files type ( usually .php )
+----------------------------------------------------------------------------------------------------
*/
const EXT = '.php';

/*
+----------------------------------------------------------------------------------------------------
| Global function
+----------------------------------------------------------------------------------------------------
*/
require_once ROOT . 'framework' . DIRECTORY_SEPARATOR . 'global' . EXT;

/*
+----------------------------------------------------------------------------------------------------
| Local autoloader
+----------------------------------------------------------------------------------------------------
*/
if (file_exists(frameworkPath() . 'autoloader.php')) {
    include_once frameworkPath() . 'autoloader.php';
}

/*
+----------------------------------------------------------------------------------------------------
| Vendor autoloader
+----------------------------------------------------------------------------------------------------
*/
if (file_exists(ROOT . '/vendor/autoload.php')) {
    require_once ROOT . '/vendor/autoload.php';
}

/*
+----------------------------------------------------------------------------------------------------
| Config temp container
+----------------------------------------------------------------------------------------------------
*/
$cfg_storage = [];

/*
+----------------------------------------------------------------------------------------------------
| Framework config settings
+----------------------------------------------------------------------------------------------------
*/
$cfg_storage['options'] = (include ROOT . 'config'. DIRECTORY_SEPARATOR . 'options' . EXT)['options'];
Buffer::getInstance()->framework_cfg = $cfg_storage;

/*
+----------------------------------------------------------------------------------------------------
| Database config settings
+----------------------------------------------------------------------------------------------------
*/
if (file_exists(ROOT . 'vendor/illuminate/database/Capsule/Manager.php')) {

    $dbObj = new Capsule();

    foreach ($cfg_storage['connections'] = (include ROOT . 'config' . DIRECTORY_SEPARATOR . 'database' . EXT)['connections'] as $name => $config) {
        $dbObj->addConnection($config, $name);
    }

    $dbObj->setAsGlobal();

    Buffer::getInstance()->framework_cfg = $cfg_storage;
}

/*
+----------------------------------------------------------------------------------------------------
| Mailer config settings
+----------------------------------------------------------------------------------------------------
*/
if (file_exists(ROOT . 'vendor/swiftmailer/swiftmailer/lib/classes/Swift/SmtpTransport.php')) {

    $mailer = [];
    foreach ($cfg_storage['mailers'] = (include ROOT . 'config' . DIRECTORY_SEPARATOR . 'mail' . EXT)['mailers'] as $name => $box) {

        $transport = (new \Swift_SmtpTransport($box['host'], $box['port'], $box['encryption']))
            ->setUsername($box['username'])
            ->setPassword($box['password'])
            ->setAuthMode($box['auth_mode']);

        $mailer[$name] = new Swift_Mailer($transport);
        $mailer[$name]->user_cfg = $box;
    }

    $cfg_storage['mailer_factory'] = $mailer;
    Buffer::getInstance()->framework_cfg = $cfg_storage;
}

/*
+----------------------------------------------------------------------------------------------------
| Routing config settings
+----------------------------------------------------------------------------------------------------
*/
$cfg_storage['routes'] = (include ROOT . 'config'. DIRECTORY_SEPARATOR . 'routing' . EXT)['routes'];
Buffer::getInstance()->framework_cfg = $cfg_storage;

/*
+----------------------------------------------------------------------------------------------------
| Listing config
+----------------------------------------------------------------------------------------------------
*/
$configs = scandir(ROOT . 'config');
$configs = array_filter($configs, function($e) {
    return !in_array($e, ['.', '..', 'database' . EXT, 'mail' . EXT, 'routing' . EXT, 'options' . EXT,]);
});

foreach ($configs as $file) {
    $cfg_storage[str_ireplace(EXT, '', $file)] = include ROOT . 'config' . DIRECTORY_SEPARATOR . $file;
}

Buffer::getInstance()->framework_cfg = $cfg_storage;

/*
+----------------------------------------------------------------------------------------------------
| Production mode ( on / off )
+----------------------------------------------------------------------------------------------------
*/
define("PROD", config('options.production'));

/*
+----------------------------------------------------------------------------------------------------
| Local site running
+----------------------------------------------------------------------------------------------------
*/
define("LOCAL", strpos(NE::getIp(), "127.0.0.") !== false
    || strpos(NE::getIp(), "192.168.0.") !== false
    || strpos(NE::getIp(), "::1") !== false);

/*
+----------------------------------------------------------------------------------------------------
| Initialization
+----------------------------------------------------------------------------------------------------
*/
if (PROD) {
    try {
        require_once frameworkPath() . 'init' . EXT;
    } catch (Error $e) {
        NE::logSystemError($e, 'error');
    } catch (Exception $e) {
        NE::logSystemError($e, 'exception');
    } catch (Throwable $e) {
        NE::logSystemError($e, 'throw');
    }
} else {
    require_once frameworkPath() . 'init' . EXT;
}
