<?php

/*
+----------------------------------------------------------------------------------------------------
| Access control
+----------------------------------------------------------------------------------------------------
*/
if ( ! defined('VERSION')) exit('Not access');

/*
+----------------------------------------------------------------------------------------------------
| Used libraries
+----------------------------------------------------------------------------------------------------
*/
use framework\classes\{NE, Route, Benchmark, Session};

/*
+----------------------------------------------------------------------------------------------------
| Start time mark
+----------------------------------------------------------------------------------------------------
*/
Benchmark::getInstance()->addMark('_work_start_');

/*
+----------------------------------------------------------------------------------------------------
| Session start
+----------------------------------------------------------------------------------------------------
*/
if (!session_id()) {
    ini_set('session.save_path', ROOT . '/' . config('options.site_dir') .'storage/framework/session');

    session_set_cookie_params(config('options.session_set_cookie_params'));
    ini_set('session.cookie_lifetime', config('options.session_set_cookie_params'));
    ini_set('session.gc_maxlifetime', config('options.session_set_cookie_params'));

    session_start();
}

/*
+----------------------------------------------------------------------------------------------------
| Framework inside Session
+----------------------------------------------------------------------------------------------------
*/
if (!isset($_SESSION[config('options.session_array')])) {
    $_SESSION[config('options.session_array')] = [];
}

/*
+----------------------------------------------------------------------------------------------------
| Session life time control
+----------------------------------------------------------------------------------------------------
*/
if (Session::get('lastActivity', true)) {
    $delay = time() - Session::get('lastActivity', true);

    if ($delay >= config('options.session_set_cookie_params')) {

        session_destroy();
        Route::redirect(Route::siteRoot(), 301);
    }
}

/*
+----------------------------------------------------------------------------------------------------
| Error display settings
+----------------------------------------------------------------------------------------------------
*/
if (PROD) {

    error_reporting(0);
    ini_set('display_errors', false);
} else {

    error_reporting(E_ALL);
    ini_set('display_errors', true);
}

/*
+----------------------------------------------------------------------------------------------------
| Locale settings
+----------------------------------------------------------------------------------------------------
*/
setlocale(LC_ALL, "en_US.UTF-8", "English");
date_default_timezone_set("Europe/Helsinki");

/*
+----------------------------------------------------------------------------------------------------
| Charset settings
+----------------------------------------------------------------------------------------------------
*/
header('Content-type: text/html; charset=' . config('options.charset'));

/*
+----------------------------------------------------------------------------------------------------
| Check for admin path
+----------------------------------------------------------------------------------------------------
*/
if (Route::adminFolder()) {
    define('ADMIN', true);
}

/*
+----------------------------------------------------------------------------------------------------
| General route parts
+----------------------------------------------------------------------------------------------------
*/
$prefix          = '';
$page_class      = Route::pageController();
$page_method     = Route::pageMethod();
$page_parameters = Route::pageParameters();
define('LANG', strtolower(Route::pageLang()));

/*
+----------------------------------------------------------------------------------------------------
| General route constants
+----------------------------------------------------------------------------------------------------
*/
define('PROJECT_URL', Route::siteRoot());
define('SITE',
    defined('ADMIN')
        ? Route::siteRoot() . config('options.admin_partition')
        : Route::siteRoot());
define('SITE_FOR_STATIC', Route::siteRootForStatic());

define('SITE_IMG', str_replace(config('options.admin_partition'), '', SITE_FOR_STATIC) . 'public/img/');
define('SITE_CSS', str_replace(config('options.admin_partition'), '', SITE_FOR_STATIC) . 'public/css/');
define('SITE_JS',  str_replace(config('options.admin_partition'), '', SITE_FOR_STATIC) . 'public/js/');
define('AUTH_PROJECT', NE::isUserAuth());

/*
+----------------------------------------------------------------------------------------------------
| Msg type constants
+----------------------------------------------------------------------------------------------------
*/
const MSG_DEFAULT = 0;
const MSG_SUCCESS = 1;
const MSG_WARNING = 2;
const MSG_ERROR   = 3;

/*
+----------------------------------------------------------------------------------------------------
| First run page
+----------------------------------------------------------------------------------------------------
*/
if (file_exists(publicPath() . 'install.php') && !Route::adminFolder()) {
//    require_once publicPath() . 'install.php';

//    die;
}

/*
+----------------------------------------------------------------------------------------------------
| Site stop checking
+----------------------------------------------------------------------------------------------------
*/
if (config('options.site_stop') && !defined('ADMIN')) {
    include_once (publicPath() . 'site_stop' . EXT);

    die;
}

/*
+----------------------------------------------------------------------------------------------------
| Visit log
+----------------------------------------------------------------------------------------------------
*/
if (!defined('ADMIN') && $page_class != 'i') {
    NE::logVisit();
}

/*
+----------------------------------------------------------------------------------------------------
| Route rules
+----------------------------------------------------------------------------------------------------
*/
$route_cfg = config('routes');

if (($route = Route::findRouteRule($route_cfg)) !== NULL && !defined('ADMIN')) {

    $page_class      = $route['class'];
    $page_method     = $route['method'];
    $page_parameters = $route['parameters'];
}


/*
+----------------------------------------------------------------------------------------------------
| Find target class controller
+----------------------------------------------------------------------------------------------------
*/
$namespace_class = defined('ADMIN')
    ? "\\admin\\controllers\\" . ucfirst($page_class)
    : "\\app\\controllers\\" . ucfirst($page_class);

Benchmark::getInstance()->addMark('_class_checker_');

/*
+----------------------------------------------------------------------------------------------------
| If controller not found, then 404
+----------------------------------------------------------------------------------------------------
*/
if (!class_exists($namespace_class)) {
    noController($page_class);
}

define('PAGE', strtolower($page_class));

/*
+----------------------------------------------------------------------------------------------------
| If controller isset, call it
+----------------------------------------------------------------------------------------------------
*/
$page = new $namespace_class();

/*
+----------------------------------------------------------------------------------------------------
| If method not found, then 404
+----------------------------------------------------------------------------------------------------
*/
if (!method_exists($page, $page_method)) {
    noMethod($page_method);
}

define('PAGE_METHOD', strtolower($page_method));
define('PAGE_QUERY', $page_parameters);
define('SITE_QUERY', Route::fullUrl());

Benchmark::getInstance()->addMark('_init_route_page_class_');

/*
+----------------------------------------------------------------------------------------------------
| If method isset, call it
+----------------------------------------------------------------------------------------------------
*/
ob_start();
if ($page_parameters == null) {
    $page->$page_method();
} else {
    call_user_func_array([$page, $page_method], $page_parameters);
}

echo ob_get_clean();

/*
+----------------------------------------------------------------------------------------------------
| Loading time mark
+----------------------------------------------------------------------------------------------------
*/
Benchmark::getInstance()->addMark('_work_end_');

/*
+----------------------------------------------------------------------------------------------------
| Debug info
+----------------------------------------------------------------------------------------------------
*/
if (config('options.debug') === true) {

    echo '<hr /><b>Site was loaded by</b> ' . Benchmark::getInstance()->elapsedTime()
        . ' seconds<hr /><b>Memory used</b> ' . Benchmark::getInstance()->memoryUse() . ' MB<hr />';

    if (isset($_GET['marks'])) {

        $marks = Benchmark::getInstance()->calcAndGet();
        ob_start();?>
        <table width="100%" border="1" cellpadding="6" cellspacing="2">
            <tr>
                <th>Mark</th>
                <th>Load time</th>
                <th>Total load</th>
                <th>Total memory</th>
            </tr>
            <?php foreach ($marks as $k => $v): ?>
                <tr>
                    <td><?= $k ?></td>
                    <td><?= number_format($v['load_mark'], 3) ?> sec.</td>
                    <td><?= number_format($v['load_total'], 3) ?> sec.</td>
                    <td><?= number_format($v['memory'], 2) ?> MB</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= ob_get_clean();

        echo '<hr />';
    }
}
