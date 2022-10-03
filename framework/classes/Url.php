<?php

namespace framework\classes;


class Url {

    public static function img($source = null)
    {
        return SITE_FOR_STATIC . 'public/img/' . ($source);
    }

    public static function css($source = null)
    {
        return SITE_FOR_STATIC . 'public/css/' . (str_ireplace('.css', '', $source) . '.css');
    }

    public static function js($source = null)
    {
        return SITE_FOR_STATIC . 'public/js/' . (str_ireplace('.js', '', $source) . '.js');
    }

    public static function site($source = null)
    {
        return Route::siteRootForStatic() . $source;
    }

    public static function admin()
    {
        return Route::siteRootForStatic() . config('options.admin_partition');
    }
}
