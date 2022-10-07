<?php

namespace framework\classes;

use framework\traits\Singleton;


class Routing {

    use Singleton;


    private $route_rules      = [];

    private $base_route       = '';

    private $requested_method = '';

    private $namespace        = '';

    private $server_base_path;

    private $target_route;


    public $controller;

    public $method;

    public $parameters;


    /**
     * Найти совпадение по шаблонам роутингов
     *
     * @return bool
     */
    public function findMatches():? bool
    {
        include ROOT . 'routes' . DIRECTORY_SEPARATOR . 'admin' . EXT;
        include ROOT . 'routes' . DIRECTORY_SEPARATOR . 'web' . EXT;

        $this->requested_method = $this->getRequestMethod();
        $uri = $this->getCurrentUri();

        if (isset($this->route_rules[$this->requested_method])) {

            foreach ($this->route_rules[$this->requested_method] as $route) {

                $is_match = $this->patternMatches($route['pattern'], $uri, $matches);

                if ($is_match) {

                    $matches = array_slice($matches, 1);

                    $parameters = array_map(function ($match, $index) use ($matches) {

                        if (isset($matches[$index + 1]) && isset($matches[$index + 1][0]) && is_array($matches[$index + 1][0])) {

                            if ($matches[$index + 1][0][1] > -1) {
                                return trim(substr($match[0][0], 0, $matches[$index + 1][0][1] - $match[0][1]), '/');
                            }
                        }

                        return
                            isset($match[0][0]) && $match[0][1] != -1
                                ? trim($match[0][0], '/')
                                : null;

                    }, $matches, array_keys($matches));

                    list($controller, $method) = explode('@', $route['action']);

                    $this->controller   = $controller;
                    $this->method       = $method;
                    $this->parameters   = $parameters;
                    $this->target_route = $route;

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check route middlewares
     *
     * @return void
     */
    private function checkMiddlewares(): void
    {
        if (count($this->target_route['before'] ?? []) > 0) {

            foreach ($this->target_route['before'] as $mw) {

                $middleware = '\\app\\middlewares\\' . $mw;

                try {
                    $reflectedMethod = new \ReflectionMethod($middleware, 'handle');

                    if ($reflectedMethod->isPublic() && (!$reflectedMethod->isAbstract())) {

                        if ($reflectedMethod->isStatic()) {
                            forward_static_call_array([$middleware, 'handle'], []);
                        } else {

                            if (\is_string($middleware)) {
                                $middleware = new $middleware();
                            }

                            call_user_func_array([$middleware, 'handle'], []);
                        }
                    }
                } catch (\ReflectionException $reflectionException) {

                    NE::logSystemError($reflectionException, 'error');
                    goTo404();
                }
            }
        }
    }

    /**
     * Run NE
     *
     * @param string $controller
     * @param string $method
     * @param array $parameters
     * @return void
     */
    public function run(string $controller, string $method, ?array $parameters = null): void
    {
        $this->checkMiddlewares();

        if ($this->getNamespace() !== '') {
            $controller = $this->getNamespace() . '\\' . $controller;
        }

        try {
            $reflectedMethod = new \ReflectionMethod($controller, $method);

            if ($reflectedMethod->isPublic() && (!$reflectedMethod->isAbstract())) {

                if ($reflectedMethod->isStatic()) {
                    forward_static_call_array([$controller, $method], $parameters);
                } else {

                    if (\is_string($controller)) {
                        $controller = new $controller();
                    }

                    call_user_func_array([$controller, $method], $parameters);
                }
            }
        } catch (\ReflectionException $reflectionException) {

            NE::logSystemError($reflectionException, 'error');
            goTo404();
        }
    }

    public function group(array $routeArgs, $action): void
    {
        $baseRoute         = $routeArgs['prefix'];
        $curBaseRoute      = $this->base_route;
        $this->base_route .= '/' . $baseRoute;

        call_user_func($action, $routeArgs['middleware'] ?? null);

        $this->base_route = $curBaseRoute;
    }

    public function request($methods, $pattern, $action): void
    {
        $methods = explode('|', strtoupper($methods));

        array_walk($methods, function ($e) use ($pattern, $action) {
            $this->$e($pattern, $action);
        });
    }

    /**
     * Добавление рота на метод GET
     *
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function get(string $pattern, $action): void
    {
        $this->match('GET', $pattern, $action);
    }

    /**
     * Добавление рота на метод POST
     *
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function post(string $pattern, $action): void
    {
        $this->match('POST', $pattern, $action);
    }

    /**
     * Добавление рота на метод PUR
     *
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function put(string $pattern, $action): void
    {
        $this->match('PUT', $pattern, $action);
    }

    /**
     * Добавление рота на метод PATCH
     *
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function patch(string $pattern, $action): void
    {
        $this->match('PATCH', $pattern, $action);
    }

    /**
     * Добавление рота на метод DELETE
     *
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function delete(string $pattern, $action): void
    {
        $this->match('DELETE', $pattern, $action);
    }

    /**
     * Добавление рота на метод OPTIONS
     *
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function options(string $pattern, $action): void
    {
        $this->match('OPTIONS', $pattern, $action);
    }

    /**
     * Коллекция роутов для обработки
     *
     * @param string $methods
     * @param string $pattern
     * @param $action
     * @return void
     */
    public function match(string $methods, string $pattern, $action): void
    {
        $pattern = $this->base_route . '/' . trim($pattern, '/');
        $pattern = $this->base_route
            ? rtrim($pattern, '/')
            : $pattern;

        foreach (explode('|', $methods) as $method) {
            $this->route_rules[$method][] = [

                'pattern' => $pattern,
                'action'  => $action['uses']       ?? $action,
                'before'  => $action['middleware'] ?? null,
            ];
        }
    }

    public function getRequestMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_start();

            $method = 'GET';
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $headers = $this->getRequestHeaders();

            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], ['PUT', 'DELETE', 'PATCH'])) {
                $method = $headers['X-HTTP-Method-Override'];
            }
        }

        return $method;
    }

    public function getRequestHeaders()
    {
        $headers = [];

        if (function_exists('getallheaders')) {
            $headers = getallheaders();

            if ($headers !== false) {
                return $headers;
            }
        }

        foreach ($_SERVER as $name => $value) {

            if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {
                $headers[str_replace([' ', 'Http'], ['-', 'HTTP'], ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }

    public function getCurrentUri()
    {
        $uri = substr(rawurldecode($_SERVER['REQUEST_URI']), strlen($this->getBasePath()));

        $lang = $this->getLang();
        foreach ($uri_arr = explode('/', $uri) as $key => $part) {
            if ($part == $lang) {
                unset($uri_arr[$key]);
            }
        }
        $uri = implode('/', array_values($uri_arr));

        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        return '/' . trim($uri, '/');
    }

    public function getLang()
    {
        if (count(config('options.site_langs') ?? []) < 2) {
            return config('options.def_lang');
        }

        $maybe_lang = array_slice(
            explode('/', substr(
                rawurldecode($_SERVER['REQUEST_URI']), strlen($this->getBasePath()))), 0, 1)[0];

        return in_array($maybe_lang, config('options.site_langs'))
            ? $maybe_lang
            : config('options.def_lang');
    }

    public function getBasePath()
    {
        if ($this->server_base_path === null) {
            $this->server_base_path = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        }

        return $this->server_base_path;
    }

    private function patternMatches($pattern, $uri, &$matches)
    {
        $pattern = preg_replace('/\/{(.*?)}/', '/(.*?)', $pattern);

        return boolval(preg_match_all('#^' . strtolower($pattern) . '$#', strtolower($uri), $matches, PREG_OFFSET_CAPTURE));
    }

    /**
     * Set namespace
     *
     * @param string $namespace
     * @return void
     */
    public function setNamespace(string $namespace): void
    {
        if (is_string($namespace)) {
            $this->namespace = $namespace;
        }
    }

    /*
     * Get namespace
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Is Admin Route ?
     *
     * @return bool
     */
    public function isAdminSegment(): bool
    {
        return in_array(config('options.admin_partition'), explode('/', $this->getCurrentUri()));
    }

}