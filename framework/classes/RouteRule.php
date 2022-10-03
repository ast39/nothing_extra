<?php


namespace framework\classes;


class RouteRule {

    const SOME_PREFIX = '{prefix}';
    const SOME_DATA   = '{data}';

    private $rule;

    public function __construct(array $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @return string
     */
    public function requestMethod(): string
    {
        return $this->rule['method'] ?? '';
    }

    /**
     * @return bool
     */
    public function prefixRequired(): bool
    {
        $pattern_arr = explode('/', $this->pattern());

        return reset($pattern_arr) == self::SOME_PREFIX;
    }

    /**
     * @return bool
     */
    public function paramsRequired(): bool
    {
        $pattern_arr = explode('/', $this->pattern());

        return end($pattern_arr) == self::SOME_DATA;
    }

    /**
     * @return string
     */
    public function pattern(): string
    {
        return $this->rule['pattern'] ?? '';
    }

    /**
     * @return string
     */
    public function softPattern(): string
    {
        $pattern_arr = explode('/', $this->pattern());

        if ($this->prefixRequired() === true) {
            array_shift($pattern_arr);
        }

        if ($this->paramsRequired() === true) {
            array_pop($pattern_arr);
        }

        # собираем новую строку шаблон правила из сегментов
        return implode('/', $pattern_arr);
    }

    /**
     * @return string
     */
    public function action(): string
    {
        return $this->rule['action'] ?? '';
    }

    /**
     * @param string $url_prefix
     * @param string $url_params
     * @return string
     */
    public function detectController(string $url_prefix, string $url_params): string
    {
        $action_arr = explode('@', $this->action());
        $target_controller = $action_arr[0] ?? 'ActionController';

        return $target_controller == self::SOME_PREFIX
            ? $url_prefix
            : ($target_controller == self::SOME_DATA
                ? $url_params
                : $target_controller);
    }

    /**
     * @param string $url_prefix
     * @param string $url_params
     * @return string
     */
    public function detectMethod(string $url_prefix, string $url_params): string
    {
        $action_arr = explode('@', $this->action());
        $target_method     = $action_arr[1] ?? 'ActionMethod';

        return $target_method == self::SOME_PREFIX
            ? $url_prefix
            : ($target_method == self::SOME_DATA
                ? $url_params
                : $target_method);
    }

    /**
     * @param string $url
     * @return string
     */
    public function removePatternFromUrl(string $url): string
    {
        $tmp_url = str_ireplace($this->softPattern(), '@', $url);
        $tmp_url = str_replace(['/@/', '@/', '/@'], '@', $tmp_url);

        if (strpos($tmp_url, '/') === 0) {
            $tmp_url = substr($tmp_url, 1);
        }

        return $tmp_url;
    }

}
