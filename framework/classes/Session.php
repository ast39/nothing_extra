<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 23.07.2019
 * Time: 12:56
 */

namespace framework\classes;


class Session {

    /**
     * Имя массива пользовательской сессии
     *
     * @return string
     */
    public static function userSession()
    {
        return config('options.session_array');
    }
    
    public static function get($key = false, $global_session = false)
    {
        if (!session_id()) {
            return false;
        }
        
        if (!$global_session && !self::userSession()) {
            return false;
        }
        
        if ($key == false) {
            
            return $global_session 
                ? $_SESSION 
                : $_SESSION[self::userSession()];
        }

        $path = explode(':', $key);
        $target = $global_session 
            ? $_SESSION 
            : $_SESSION[self::userSession()];
        
        foreach ($path as $part) {
            $target = $target[$part] ?? null;
        }

        return $target;
    }

    public static function set($data, $key, $global_session = false)
    {
        if (!session_id()) {
            return false;
        }

        if (!$global_session && !self::userSession()) {
            return false;
        }

        if ($global_session)
            $target =& $_SESSION;
        else
            $target =& $_SESSION[self::userSession()];

        $path = explode(':', $key);

        foreach ($path as $part) {
            $target =& $target[$part];
        }

        $target = $data;
        
        return true;
    }

    public static function remove($key, $global_session = false)
    {
        if (!session_id()) {
            return false;
        }

        if (!$global_session && !self::userSession()) {
            return false;
        }

        if ($global_session)
            $target =& $_SESSION;
        else
            $target =& $_SESSION[self::userSession()];
        
        $path = explode(':', $key);
        $i = 1;

        while ($i < count($path)) {
            $target =& $target[current($path)];
            next($path);
            $i++;
        }

        unset($target[current($path)]);

        return true;
    }
}
