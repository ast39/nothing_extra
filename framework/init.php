<?php

use framework\classes\Routing;

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
use framework\classes\{NE, Url, Benchmark, Session};

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
        redirect(Url::siteRoot(), 301);
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
if (Routing::getInstance()->isAdminSegment()) {
    define('ADMIN', true);
}

/*
+----------------------------------------------------------------------------------------------------
| General route constants
+----------------------------------------------------------------------------------------------------
*/
define('LANG', Routing::getInstance()->getLang());
define('PROJECT_URL', Url::siteRoot());
define('SITE',
    defined('ADMIN')
        ? Url::siteRoot() . config('options.admin_partition') . '/'
        : Url::siteRoot());
define('SITE_FOR_STATIC', Url::siteRootForStatic());

define('SITE_IMG', Url::img());
define('SITE_CSS', Url::css());
define('SITE_JS',  Url::js());
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
if (file_exists(publicPath() . 'install.php') && !Url::isAdminPanel()) {
    require_once publicPath() . 'install.php';

    die;
}

/*
+----------------------------------------------------------------------------------------------------
| Site stop checking
+----------------------------------------------------------------------------------------------------
*/
if (config('options.site_stop') && !Url::isAdminPanel()) {
    include_once (publicPath() . 'site_stop' . EXT);

    die;
}

/*
+----------------------------------------------------------------------------------------------------
| Visit log
+----------------------------------------------------------------------------------------------------
*/
if (!Url::isAdminPanel()) {
    NE::logVisit();
}

/*
+----------------------------------------------------------------------------------------------------
| Route rules
+----------------------------------------------------------------------------------------------------
*/
Benchmark::getInstance()->addMark('_init_route_page_class_');

if (!Routing::getInstance()->findMatches()) {

    $uri_parts = explode('/', Routing::getInstance()->getCurrentUri());
    $uri_parts = array_filter($uri_parts, function($e) {
        return !empty($e);
    });

    if (count($uri_parts) > 0) {
        goTo404();
    } else {
        define('PAGE', config('options.def_page'));
        define('PAGE_METHOD', config('options.def_method'));
        define('PAGE_QUERY', []);
    }
} else {

    define('PAGE', Routing::getInstance()->controller);
    define('PAGE_METHOD', Routing::getInstance()->method);
    define('PAGE_QUERY', Routing::getInstance()->parameters);
}

ob_start();
Routing::getInstance()->setNamespace(defined('ADMIN')
    ? '\\admin\\controllers'
    : '\\app\\controllers');
Routing::getInstance()->run(PAGE, PAGE_METHOD, PAGE_QUERY);
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
