<?php

namespace framework\classes;


class Route {

    /**
     * Default controller partition
     */
    const CONTROLLER_PARTITION = 0;

    /**
     * Default method partition
     */
    const METHOD_PARTITION     = 1;

    /**
     * Default parameters partition
     */
    const PARAMETERS_PARTITION = 2;

    public static $without_index      = false;
    public static $replace_controller = false;


    /**
     * Site folder, if site in folder
     *
     * @return bool|null
     */
    public static function sitePath()
    {
        return
            config('options.site_dir') ?: false;
    }

    /**
     * Current site language version
     *
     * @return string|null
     */
    public static function pageLang()
    {
        switch (true) {

            case self::siteInPath() && self::validLang()  :
                return self::urlPathElement(1);
            case !self::siteInPath() && self::validLang() :
                return self::urlPathElement(0);
            default :
                return config('options.def_lang');
        }
    }

    /**
     * Current page controller
     *
     * @return string
     */
    public static function pageController()
    {
        return
            self::$replace_controller
                ? self::$replace_controller
                : (self::urlPathElement(self::CONTROLLER_PARTITION + self::indexCorrection())
                ?? config('options.def_page'));
    }

    /**
     * Current page controller method
     *
     * @return string
     */
    public static function pageMethod()
    {
        return
            self::$without_index
                ? config('options.def_method')
                : (self::urlPathElement(self::METHOD_PARTITION + self::indexCorrection())
                ?? config('options.def_method'));
    }

    /**
     * Current parameters for page controller method
     *
     * @return array|null
     */
    public static function pageParameters()
    {
        return
            self::urlPathElement($index = self::PARAMETERS_PARTITION + self::indexCorrection() - self::withoutIndex() - self::withoutController())
                ? array_slice(self::allQueryData(), $index)
                : null;
    }


    /**
     * Site scheme
     *
     * @return string
     */
    public static function scheme()
    {
        return
            (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' ?? null;
    }

    /**
     * Site host
     *
     * @return null
     */
    public static function host()
    {
        return
            $_SERVER['HTTP_HOST']
            ?? null;
    }

    /**
     * Request uri
     *
     * @return null
     */
    public static function path()
    {
        return
            $_SERVER['REQUEST_URI']
            ?? null;
    }

    /**
     * Full current URL
     *
     * @return string
     */
    public static function fullUrl()
    {
        return
            self::scheme() . self::host() . self::path();
    }

    /**
     * Site URL without language version
     *
     * @return string
     */
    public static function siteRootForStatic()
    {
        return
            self::scheme() . self::host() . '/' . (self::sitePath() ? self::sitePath() . '/' : false);
    }

    /**
     * Site URL with language version
     *
     * @return string
     */
    public static function siteRoot()
    {
        return
            self::siteRootForStatic() . (self::multiLang() ? self::pageLang() . '/' : false);
    }

    /**
     * Correct redirect
     *
     * @param $url
     * @param int $code
     */
    public static function redirect($url, $code = 302)
    {
        SystemMessage::saveMessages();

        header("Location: " . $url, true,
            in_array($code, [300,301,302,303,304,305,306,307,308])
                ? $code : 302);
        exit();
    }


    /**
     * Requested URL path element
     *
     * @param int $number
     * @return null
     */
    private static function urlPathElement(int $number)
    {
        return
            isset(self::allQueryData()[$number])
                ? strtolower(self::allQueryData()[$number])
                : null;
    }

    /**
     * Requested URL as array
     *
     * @return array
     */
    private static function allQueryData()
    {
        if (!empty(self::path())) {

            $data = explode('/', substr(self::path(), 1));

            return array_values(array_filter($data, function($element) {
                return !empty($element);
            }));
        }

        return [];
    }

    /**
     * Is the site in folder
     *
     * @return bool
     */
    private static function siteInPath()
    {
        return (bool)config('options.site_dir') ?: false;
    }

    /**
     * Is the site multilingual?
     *
     * @return bool
     */
    private static function multiLang()
    {
        return (bool)config('options.multi_lang') ?: false;
    }

    /**
     * Is language version valid
     *
     * @return bool
     */
    private static function validLang()
    {
        return
            self::multiLang()
                ? in_array(self::allQueryData()[self::siteInPath() ? 1 : 0] ?? null, config('options.site_langs'))
                : false;

    }

    /**
     * Is this request to site admin panel
     *
     * @return bool
     */
    public static function adminFolder()
    {
        return
            (bool)isset(self::allQueryData()[$index = abs(self::siteInPath()) + abs(self::validLang())])
                ? self::allQueryData()[$index]  == str_ireplace('/', '', config('options.admin_partition'))
                : false;
    }

    /**
     * Check routing rules and find rule by pattern
     *
     * @param array $route_cfg
     * @return array|null
     */
    public static function findRouteRule(array $route_cfg):? array
    {
        # получим тип метода запроса
        $request_method = $_SERVER['REQUEST_METHOD'] ?? null;

        # получим URL запроса
        $url_query      = self::pageController() . '/' . self::pageMethod();
        $url_query     .= count(self::pageParameters() ?: []) > 0 ? '/' . implode('/', self::pageParameters()) : '';

        # ищем в конфиге роутинга
        foreach ($route_cfg as $rule) {

            $rule_obj = new RouteRule($rule);

            # если метод правила не совпадает с методом запроса - пропускаем итерацию
            if (strtoupper($request_method) != strtoupper($rule_obj->requestMethod())) {
                continue;
            }

            # если в URL не встречается такой шаблон - пропускаем итерацию
            if (stripos($url_query, $rule_obj->softPattern()) === false) {
                continue;
            }

            # убираем из URL найденный шаблон правила, чтобы понять что останется
            $tmp_url_query = $rule_obj->removePatternFromUrl($url_query);

            # выявим, что из URL является префиксом, а что данными
            $arr_tmp_url_query = explode('@', $tmp_url_query);
            $url_prefix = $arr_tmp_url_query[0] ?? null;
            $url_data   = $arr_tmp_url_query[1] ?? null;

            # если должен быть префикс, а его нет или не должно быть префикса, а он есть - пропускаем итерацию
            if (($rule_obj->prefixRequired() === true && empty($url_prefix))
                || ($rule_obj->prefixRequired() === false && !empty($url_prefix))) {
                continue;
            }

            # если должны быть параметры, а их нет или не должно быть параметров, а они есть - пропускаем итерацию
            if (($rule_obj->paramsRequired() === true && empty($url_data))
                || ($rule_obj->paramsRequired() === false && !empty($url_data))) {
                continue;
            }

            return [

                'class'      => $rule_obj->detectController($url_prefix, $url_data),
                'method'     => $rule_obj->detectMethod($url_prefix, $url_data),
                'parameters' => explode('/', $url_data)
            ];
        }

        return null;
    }

    /**
     * Shift correction along the site partition to determine the basic routing elements
     *
     * @return int
     */
    private static function indexCorrection()
    {
        return
            + abs(self::siteInPath() ?: 0)
            + abs(self::adminFolder() ?: 0)
            + abs(self::validLang() ?: 0);
    }

    /**
     * Check mark about without index
     *
     * @return int
     */
    public static function withoutIndex()
    {
        return self::$without_index == true ? 1 : 0;
    }

    /**
     * Check mark about without controller
     *
     * @return int
     */
    public static function withoutController()
    {
        return self::$replace_controller == false ? 0 : 1;
    }
}