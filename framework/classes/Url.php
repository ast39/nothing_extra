<?php

namespace framework\classes;


class Url {

    public static function img($source = null): string
    {
        return SITE_FOR_STATIC . 'public/img/' . ($source);
    }

    public static function css($source = null): string
    {
        return SITE_FOR_STATIC . 'public/css/' . (str_ireplace('.css', '', $source) . '.css');
    }

    public static function js($source = null): string
    {
        return SITE_FOR_STATIC . 'public/js/' . (str_ireplace('.js', '', $source) . '.js');
    }

    public static function scheme(): string
    {
        return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://';
    }

    public static function host(): string
    {
        return $_SERVER['HTTP_HOST'] ?? '';
    }

    public static function path(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '';
    }

    public static function sitePath(): string
    {
        return config('sys.site_dir') ?: '';
    }

    public static function pageController(): string
    {
        return PAGE ?? config('sys.def_page');
    }

    public static function pageMethod(): string
    {
        return PAGE_METHOD ?? config('sys.def_method');
    }

    public static function pageParameters(): array
    {
        return PAGE_QUERY ?? [];
    }

    public static function pageLang(): string
    {
        return config('sys.def_lang');
    }

    public static function isAdminPanel(): bool
    {
        return defined('ADMIN') && ADMIN === true;
    }

    public static function siteRootForStatic(): string
    {
        return self::scheme() . self::host() . '/' . (self::sitePath() ? self::sitePath() . '/' : '');
    }

    public static function siteRoot(): string
    {
        return self::siteRootForStatic()
            . (count(config('sys.site_langs') ?? []) > 1 ? LANG . '/' : '');
    }

    public static function adminRoot(): string
    {
        return self::siteRootForStatic()
            . (count(config('sys.site_langs') ?? []) > 1 ? LANG . '/' : '')
            . config('sys.admin_partition');
    }

    public static function inUrl(string $segment): bool
    {
        return in_array($segment, explode('/', self::siteRoot()));
    }

}
