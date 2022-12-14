<?php

use DI\ContainerBuilder;
use framework\classes\{Buffer, NE, Log, Url, Benchmark, Session, Routing};
use Illuminate\Database\Capsule\Manager;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/*
+----------------------------------------------------------------------------------------------------
| Без вендоров нет смысла запускать движок
+----------------------------------------------------------------------------------------------------
*/
if (!file_exists(BASE_DIR . '/vendor/autoload.php')) {
    require_once publicPath() . 'install.php';
    die;
}

/*
+----------------------------------------------------------------------------------------------------
| Подключение вендоров
+----------------------------------------------------------------------------------------------------
*/
require_once BASE_DIR . '/vendor/autoload.php';

/*
+----------------------------------------------------------------------------------------------------
| Константы мессенджера
+----------------------------------------------------------------------------------------------------
*/
const MSG_DEFAULT = 0;
const MSG_SUCCESS = 1;
const MSG_WARNING = 2;
const MSG_ERROR   = 3;

try {

    /*
    +----------------------------------------------------------------------------------------------------
    | Метка начала работы приложения
    +----------------------------------------------------------------------------------------------------
    */
    Benchmark::instance()->addMark('_work_start_');

    /*
    +----------------------------------------------------------------------------------------------------
    | Пподключение DotEnv
    +----------------------------------------------------------------------------------------------------
    */
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
    $dotenv->load();

    /*
    +----------------------------------------------------------------------------------------------------
    | DI контейнер с автопоиском
    +----------------------------------------------------------------------------------------------------
    */
    $builder = new ContainerBuilder();
    $builder->useAutowiring(true);
    $app = $builder->build();

    /*
    +----------------------------------------------------------------------------------------------------
    | Сбор конфигов и запись в буффер
    +----------------------------------------------------------------------------------------------------
    */
    $files = array_merge(
        glob(BASE_DIR . 'config/*.php' ?: []),
    );
    $config = array_map(fn($file) => require $file, $files);
    Buffer::instance()->set('framework_cfg', array_merge_recursive(...$config));

    /*
    +----------------------------------------------------------------------------------------------------
    | Настройка логгера
    +----------------------------------------------------------------------------------------------------
    */
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/debug/' . date('Y-m-d', time()) . '.log', Logger::DEBUG));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/info/' . date('Y-m-d', time()) . '.log', Logger::INFO));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/notice/' . date('Y-m-d', time()) . '.log', Logger::NOTICE));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/warning/' . date('Y-m-d', time()) . '.log', Logger::WARNING));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/error/' . date('Y-m-d', time()) . '.log', Logger::ERROR));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/critical/' . date('Y-m-d', time()) . '.log', Logger::CRITICAL));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/alert/' . date('Y-m-d', time()) . '.log', Logger::ALERT));
    Log::instance()->pushHandler(new StreamHandler(BASE_DIR . 'storage/logs/emergency/' . date('Y-m-d', time()) . '.log', Logger::EMERGENCY));

    /*
    +----------------------------------------------------------------------------------------------------
    | Настройка билдэра баз данных и соединений
    +----------------------------------------------------------------------------------------------------
    */
    $dbObj = new Manager();
    foreach ($cfg_storage['connections'] = (include BASE_DIR . 'config' . DIRECTORY_SEPARATOR . 'database.php')['connections'] as $name => $config) {
        $dbObj->addConnection($config, $name);
    }
    $dbObj->setAsGlobal();

    /*
    +----------------------------------------------------------------------------------------------------
    | Настройка почты
    +----------------------------------------------------------------------------------------------------
    */
    $mailer = [];
    foreach (config('mailers') as $name => $box)
    {
        $transport = (new \Swift_SmtpTransport($box['host'], $box['port'], $box['encryption']))
            ->setUsername($box['username'])
            ->setPassword($box['password'])
            ->setAuthMode($box['auth_mode']);

        $mailer[$name] = new Swift_Mailer($transport);
        $mailer[$name]->user_cfg = $box;
    }
    $app->set('smtp', $mailer);

    /*
    +----------------------------------------------------------------------------------------------------
    | Установка типа приложения (разработка или продакшн)
    +----------------------------------------------------------------------------------------------------
    */
    define("PROD", config('sys.production'));

    /*
    +----------------------------------------------------------------------------------------------------
    | Определение локального запуска приожения
    +----------------------------------------------------------------------------------------------------
    */
    define("LOCAL", strpos(NE::getIp(), "127.0.0.") !== false
        || strpos(NE::getIp(), "192.168.0.") !== false
        || strpos(NE::getIp(), "::1") !== false);

    /*
    +----------------------------------------------------------------------------------------------------
    | Старт сессии
    +----------------------------------------------------------------------------------------------------
    */
    if (!session_id()) {
        ini_set('session.save_path', BASE_DIR . '/' . config('sys.site_dir') .'storage/framework/session');

        session_set_cookie_params(config('sys.session_set_cookie_params'));
        ini_set('session.cookie_lifetime', config('sys.session_set_cookie_params'));
        ini_set('session.gc_maxlifetime', config('sys.session_set_cookie_params'));

        session_start();
    }
    if (!isset($_SESSION[config('sys.session_array')])) {
        $_SESSION[config('sys.session_array')] = [];
    }

    /*
    +----------------------------------------------------------------------------------------------------
    | Контроль времени жизни сессии
    +----------------------------------------------------------------------------------------------------
    */
    if (Session::get('lastActivity', true)) {
        $delay = time() - Session::get('lastActivity', true);

        if ($delay >= config('sys.session_set_cookie_params')) {

            session_destroy();
            redirect(Url::siteRoot(), 301);
        }
    }

    /*
    +----------------------------------------------------------------------------------------------------
    | Для продакшена скрываем ошибки, для разработки выводим
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
    | Локаль приложения
    +----------------------------------------------------------------------------------------------------
    */
    setlocale(LC_ALL, "en_US.UTF-8", "English");
    date_default_timezone_set("Europe/Helsinki");

    /*
    +----------------------------------------------------------------------------------------------------
    | Кодировка приложения
    +----------------------------------------------------------------------------------------------------
    */
    header('Content-type: text/html; charset=' . config('sys.charset'));

    /*
    +----------------------------------------------------------------------------------------------------
    | Основные константы
    +----------------------------------------------------------------------------------------------------
    */
    define('LANG', Routing::instance()->getLang());
    define('PROJECT_URL', Url::siteRoot());
    define('ADMIN', Routing::instance()->isAdminSegment());
    define('SITE',
        Url::isAdminPanel()
            ? Url::siteRoot() . config('sys.admin_partition') . '/'
            : Url::siteRoot());
    define('SITE_FOR_STATIC', Url::siteRootForStatic());
    define('SITE_IMG', Url::img());
    define('SITE_CSS', Url::css());
    define('SITE_JS',  Url::js());
    define('AUTH_PROJECT', NE::isUserAuth());

    /*
    +----------------------------------------------------------------------------------------------------
    | Если приложение экстренно выключили - вывести соответствующую страничку
    +----------------------------------------------------------------------------------------------------
    */
    if (config('sys.site_stop') && !Url::isAdminPanel()) {
        include_once (publicPath() . 'site_stop.php');
        die;
    }

    /*
    +----------------------------------------------------------------------------------------------------
    | Логирование посетителей
    +----------------------------------------------------------------------------------------------------
    */
    if (!Url::isAdminPanel()) {
        NE::logVisit();
    }

    /*
    +----------------------------------------------------------------------------------------------------
    | Метка старта работы роутинга
    +----------------------------------------------------------------------------------------------------
    */
    Benchmark::instance()->addMark('_init_route_page_class_');

    /*
    +----------------------------------------------------------------------------------------------------
    | Основная работа роутинга
    +----------------------------------------------------------------------------------------------------
    */
    if (!Routing::instance()->findMatches()) {

        $uri_parts = explode('/', Routing::instance()->getCurrentUri());
        $uri_parts = array_filter($uri_parts, function($e) {
            return !empty($e);
        });

        if (count($uri_parts) > 0) {
            goTo404();
        } else {
            define('PAGE', config('sys.def_page'));
            define('PAGE_METHOD', config('sys.def_method'));
            define('PAGE_QUERY', []);
        }
    } else {

        define('PAGE', Routing::instance()->controller);
        define('PAGE_METHOD', Routing::instance()->method);
        define('PAGE_QUERY', Routing::instance()->parameters);
    }

    ob_start();
    Routing::instance()->setNamespace(Url::isAdminPanel()
        ? '\\admin\\controllers'
        : '\\app\\controllers');
    Routing::instance()->run(PAGE, PAGE_METHOD, PAGE_QUERY);
    echo ob_get_clean();

    /*
    +----------------------------------------------------------------------------------------------------
    | Метка завершения работы приложения
    +----------------------------------------------------------------------------------------------------
    */
    Benchmark::instance()->addMark('_work_end_');

    /*
    +----------------------------------------------------------------------------------------------------
    | Вывод дебаг информации для режима разработки
    +----------------------------------------------------------------------------------------------------
    */
    if (config('sys.debug') === true) {
        $marks = Benchmark::instance()->calcAndGet();

        ob_start();?>
        <div style="width: 70%; margin: 10px auto; text-align: center">
            <hr />
            <b>Site was loaded by</b> <?= Benchmark::instance()->elapsedTime() ?> seconds
            <hr />
            <b>Memory used</b> <?= Benchmark::instance()->memoryUse() ?> MB
            <hr />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Mark</th>
                    <th>Load time</th>
                    <th>Total load</th>
                    <th>Total memory</th>
                </tr>
                <tr><td colspan="4"><hr /></td></tr>
                <?php foreach ($marks as $k => $v): ?>
                    <tr>
                        <td><?= $k ?></td>
                        <td><?= number_format($v['load_mark'], 3) ?> sec.</td>
                        <td><?= number_format($v['load_total'], 3) ?> sec.</td>
                        <td><?= number_format($v['memory'], 2) ?> MB</td>
                    </tr>
                    <tr><td colspan="4"><hr /></td></tr>
                <?php endforeach; ?>
            </table>
            <hr />
        </div>
        <?= ob_get_clean();
    }
} catch (Error $e) {
    NE::logSystemError($e, 'error');
} catch (Exception $e) {
    NE::logSystemError($e, 'exception');
} catch (Throwable $e) {
    NE::logSystemError($e, 'throw');
}
