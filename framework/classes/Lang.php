<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 18:22
 */

namespace framework\classes;

use framework\traits\SingletonCollection;


abstract class Lang {

    use SingletonCollection;

    public function __get($name)
    {
        return property_exists($this, $name)
            ? $this->$name
            : null;
    }
}
